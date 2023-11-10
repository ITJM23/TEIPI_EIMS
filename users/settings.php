<?php
    session_start();
    include "includes/sessions.php";
?>

<!DOCTYPE html>

<html lang="en">

  <head>
    
    <meta charset="utf-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <meta name="description" content=""/>

    <meta name="author" content=""/>

    <title>IMS | Settings</title>

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
    <!-- Icons CSS-->
    <!-- <link href="../assets/css/icons.css" rel="stylesheet" type="text/css"/> -->
    <link href="../assets/icons/fontawesome-free-6.0.0-web/css/all.css" rel="stylesheet" type="text/css"/>

    <link href="../assets/css/toastr.min.css" rel="stylesheet" type="text/css">

    <!-- Sidebar CSS-->
    <link href="../assets/css/sidebar-menu.css" rel="stylesheet"/>

    <!-- Custom Style-->
    <link href="../assets/css/app-style.css" rel="stylesheet"/>
    
  </head>

  <body class="bg-theme bg-theme2">
  
    <!-- ============================== The source code is written by Richard Altre (2022) ========================= -->

    <!-- Start wrapper-->
    <div id="wrapper">
      
        <?php include "layout/sidebar.php"; ?>

        <?php include "layout/topbar.php"; ?>

        <div class="clearfix"></div>
        
        <div class="content-wrapper">

            <!--Start Dashboard Content-->

            <div class="container-fluid"><br>


                <div class="card">

                    <div class="card-header">
                        <h4>Settings</h4>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-lg-4">

                                <div class="card cursor-pointer" onclick="accSettMod()">

                                    <div class="card-body d-flex align-items-center">

                                        <h4><span class="fa fa-solid fa-user mr-4"></span></h4>

                                        <div>
                                            <h5><b>Account</b></h5>
                                            <p>Manage your account info.</p>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <?php 

                                if($_COOKIE['EIMS_usrlvl'] == '2'){

                                    ?>

                                        <div class="col-lg-4">

                                            <div class="card cursor-pointer" onclick="location.href='user_accounts.php';">

                                                <div class="card-body d-flex align-items-center">

                                                    <h4><span class="fa fa-solid fa-users mr-4"></span></h4>

                                                    <div>
                                                        <h5><b>User Accounts</b></h5>
                                                        <p>Manage user accounts</p>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                        
                                        <div class="col-lg-4">
            
                                            <div class="card cursor-pointer" onclick="">
            
                                                <div class="card-body d-flex align-items-center">
            
                                                    <h4><span class="fa fa-solid fa-bell mr-4"></span></h4>
            
                                                    <div>
                                                        <h5><b>Notifications</b></h5>
                                                        <p>Manage notification alerts</p>
                                                    </div>
            
                                                </div>
            
                                            </div>
            
                                        </div>
                                        
                                    <?php
                                }

                            ?>


                        </div>

                    </div>

                </div>

                <!-- ===================== Account Settings =================== -->
                    <div class="modal" id="accSettMod">

                        <div class="modal-dialog">

                            <div class="modal-content bg-dark text-white">

                                <form method="POST" id="accSettForm">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h5>Account Settings</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <p><b>Username</b></p>
                                            <input type="text" class="form-control" name="e_username" id="e_username" placeholder="Input username here" required>
                                        </div>

                                        <div class="form-group">
                                            <p><b>Password</b></p>
                                            <input type="password" class="form-control" name="e_password" id="e_password" placeholder="Input new password here" required>
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <p><b>Current Password</b> (to apply changes)</p>
                                            <input type="password" class="form-control" name="e_oldpass" id="e_oldpass" placeholder="Input current password here" required>
                                        </div>

                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>
                <!-- ===================== Account Settings END =============== -->

            </div>

            <!--End Dashboard Content-->
        
            <!--start overlay-->
            <div class="overlay toggle-menu"></div>
            <!--end overlay-->

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

    <!-- sidebar-menu js -->
    <script src="../assets/js/sidebar-menu.js"></script>

    <!-- loader scripts -->
    <script src="../assets/js/jquery.loading-indicator.js"></script>

    <script src="../assets/js/toastr.min.js"></script>

    <!-- Custom scripts -->
    <script src="../assets/js/app-script.js"></script>

    <script src="../assets/js/functions.js"></script>


    <script>

        $(document).ready(function(){
            
            $('#accSettForm').on('submit', function(aa){

                aa.preventDefault()

                var data = $('#accSettForm').serializeArray()

                data.push(
                    {name: 'action', value:'update_acc'},
                )

                $.ajax({
                    type: "POST",
                    url: "exec/update.php",
                    data: data,
                    dataType: "JSON",
                    success: function (response) {
                        
                        if(response == '1'){

                            $('#accSettMod').modal('hide')

                            $('#accSettForm')[0].reset()

                            toastr.success('You update your info.', 'Successfully Updated', { "progressBar": true });
                        }

                        else if(response == '2'){

                            toastr.error('Somehing went wrong', 'Please contact your developer', { "progressBar": true });
                        }

                        else if(response == '3'){

                            toastr.error('Somehing went wrong', 'Please contact your developer', { "progressBar": true });
                        }

                        else if(response == '4'){

                            toastr.info('Please try again', 'Invalid Password', { "progressBar": true });
                        }
                    }
                })


            })

        })



        function accSettMod(){

            $('#accSettMod').modal('show')

            $.ajax({
                type: "POST",
                url: "exec/fetch.php",
                data: {
                    action:"fetch_acc_info"
                },
                dataType: "JSON",
                success: function (response) {
                    
                    $('#e_username').val(response.UsrName)
                }
            })
        } 

    </script>

    
  </body>

</html>
