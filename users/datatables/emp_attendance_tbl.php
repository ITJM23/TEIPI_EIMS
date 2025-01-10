<?php
include "../includes/db.php";
include "../includes/functions.php";

//========================== Checking User IDs ===========================
if(isset($_COOKIE['EIMS_emp_Id'])){
    $emp_Id = $_COOKIE['EIMS_emp_Id'];

    $query0 = "SELECT Emp_Num FROM EmployeeView WHERE Emp_Id = ?";
    $params = array($emp_Id);
    
    $stmt = sqlsrv_query($con2, $query0, $params);

    if($stmt){
        $row0 = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        
        if ($row0) {
            $emp_num0 = $row0['Emp_Num'];
        }
    }
} else {
    $emp_Id = 0;
}
//========================== Checking User IDs END =======================

// Define the SQL query
$sql = "SELECT TDate, Fname, TimeIn, TimeOut FROM dbo.AttendanceView WHERE Emp_Id = ?";
$params = array($emp_Id);

if (!empty($_POST['datefil1']) && !empty($_POST['datefil2'])){
    $date_fil1 = $_POST['datefil1'];
    $date_fil2 = $_POST['datefil2'];    

    $sql .= " AND TDate BETWEEN ? AND ?";
    array_push($params, $date_fil1, $date_fil2);
} else {
    $sql .= " AND TDate = CAST(GETDATE() AS DATE)";
}

$sql .= " ORDER BY TDate DESC";

// Initialize the attendance_arr array
$attendance_arr = array();

$result = sqlsrv_query($con2, $sql, $params);

if ($result === false) {
    die("Query execution failed: " . print_r(sqlsrv_errors(), true));
}

while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $att_date = $row['TDate']->format('Y-m-d');
    $att_fullname = $row['Fname'];

    $converted_time_in = $row['TimeIn'] ? $row['TimeIn']->format('g:i A') : null;
    $converted_time_out = $row['TimeOut'] ? $row['TimeOut']->format('g:i A') : null;
    $converted_date = date("M d, Y", strtotime($att_date));

    $attendance_arr[] = array(
        "date" => $converted_date,
        "fullname" => $att_fullname,
        "timein" => $converted_time_in,
        "timeout" => $converted_time_out
    );
}

$response = array(
    "data" => $attendance_arr
);

echo json_encode($response);
?>
