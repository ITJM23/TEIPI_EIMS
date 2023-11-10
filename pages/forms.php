<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="utf-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <meta name="description" content=""/>

    <meta name="author" content=""/>

    <title>Dashtreme Admin - Free Dashboard for Bootstrap 4 by Codervent</title>

    <!-- loader-->
    <link href="../assets/css/pace.min.css" rel="stylesheet"/>
    <script src="../assets/js/pace.min.js"></script>

    <!--favicon-->
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    
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

    <!-- Custom Style-->
    <link href="../assets/css/app-style.css" rel="stylesheet"/>
    
    
  </head>

  <body class="bg-theme bg-theme6">

    <!-- start loader -->
      <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
    <!-- end loader -->

    <!-- Start wrapper-->
      <div id="wrapper">

        <?php include "layout/sidebar.php"; ?>

        <?php include "layout/topbar.php"; ?>

        <div class="clearfix"></div>
	
        <div class="content-wrapper">

          <div class="container-fluid">

            <div class="row mt-3">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                  <div class="card-title">Vertical Form</div>
                  <hr>
                    <form>
                  <div class="form-group">
                    <label for="input-1">Name</label>
                    <input type="text" class="form-control" id="input-1" placeholder="Enter Your Name">
                  </div>
                  <div class="form-group">
                    <label for="input-2">Email</label>
                    <input type="text" class="form-control" id="input-2" placeholder="Enter Your Email Address">
                  </div>
                  <div class="form-group">
                    <label for="input-3">Mobile</label>
                    <input type="text" class="form-control" id="input-3" placeholder="Enter Your Mobile Number">
                  </div>
                  <div class="form-group">
                    <label for="input-4">Password</label>
                    <input type="text" class="form-control" id="input-4" placeholder="Enter Password">
                  </div>
                  <div class="form-group">
                    <label for="input-5">Confirm Password</label>
                    <input type="text" class="form-control" id="input-5" placeholder="Confirm Password">
                  </div>
                  <div class="form-group py-2">
                    <div class="icheck-material-white">
                    <input type="checkbox" id="user-checkbox1" checked=""/>
                    <label for="user-checkbox1">I Agree Terms & Conditions</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-light px-5"><i class="icon-lock"></i> Register</button>
                  </div>
                  </form>
                </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                  <div class="card-title">Round Vertical Form</div>
                  <hr>
                    <form>
                  <div class="form-group">
                    <label for="input-6">Name</label>
                    <input type="text" class="form-control form-control-rounded" id="input-6" placeholder="Enter Your Name">
                  </div>
                  <div class="form-group">
                    <label for="input-7">Email</label>
                    <input type="text" class="form-control form-control-rounded" id="input-7" placeholder="Enter Your Email Address">
                  </div>
                  <div class="form-group">
                    <label for="input-8">Mobile</label>
                    <input type="text" class="form-control form-control-rounded" id="input-8" placeholder="Enter Your Mobile Number">
                  </div>
                  <div class="form-group">
                    <label for="input-9">Password</label>
                    <input type="text" class="form-control form-control-rounded" id="input-9" placeholder="Enter Password">
                  </div>
                  <div class="form-group">
                    <label for="input-10">Confirm Password</label>
                    <input type="text" class="form-control form-control-rounded" id="input-10" placeholder="Confirm Password">
                  </div>
                  <div class="form-group py-2">
                    <div class="icheck-material-white">
                    <input type="checkbox" id="user-checkbox2" checked=""/>
                    <label for="user-checkbox2">I Agree Terms & Conditions</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-light btn-round px-5"><i class="icon-lock"></i> Register</button>
                  </div>
                  </form>
                </div>
                </div>
              </div>
            </div>
            <!--End Row-->

            <!--start overlay-->
              <div class="overlay toggle-menu"></div>
            <!--end overlay-->

          </div>
          <!-- End container-fluid-->
    
        </div>
        <!--End content-wrapper-->


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

    <!-- sidebar-menu js -->
    <script src="../assets/js/sidebar-menu.js"></script>
    
    <!-- Custom scripts -->
    <script src="../assets/js/app-script.js"></script>
	
  </body>

</html>
