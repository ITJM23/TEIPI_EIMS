<?php
    session_start();
    include "includes/sessions.php";

    date_default_timezone_set("Asia/Manila");
?>

<!DOCTYPE html>

<html lang="en">

  <head>
    
    <meta charset="utf-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <meta name="description" content=""/>

    <meta name="author" content="IS Team | Richard Altre"/>

    <title>IMS | Attendance Record</title>

    <!-- loader-->
    <link href="../assets/css/pace.min.css" rel="stylesheet"/>
    
    <script src="../assets/js/pace.min.js"></script>

    <!--favicon-->
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">

    <!-- Vector CSS -->
    <link href="../assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>

    <!-- simplebar CSS-->
    <link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>

    <!-- Bootstrap core CSS-->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- animate CSS-->
    <link href="../assets/css/animate.css" rel="stylesheet" type="text/css"/>

    <!-- Icons CSS-->
    <!-- <link href="../assets/css/icons.css" rel="stylesheet" type="text/css"/> -->
    <link href="../assets/icons/fontawesome-free-6.0.0-web/css/all.css" rel="stylesheet" type="text/css"/>

    <!-- Sidebar CSS-->
    <link href="../assets/css/sidebar-menu.css" rel="stylesheet"/>

    <link href="../assets/css/dataTables.bootstrap4.css" rel="stylesheet" />
    <link href="../assets/css/responsive.dataTables.min.css" rel="stylesheet" />

    <link href="../assets/css/toastr.min.css" rel="stylesheet">

    <link href="../assets/css/select2.min.css" rel="stylesheet">

    <!-- Custom Style-->
    <link href="../assets/css/app-style.css" rel="stylesheet"/>

    <style>

        /* .select2-search input { background-color: #00f; } */

        .select2-results { color:#000; }

    </style>
    
  </head>

  <body class="bg-theme bg-theme2">

    <!-- Start wrapper-->
      <div id="wrapper">
      
        <?php include "layout/sidebar.php"; ?>

        <?php include "layout/topbar.php"; ?>

        <div class="clearfix"></div>
        
        <div class="content-wrapper">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-8">

                        <div class="card">

                            <div class="card-header">
                                <h4>Attendance Record</h4>
                            </div>

                            <div class="card-body">

                                <!-- <div class="row">

                                    <div class="col-lg-3">
                                        <p><b>From</b></p>
                                        <input type="date" class="form-control" name="date_fil1" id="date_fil1">
                                    </div>

                                    <div class="col-lg-3">
                                        <p><b>To</b></p>
                                        <input type="date" class="form-control" name="date_fil2" id="date_fil2">
                                    </div>

                                    <div class="col-lg">
                                        <p style="color:transparent;">Action</p>
                                        <button type="button" class="btn btn-info" onclick="filterByDate()">Apply</button>
                                    </div>

                                </div>
                                
                                <br><br> -->

                                <div class="row">



                                </div>
                                
                                <br><hr>

                                <div class="row">

                                    <div class="col-lg-4">
                                        <button type="button" class="btn btn-light border-info" onclick="$('#dateFilMod').modal('show')"><span class="fa fa-calendar"></span>&nbsp&nbspFilter by date</button>
                                        <!-- <button type="button" class="btn btn-light border-info" onclick="cutOffFil('')">This Month</button>
                                        <button type="button" class="btn btn-light border-info" onclick="cutOffFil('1st')">1st cutoff</button>
                                        <button type="button" class="btn btn-light border-info" onclick="cutOffFil('2nd')">2nd cutoff</button> -->
                                    </div>

                                    <div class="col-lg-4 text-center">
                                        <p>Attendance Record as of</p>
                                        <h5><b id="trans_date"><?php echo date('M d, Y', strtotime("now")); ?></b></h5>
                                    </div>

                                </div>

                                <br>

                                <table class="table table-hover" id="emp_attendance_tbl" style="width:100%;">

                                    <thead class="text-uppercase bg-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Fullname</th>
                                            <th>Time in</th>
                                            <th>Time out</th>

                                        
                                        </tr>
                                    </thead>

                                    <tbody class="table-bordered"></tbody>

                                </table>

                               

                                <!-- ======================== Date Filter Modal ======================== -->
                                    <div class="modal" id="dateFilMod">

                                        <div class="modal-dialog">

                                            <div class="modal-content bg-dark">

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Filter by date</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">

                                                    <br>

                                                    <div class="form-group">

                                                        <div class="row">

                                                            <div class="col-lg">
                                                                <p><b>From</b></p>
                                                                <input type="date" class="form-control" name="date_fil1" id="date_fil1">
                                                            </div>

                                                            <div class="col-lg">
                                                                <p><b>To</b></p>
                                                                <input type="date" class="form-control" name="date_fil2" id="date_fil2">
                                                            </div>

                                                            <div class="col-lg">
                                                                <p style="color:transparent;">Action</p>
                                                                <button type="button" class="btn btn-info" onclick="filterByDate()">Apply</button>
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <br><hr>

                                                    <div class="form-group text-center">

                                                        <em>shortcuts</em>

                                                        <br><br>

                                                        <button type="button" class="btn btn-light border-info" onclick="cutOffFil('')">This Month</button>
                                                        <button type="button" class="btn btn-light border-info" onclick="cutOffFil('1st')">First cutoff</button>
                                                        <button type="button" class="btn btn-light border-info" onclick="cutOffFil('2nd')">Last cutoff</button>
                                                        <button type="button" class="btn btn-light border-info" onclick="cutOffFil('Today')">Today</button>

                                                    </div>

                                                    <br><br>

                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                <!-- ======================== Date Filter Modal END ==================== -->

                            </div>

                            <div class="card-footer">

                                <div class="row m-0" id="discounts_card"></div>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg">

                        

                </div>

                
                <!--start overlay-->
                    <div class="overlay toggle-menu"></div>
                <!--end overlay-->
            
          
            </div>
          <!-- End container-fluid-->
          
        </div><!--End content-wrapper-->

        <!--Start Back To Top Button-->
          <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->
        
        <?php include "layout/footer.php"; ?>
        
        <?php include "layout/color_switcher.php"; ?>
        
      </div>
    <!--End wrapper-->



    <!-- Bootstrap core JavaScript-->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
      
    <!-- simplebar js -->
    <script src="../assets/plugins/simplebar/js/simplebar.js"></script>

    <script src="../assets/js/datatables.min.js"></script>
    <script src="../assets/js/dataTables.responsive.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.js"></script>

    <script src="../assets/js/toastr.min.js"></script>

    <!-- <script src="../assets/js/select2.min.js"></script> -->

 
    <!-- sidebar-menu js -->
    <script src="../assets/js/sidebar-menu.js"></script>

    <!-- loader scripts -->
    <script src="../assets/js/jquery.loading-indicator.js"></script>

    <!-- Custom scripts -->
    <script src="../assets/js/app-script.js"></script>

    <script src="../assets/js/functions.js"></script>

    <script>

    $(document).ready(function(){

        empattendance('emp_attendance_tbl','','')

        

    })





    function empattendance(id,date_fil1,date_fil2){
        var dataTable = $("#"+id).DataTable({

        "responsive": false,
        "searching" : false, // Disable search input
        "processing": true,
        "lengthChange": false,
        //"pagingType": "simple",
        "serverSide": false, // para hindi mahirapan magfetch ng big data
        "bSort": false,
        "bInfo":false,
        "order" : [],
        "ajax" : {
            url:"datatables/emp_attendance_tbl.php",
            type: "POST",
            data:{
                        datefil1:date_fil1,
                        datefil2:date_fil2,
                    }
            
        },

        "columns": [
            { data: 'date' },
            { data: 'fullname' },
            { data: 'timein' },
            { data: 'timeout' }
        ]
        ,
        //paging test
        "paging": true, // Activate paging
        "pageLength": 10, // Set the number of records per page (adjust as needed)
        //paging test
        
        })
        }

        function filterByDate(){

        var date1 = $('#date_fil1').val()
        var date2 = $('#date_fil2').val()

        if(date1 != '' && date2 != ''){

            $('#dateFilMod').modal('hide')

            $('#emp_attendance_tbl').DataTable().destroy()

            empattendance('emp_attendance_tbl', date1, date2)

            $('#trans_date').html(formatDate(date1) + " to " + formatDate(date2))

            //$('#trans_date').html('from '+formatDate(date1) + " to " + formatDate(date2))

}
}



function cutOffFil(co_val){

$.ajax({
    type: "POST",
    url: "exec/fetch.php",
    data: {
        coval:co_val,
        action:'get_cutoff'
    },
    dataType: "JSON",
    success: function (response) {

        $('#dateFilMod').modal('hide')


        $('#emp_attendance_tbl').DataTable().destroy()

        empattendance('emp_attendance_tbl', response.FirstDate, response.LastDate)

        if(co_val == 'Today'){
            
            $('#trans_date').html(formatDate(response.FirstDate))
        }

        else{

            $('#trans_date').html(formatDate(response.FirstDate) + " to " + formatDate(response.LastDate))
        }

        //discountCards('discounts_card', co_val, '', '')
    }
})
}




        

    </script>

    
  </body>

</html>
