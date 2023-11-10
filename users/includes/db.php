<?php
	
	// ============ Canteen Database ============
		$servername1 	= "localhost";
		$username1 		= "root";
		$password1 		= "";
		$dbname1 		= "canteen2";

		$con = mysqli_connect($servername1, $username1, $password1, $dbname1, '3308');
	// ============ Canteen Database END ========



	// ============ HR Admin Database ============
		$servername2 	= "localhost";
		$username2 		= "root";
		$password2 		= "";
		$dbname2 		= "teipi_emp2";

		$con2 = mysqli_connect($servername2, $username2, $password2, $dbname2, '3308');
	// ============ HR Admin Database END ========	



	// ============ Health Declaration Database ============
		$servername3 	= "localhost";
		$username3 		= "root";
		$password3 		= "";
		$dbname3 		= "health_declaration";

		$con3 = mysqli_connect($servername3, $username3, $password3, $dbname3, '3308');
	// ============ Health Declaration Database END ========	



	// ============ Employee IMS Database ============
		$servername4 	= "localhost";
		$username4 		= "root";
		$password4 		= "";
		$dbname4 		= "eims";

		$con4 = mysqli_connect($servername4, $username4, $password4, $dbname4, '3308');
	// ============ Employee IMS Database END ========	

	$serverName = "jvaserver";
	$connectionOptions = array(
    "Database" => "TEIPIHRDB",
    "Uid" => "SystemDeveloper",
    "PWD" => "admin"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(print_r(sqlsrv_errors(), true)); // Print detailed error information
}


?>