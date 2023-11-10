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

// Define the SQL query
//$sql = "SELECT Tdate, Fullname, TimeIn, TimeOut FROM dbo.tblEmp_TimeLog  ORDER BY Tdate ASC";




$sql = "SELECT Tdate, Fullname, TimeIn, TimeOut FROM dbo.tblEmp_TimeLog WHERE Employeenumber = '$emp_num0' ";

if ($_POST['datefil1'] != '' && $_POST['datefil2'] != ''){

    $date_fil1 = $_POST['datefil1'];
    $date_fil2 = $_POST['datefil2'];    

    $sql .="AND Tdate BETWEEN '$date_fil1' AND '$date_fil2' ";
}

else {

    $sql .="AND Tdate = CAST(GETDATE() AS DATE) ";
}

$sql .= "ORDER BY Tdate DESC";





// Initialize the attendance_arr array
$attendance_arr = array();
//$data = array();
//$response = array();

$result = sqlsrv_query($conn, $sql);



if ($result === false) {
    die("Query execution failed: " . sqlsrv_errors());
}

while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $att_date = $row['Tdate']->format('Y-m-d');
    $att_fullname = $row['Fullname'];
    $att_timein = $row['TimeIn']->format('H:i');
    
    //check if Timein is null or not 
    if ($row['TimeIn'] == NULL){
        $att_timein = $row['TimeIn'];
        $converted_time_in = $att_timein;
    }   
    
    else{
        $att_timein = $row['TimeIn']->format('H:i');
        $converted_time_in = date("g:i A", strtotime($att_timein));
    }
    //check if Timein is null or not 
 //==================================================
    //check if Timeout is null or not 
    if ($row['TimeOut'] == NULL){
        $att_timeout = $row['TimeOut'];
        $converted_time_out = $att_timeout;
    }

    else{
        $att_timeout = $row['TimeOut']->format('H:i');
        $converted_time_out = date("g:i A", strtotime($att_timeout));
    }
    //check if Timeout is null or not 


    $converted_date = date("M d, Y", strtotime($att_date));
   
   


    $sub_array = array(
         "date" => $converted_date,
         "fullname" => $att_fullname,
         "timein" => $converted_time_in,
         "timeout" => $converted_time_out
    );

    $attendance_arr[] = $sub_array; // Add the sub-array to the main array



    
    
    

    //print_r($sub_array); // You can process the data here
    
}

$response = array(
    "data" => $attendance_arr
);

    //testing
    //print_r($attendance_arr); // You can process the data here
    //testing
    echo json_encode($response);



    


    ?>