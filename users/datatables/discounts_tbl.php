<?php

include "../includes/db.php";
include "../includes/functions.php";

//========================== Checking User IDs ===========================
if (isset($_COOKIE['EIMS_emp_Id'])) {
    $emp_Id = $_COOKIE['EIMS_emp_Id'];
} else {
    $emp_Id = 0;
}
//========================== Checking User IDs END =======================

$column = array("Disc_name", "Disc_amount");

// Base query
$query = "SELECT trans_disc.Disc_Id, discounts.Disc_name, discounts.Disc_amount 
          FROM canteen2.trans_disc 
          LEFT JOIN canteen2.discounts ON trans_disc.Disc_Id = discounts.Disc_Id 
          WHERE NOT trans_disc.Trans_Id = '' ";

$params = [];

// Add condition for transaction ID
if ($_POST['transid'] != '') {
    $trans_Id = $_POST['transid'];
    $query .= "AND trans_disc.Trans_Id = ? ";
    $params[] = $trans_Id;
}

// Add search filter
if (isset($_POST["search"]["value"])) {
    $searchValue = $_POST["search"]["value"];
    $query .= "AND discounts.Disc_name LIKE ? ";
    $params[] = "%$searchValue%";
}

// Add ordering
if (isset($_POST["order"])) {
    $query .= "ORDER BY " . $column[$_POST['order']['0']['column']] . " " . $_POST['order']['0']['dir'] . " ";
} else {
    $query .= "ORDER BY trans_disc.Trans_D_Id DESC ";
}

// Add pagination
$query1 = '';
if ($_POST["length"] != -1) {
    $query1 = "OFFSET ? ROWS FETCH NEXT ? ROWS ONLY";
    $params[] = intval($_POST['start']);
    $params[] = intval($_POST['length']);
}

// Count total records
$countQuery = "SELECT COUNT(*) AS TotalRecords 
               FROM canteen2.trans_disc 
               LEFT JOIN canteen2.discounts ON trans_disc.Disc_Id = discounts.Disc_Id 
               WHERE NOT trans_disc.Trans_Id = '' ";
$countParams = [];

// Add transaction ID condition for count query
if ($_POST['transid'] != '') {
    $countQuery .= "AND trans_disc.Trans_Id = ? ";
    $countParams[] = $trans_Id;
}

$countStmt = sqlsrv_query($con, $countQuery, $countParams);
$countResult = sqlsrv_fetch_array($countStmt, SQLSRV_FETCH_ASSOC);
$count = $countResult['TotalRecords'];

// Execute main query
$fullQuery = $query . $query1;
$stmt = sqlsrv_query($con, $fullQuery, $params);

confirmQuery($stmt);

$data = array();

// Fetch results
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $disc_name = $row['Disc_name'];
    $disc_amount = $row['Disc_amount'];

    $sub_array = array();
    $sub_array[] = $disc_name;
    $sub_array[] = $disc_amount;

    $data[] = $sub_array;
}

// Prepare output
$output = array(
    'draw' => intval($_POST['draw']),
    'recordsFiltered' => $count,
    'data' => $data
);

echo json_encode($output);

?>
