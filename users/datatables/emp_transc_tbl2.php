<?php

// session_start();
include "../includes/db.php"; // Ensure this uses SQL Server connections
include "../includes/functions.php";

//========================== Checking User IDs ===========================
if(isset($_COOKIE['EIMS_emp_Id'])){
    $emp_Id = $_COOKIE['EIMS_emp_Id'];
} else {
    $emp_Id = 0;
}
//========================== Checking User IDs END =======================

$column = array("Trans_Id", "Grand_Total", "Pay_amount", "Trans_change", "Pay_Method", "Date_added", "");

$query = "SELECT DISTINCT Trans_Id, Transc_Id, Emp_Id, Pay_amount, Grand_Total, Trans_change, Pay_amount, Pay_Method, Date_added, Time_added 
          FROM canteen2.transactions 
          WHERE Status = 1 
          AND Emp_Id = ?"; // Using a parameterized query for Emp_Id

$params = array($emp_Id);

if($_POST['datefil1'] != '' && $_POST['datefil2'] != ''){
    $date_fil1 = $_POST['datefil1'];
    $date_fil2 = $_POST['datefil2'];    

    $query .= " AND Date_added BETWEEN ? AND ?";
    $params[] = $date_fil1;
    $params[] = $date_fil2;
} else {
    $query .= " AND Date_added = CONVERT(DATE, GETDATE())"; // SQL Server's current date
}

if(isset($_POST["search"]["value"])){
    $searchValue = $_POST["search"]["value"];
    $query .= " AND Pay_Method LIKE ?";
    $params[] = "%$searchValue%";
}

if(isset($_POST["order"])){
    $query .= " ORDER BY " . $column[$_POST['order']['0']['column']] . " " . $_POST['order']['0']['dir'];
} else {
    $query .= " ORDER BY Date_added DESC, Time_added DESC";
}

$query1 = '';
if($_POST["length"] != -1){
    $query1 = " OFFSET ? ROWS FETCH NEXT ? ROWS ONLY"; // SQL Server's pagination
    $params[] = intval($_POST['start']);
    $params[] = intval($_POST['length']);
}

$fullQuery = $query . $query1;

// Get total records count
$countQuery = "SELECT COUNT(*) AS TotalRecords 
               FROM canteen2.transactions 
               WHERE Status = 1 
               AND Emp_Id = ?";
$countStmt = sqlsrv_query($con, $countQuery, array($emp_Id));
$countResult = sqlsrv_fetch_array($countStmt, SQLSRV_FETCH_ASSOC);
$count = $countResult['TotalRecords'];

// Execute main query
$stmt = sqlsrv_query($con, $fullQuery, $params);
confirmQuery($stmt);

$data = array();
$n = 1;

while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
    $trans_Id = $row['Trans_Id'];
    $pay_amount = $row['Pay_amount'];
    $g_total = $row['Grand_Total'];
    $pay_change = $row['Trans_change'];
    $pay_method = $row['Pay_Method'];
    $date_added = $row['Date_added'];
    $time_added = $row['Time_added'];

    // ================== Get employee info =====================
    $empQuery = "SELECT Lname, Fname FROM Teipi_emp3.emp_info WHERE Emp_Id = ?";
    $empStmt = sqlsrv_query($con2, $empQuery, array($emp_Id));

    if($empStmt){
        $row3 = sqlsrv_fetch_array($empStmt, SQLSRV_FETCH_ASSOC);
        $lname = $row3['Lname'];
        $fname = $row3['Fname'];
        $fullname = $fname . " " . $lname;
    }
    // ================== Get employee info END =================

    $sub_array = array();   
    $sub_array[] = date_format($date_added, 'M d, Y') . " | " . date_format($time_added, 'h:i A');
    $sub_array[] = substr($trans_Id, 0, 10);
    $sub_array[] = "<b>" . $fullname . "</b>";
    $sub_array[] = "<b>" . number_format($g_total, 2) . "</b>";
    $sub_array[] = "<b>" . $pay_method . "</b>";
    $sub_array[] = "
                    <button type='button' class='btn btn-outline-info btn-sm' onclick='viewTransDet(`" . $trans_Id . "`)'><i class='fa fa-search'></i> View</button>
                ";
    $data[] = $sub_array;
}

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsFiltered' => $count,
    'data' => $data
);

echo json_encode($output);

?>
