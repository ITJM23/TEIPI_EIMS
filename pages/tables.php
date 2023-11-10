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

                  <h5 class="card-title">Basic Table</h5>

                  <div class="table-responsive">

                    <table class="table">

                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">First</th>
                          <th scope="col">Last</th>
                          <th scope="col">Handle</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Larry</td>
                          <td>the Bird</td>
                          <td>@twitter</td>
                        </tr>
                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

            </div>

            <div class="col-lg-6">

              <div class="card">

                <div class="card-body">

                  <h5 class="card-title">Bordered Table</h5>

                  <div class="table-responsive">

                    <table class="table table-bordered">

                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">First</th>
                          <th scope="col">Last</th>
                          <th scope="col">Handle</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td colspan="2">Larry the Bird</td>
                          <td>@twitter</td>
                        </tr>
                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

            </div>

          </div><!--End Row-->



          <div class="row">

            <div class="col-lg-6">

              <div class="card">

                <div class="card-body">

                  <h5 class="card-title">Striped Table</h5>

                  <div class="table-responsive">

                    <table class="table table-striped">

                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">First</th>
                          <th scope="col">Last</th>
                          <th scope="col">Handle</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Larry</td>
                          <td>the Bird</td>
                          <td>@twitter</td>
                        </tr>
                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

            </div>
            
            <div class="col-lg-6">

              <div class="card">

                <div class="card-body">

                  <h5 class="card-title">Hover Table</h5>

                  <div class="table-responsive">

                    <table class="table table-hover">

                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">First</th>
                          <th scope="col">Last</th>
                          <th scope="col">Handle</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td colspan="2">Larry the Bird</td>
                          <td>@twitter</td>
                        </tr>
                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

            </div>

          </div><!--End Row-->



          <div class="row">

            <div class="col-lg-6">

              <div class="card">

                <div class="card-body">

                  <h5 class="card-title">Small Table</h5>

                  <div class="table-responsive">

                    <table class="table table-sm">

                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">First</th>
                          <th scope="col">Last</th>
                          <th scope="col">Handle</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td colspan="2">Larry the Bird</td>
                          <td>@twitter</td>
                        </tr>
                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

            </div>

            <div class="col-lg-6">

              <div class="card">

                <div class="card-body">

                  <h5 class="card-title">Responsive Table</h5>

                  <div class="table-responsive">

                    <table class="table">

                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Heading</th>
                          <th scope="col">Heading</th>
                          <th scope="col">Heading</th>
                          <th scope="col">Heading</th>
                          <th scope="col">Heading</th>
                          <th scope="col">Heading</th>
                          <th scope="col">Heading</th>
                          <th scope="col">Heading</th>
                          <th scope="col">Heading</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                          <td>Cell</td>
                        </tr>
                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

            </div>

          </div><!--End Row-->
      
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
   
    </div><!--End wrapper-->


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
