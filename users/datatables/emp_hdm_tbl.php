<?php

    include "../includes/db.php";
    include "../includes/functions.php";

    //========================== Checking User IDs ===========================
        if(isset($_COOKIE['EIMS_emp_Id'])){

            $emp_Id = $_COOKIE['EIMS_emp_Id'];

            $query0 = "SELECT Emp_Num FROM employees WHERE Emp_Id = '$emp_Id' ";
            $fetch0 = mysqli_query($con2, $query0);

            if($fetch0){

                $row0 = mysqli_fetch_assoc($fetch0);

                $emp_num0 = $row0['Emp_Num'];
            }
        }

        else{

            $emp_Id = 0;
        }
    //========================== Checking User IDs END =======================

    $column = array("");

    $query ="SELECT Trans_Id, Emp_Num, Temperature, `Status`, Date_added, Time_added ";
    $query .="FROM transactions ";
    $query .="WHERE randSalt1 = 1 ";

    // if($_POST['datefil1'] != '' && $_POST['datefil2'] != ''){

    //     $date_fil1 = $_POST['datefil1'];
    //     $date_fil2 = $_POST['datefil2'];

    //     $query .="AND Date_added BETWEEN '$date_fil1' AND '$date_fil2' ";
    // }

    // else{

        $query .="AND MONTH(Date_added) = MONTH(curdate()) ";
    // }

    $emp_num_val = substr($emp_num0, 2);

    $query .="AND Emp_Num = '$emp_num_val' ";

    if(isset($_POST["search"]["value"])){											

        $query .='AND (Emp_Num LIKE "%'.$_POST["search"]["value"].'%" ';
        $query .='OR Temperature LIKE "%'.$_POST["search"]["value"].'%" ';
        $query .='OR Status LIKE "%'.$_POST["search"]["value"].'%") ';
    }

    if(isset($_POST["order"])){

        $query .='ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir']. ' ';
    } 

    else{

        $query .='ORDER BY Date_added DESC, Time_added DESC ';
    }

    $query1 ='';

    if($_POST["length"] != -1){

        $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }

    $count = mysqli_num_rows(mysqli_query($con3, $query));

    $result = mysqli_query($con3, $query . $query1);

    confirmQuery($result);

    $data = array();

    $n = 1;

    while($row = mysqli_fetch_assoc($result)){

        $trans_Id       = $row['Trans_Id'];
        $emp_num        = $row['Emp_Num'];
        $temperature    = $row['Temperature'];
        $status         = $row['Status'];
        $date_added     = $row['Date_added'];
        $time_added     = $row['Time_added'];

        $emp_class1 = "TP".$emp_num;
        $emp_class2 = "CP".$emp_num;
        $emp_class3 = "SG".$emp_num;

        $date_mod = date('F d, Y', strtotime($date_added)) ." | ". date('h:i A', strtotime($time_added));

        $sub_array = array();

        $sub_array[] = "<p class='font-weight-bold'>".$date_mod."</b>";

        if($temperature > floatval(37.4)){

            $sub_array[] = "<h4><span class='text-danger font-weight-bold'>".$temperature."</span></h4>";
        }

        else{

            $sub_array[] = "<h4><span class='text-success font-weight-bold'>".$temperature."</span></h4>";
        }

        if($status == 'Allowed'){

            $sub_array[] = "<h4><span class='badge badge-success font-weight-bold'>".$status."</span></h4>";
        }

        else{

            $sub_array[] = "<h4><span class='badge badge-danger font-weight-bold'>".$status."</span></h4>";
        }


        $data[] = $sub_array;
    }

    $output = array(
        'draw' => intval($_POST['draw']),
        'recordsFiltered' => $count,
        'data' => $data
    );

    echo json_encode($output);

?>