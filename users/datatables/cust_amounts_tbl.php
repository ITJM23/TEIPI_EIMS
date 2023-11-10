<?php

    include "../includes/db.php";
    include "../includes/functions.php";

    $column = array("Item_name", "Quantity");

    $query ="SELECT Amount FROM trans_custom WHERE NOT Trans_C_Id = '' ";

    if($_POST['transid'] != ''){

        $trans_Id = $_POST['transid'];

        $query .="AND Trans_Id = '$trans_Id' ";
    }


    if(isset($_POST["search"]["value"])){											

        $query .='AND Amount LIKE "%'.$_POST["search"]["value"].'%" ';
    }

    if(isset($_POST["order"])){

        $query .='ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir']. ' ';
    } 

    else{

        $query .='ORDER BY Trans_C_Id DESC ';
    }

    $query1 ='';

    if($_POST["length"] != -1){

        $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }

    $count = mysqli_num_rows(mysqli_query($con, $query));

    $result = mysqli_query($con, $query . $query1);

    confirmQuery($result);

    $data = array();

    $n = 1;

    while($row = mysqli_fetch_assoc($result)){

        $item_price = $row['Amount'];

        $sub_array = array();

        $sub_array[] = "Custom Amount";
        $sub_array[] = $item_price;

        $data[] = $sub_array;
    }

    $output = array(
        'draw' => intval($_POST['draw']),
        'recordsFiltered' => $count,
        'data' => $data
    );

    echo json_encode($output);

?>