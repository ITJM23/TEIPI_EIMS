<?php
    
    include "../includes/db.php";
    include "../includes/functions.php";

    date_default_timezone_set("Asia/Manila");

    $current_hour = date('H', strtotime("now"));

    //========================== Checking User IDs ===========================
        if(isset($_COOKIE['EIMS_emp_Id'])){

            $emp_Id = $_COOKIE['EIMS_emp_Id'];
        }

        else{

            $emp_Id = 0;
        }
    //========================== Checking User IDs END =======================

    if(isset($_POST['action'])){

        
        // =================== Included ===================
        if($_POST['action'] == 'user_info'){    

            $query = "SELECT emp_info.Lname, emp_info.Fname, emp_info.Birthdate, employees.Image, ";
            $query .="emp_desig.Pos_Id, emp_position.Emp_pos ";
            $query .="FROM emp_info LEFT JOIN employees ";
            $query .="ON emp_info.Emp_Id = employees.Emp_Id ";
            $query .="LEFT JOIN emp_desig ";
            $query .="ON emp_info.Emp_Id = emp_desig.Emp_Id ";
            $query .="LEFT JOIN emp_position ";
            $query .="ON emp_desig.Pos_Id = emp_position.Emp_Pos_Id ";
            $query .="WHERE emp_info.Emp_Id = '$emp_Id' ";

            $fetch = mysqli_query($con2, $query);

            if($fetch){

                $row = mysqli_fetch_assoc($fetch);

                $fname      = $row['Fname'];
                $lname      = $row['Lname'];
                $image      = $row['Image'];
                $emp_pos    = $row['Emp_pos'];
                $bdate      = $row['Birthdate'];

                $arr = array('Fname' => $fname, 'Lname' => $lname, 'Bdate' => $bdate, 'EmpPos' => $emp_pos, 'EmpImg' => $image);

                echo json_encode($arr);
            }
        }

        
        // =================== Included ===================
        else if($_POST['action'] == 'login'){   

            if(isset($_POST['username']) && isset($_POST['password'])){

                $username = escape($_POST['username']);
                $password = escape($_POST['password']);

                $query = "SELECT Emp_Acc_Id, Emp_Id, Username, `Password`, User_lvl_Id ";
                $query .="FROM accounts WHERE Username = '$username' ";
                $query .="AND `Status` = 1 ";

                $fetch = mysqli_query($con4, $query);

                $count = mysqli_num_rows($fetch);

                if($count > 0){

                    while($row = mysqli_fetch_array($fetch)){
                        
                        $db_user_Id         = escape($row['Emp_Acc_Id']);
                        $db_emp_Id          = escape($row['Emp_Id']);
                        $db_username		= escape($row['Username']);
                        $db_user_password 	= escape($row['Password']);
                        $db_user_lvl        = escape($row['User_lvl_Id']);

                    }
    
                    if(isset($db_user_password)){
    
                        if(password_verify($password, $db_user_password)){
    
                            setcookie("EIMS_usr_Id", $db_user_Id, time()+3600 * 24 * 365, '/');
                            setcookie("EIMS_emp_Id", $db_emp_Id, time()+3600 * 24 * 365, '/');
                            setcookie("EIMS_usrname", $db_username, time()+3600 * 24 * 365, '/');
                            setcookie("EIMS_usrlvl", $db_user_lvl, time()+3600 * 24 * 365, '/');
                            
                            echo json_encode('1');
    
                        }
    
                        else{
    
                            echo json_encode('2');
    
                        }
    
                    }
    
                    else{
    
                        echo json_encode('2');
                    }
    
                }
    
                else{
    
                    echo json_encode('4');
                    
                }
            }

            else{
    
                echo json_encode('3');
                
            }

        }

        

        // =================== Included ===================
        else if($_POST['action'] == 'order_info'){

            if(isset($_POST['transid'])){

                $trans_Id = $_POST['transid'];

                $query = "SELECT Emp_Id, Pay_amount, Grand_Total, Trans_change, Pay_Method, Date_added, Time_added ";
                $query .="FROM transactions ";
                $query .="WHERE Trans_Id = '$trans_Id' ";

                $fetch = mysqli_query($con, $query);

                if($fetch){

                    $row = mysqli_fetch_assoc($fetch);

                    $emp_Id     = $row['Emp_Id'];
                    $pay_amount = $row['Pay_amount'];
                    $g_total    = $row['Grand_Total'];
                    $pay_change = $row['Trans_change'];
                    $pay_method = $row['Pay_Method'];
                    $date_added = $row['Date_added'];
                    $time_added = $row['Time_added'];

                    $date_mod = date('F d, Y', strtotime($date_added)) ." | ". date('h:i A', strtotime($time_added));

                    $query2 = "SELECT Lname, Fname, Mname FROM emp_info WHERE Emp_Id = '$emp_Id' ";
                    $fetch2 = mysqli_query($con2, $query2);

                    if($fetch2){

                        $row2 = mysqli_fetch_assoc($fetch2);

                        $lname = $row2['Lname'];
                        $fname = $row2['Fname'];
                        $mname = $row2['Mname'];

                        $arr = array(
                            'DateMod' => $date_mod,
                            'Payment' => number_format($pay_amount, 2),
                            'GTotal' => number_format($g_total, 2),
                            'PChange' => number_format($pay_change, 2),
                            'PMethod' => $pay_method,
                            'Lname' => $lname,
                            'Fname' => $fname,
                            'Mname' => $mname
                        );

                        echo json_encode($arr);
                    }


                }
            }
        }



        // ====================== Included =================
        else if($_POST['action'] == 'total_credits'){

            if(isset($_POST['datefil1']) && isset($_POST['datefil2'])){

                $date_fil1 = $_POST['datefil1'];
                $date_fil2 = $_POST['datefil2'];

                $query ="SELECT SUM(Grand_Total) as Total FROM transactions ";
                $query .="WHERE Status = 1 AND Pay_Method = 'Credit' ";

                if($_POST['datefil1'] != '' && $_POST['datefil2'] != ''){

                    $date_fil1 = $_POST['datefil1'];
                    $date_fil2 = $_POST['datefil2'];

                    $query .="AND Date_added BETWEEN '$date_fil1' AND '$date_fil2' ";
                }

                else{

                    $query .="AND Date_added = curdate() ";
                }

                $query .="AND Emp_Id = '$emp_Id' ";

                $fetch = mysqli_query($con, $query);

                if($fetch){

                    $row = mysqli_fetch_assoc($fetch);

                    $total = $row['Total'];

                    echo json_encode(number_format($total, 2));
                }
            }
        }

        
        
        // =============== Included ==============
        else if($_POST['action'] == 'count_c_transc'){

            $query ="SELECT COUNT(Trans_Id) as Total ";
            $query .="FROM transactions ";
            $query .="WHERE Status = 1 ";
            
            if($_POST['datefil1'] != '' && $_POST['datefil2'] != ''){

                $date_fil1 = $_POST['datefil1'];
                $date_fil2 = $_POST['datefil2'];

                $query .="AND Date_added BETWEEN '$date_fil1' AND '$date_fil2' ";
            }

            else{

                $query .="AND Date_added = curdate() ";
            }

            $query .="AND Emp_Id = '$emp_Id' ";

            $fetch = mysqli_query($con, $query);

            if($fetch){

                $row = mysqli_fetch_assoc($fetch);

                $total = $row['Total'];

                echo json_encode($total);
            }
        }
        


        // ============== Included =============
        else if($_POST['action'] == 'change_bg'){

            if(isset($_POST['colorid'])){

                $color_Id = $_POST['colorid'];

                setcookie("EIMS_bg_color", $color_Id, time()+3600 * 24 * 365, '/');
            }
        }

        

        // ============= Included ============
        else if($_POST['action'] == 'get_bg_cookie'){

            $cookie_val = $_COOKIE['EIMS_bg_color'];

            echo json_encode($cookie_val);
        }



        // ================= Included =================
        else if($_POST['action'] == 'total_cash'){

            if(isset($_POST['datefil1']) && isset($_POST['datefil2'])){

                $date_fil1 = $_POST['datefil1'];
                $date_fil2 = $_POST['datefil2'];

                $query ="SELECT SUM(Grand_Total) as Total FROM transactions ";
                $query .="WHERE Status = 1 AND Pay_Method = 'Cash' ";

                if($_POST['datefil1'] != '' && $_POST['datefil2'] != ''){

                    $date_fil1 = $_POST['datefil1'];
                    $date_fil2 = $_POST['datefil2'];

                    $query .="AND Date_added BETWEEN '$date_fil1' AND '$date_fil2' ";
                }

                else{

                    $query .="AND Date_added = curdate() ";
                }

                $query .="AND Emp_Id = '$emp_Id' ";

                $fetch = mysqli_query($con, $query);

                if($fetch){

                    $row = mysqli_fetch_assoc($fetch);

                    $total = $row['Total'];

                    echo json_encode(number_format($total, 2));
                }
            }
        }



        // =================== Included ==============
        else if($_POST['action'] == 'get_cutoff'){

            if(isset($_POST['coval'])){

                $cutoff_val = $_POST['coval'];

                if($cutoff_val == '1st'){

                    $first_date = date('Y-m-01', strtotime("now"));
                    $last_date  = date('Y-m-d', strtotime('+14 days', strtotime($first_date)));

                    // $day = date("Y-m-d", $last_date);

                    $arr = array(
                        'FirstDate' => $first_date,
                        'LastDate' => $last_date
                    );

                    echo json_encode($arr);
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

                    $arr = array(
                        'FirstDate' => $first_date,
                        'LastDate' => $day
                    );

                    echo json_encode($arr);

                }

                else if($cutoff_val == 'Today'){

                    $date = date("Y-m-d", strtotime("now"));

                    $arr = array(
                        'FirstDate' => $date,
                        'LastDate' => $date
                    );

                    echo json_encode($arr);
                }

                else{

                    $date = strtotime("now");

                    $first_date = date('Y-m-01', $date);
                    $last_date  = strtotime(date("Y-m-t", $date ));
                    $day        = date("Y-m-d", $last_date);

                    $arr = array(
                        'FirstDate' => $first_date,
                        'LastDate' => $day
                    );

                    echo json_encode($arr);
                }
            }
        }


        
        else if($_POST['action'] == 'emp_info'){

            if(isset($_POST['emphash'])){

                $emp_hash = $_POST['emphash'];

                $query = "SELECT employees.Emp_Id, emp_info.Lname, emp_info.Fname, emp_info.Mname ";
                $query .="FROM employees LEFT JOIN emp_info ";
                $query .="ON employees.Emp_Id = emp_info.Emp_Id ";
                $query .="WHERE employees.Emp_Hash = '$emp_hash' AND employees.Status = 1 ";

                $fetch = mysqli_query($con2, $query);

                $count = mysqli_num_rows($fetch);

                if($fetch){

                    if($count > 0){

                        $row = mysqli_fetch_assoc($fetch);
    
                        $emp_Id = $row['Emp_Id'];
                        $lname  = $row['Lname'];
                        $fname  = $row['Fname'];
    
                        $fullname = $fname ." ". $lname;
    
                        $arr = array(
                            'EmpId' => $emp_Id,
                            'Lname' => $lname,
                            'Fname' => $fname,
                            'FullName' => $fullname,
                            'EmpCount' => $count
                        );
                    }

                    else{

                        $arr = array(
                            'EmpId' => "",
                            'Lname' => "",
                            'Fname' => "",
                            'FullName' => "",
                            'EmpCount' => 0
                        );
    
                    }
                    
                    echo json_encode($arr);
                }
            }
        }


        // ===================== Dashboard Functions =======================
        else if($_POST['action'] == 'discount_cards'){

            $query = "SELECT Disc_Id, Disc_name, Disc_amount ";
            $query .="FROM discounts ";
            $query .="WHERE Status = 1 ";

            $fetch = mysqli_query($con, $query);

            $count = mysqli_num_rows($fetch);

            // ================= Cutoff Checker =================
                if($_POST['cutoffval'] != ''){
                    
                    $cutoff_val = $_POST['cutoffval'];
                }
                
                else{
                    
                    $cutoff_val = '';
                }
            // ================= Cutoff Checker END =============

            $output ='';

            if($fetch){

                while($row = mysqli_fetch_assoc($fetch)){ //jm
                    
                    $disc_Id        = $row['Disc_Id'];
                    $disc_name      = $row['Disc_name'];
                    $disc_amount    = $row['Disc_amount'];
                    
                    
                    $query2 = "SELECT transactions.Trans_Id, trans_disc.Trans_D_Id ";
                    $query2 .="FROM transactions ";
                    $query2 .="LEFT JOIN trans_disc ";
                    $query2 .="ON transactions.Trans_Id = trans_disc.Trans_Id ";
                    $query2 .="WHERE transactions.Status = 1 ";
                    $query2 .="AND transactions.Emp_Id = '$emp_Id' AND trans_disc.Disc_Id = '$disc_Id' ";
                    
                    if($cutoff_val == '1st'){

                        $first_date = date('Y-m-01', strtotime("now"));
                        $last_date  = date('Y-m-d', strtotime('+14 days', strtotime($first_date)));

                        $query2 .="AND transactions.Date_added BETWEEN '$first_date' AND '$last_date' ";
    
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

                        $query2 .="AND transactions.Date_added BETWEEN '$first_date' AND '$day' ";
    
                    }

                    else if($cutoff_val == 'Today'){

                        $query2 .="AND transactions.Date_added = curdate() ";
                    }

                    else if($cutoff_val == 'date_range'){

                        if($_POST['date1'] != '' && $_POST['date2'] != ''){

                            $date1 = $_POST['date1'];
                            $date2 = $_POST['date2'];

                            $query2 .="AND transactions.Date_added BETWEEN '$date1' AND '$date2' ";
                        }
                    }

                    else{

                        $query2 .= "AND YEAR(transactions.Date_added) = YEAR(curdate()) AND MONTH(transactions.Date_added) = MONTH(curdate())"; //jm

                    }

                    // $query2 .="AND Date_added ";
                    
                    $fetch2 = mysqli_query($con, $query2);
                    
                    if($fetch2){
                        
                        $grand_total = 0;

                        $n = 0;

                        while($row2 = mysqli_fetch_assoc($fetch2)){

                            $grand_total += $disc_amount;

                            $n++;

                        }
                        
                    }

                    if($count > 3){

                        $output .='<div class="col-lg-4 border-light text-center">';
                    
                    }

                    else{

                        $output .='<div class="col-lg border-light text-center">'; //jm
                    }
                    
                    $output .='<div class="card">';
                    $output .='<div class="card-body">';
                    // $output .='<h4 class="text-white mb-0 font-weight-bold"> <span>P'.number_format($grand_total, 2).'</span></h4><br>';
                    $output .='<h3 class="text-white mb-0 font-weight-bold"> <span>'.$n.'</span></h3><br>';
                    $output .='<p class="mb-0 text-info small-font">'.$disc_name.' consumed</p>';
                    $output .='</div>';
                    $output .='</div>';
                    $output .='</div>';
                }
            }

            echo json_encode($output);
        }
        // ===================== Dashboard Functions END ===================

        

        // =================== Included ===============
        else if($_POST['action'] == 'discounts_card'){

            $query = "SELECT Disc_Id, Disc_name FROM discounts WHERE `Status` = 1 ";
            $fetch = mysqli_query($con, $query);

            if($fetch){

                $output ='';

                while($row = mysqli_fetch_assoc($fetch)){

                    $disc_Id    = $row['Disc_Id'];
                    $disc_name  = $row['Disc_name'];

                    $query2 = "SELECT trans_disc.Disc_Id, transactions.Trans_Id, SUM(discounts.Disc_amount) as Total ";
                    $query2 .="FROM trans_disc LEFT JOIN transactions ";
                    $query2 .="ON trans_disc.Trans_Id = transactions.Trans_Id ";
                    $query2 .="LEFT JOIN discounts ";
                    $query2 .="ON trans_disc.Disc_Id = discounts.Disc_Id ";
                    $query2 .="WHERE trans_disc.Disc_Id = '$disc_Id' ";
                    $query2 .="AND transactions.Emp_Id = '$emp_Id' ";
                    $query2 .="AND transactions.Status = 1 ";

                    if($_POST['datefil1'] != '' && $_POST['datefil2'] != ''){

                        $date_fil1 = $_POST['datefil1'];
                        $date_fil2 = $_POST['datefil2'];

                        $query2 .="AND transactions.Date_added BETWEEN '$date_fil1' AND '$date_fil2' ";
                    }

                    else{

                        $query2 .="AND transactions.Date_added = curdate() ";
                    }

                    $fetch2 = mysqli_query($con, $query2);
                    
                    if($fetch2){

                        $row2 = mysqli_fetch_assoc($fetch2);

                        $total_amount = $row2['Total'];

                    }

                    $output .='<div class="col-lg-4 text-center">';
                    $output .='<div class="card">';
                    $output .='<div class="card-body text-warning">';
                    $output .='<h4 class="mb-0 font-weight-bold"><span id="total_cash">P'.number_format($total_amount,2).'</span></h4><br>';
                    $output .='<p class="mb-0 small-font">Total '.$disc_name.' Amount <span class="float-right text-success" style="font-weight:bold"></span></p>';
                    $output .='</div>';
                    $output .='</div>';
                    $output .='</div>';

                }

                echo json_encode($output);
            }
        }



        else if($_POST['action'] == 'cred_summ_chart'){

            $cutoff_val = array();

            // ======================= First Cutoff ====================
                $first_date1 = date('Y-m-01', strtotime("now"));
                $last_date   = date('Y-m-d', strtotime('+14 days', strtotime($first_date1)));

                $query1 = "SELECT Trans_Id, SUM(Grand_Total) as Total ";
                $query1 .="FROM transactions ";
                $query1 .="WHERE Emp_Id = '$emp_Id' AND Status = 1 ";
                $query1 .="AND Date_added BETWEEN '$first_date1' AND '$last_date' ";
                $query1 .="AND Pay_Method = 'Credit' ";

                $fetch1 = mysqli_query($con, $query1);

                if($fetch1){

                    $row1 = mysqli_fetch_assoc($fetch1);

                    $total_1 = $row1['Total'];

                    array_push($cutoff_val, $total_1);
                }
            // ======================= First Cutoff END ================

            // ======================= Second Cutoff =========================
                $date = strtotime("now");

                $no_of_days = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime("now")), date('Y', strtotime("now")) );

                $last_date = strtotime(date("Y-m-t", $date ));

                $day = date("Y-m-d", $last_date);

                if($no_of_days == '31'){

                    $first_date2 = date('Y-m-d', strtotime('-15 days', strtotime($day)));
                }

                else if($no_of_days == '30'){

                    $first_date2 = date('Y-m-d', strtotime('-14 days', strtotime($day)));
                }

                else if($no_of_days == '28'){

                    $first_date2 = date('Y-m-d', strtotime('-12 days', strtotime($day)));
                }

                $query2 = "SELECT Trans_Id, SUM(Grand_Total) as Total ";
                $query2 .="FROM transactions ";
                $query2 .="WHERE Emp_Id = '$emp_Id' AND Status = 1 ";
                $query2 .="AND Date_added BETWEEN '$first_date2' AND '$day' ";
                $query2 .="AND Pay_Method = 'Credit' ";

                $fetch2 = mysqli_query($con, $query2);

                if($fetch2){

                    $row2 = mysqli_fetch_assoc($fetch2);

                    $total_2 = $row2['Total'];

                    array_push($cutoff_val, $total_2);
                }
            // ======================= Second Cutoff END =====================

            $arr = array(
                'Total1' => number_format($total_1, 2),
                'Total2' => number_format($total_2, 2),
                'DataSet' => $cutoff_val
            );

            echo json_encode($arr);

        }



        else if($_POST['action'] == 'health_dec_temp'){

            // =================== Getting Employee ID Number ====================
                $query0 = "SELECT Emp_Num FROM employees WHERE Emp_Id = '$emp_Id' ";
                $fetch0 = mysqli_query($con2, $query0);

                if($fetch0){

                    $row0 = mysqli_fetch_assoc($fetch0);

                    $emp_num = substr($row0['Emp_Num'], 2);

                }
            // =================== Getting Employee ID Number END ================

            $query = "SELECT Temperature, `Status` ";
            $query .="FROM transactions ";
            $query .="WHERE Date_added = curdate() AND Emp_Num = '$emp_num' and randSalt1 = 1 ";

            $fetch = mysqli_query($con3, $query);

            if($fetch){

                $row = mysqli_fetch_assoc($fetch);

                $temperature = $row['Temperature'];
                $temp_stat   = $row['Status'];

                $arr = array(
                    'TempVal' => $temperature,
                    'TempStat' => $temp_stat
                );

                echo json_encode($arr);
            }
        }



        else if($_POST['action'] == 'weekly_summ_chart'){

            $monday_d     = date('Y-m-d', strtotime('monday this week'));
            $tuesday_d    = date('Y-m-d', strtotime('tuesday this week'));
            $wednesday_d  = date('Y-m-d', strtotime('wednesday this week'));
            $thursday_d   = date('Y-m-d', strtotime('thursday this week'));
            $friday_d     = date('Y-m-d', strtotime('friday this week'));
            $saturday_d   = date('Y-m-d', strtotime('saturday this week'));
            // $sunday_d     = date('Y-m-d', strtotime('sunday this week'));

            $monday     = date('l', strtotime('monday this week'));
            $tuesday    = date('l', strtotime('tuesday this week'));
            $wednesday  = date('l', strtotime('wednesday this week'));
            $thursday   = date('l', strtotime('thursday this week'));
            $friday     = date('l', strtotime('friday this week'));
            $saturday   = date('l', strtotime('saturday this week'));
            // $sunday     = date('l', strtotime('sunday this week'));

            $days   = array($monday, $tuesday, $wednesday, $thursday, $friday, $saturday);
            $dates  = array($monday_d, $tuesday_d, $wednesday_d, $thursday_d, $friday_d, $saturday_d); 


            $cash_dataset   = array();
            $credit_dataset = array();

            foreach($dates as $date){

                // ================== Credit Dataset ====================
                    $query1 = "SELECT SUM(Grand_Total) as Total1 ";
                    $query1 .="FROM transactions ";
                    $query1 .="WHERE Date_added = '$date' AND Status = 1 AND Pay_Method = 'Cash' ";
                    $query1 .="AND Emp_Id = '$emp_Id' ";

                    $fetch1 = mysqli_query($con, $query1);

                    if($fetch1){

                        $row1 = mysqli_fetch_assoc($fetch1);

                        $total_cash = $row1['Total1'];

                        array_push($cash_dataset, $total_cash);
                    }
                // ================== Credit Dataset END ================

                // ================== Credit Dataset ====================
                    $query2 = "SELECT SUM(Grand_Total) as Total2 ";
                    $query2 .="FROM transactions ";
                    $query2 .="WHERE Date_added = '$date' AND Status = 1 AND Pay_Method = 'Credit' ";
                    $query2 .="AND Emp_Id = '$emp_Id' ";

                    $fetch2 = mysqli_query($con, $query2);

                    if($fetch2){

                        $row2 = mysqli_fetch_assoc($fetch2);

                        $total_credit = $row2['Total2'];

                        array_push($credit_dataset, $total_credit);
                    }
                // ================== Credit Dataset END ================
            }

            $arr = array(
                'DaysArr' => $days,
                'CashArr' => $cash_dataset,
                'CreditArr' => $credit_dataset
            );

            echo json_encode($arr);
        }



        else if($_POST['action'] == 'check_emp'){

            if(isset($_POST['empnum'])){

                $emp_num = $_POST['empnum'];

                $query = "SELECT COUNT(Emp_Id) as Total, Emp_Id ";
                $query .="FROM employees ";
                $query .="WHERE Emp_Num LIKE '%".$emp_num."%' ";
                $query .="AND randSalt1 = 1 ";
                $query .="LIMIT 1 ";

                $fetch = mysqli_query($con2, $query);

                if($fetch){

                    $row = mysqli_fetch_assoc($fetch);

                    $emp_Id = $row['Emp_Id'];
                    $total  = $row['Total'];

                    
                    if($total > 0){
                        
                        $arr = array(
                            'ResVal' => 1,
                            'EmpId' => $emp_Id
                        );
                        // echo json_encode('1');
                    }

                    else{

                        $arr = array(
                            'ResVal' => 4,
                            'EmpId' => $emp_Id
                        );

                        // echo json_encode('4');
                    }
                }

                else{

                    $arr = array(
                        'ResVal' => 2,
                        'EmpId' => $emp_Id
                    );

                    // echo json_encode('2');
                }

                echo json_encode($arr);

            }

            else{

                $arr = array(
                    'ResVal' => 3,
                    'EmpId' => $emp_Id
                );

                // echo json_encode('3');

                echo json_encode($arr);
            }
        }



        else if($_POST['action'] == 'fetch_acc_info'){

            $query = "SELECT Emp_Acc_Id, Username FROM accounts WHERE Emp_Id = '$emp_Id' ";
            $fetch = mysqli_query($con4, $query);

            if($fetch){

                $row = mysqli_fetch_assoc($fetch);

                $emp_acc_Id = $row['Emp_Acc_Id'];
                $username   = $row['Username'];

                $arr = array(
                    'EmpAccID' => $emp_acc_Id,
                    'UsrName' => $username
                );

                echo json_encode($arr);
            }
        }



        else if($_POST['action'] == 'level_dd'){

            $query = "SELECT User_lvl_Id, User_level ";
            $query .="FROM user_level ";
            $query .="WHERE Status = 1 ";

            $fetch = mysqli_query($con4, $query);

            if($fetch){

                $output ='';

                $output .='<option value="">Select user level here</option>';

                while($row = mysqli_fetch_assoc($fetch)){

                    $usr_lvl_Id = $row['User_lvl_Id'];
                    $user_level = $row['User_level'];

                    $output .='<option value="'.$usr_lvl_Id.'">'.$user_level.'</option>';
                }

                echo json_encode($output);
            }
        }

        

        else if($_POST['action'] == 'emp_dd'){  

            $query = "SELECT employees.Emp_Id, emp_info.Lname, emp_info.Fname ";
            $query .="FROM employees LEFT JOIN emp_info ";
            $query .="ON employees.Emp_Id = emp_info.Emp_Id ";
            $query .="WHERE employees.randSalt1 = 1 AND Status = 1 ";

            $fetch = mysqli_query($con2, $query);

            if($fetch){

                $output ='';

                $output .='<option value="">Select employee here</option>';

                while($row = mysqli_fetch_assoc($fetch)){

                    $emp_Id = $row['Emp_Id'];
                    $lname  = $row['Lname'];
                    $fname  = $row['Fname'];

                    $fullname = $fname ." ". $lname;

                    $output .='<option value="'.$emp_Id.'">'.$fullname.'</option>';
                }

                echo json_encode($output);
            }
        }



        else if($_POST['action'] == 'fetch_acc_info2'){

            if(isset($_POST['accid'])){

                $acc_Id = $_POST['accid'];

                $query = "SELECT Username, User_lvl_Id ";
                $query .="FROM accounts WHERE Emp_Acc_Id = '$acc_Id' LIMIT 1 ";

                $fetch = mysqli_query($con4, $query);

                if($fetch){

                    $row = mysqli_fetch_assoc($fetch);

                    $username   = $row['Username'];
                    $usr_lvl_Id = $row['User_lvl_Id'];

                    $arr = array(
                        'UsrName' => $username,
                        'UsrLvl' => $usr_lvl_Id
                    );

                    echo json_encode($arr);
                }
            }
        }



        else if($_POST['action'] == 'credit_info'){

            $query = "SELECT COUNT(Credit_Id) as Total ";
            $query .="FROM emp_credits ";
            $query .="WHERE Emp_Id = '$emp_Id' ";
            
            $fetch = mysqli_query($con, $query);

            if($fetch){

                $output ='';

                $row = mysqli_fetch_assoc($fetch);

                $total = $row['Total'];

                if($total == 0){


                    // ================ Get Hire Date ================
                        $query2 = "SELECT Date_hired FROM emp_desig WHERE Emp_Id = '$emp_Id' ";
                        $fetch2 = mysqli_query($con2, $query2);

                        confirmQuery($fetch2);

                        if($fetch2){

                            $row2 = mysqli_fetch_assoc($fetch2);

                            $date_hired = $row2['Date_hired'];

                            $one_month  = date('Y-m-d', strtotime($date_hired." + 1 month"));
                            $currdate   = date('Y-m-d', strtotime("now"));

                            $datetime1 = date_create($one_month);
                            $datetime2 = date_create($currdate);
                            
                            // Calculates the difference between DateTime objects
                            $interval = date_diff($datetime2, $datetime1);

                            $days_left = (int)$interval->format('%R%a');

                        }
                    // ================ Get Hire Date END ============

                    if($days_left < 0){

                        $output .='<div class="card-header">Credit Information</div>';
                        $output .='<div class="card-body d-flex align-items-center" ><br>';
                        $output .='<span class="fa fa-close p-2" style="background:red; border-radius:100%; font-size:20px;"></span>&nbsp&nbsp';
                        $output .='<h6>Not Allowed for Credits</h6>';
                        $output .='</div>';
                    }

                    else{

                        $output .='<div class="card-header">Credit Information</div>';
                        $output .='<div class="card-body" ><br>';
                        $output .='<h3> <span class="text-warning">'.$days_left.'</span> day/s</h3>';
                        $output .='<p class="text-muted">before you can transact through credit</p>';
                        $output .='</div>';
                        
                    }


                }

                else{

                    $output .='<div class="card-header">Credit Information</div>';
                    $output .='<div class="card-body d-flex align-items-center" ><br>';
                    $output .='<span class="fa fa-check p-2" style="background:green; border-radius:100%; font-size:25px;"></span>&nbsp&nbsp';
                    $output .='<h6>Allowed for Credits</h6>';
                    $output .='</div>';
                }

                // $output .=$total;

                echo json_encode($output);
            }
        }

    }

?>