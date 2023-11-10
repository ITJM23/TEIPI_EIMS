<?php

  session_start();
  include "includes/authenticate.php";

?>

<!DOCTYPE html>

<html lang="en">

  <head>
    
    <meta charset="utf-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <meta name="description" content=""/>

    <meta name="author" content=""/>

    <title>Information Management System | Register</title>

    <!-- loader-->
    <link href="../assets/css/pace.min.css" rel="stylesheet"/>
    <script src="../assets/js/pace.min.js"></script>

    <!--favicon-->
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">

    <!-- Bootstrap core CSS-->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- animate CSS-->
    <!-- <link href="../assets/css/animate.css" rel="stylesheet" type="text/css" /> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Icons CSS-->
    <!-- <link href="../assets/css/icons.css" rel="stylesheet" type="text/css"/> -->
    <link href="../assets/icons/fontawesome-free-6.0.0-web/css/all.css" rel="stylesheet" type="text/css"/>

    <link href="../assets/css/toastr.min.css" rel="stylesheet" type="text/css">

    <!-- Custom Style-->
    <link href="../assets/css/app-style.css" rel="stylesheet"/>
    
  </head>

  <body class="bg-theme bg-theme2">

    <!-- start loader -->
      <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
    <!-- end loader -->

    <!-- Start wrapper-->
    <div id="wrapper">

      <div class="loader-wrapper">
        <div class="lds-ring"></div>
      </div>

      <div class="card card-authentication1 mx-auto my-5">

        <div class="card-body">

          <div class="card-content p-2">

            <div class="text-center">

              <img src="../assets/images/Tsukiden_Transparent_White.png" style="width:200px;" alt="logo icon">
                
              <hr>

            </div>  
              
            <form method="POST" id="regForm">

              <div id="step1" class="animate__animated animate__zoomIn">
                
                <div class="text-center">
                  <h4 class="text-uppercase py-3"><b>Register</b></h4>
                </div>

                <div class="form-group">
  
                  <p><b>Employee ID</b></p>
  
                  <div class="position-relative has-icon-right">

                    <input type="hidden" name="emp_id" id="emp_id">
                    <input type="number" name="emp_num" id="emp_num" class="form-control input-shadow" placeholder="Enter employee ID" required>
  
                    <br>
                      
                    <div class="form-control-position" id="reg_status">
                      <!--  -->
                      <i class="fa fa-user"></i>
                    </div>
  
                  </div>
  
                </div>
  
                <button type="button" class="btn btn-info btn-block" onclick="nextStep()" id="nxtstp_btn" disabled>Next</button>

              </div>

              <div id="step2" style="display:none;">

                <div style="display:flex; align-items:center; text-align:center;">

                  <button type="button" class="btn btn-dark" id="prev_step"onclick="prevStep()"><span class="fa fa-arrow-left"></span></button>
                  
                  <h4 class="text-uppercase py-3 flex-grow-1"><b>Register</b></h4>
                  
                  <button type="button" class="btn" style="color:transparent;"><span class="fa fa-arrow-left"></span></button>

                </div>

                <br>

                <div class="form-group">
  
                  <p><b>Username</b></p>
  
                  <div class="position-relative has-icon-right">
  
                    <input type="text" name="username" id="username" class="form-control input-shadow" placeholder="Enter username" required>
                      
                    <div class="form-control-position">
                      <i class="fa fa-user"></i>
                    </div>
  
                  </div>
  
                </div>

                <div class="form-group">
  
                  <p><b>Password</b> <span class="text-muted">(minimum 8 characters)</span></p>
  
                  <div class="position-relative has-icon-right">
  
                    <input type="password" name="pssword" id="pssword" class="form-control input-shadow" placeholder="Enter password" required>
                      
                    <div class="form-control-position">
                      <i class="fa fa-lock"></i>
                    </div>
  
                  </div>
  
                </div>

                <div class="form-group">
  
                  <p><b>Retype Password</b></p>
  
                  <div class="position-relative has-icon-right">
  
                    <input type="password" name="repass" id="repass" class="form-control input-shadow" placeholder="Retype password" required>
                      
                    <div class="form-control-position">
                      <i class="fa fa-lock"></i>
                    </div>
  
                  </div>
  
                </div>
  
                <button type="submit" class="btn btn-success btn-block">Submit</button>

              </div>

              <hr>

              <div class="text-center">
                <p>Already have an account?</p>
                <a href="login.php">Log In here</a>
              </div>

              <br>

            </form>
            
          </div>
          
        </div>
        
      </div>

      <!--Start Back To Top Button-->
      <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>

    </div><!--wrapper-->
	
    <!-- Bootstrap core JavaScript-->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <script src="../assets/js/toastr.min.js"></script>
    
    <!-- sidebar-menu js -->
    <script src="../assets/js/sidebar-menu.js"></script>
    
    <!-- Custom scripts -->
    <script src="../assets/js/app-script.js"></script>

    <script src="../assets/js/functions.js"></script>

    <script>  

      $(document).ready(function(){

        $('#emp_num').focus()

        $('#regForm').on('submit', function(aa){

          aa.preventDefault()

          var data    = $('#regForm').serializeArray()
          var pssword = $('#pssword').val()
          var repass  = $('#repass').val()

          data.push(
            {name: 'action', value: 'register'}
          )

          if(repass != pssword){

            toastr.error('Password not matched', '', { "progressBar": true });

            $('#pssword').addClass('border border-danger')
            $('#repass').addClass('border border-danger')

          }

          else if(pssword.length < 8){

            toastr.error('Minimum of 8 characters required', '', { "progressBar": true });

            $('#pssword').addClass('border border-danger')
          }

          else{

            $('#pssword').removeClass('border border-danger')
            $('#repass').removeClass('border border-danger')

            $.ajax({
              type: "POST",
              url: "exec/insert.php",
              data: data,
              dataType: "JSON",
              success: function (response) {
                
                if(response == '1'){

                  location.href='index.php';
                }

                else if(response == '2'){

                  toastr.error('Something went wrong', 'Please contact the developer', { "progressBar": true });
                }

                else if(response == '3'){ 

                  toastr.error('Something went wrong', 'Please contact the developer', { "progressBar": true });
                }

                else if(response == '4'){

                  toastr.info('Already Exist', 'Employee ID already have an account ', { "progressBar": true });
                }
              }

            })

          }

        })

        $('#emp_num').keyup(function(){

          var emp_num = $('#emp_num').val()

          if(emp_num.length >= 5){

            $.ajax({
              type: "POST",
              url: "exec/fetch.php",
              data: {
                empnum:emp_num,
                action:"check_emp"
              },
              dataType: "JSON",
              success: function (response) {
                
                if(response.ResVal == '1'){

                  $('#emp_id').val(response.EmpId)

                  $('#reg_status').html('<i class="fa fa-check text-success" style="font-size:25px;"></i>')

                  $('#nxtstp_btn').prop('disabled', false)
                }
                
                else if(response.ResVal == '4'){
                  
                  $('#reg_status').html('<i class="fa fa-close text-danger" style="font-size:25px;"></i>')

                  $('#nxtstp_btn').prop('disabled', true)

                }

              }
            })

          }

          else{

            $('#reg_status').html('<i class="fa fa-user"></i>')

            $('#nxtstp_btn').prop('disabled', true)

          }
        })

      })



      function prevStep(){

        $('#step2').hide()  
        $('#prev_step').hide()
        $('#step1').show()
      }



      function nextStep(){

        $('#step1').hide()  
        $('#prev_step').show()
        $('#step2').show()

      }

    </script>
  
  </body>

</html>
