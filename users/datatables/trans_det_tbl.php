<?php

include "../includes/db.php";
include "../includes/functions.php";

$column = array("Item_name", "Quantity");

// Base query
$query = "SELECT trans_details.Quantity, items.Item_name, items.Price 
          FROM canteen2.trans_details 
          LEFT JOIN canteen2.items ON trans_details.Item_Id = items.Item_Id 
          WHERE NOT Trans_det_Id = '' ";

// Add condition for transaction ID
if ($_POST['transid'] != '') {
    $trans_Id = $_POST['transid'];
    $query .= "AND trans_details.Trans_Id = ? ";
    $params[] = $trans_Id;
} else {
    $params = [];
}

// Add search filter
if (isset($_POST["search"]["value"])) {
    $searchValue = $_POST["search"]["value"];
    $query .= "AND items.Item_name LIKE ? ";
    $params[] = "%$searchValue%";
}

// Add order clause
if (isset($_POST["order"])) {
    $query .= "ORDER BY " . $column[$_POST['order']['0']['column']] . " " . $_POST['order']['0']['dir'] . " ";
} else {
    $query .= "ORDER BY trans_details.Trans_det_Id DESC ";
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
               FROM canteen2.trans_details 
               LEFT JOIN canteen2.items ON trans_details.Item_Id = items.Item_Id 
               WHERE NOT Trans_det_Id = '' ";
if ($_POST['transid'] != '') {
    $countQuery .= "AND trans_details.Trans_Id = ? ";
    $countParams = [$trans_Id];
} else {
    $countParams = [];
}
$countStmt = sqlsrv_query($con, $countQuery, $countParams);
$countResult = sqlsrv_fetch_array($countStmt, SQLSRV_FETCH_ASSOC);
$count = $countResult['TotalRecords'];

// Execute main query
$fullQuery = $query . $query1;
$stmt = sqlsrv_query($con, $fullQuery, $params);

confirmQuery($stmt);

$data = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $item_name  = $row['Item_name'];
    $item_qty   = $row['Quantity'];
    $item_price = $row['Price'];

    $sub_array = array();

    $sub_array[] = substr($item_name, 0, 10) . "...";
    $sub_array[] = $item_qty;

    $g_total = $item_price * $item_qty;

    $sub_array[] = number_format($g_total, 2);

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
