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

    $query ="SELECT accounts.Emp_Acc_Id, accounts.Emp_Id, user_level.User_level, user_level.Date_added, accounts.Status ";
    $query .="FROM accounts LEFT JOIN user_level ";
    $query .="ON accounts.User_lvl_Id = user_level.User_lvl_Id ";
    $query .="WHERE accounts.Status = 1 AND NOT accounts.Emp_Id = '$emp_Id' ";

    if($_POST['usrfil'] != ''){

        $usr_Id = $_POST['usrfil'];

        $query .="AND accounts.Emp_Id = '$usr_Id' ";
    }

    if($_POST['lvlfil'] != ''){

        $level_Id = $_POST['lvlfil'];

        $query .="AND user_level.User_lvl_Id = '$level_Id' ";
    }

    if($_POST['statfil'] != ''){

        $stat_Id = $_POST['statfil'];

        $query .="AND accounts.Status = '$stat_Id' ";
    }

    if(isset($_POST["search"]["value"])){											

        $query .='AND User_level LIKE "%'.$_POST["search"]["value"].'%" ';
    }

    if(isset($_POST["order"])){

        $query .='ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir']. ' ';
    } 

    else{

        $query .='ORDER BY accounts.Date_added DESC, accounts.Time_added DESC ';
    }

    $query1 ='';

    if($_POST["length"] != -1){

        $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }

    $count = mysqli_num_rows(mysqli_query($con4, $query));

    $result = mysqli_query($con4, $query . $query1);

    confirmQuery($result);

    $data = array();

    $n = 1;

    while($row = mysqli_fetch_assoc($result)){

        $emp_acc_Id = $row['Emp_Acc_Id'];
        $usr_emp_id = $row['Emp_Id'];
        $user_level = $row['User_level'];
        $date_added = $row['Date_added'];
        $acc_stat   = $row['Status'];

        $query2 = "SELECT Fname, Lname FROM emp_info WHERE Emp_Id = '$usr_emp_id' ";
        $fetch2 = mysqli_query($con2, $query2);

        if($fetch2){

            $row2 = mysqli_fetch_assoc($fetch2);

            $fname = $row2['Fname'];
            $lname = $row2['Lname'];

            $fullname = $fname ." ". $lname;
        }

        $date_mod = date('F d, Y', strtotime($date_added));

        $sub_array = array();

        $sub_array[] = "<p class='font-weight-bold'>".$fullname."</b>";
        $sub_array[] = "<p class='font-weight-bold'>".$date_mod."</b>";
        $sub_array[] = $user_level;

        if($acc_stat == 1){
            
            $sub_array[] = "<span class='badge badge-success'>Active</span>";
        }
        
        else{
            
            $sub_array[] = "<span class='badge badge-danger'>Inactive</span>";
        }
        
        $sub_array[] = "
            <button type='button' class='btn btn-outline-primary' onclick='editAcc(`".$emp_acc_Id."`)'>Edit</button>
            <button type='button' class='btn btn-outline-danger' onclick='setAsInactive(`".$emp_acc_Id."`)'>Delete</button>
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