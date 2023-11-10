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


        if($_POST['action'] == 'update_acc'){

            if(isset($_POST['e_username']) && isset($_POST['e_password']) && isset($_POST['e_oldpass'])){

                $e_username = escape($_POST['e_username']);
                $e_password = escape($_POST['e_password']);
                $e_oldpass  = escape($_POST['e_oldpass']);
      

                // =================== Fetching User Password =====================
                    $query0 = "SELECT `Password` FROM accounts WHERE Emp_Id = '$emp_Id' ";
                    $fetch0 = mysqli_query($con4, $query0); 
                    
                    if($fetch0){
                        
                        $row0 = mysqli_fetch_assoc($fetch0);
                        
                        $db_user_password = $row0['Password'];
                    }
                // =================== Fetching User Password END =================
                

                if(password_verify($e_oldpass, $db_user_password)){
                    
                    $e_password = password_hash($e_password, PASSWORD_BCRYPT, array('cost' => 12));

                    $query = "UPDATE accounts SET Username = '$e_username', `Password` = '$e_password' ";
                    $query .="WHERE Emp_Id = '$emp_Id' ";

                    $update = mysqli_query($con4, $query);

                    if($update){    

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

                echo json_encode('3');
            }

        }


        else if($_POST['action'] == 'edit_usr_acc'){

            if( isset($_POST['e_usr_Id']) && 
                isset($_POST['e_usrname']) && 
                isset($_POST['e_password']) && 
                isset($_POST['e_lvl_dd'])){

                $usr_Id     = escape($_POST['e_usr_Id']);
                $usrname    = escape($_POST['e_usrname']);
                $usrpass    = escape($_POST['e_password']);
                $usr_lvl    = escape($_POST['e_lvl_dd']);

                if($usrpass != ''){

                    $new_password = password_hash($usrpass, PASSWORD_BCRYPT, array('cost' => 12));
    
                    $query = "UPDATE accounts SET Username = '$usrname', `Password` = '$new_password', User_lvl_Id = '$usr_lvl' ";
                    $query .="WHERE Emp_Acc_Id = '$usr_Id' ";
                }

                else{

                    $query = "UPDATE accounts SET Username = '$usrname', User_lvl_Id = '$usr_lvl' ";
                    $query .="WHERE Emp_Acc_Id = '$usr_Id' ";
                }


                $update = mysqli_query($con4, $query);

                if($update){

                    echo json_encode('1');
                }

                else{

                    echo json_encode('2');
                }
            }

            else{

                echo json_encode('3');
            }
        }


        else if($_POST['action'] == 'remove_acc'){

            if(isset($_POST['accid'])){

                $acc_Id = $_POST['accid'];

                $query  = "UPDATE accounts SET `Status` = 0 WHERE Emp_Acc_Id = '$acc_Id' ";
                $update = mysqli_query($con4, $query);

                if($update){

                    echo json_encode('1');
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