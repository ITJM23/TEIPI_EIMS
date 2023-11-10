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



        if($_POST['action'] == 'register'){

            if(isset($_POST['emp_id']) && isset($_POST['username']) && isset($_POST['pssword'])){

                $emp_Id     = escape($_POST['emp_id']);
                $username   = escape($_POST['username']);
                $password   = escape($_POST['pssword']);

                $query = "SELECT Emp_Acc_Id ";
                $query .="FROM accounts ";
                $query .="WHERE Emp_Id = '$emp_Id' ";

                $fetch = mysqli_query($con4, $query);

                $count = mysqli_num_rows($fetch);

                if($fetch){

                    if($count > 0){
                        
                        echo json_encode('4');
                    }

                    else{

                        $new_password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

                        $query2 = "INSERT INTO accounts (Emp_Id, Username, `Password`, Date_added, Time_added, User_lvl_Id) ";
                        $query2 .="VALUES ('$emp_Id', '$username', '$new_password', curdate(), curtime(), 1) ";

                        $insert2 = mysqli_query($con4, $query2);

                        $last_Id = mysqli_insert_id($con4);

                        if($insert2){

                            setcookie("EIMS_usr_Id", $last_Id, time()+3600 * 24 * 365, '/');
                            setcookie("EIMS_emp_Id", $emp_Id, time()+3600 * 24 * 365, '/');
                            setcookie("EIMS_usrname", $username, time()+3600 * 24 * 365, '/');
                            setcookie("EIMS_usrlvl", 1, time()+3600 * 24 * 365, '/');

                            echo json_encode('1');
                        }

                        else{

                            echo json_encode('2');
                        }
                    }
                }

                else{

                    echo json_encode('2');
                }
            }

            else{

                echo json_encode('3');
            }
        }



        else if($_POST['action'] == 'new_usr_acc'){

            if( isset($_POST['usr_dd']) && 
                isset($_POST['usrname']) &&
                isset($_POST['password']) &&
                isset($_POST['lvl_dd'])) {

                $emp_Id     = escape($_POST['usr_dd']);
                $usrname    = escape($_POST['usrname']);
                $pssword    = escape($_POST['password']);
                $level_Id   = escape($_POST['lvl_dd']);

                $query = "SELECT Emp_Acc_Id ";
                $query .="FROM accounts ";
                $query .="WHERE Emp_Id = '$emp_Id' ";

                $fetch = mysqli_query($con4, $query);

                $count = mysqli_num_rows($fetch);

                if($fetch){

                    if($count == 0){

                        $new_password = password_hash($pssword, PASSWORD_BCRYPT, array('cost' => 12));

                        $query2 = "INSERT INTO accounts (Emp_Id, Username, `Password`, Date_added, Time_added, User_lvl_Id) ";
                        $query2 .="VALUES ('$emp_Id', '$usrname', '$new_password', curdate(), curtime(), '$level_Id') ";

                        $insert2 = mysqli_query($con4, $query2);

                        if($insert2){

                            echo json_encode('1');
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

                    echo json_encode('2');
                }
            }

            else{

                echo json_encode('3');
            }
        }


        
    }

?>