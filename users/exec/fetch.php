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
        if ($_POST['action'] == 'user_info') {
            
            $query = "SELECT emp_info.Lname, emp_info.Fname, FORMAT(emp_info.Birthdate, 'yyyy-MM-dd') AS Birthdate, 
                              emp_desig.Pos_Id, emp_position.Emp_pos 
                      FROM Teipi_emp3.emp_info 
                      LEFT JOIN Teipi_emp3.employees 
                             ON emp_info.Emp_Id = employees.Emp_Id 
                      LEFT JOIN Teipi_emp3.emp_desig 
                             ON emp_info.Emp_Id = emp_desig.Emp_Id 
                      LEFT JOIN Teipi_emp3.emp_position 
                             ON emp_desig.Pos_Id = emp_position.Emp_Pos_Id 
                      WHERE emp_info.Emp_Id = ?";
            $params = array($emp_Id);
            $stmt = sqlsrv_prepare($con2, $query, $params);
        
            if (!$stmt) {
                die(print_r(sqlsrv_errors(), true));
            }
        
            if (sqlsrv_execute($stmt)) {
                $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                if ($row) {
                    $arr = array(
                        'Fname'  => $row['Fname'] ?? 'N/A',
                        'Lname'  => $row['Lname'] ?? 'N/A',
                        'Bdate'  => $row['Birthdate'] ?? '0000-00-00',
                        'EmpPos' => $row['Emp_pos'] ?? 'Unknown',
                        
                    );
        
                    echo json_encode($arr);
                } else {
                    echo json_encode(['error' => 'No data found']);
                }
            } else {
                die(print_r(sqlsrv_errors(), true));
            }
        }
        

        
        // =================== Included ===================
        if ($_POST['action'] == 'login') {   
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
        
                $query = "SELECT Emp_Acc_Id, Emp_Id, Username, Password, User_lvl_Id 
                          FROM eims.accounts 
                          WHERE Username = ? AND Status = 1";
        
                // Prepare the statement to prevent SQL injection
                $params = array($username);
                $stmt = sqlsrv_prepare($con3, $query, $params);
        
                if (!$stmt) {
                    die(print_r(sqlsrv_errors(), true));
                }
        
                if (sqlsrv_execute($stmt)) {
                    if (sqlsrv_has_rows($stmt)) {
                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                            $db_user_Id = $row['Emp_Acc_Id'];
                            $db_emp_Id = $row['Emp_Id'];
                            $db_username = $row['Username'];
                            $db_user_password = $row['Password'];
                            $db_user_lvl = $row['User_lvl_Id'];
                        }
        
                        if (isset($db_user_password)) {
                            if (password_verify($password, $db_user_password)) {
                                setcookie("EIMS_usr_Id", $db_user_Id, time() + 3600 * 24 * 365, '/');
                                setcookie("EIMS_emp_Id", $db_emp_Id, time() + 3600 * 24 * 365, '/');
                                setcookie("EIMS_usrname", $db_username, time() + 3600 * 24 * 365, '/');
                                setcookie("EIMS_usrlvl", $db_user_lvl, time() + 3600 * 24 * 365, '/');
        
                                echo json_encode('1'); // Successful login
                            } else {
                                echo json_encode('2'); // Password mismatch
                            }
                        } else {
                            echo json_encode('2'); // Password not found
                        }
                    } else {
                        echo json_encode('4'); // User not found or inactive
                    }
                } else {
                    die(print_r(sqlsrv_errors(), true));
                }
            } else {
                echo json_encode('3'); // Missing username or password
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
        else if ($_POST['action'] == 'total_credits') {
            if (isset($_POST['datefil1']) && isset($_POST['datefil2'])) {
                $date_fil1 = $_POST['datefil1'];
                $date_fil2 = $_POST['datefil2'];
        
                $query = "SELECT SUM(Grand_Total) AS Total 
                          FROM canteen2.transactions 
                          WHERE Status = 1 AND Pay_Method = 'Credit'";
        
                if ($date_fil1 != '' && $date_fil2 != '') {
                    $query .= " AND Date_added BETWEEN ? AND ?";
                    $params = array($date_fil1, $date_fil2);
                } else {
                    $query .= " AND CAST(Date_added AS DATE) = CAST(GETDATE() AS DATE)";
                    $params = array();
                }
        
                $query .= " AND Emp_Id = ?";
                $params[] = $emp_Id;
        
                $fetch = sqlsrv_query($con, $query, $params);
        
                if ($fetch) {
                    $row = sqlsrv_fetch_array($fetch, SQLSRV_FETCH_ASSOC);
        
                    $total = $row['Total'] ?? 0; // Default to 0 if no rows match
        
                    echo json_encode(number_format($total, 2));
                }
            }
        }
        

        
        
        // =============== Included ==============
        else if ($_POST['action'] == 'count_c_transc') {
            $query = "SELECT COUNT(Trans_Id) AS Total 
                      FROM canteen2.transactions 
                      WHERE Status = 1";
        
            $params = [];
        
            if (!empty($_POST['datefil1']) && !empty($_POST['datefil2'])) {
                $date_fil1 = $_POST['datefil1'];
                $date_fil2 = $_POST['datefil2'];
        
                $query .= " AND Date_added BETWEEN ? AND ?";
                $params[] = $date_fil1;
                $params[] = $date_fil2;
            } else {
                $query .= " AND CAST(Date_added AS DATE) = CAST(GETDATE() AS DATE)";
            }
        
            $query .= " AND Emp_Id = ?";
            $params[] = $emp_Id;
        
            $fetch = sqlsrv_query($con, $query, $params);
        
            if ($fetch) {
                $row = sqlsrv_fetch_array($fetch, SQLSRV_FETCH_ASSOC);
        
                $total = $row['Total'] ?? 0; // Handle null case
        
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
        else if ($_POST['action'] == 'total_cash') {
            if (isset($_POST['datefil1']) && isset($_POST['datefil2'])) {
                $date_fil1 = $_POST['datefil1'];
                $date_fil2 = $_POST['datefil2'];
        
                $query = "SELECT SUM(Grand_Total) AS Total 
                          FROM canteen2.transactions 
                          WHERE Status = 1 AND Pay_Method = 'Cash'";
        
                if ($date_fil1 != '' && $date_fil2 != '') {
                    $query .= " AND Date_added BETWEEN ? AND ?";
                    $params = array($date_fil1, $date_fil2);
                } else {
                    $query .= " AND CAST(Date_added AS DATE) = CAST(GETDATE() AS DATE)";
                    $params = array();
                }
        
                $query .= " AND Emp_Id = ?";
        
                $params[] = $emp_Id;
        
                $fetch = sqlsrv_query($con, $query, $params);
        
                if ($fetch) {
                    $row = sqlsrv_fetch_array($fetch, SQLSRV_FETCH_ASSOC);
        
                    $total = $row['Total'] ?? 0; // Handle null case
        
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
        else if ($_POST['action'] == 'discount_cards') {

            $query = "SELECT Disc_Id, Disc_name, Disc_amount 
                      FROM discounts 
                      WHERE Status = 1";
        
            $stmt = sqlsrv_query($con, $query);
        
            $cutoff_val = $_POST['cutoffval'] ?? ''; // Default to an empty string if not provided
        
            $output = '';
        
            if ($stmt) {
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        
                    $disc_Id = $row['Disc_Id'];
                    $disc_name = $row['Disc_name'];
                    $disc_amount = $row['Disc_amount'];
        
                    $query2 = "SELECT transactions.Trans_Id, trans_disc.Trans_D_Id 
                               FROM transactions 
                               LEFT JOIN trans_disc 
                               ON transactions.Trans_Id = trans_disc.Trans_Id 
                               WHERE transactions.Status = 1 
                               AND transactions.Emp_Id = ? 
                               AND trans_disc.Disc_Id = ?";
        
                    $params2 = [$emp_Id, $disc_Id];
        
                    // Add conditions based on cutoff value
                    if ($cutoff_val == '1st') {
                        $first_date = date('Y-m-01', strtotime("now"));
                        $last_date = date('Y-m-d', strtotime('+14 days', strtotime($first_date)));
                        $query2 .= " AND transactions.Date_added BETWEEN ? AND ?";
                        array_push($params2, $first_date, $last_date);
                    } elseif ($cutoff_val == '2nd') {
                        $date = strtotime("now");
                        $no_of_days = cal_days_in_month(CAL_GREGORIAN, date('m', $date), date('Y', $date));
                        $last_date = strtotime(date("Y-m-t", $date));
                        $day = date("Y-m-d", $last_date);
        
                        if ($no_of_days == 31) {
                            $first_date = date('Y-m-d', strtotime('-15 days', strtotime($day)));
                        } elseif ($no_of_days == 30) {
                            $first_date = date('Y-m-d', strtotime('-14 days', strtotime($day)));
                        } elseif ($no_of_days == 28) {
                            $first_date = date('Y-m-d', strtotime('-12 days', strtotime($day)));
                        }
        
                        $query2 .= " AND transactions.Date_added BETWEEN ? AND ?";
                        array_push($params2, $first_date, $day);
                    } elseif ($cutoff_val == 'Today') {
                        $today = date('Y-m-d');
                        $query2 .= " AND transactions.Date_added = ?";
                        array_push($params2, $today);
                    } elseif ($cutoff_val == 'date_range') {
                        if (!empty($_POST['date1']) && !empty($_POST['date2'])) {
                            $date1 = $_POST['date1'];
                            $date2 = $_POST['date2'];
                            $query2 .= " AND transactions.Date_added BETWEEN ? AND ?";
                            array_push($params2, $date1, $date2);
                        }
                    } else {
                        $query2 .= " AND YEAR(transactions.Date_added) = YEAR(GETDATE()) 
                                     AND MONTH(transactions.Date_added) = MONTH(GETDATE())";
                    }
        
                    $stmt2 = sqlsrv_query($con, $query2, $params2);
        
                    if ($stmt2) {
                        $grand_total = 0;
                        $n = 0;
        
                        while ($row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
                            $grand_total += $disc_amount;
                            $n++;
                        }
                    }
        
                    if (sqlsrv_num_rows($stmt) > 3) {
                        $output .= '<div class="col-lg-4 border-light text-center">';
                    } else {
                        $output .= '<div class="col-lg border-light text-center">';
                    }
        
                    $output .= '<div class="card">';
                    $output .= '<div class="card-body">';
                    $output .= '<h3 class="text-white mb-0 font-weight-bold"> <span>' . $n . '</span></h3><br>';
                    $output .= '<p class="mb-0 text-info small-font">' . $disc_name . ' consumed</p>';
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '</div>';
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



        else if ($_POST['action'] == 'cred_summ_chart') {

            $cutoff_val = [];
        
            // ======================= First Cutoff ====================
            $first_date1 = date('Y-m-01', strtotime("now"));
            $last_date1 = date('Y-m-d', strtotime('+14 days', strtotime($first_date1)));
        
            $query1 = "SELECT SUM(Grand_Total) AS Total 
                       FROM transactions 
                       WHERE Emp_Id = ? AND Status = 1 
                       AND Date_added BETWEEN ? AND ? 
                       AND Pay_Method = 'Credit'";
        
            $params1 = [$emp_Id, $first_date1, $last_date1];
            $stmt1 = sqlsrv_query($con, $query1, $params1);
        
            if ($stmt1) {
                $row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC);
                $total_1 = $row1['Total'] ?? 0; // Default to 0 if NULL
                array_push($cutoff_val, $total_1);
            } else {
                $total_1 = 0; // Default to 0 if query fails
                array_push($cutoff_val, $total_1);
            }
            // ======================= First Cutoff END ================
        
            // ======================= Second Cutoff ===================
            $date = strtotime("now");
            $no_of_days = cal_days_in_month(CAL_GREGORIAN, date('m', $date), date('Y', $date));
            $last_date2 = strtotime(date("Y-m-t", $date)); // Last day of the month
            $day = date("Y-m-d", $last_date2);
        
            if ($no_of_days == 31) {
                $first_date2 = date('Y-m-d', strtotime('-15 days', strtotime($day)));
            } elseif ($no_of_days == 30) {
                $first_date2 = date('Y-m-d', strtotime('-14 days', strtotime($day)));
            } elseif ($no_of_days == 28) {
                $first_date2 = date('Y-m-d', strtotime('-12 days', strtotime($day)));
            }
        
            $query2 = "SELECT SUM(Grand_Total) AS Total 
                       FROM transactions 
                       WHERE Emp_Id = ? AND Status = 1 
                       AND Date_added BETWEEN ? AND ? 
                       AND Pay_Method = 'Credit'";
        
            $params2 = [$emp_Id, $first_date2, $day];
            $stmt2 = sqlsrv_query($con, $query2, $params2);
        
            if ($stmt2) {
                $row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC);
                $total_2 = $row2['Total'] ?? 0; // Default to 0 if NULL
                array_push($cutoff_val, $total_2);
            } else {
                $total_2 = 0; // Default to 0 if query fails
                array_push($cutoff_val, $total_2);
            }
            // ======================= Second Cutoff END ================
        
            // Prepare JSON response
            $arr = array(
                'Total1' => number_format($total_1, 2),
                'Total2' => number_format($total_2, 2),
                'DataSet' => $cutoff_val
            );
        
            echo json_encode($arr);
        }
        



        


        else if ($_POST['action'] == 'weekly_summ_chart') {

            // Calculate dates and day names for the current week
            $dates = [];
            $days = [];
            $weekDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
            foreach ($weekDays as $day) {
                $dates[] = date('Y-m-d', strtotime("$day this week"));
                $days[] = date('l', strtotime("$day this week"));
            }
        
            $cash_dataset = [];
            $credit_dataset = [];
        
            foreach ($dates as $date) {
                // ================== Cash Dataset ====================
                $query1 = "SELECT SUM(Grand_Total) AS Total1 
                           FROM transactions 
                           WHERE Date_added = ? AND Status = 1 AND Pay_Method = 'Cash' 
                           AND Emp_Id = ?";
        
                $params1 = [$date, $emp_Id];
                $stmt1 = sqlsrv_query($con, $query1, $params1);
        
                if ($stmt1) {
                    $row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC);
                    $total_cash = $row1['Total1'] ?? 0; // Default to 0 if NULL
                    array_push($cash_dataset, $total_cash);
                } else {
                    array_push($cash_dataset, 0); // Default to 0 if query fails
                }
        
                // ================== Credit Dataset ====================
                $query2 = "SELECT SUM(Grand_Total) AS Total2 
                           FROM transactions 
                           WHERE Date_added = ? AND Status = 1 AND Pay_Method = 'Credit' 
                           AND Emp_Id = ?";
        
                $params2 = [$date, $emp_Id];
                $stmt2 = sqlsrv_query($con, $query2, $params2);
        
                if ($stmt2) {
                    $row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC);
                    $total_credit = $row2['Total2'] ?? 0; // Default to 0 if NULL
                    array_push($credit_dataset, $total_credit);
                } else {
                    array_push($credit_dataset, 0); // Default to 0 if query fails
                }
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



        if ($_POST['action'] == 'credit_info') {
            $query = "SELECT COUNT(Credit_Id) AS Total 
                      FROM canteen2.emp_credits 
                      WHERE Emp_Id = '$emp_Id'";
        
            $fetch = sqlsrv_query($con, $query);
        
            if ($fetch) {
                $output = '';
        
                $row = sqlsrv_fetch_array($fetch, SQLSRV_FETCH_ASSOC);
                $total = $row['Total'];
        
                if ($total == 0) {
                    // Get Hire Date
                    $query2 = "SELECT Date_hired 
                               FROM canteen2.emp_desig 
                               WHERE Emp_Id = '$emp_Id'";
        
                    $fetch2 = sqlsrv_query($con, $query2);
        
                    if ($fetch2) {
                        $row2 = sqlsrv_fetch_array($fetch2, SQLSRV_FETCH_ASSOC);
                        $date_hired = $row2['Date_hired'];
        
                        $one_month = date('Y-m-d', strtotime($date_hired . " + 1 month"));
                        $currdate = date('Y-m-d', strtotime("now"));
        
                        $datetime1 = date_create($one_month);
                        $datetime2 = date_create($currdate);
        
                        $interval = date_diff($datetime2, $datetime1);
                        $days_left = (int)$interval->format('%R%a');
                    }
        
                    // Output based on remaining days
                    if ($days_left < 0) {
                        $output .= '<div class="card-header">Credit Information</div>';
                        $output .= '<div class="card-body d-flex align-items-center"><br>';
                        $output .= '<span class="fa fa-close p-2" style="background:red; border-radius:100%; font-size:20px;"></span>&nbsp&nbsp';
                        $output .= '<h6>Not Allowed for Credits</h6>';
                        $output .= '</div>';
                    } else {
                        $output .= '<div class="card-header">Credit Information</div>';
                        $output .= '<div class="card-body"><br>';
                        $output .= '<h3><span class="text-warning">' . $days_left . '</span> day/s</h3>';
                        $output .= '<p class="text-muted">before you can transact through credit</p>';
                        $output .= '</div>';
                    }
                } else {
                    $output .= '<div class="card-header">Credit Information</div>';
                    $output .= '<div class="card-body d-flex align-items-center"><br>';
                    $output .= '<span class="fa fa-check p-2" style="background:green; border-radius:100%; font-size:25px;"></span>&nbsp&nbsp';
                    $output .= '<h6>Allowed for Credits</h6>';
                    $output .= '</div>';
                }
        
                echo json_encode($output);
            }
        }
        
    }

?>