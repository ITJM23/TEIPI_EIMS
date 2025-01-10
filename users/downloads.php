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

                    <div class="col-lg-12">

                        <div class="card">

                            <div class="card-header">
                                <h4>Downloadable Files</h4>
                            </div>

                            <div class="card-body">
                                
                            <div class="row m-0" id="discounts_card">
                              <div class="col-lg border-light text-center"><div class="card"><div class="card-body"><h3 class="text-white mb-0 font-weight-bold"> <span>TEIPI Handbook </span><br><span>(revised 2023)</span></h3><br><p class="mb-0 text-info small-font" id = "TEIPI_Handbook_download"> <a href="http://192.168.1.14:8000/TEIPI_EIMS/users/downloads/TEIPI_HANDBOOK_REVISED_2023.pdf" target="_blank"><Button> Download </button></a></p></div></div></div>
                            
                              <div class="col-lg border-light text-center"><div class="card"><div class="card-body"><h3 class="text-white mb-0 font-weight-bold"> <span>Company Loan Application Form</span></h3><br><p class="mb-0 text-info small-font" id="companyloan_download" > <a href="http://192.168.1.14:8000/TEIPI_EIMS/users/downloads/COMPANY_LOAN_APPLICATION_FORM.xlsx" > <button>Download</button> </a></p></div></div></div>
                              <div class="col-lg border-light text-center"><div class="card"><div class="card-body"><h3 class="text-white mb-0 font-weight-bold"> <span>IS Request/Technical form</span></h3><br><p class="mb-0 text-info small-font" id="companyloan_download" > <a href="http://192.168.1.14:8000/TEIPI_EIMS/users/downloads/IS_REQUEST_FORM.xlsx" > <button>Download</button> </a></p></div></div></div>
                                
                              </div>

                              <div class="row m-0" id="discounts_card">
                              <div class="col-lg border-light text-center"><div class="card"><div class="card-body"><h3 class="text-white mb-0 font-weight-bold"> <span>DATA MAINTENANCE FORM </span><br><span> (Dry run form 1 Month)</span></h3><br><p class="mb-0 text-info small-font" id = "TEIPI_Handbook_download"> <a href="http://192.168.1.14:8000/TEIPI_EIMS/users/downloads/DATA_MAINTENANCE_FORM.xlsx" target="_blank"><Button> Download </button></a></p></div></div></div>
                            
                              <div class="col-lg border-light text-center"></div>
                              <div class="col-lg border-light text-center"></div>
                              </div>
                                

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





    
  </body>

</html>
