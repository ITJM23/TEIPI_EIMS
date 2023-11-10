<?php

    // session_start();

    error_reporting(0);
    
    session_destroy();

    if( isset($_COOKIE["EIMS_usr_Id"]) && 
        isset($_COOKIE["EIMS_emp_Id"]) && 
        isset($_COOKIE["EIMS_usrname"]) ){

        setcookie("EIMS_usr_Id", $_COOKIE["EIMS_usr_Id"], time()-3600 * 24 * 365, '/');
        setcookie("EIMS_emp_Id", $_COOKIE["EIMS_emp_Id"], time()-3600 * 24 * 365, '/');
        setcookie("EIMS_usrname", $_COOKIE["EIMS_usrname"], time()-3600 * 24 * 365, '/');
    
        echo "<script>location.href='../login.php';</script>";

    }
    

?>