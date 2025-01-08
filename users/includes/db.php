<?php
	
// ============ Canteen Database ============
$serverName = "IMSERVER";
$connectionOptions = array(
    "Database" => "canteen2",
    "Uid" => "sa",
    "PWD" => "IS@Admin"
);

$con = sqlsrv_connect($serverName, $connectionOptions);

if (!$con) {
    die(print_r(sqlsrv_errors(), true));
} else {
    //echo 'Connect success to canteen2 database';
}

// ============ Canteen Database END ========



// ============ Teipi_emp3 Database ============
$serverName2 = "IMSERVER";
$connectionOptions2 = array(
    "Database" => "Teipi_emp3",
    "Uid" => "sa",
    "PWD" => "IS@Admin"
);

$con2 = sqlsrv_connect($serverName2, $connectionOptions2);

if (!$con2) {
    die(print_r(sqlsrv_errors(), true));
} else {
    //echo 'Connect success to Teipi_emp3 database';
}



?>