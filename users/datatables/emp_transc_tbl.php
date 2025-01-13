<?php

// session_start();
include "../includes/db.php";
include "../includes/functions.php";

//========================== Checking User IDs ===========================
if (isset($_COOKIE['EIMS_emp_Id'])) {
    $emp_Id = $_COOKIE['EIMS_emp_Id'];
} else {
    $emp_Id = 0;
}
//========================== Checking User IDs END =======================

$column = array("Trans_Id", "Grand_Total", "Pay_amount", "Trans_change", "Pay_Method", "Date_added", "");

$query = "SELECT DISTINCT Trans_Id, Transc_Id, Emp_Id, Pay_amount, Grand_Total, Trans_change, Pay_Method, Date_added, Time_added ";
$query .= "FROM canteen2.transactions ";
$query .= "WHERE Status = 1 ";
$query .= "AND Emp_Id = ? ";

$params = array($emp_Id);

if (isset($_POST['cutoffval']) && $_POST['cutoffval'] != '') {
    $cutoff_val = $_POST['cutoffval'];
} else {
    $cutoff_val = '';
}

if ($cutoff_val == '1st') {
    $first_date = date('Y-m-01', strtotime("now"));
    $last_date = date('Y-m-d', strtotime('+14 days', strtotime($first_date)));

    $query .= "AND Date_added BETWEEN ? AND ? ";
    array_push($params, $first_date, $last_date);

} elseif ($cutoff_val == '2nd') {
    $date = strtotime("now");
    $no_of_days = cal_days_in_month(CAL_GREGORIAN, date('m', $date), date('Y', $date));
    $last_date = strtotime(date("Y-m-t", $date));
    $day = date("Y-m-d", $last_date);

    if ($no_of_days == '31') {
        $first_date = date('Y-m-d', strtotime('-15 days', strtotime($day)));
    } elseif ($no_of_days == '30') {
        $first_date = date('Y-m-d', strtotime('-14 days', strtotime($day)));
    } elseif ($no_of_days == '28') {
        $first_date = date('Y-m-d', strtotime('-12 days', strtotime($day)));
    }

    $query .= "AND Date_added BETWEEN ? AND ? ";
    array_push($params, $first_date, $day);

} else {
    $query .= "AND MONTH(Date_added) = MONTH(GETDATE()) ";
}

if (isset($_POST["search"]["value"])) {
    $query .= "AND Pay_Method LIKE ? ";
    array_push($params, "%" . $_POST["search"]["value"] . "%");
}

if (isset($_POST["order"])) {
    $query .= "ORDER BY " . $column[$_POST['order']['0']['column']] . " " . $_POST['order']['0']['dir'] . " ";
} else {
    $query .= "ORDER BY Date_added DESC, Time_added DESC ";
}

// Validate length and start for pagination
$query1 = '';
if (isset($_POST["length"]) && is_numeric($_POST["length"]) && $_POST["length"] != -1) {
    $start = isset($_POST['start']) && is_numeric($_POST['start']) ? intval($_POST['start']) : 0;
    $length = intval($_POST["length"]);

    $query1 = "OFFSET ? ROWS FETCH NEXT ? ROWS ONLY";
    array_push($params, $start, $length);
}

$stmt = sqlsrv_query($con, $query . $query1, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$data = array();

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $trans_Id = $row['Trans_Id'];
    $pay_amount = $row['Pay_amount'];
    $g_total = $row['Grand_Total'];
    $pay_change = $row['Trans_change'];
    $pay_method = $row['Pay_Method'];
    $date_added = isset($row['Date_added']) ? $row['Date_added'] : null;
    $time_added = isset($row['Time_added']) ? $row['Time_added'] : null;

    // Validate and format date and time
    if ($date_added && $time_added) {
        // Check if $date_added and $time_added are DateTime objects
        if ($date_added instanceof DateTime) {
            $date_added = $date_added->format('Y-m-d'); // Convert to string in the required format
        }
        if ($time_added instanceof DateTime) {
            $time_added = $time_added->format('H:i:s'); // Convert to string in the required format
        }
    
        // Now process them with strtotime
        if (strtotime($date_added) && strtotime($time_added)) {
            $formatted_date = date('M d, Y', strtotime($date_added)) . " | " . date('h:i A', strtotime($time_added));
        } else {
            $formatted_date = "Invalid date/time";
        }
    } else {
        $formatted_date = "Invalid date/time";
    }
    

    // ================== Get employee info =====================
    $query3 = "SELECT Lname, Fname FROM teipi_emp3.emp_info WHERE Emp_Id = ? ";
    $stmt3 = sqlsrv_query($con2, $query3, array($emp_Id));

    if ($stmt3) {
        $row3 = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC);
        $lname = $row3['Lname'];
        $fname = $row3['Fname'];
        $fullname = $fname . " " . $lname;
    } else {
        $fullname = "N/A";
    }
    // ================== Get employee info END =================

    $sub_array = array();
    $sub_array[] = $formatted_date;
    $sub_array[] = substr($trans_Id, 0, 10);
    $sub_array[] = "<b>" . $fullname . "</b>";
    $sub_array[] = "<b>" . number_format($g_total, 2) . "</b>";
    $sub_array[] = "<b>" . $pay_method . "</b>";
    $sub_array[] = "
                    <button type='button' class='btn btn-outline-info btn-sm' onclick='viewTransDet(`" . $trans_Id . "`)'><i class='fa fa-search'></i> View</button>
                ";

    $data[] = $sub_array;
}

// Count filtered records
$filtered_records_query = "SELECT COUNT(*) AS count FROM canteen2.transactions WHERE Status = 1 AND Emp_Id = ?";
$filtered_stmt = sqlsrv_query($con, $filtered_records_query, array($emp_Id));
$filtered_count = ($filtered_stmt && $row = sqlsrv_fetch_array($filtered_stmt, SQLSRV_FETCH_ASSOC)) ? $row['count'] : 0;

$output = array(
    'draw' => intval($_POST['draw']),
    'recordsFiltered' => $filtered_count,
    'data' => $data
);

echo json_encode($output);

?>
