<?php

    // session_start();
    include "../includes/db.php";
    include "../includes/functions.php";

    //========================== Checking User IDs ===========================
        if(isset($_COOKIE['EIMS_emp_Id'])){

            $emp_Id = $_COOKIE['EIMS_emp_Id'];
        }

        else{

            $emp_Id = 0;
        }
    //========================== Checking User IDs END =======================

    $column = array("Trans_Id", "Grand_Total", "Pay_amount", "Trans_change", "Pay_Method", "Date_added", "");

    $query ="SELECT DISTINCT Trans_Id, Transc_Id, Emp_Id, Pay_amount, Grand_Total, Trans_change, Pay_amount, Pay_Method, Date_added, Time_added ";
    $query .="FROM transactions ";
    $query .="WHERE Status = 1 ";
    $query .="AND Emp_Id = '$emp_Id' ";



    if($_POST['cutoffval'] != ''){

        $cutoff_val = $_POST['cutoffval'];
    }

    else{

        $cutoff_val = '';
    }



    if($cutoff_val == '1st'){

        $first_date = date('Y-m-01', strtotime("now"));
        $last_date  = date('Y-m-d', strtotime('+14 days', strtotime($first_date)));

        $query .="AND Date_added BETWEEN '$first_date' AND '$last_date' ";

    }

    else if($cutoff_val == '2nd'){

        $date = strtotime("now");

        $no_of_days = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime("now")), date('Y', strtotime("now")) );

        $last_date = strtotime(date("Y-m-t", $date ));

        $day = date("Y-m-d", $last_date);

        if($no_of_days == '31'){

            $first_date = date('Y-m-d', strtotime('-15 days', strtotime($day)));
        }

        else if($no_of_days == '30'){

            $first_date = date('Y-m-d', strtotime('-14 days', strtotime($day)));
        }

        else if($no_of_days == '28'){

            $first_date = date('Y-m-d', strtotime('-12 days', strtotime($day)));
        }

        $query .="AND Date_added BETWEEN '$first_date' AND '$day' ";

    }

    else{

        $query .="AND MONTH(Date_added) = MONTH(curdate()) ";

    }



    if(isset($_POST["search"]["value"])){											

        $query .='AND Pay_Method LIKE "%'.$_POST["search"]["value"].'%" ';
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

    $count = mysqli_num_rows(mysqli_query($con, $query));

    $result = mysqli_query($con, $query . $query1);

    confirmQuery($result);

    $data = array();

    $n = 1;

    while($row = mysqli_fetch_assoc($result)){

        $trans_Id       = $row['Trans_Id'];
        $pay_amount     = $row['Pay_amount'];
        $g_total        = $row['Grand_Total'];
        $pay_change     = $row['Trans_change'];
        $pay_method     = $row['Pay_Method'];
        $date_added     = $row['Date_added'];
        $time_added     = $row['Time_added'];

        // ================== Get employee info =====================
            $query3 = "SELECT Lname, Fname FROM emp_info WHERE Emp_Id = '$emp_Id' ";
            $fetch3 = mysqli_query($con2, $query3);

            if($fetch3){

                $row3 = mysqli_fetch_assoc($fetch3);

                $lname = $row3['Lname'];
                $fname = $row3['Fname'];

                $fullname = $fname ." ". $lname;

            }
        // ================== Get employee info END =================
        

        $sub_array = array();   

        $sub_array[] = date('M d, Y', strtotime($date_added)) . " | " . date('h:i A', strtotime($time_added));
        $sub_array[] = substr($trans_Id, 0, 10);
        $sub_array[] = "<b>".$fullname."</b>";
        $sub_array[] = "<b>".number_format($g_total, 2)."</b>";
        $sub_array[] = "<b>".$pay_method."</b>";
        $sub_array[] = "
                        <button type='button' class='btn btn-outline-info btn-sm' onclick='viewTransDet(`".$trans_Id."`)'><i class='fa fa-search'></i> View</button>
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