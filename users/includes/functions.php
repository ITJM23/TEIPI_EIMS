<?php

function confirmQuery($string) {
    global $con;
    if(!$string) {
        die("ERROR" . sqlsrv_errors());
    }
}

function escape($string) {
    global $con;
    return $string;
}


?>