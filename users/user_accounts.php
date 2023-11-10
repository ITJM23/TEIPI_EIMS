<?php

    session_start();
    
    include "includes/sessions.php";

    date_default_timezone_set("Asia/Manila");

    if($_COOKIE['EIMS_usrlvl'] != '2'){

        echo "<script>location.href='index.php';</script>";
    }
?>

<!DOCTYPE html>

<html lang="en">

  <head>
    
    <meta charset="utf-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <meta name="description" content=""/>

    <meta name="author" content="IS Team | Richard Altre"/>

    <title>IMS | User Accounts</title>

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
                                <h4>User Accounts</h4>
                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-lg-3">
                                        <p><b>User</b></p>
                                        <select class="form-control" name="usr_fil" id="usr_fil">
                                        </select>
                                    </div>

                                    <div class="col-lg-3">
                                        <p><b>Level</b></p>
                                        <select class="form-control" name="lvl_fil" id="lvl_fil">
                                        </select>
                                    </div>

                                    <div class="col-lg-3">
                                        <p><b>Status</b></p>
                                        <select class="form-control" name="stat_fil" id="stat_fil">
                                            <option value="">Select status here</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-lg">
                                        <p style="color:transparent;">Action</p>
                                        <button type="button" class="btn btn-info" onclick="filterDT()">Apply</button>
                                    </div>

                                </div>
                                
                                <br><br>

                                <table class="table table-hover table-striped" id="usr_accs_tbl" style="width:100%;">

                                    <thead class="text-uppercase bg-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Date Added</th>
                                            <th>Level</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody class="table-bordered"></tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-4">

                        <!-- ====================== Adding New Account Form ================= -->
                            <form method="POST" id="newAccForm">

                                <div class="card">

                                    <div class="card-header">
                                        <h5>Add New Accounts</h5>
                                    </div>

                                    <div class="card-body">

                                        <div class="form-group">
                                            <p><b>Employee</b></p>
                                            <select class="form-control" name="usr_dd" id="usr_dd" required></select>
                                        </div>

                                        <div class="form-group">
                                            <p><b>Username</b></p>
                                            <input type="text" class="form-control" name="usrname" id="usrname" placeholder="Input username here" required>
                                        </div>

                                        <div class="form-group">
                                            <p><b>Password</b></p>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Input password here" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <p><b>Retype Password</b></p>
                                            <input type="password" class="form-control" name="repass" id="repass" placeholder="Retype password here" required>
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <p><b>User level</b></p>
                                            <select class="form-control" name="lvl_dd" id="lvl_dd" required>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <button type="button" class="btn btn-light">Cancel</button>
                                        </div>
                                    </div>

                                </div>

                            </form>
                        <!-- ====================== Adding New Account Form END ============= -->

                        <!-- ====================== Editing Account Form ================= -->
                            <form method="POST" id="editAccForm" style="display:none;">

                                <div class="card">

                                    <div class="card-header">
                                        <h5>Edit An Account</h5>
                                    </div>

                                    <div class="card-body">

                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="e_usr_Id" id="e_usr_Id" required>
                                        </div>

                                        <div class="form-group">
                                            <p><b>Username</b></p>
                                            <input type="text" class="form-control" name="e_usrname" id="e_usrname" placeholder="Input username here" required>
                                        </div>

                                        <div class="form-group">
                                            <p><b>Password</b></p>
                                            <input type="password" class="form-control" name="e_password" id="e_password" placeholder="Input password here">
                                        </div>
                                        
                                        <div class="form-group">
                                            <p><b>Retype Password</b></p>
                                            <input type="password" class="form-control" name="e_repass" id="e_repass" placeholder="Retype password here">
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <p><b>User level</b></p>
                                            <select class="form-control" name="e_lvl_dd" id="e_lvl_dd" required>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-info">Save</button>
                                            <button type="button" class="btn btn-light">Cancel</button>
                                        </div>
                                    </div>

                                </div>

                            </form>
                        <!-- ====================== Editing Account Form END ============= -->

                    </div>

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

    <script src="../assets/js/select2.min.js"></script>

 
    <!-- sidebar-menu js -->
    <script src="../assets/js/sidebar-menu.js"></script>

    <!-- loader scripts -->
    <script src="../assets/js/jquery.loading-indicator.js"></script>

    <!-- Custom scripts -->
    <script src="../assets/js/app-script.js"></script>

    <script src="../assets/js/functions.js"></script>

    <script>
        

        
        $(document).ready(function(){
            
            empDD('usr_fil')
            empDD('usr_dd')
            
            levelDD('lvl_fil')
            levelDD('lvl_dd')
            levelDD('e_lvl_dd')

            $('#usr_fil').select2()
            $('#usr_dd').select2()


            usrAccTbl('usr_accs_tbl', '', '', '')

            $('#newAccForm').on('submit', function(aa){

                aa.preventDefault()

                var data        = $('#newAccForm').serializeArray()
                var password    = $('#password').val()
                var repass      = $('#repass').val()

                data.push(
                    {name: 'action', value: 'new_usr_acc'}
                )

                if(repass != password){

                    toastr.error('Please try again', 'Password not matched', { "progressBar": true });
                }

                else{


                    $.ajax({
                        type: "POST",
                        url: "exec/insert.php",
                        data: data,
                        dataType: "JSON",
                        success: function (response) {
                        
                            if(response == 1){

                                $('#newAccForm')[0].reset()

                                $('#usr_accs_tbl').DataTable().ajax.reload()

                                toastr.success('You added a new account', 'Successfully Added', { "progressBar": true }); 
                            }
    
                            else if(response == 2){
    
                                toastr.info('Please contact your developer', 'Something went wrong', { "progressBar": true }); 
                            }
    
                            else if(response == 3){
    
                                toastr.info('Please contact your developer', 'Something went wrong', { "progressBar": true }); 
                            }

                            else if(response == 4){
    
                                toastr.error('User already have an account', 'Account already exist', { "progressBar": true }); 
                            }
                        }
                    })
                }

            })

            $('#editAccForm').on('submit', function(ab){

                ab.preventDefault()

                var data        = $('#editAccForm').serializeArray();
                var password    = $('#e_password').val()
                var repass      = $('#e_repass').val()

                data.push(
                    {name:'action', value:'edit_usr_acc'}
                )

                // if(repass != password){

                //     toastr.error('Please try again', 'Password not matched', { "progressBar": true });
                // }

                // else{

                    $.ajax({
                        type: "POST",
                        url: "exec/update.php",
                        data: data,
                        dataType: "JSON",
                        success: function (response) {
                            
                            if(response == 1){

                                $('#editAccForm')[0].reset()

                                $('#editAccForm').hide()
                                $('#newAccForm').show()

                                $('#usr_accs_tbl').DataTable().ajax.reload()

                                toastr.success('You updated account', 'Successfully Updated', { "progressBar": true }); 
                            }

                            else if(response == 2){

                                toastr.info('Please contact your developer', 'Something went wrong', { "progressBar": true }); 
                            }

                            else if(response == 3){

                                toastr.info('Please contact your developer', 'Something went wrong', { "progressBar": true }); 
                            }
                        }
                    })

                // }
            })
        })

        

        function usrAccTbl(id, usr_fil, lvl_fil, stat_fil){

            var dataTable = $('#'+id).DataTable({

                "responsive": true,
                "processing": true,
                "serverSide": true,
                "bSort": false,
                "bInfo":false,
                "order" : [],
                "ajax" : {
                    url:"datatables/usr_accs_tbl.php",
                    type: "POST",
                    data:{
                        usrfil:usr_fil,
                        lvlfil:lvl_fil,
                        statfil:stat_fil,
                    }
                },
                dom: 'Bfrtip',
                //     buttons: [
                //         { extend: 'copyHtml5', className: 'btn btn-outline-primary' },
                //         { extend: 'csvHtml5', className: 'btn btn-outline-primary' },
                //         { extend: 'excelHtml5', className: 'btn btn-outline-primary' },
                //         { extend: 'pdfHtml5', className: 'btn btn-outline-primary' }
                        
                //     ],
                // "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
            })
        }



        function levelDD(id){

            $.ajax({
                type: "POST",
                url: "exec/fetch.php",
                data: {
                    action:"level_dd"
                },
                dataType: "JSON",
                success: function (response) {
                    
                    $('#'+id).html(response)

                }
            })
        }



        function empDD(id){

            $.ajax({
                type: "POST",
                url: "exec/fetch.php",
                data: {
                    action:"emp_dd"
                },
                dataType: "JSON",
                success: function (response) {
                    
                    $('#'+id).html(response)
                }
            })
        }



        function filterDT(){

            var usr_fil  = $('#usr_fil').val()
            var lvl_fil  = $('#lvl_fil').val()
            var stat_fil = $('#stat_fil').val()

            $('#usr_accs_tbl').DataTable().destroy()

            usrAccTbl('usr_accs_tbl', usr_fil, lvl_fil, stat_fil)
        }



        function editAcc(acc_id){

            $('#newAccForm').hide()
            $('#editAccForm').show()

            $.ajax({
                type: "POST",
                url: "exec/fetch.php",
                data: {
                    accid:acc_id,
                    action:"fetch_acc_info2"
                },
                dataType: "JSON",
                success: function (response) {
                    
                    $('#e_usr_Id').val(acc_id)
                    $('#e_usrname').val(response.UsrName)
                    $('#e_lvl_dd').val(response.UsrLvl)
                }
            })
        }



        function setAsInactive(acc_Id){

            $.ajax({
                type: "POST",
                url: "exec/update.php",
                data: {
                    accid:acc_Id,
                    action:"remove_acc"
                },
                dataType: "JSON",
                success: function (response) {
                    
                    if(response == '1'){

                        $('#usr_accs_tbl').DataTable().ajax.reload()

                        toastr.success('You removed an account', 'Successfully Removed', { "progressBar": true }); 
                    }

                    else if(response == '2'){

                        toastr.error('Please contact your developer', 'Something went wrong', { "progressBar": true }); 
                    }

                    else if(response == '3'){

                        toastr.info('Please contact your developer', 'Item has been missing', { "progressBar": true }); 
                    }
                }
            })
        }

        

    </script>

    
  </body>

</html>
