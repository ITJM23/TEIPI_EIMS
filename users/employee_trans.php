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

    <title>IMS | Canteen Transactions</title>

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
                                <h4>Canteen Transactions</h4>
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

                                    <div class="col-lg-4">

                                        <div class="card border border-success">

                                            <div class="card-body text-success">
                                                <h4 class="mb-0 font-weight-bold"><span id="total_transc">0</span><span class="float-right"><i class="fa fa-shopping-cart"></i></span></h4><br>
                                                <p class="mb-0 small-font">Total transactions<span class="float-right text-success" style="font-weight:bold"></span></p>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-lg-4">

                                        <div class="card border border-info">

                                            <div class="card-body text-info">
                                                <h4 class="mb-0 font-weight-bold"><span id="total_cash">P0.00</span><span class="float-right"><i class="fa-solid fa-dollar"></i></span></h4><br>
                                                <p class="mb-0 small-font">Total Cash Amount <span class="float-right text-success" style="font-weight:bold"></span></p>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-lg-4">

                                        <div class="card border border-info">

                                            <div class="card-body text-info">
                                                <h4 class="mb-0 font-weight-bold"><span id="total_credit">P0.00</span><span class="float-right"><i class="fa-solid fa-dollar"></i></span></h4><br>
                                                <p class="mb-0 small-font">Total Credit Amount <span class="float-right text-success" style="font-weight:bold"></span></p>
                                            </div>

                                        </div>

                                    </div>

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
                                        <p>canteen transactions as of</p>
                                        <h5><b id="trans_date"><?php echo date('M d, Y', strtotime("now")); ?></b></h5>
                                    </div>

                                </div>

                                <br>

                                <table class="table table-hover" id="emp_trans_tbl" style="width:100%;">

                                    <thead class="text-uppercase bg-light">
                                        <tr>
                                            <th>Date Added</th>
                                            <th>Transaction ID</th>
                                            <th>Employee</th>
                                            <th>Grand Total</th>
                                            <!-- <th>Cash</th>
                                            <th>Change</th> -->
                                            <th>Payment</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody class="table-bordered"></tbody>

                                </table>

                                <!-- ======================== Employee Modal ======================== -->
                                    <!-- <div class="modal" id="srchEmpMod">

                                        <div class="modal-dialog">

                                            <div class="modal-content bg-dark">

                                                <div class="modal-header">
                                                    <h4 class="modal-title">Search an employee</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <div class="modal-body">
                                                <div class="form-group">
                                                    <p><b>Employee</b></p>
                                                    <select class="form-control" name="emp_dd" id="emp_dd" style="width:100%;"></select>
                                                </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" onclick="empFetch()">Submit</button>
                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                                </div>

                                            </div>

                                        </div>

                                    </div> -->
                                <!-- ======================== Employee Modal END ==================== -->

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

                        <div class="card">

                            <div class="card-header">
                                <h5>Transaction Details <span class="text-info" id="transc_id"></span></h5>
                            </div>
                                
                            <div class="card-body">
                                    
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Date Added</td>
                                            <td><h5 id="emp_trans_date">---</h5></td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td><h5 id="emp_name">---</h5></td>
                                        </tr>
                                        <tr>
                                            <td>Cash</td>
                                            <td id="cash_amount">0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Change</td>
                                            <td id="cash_change">0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Payment</td>
                                            <td id="payment">---</td>
                                        </tr>
                                        <tr>
                                            <td>Grand Total</td>
                                            <td><h4 class="text-success" id="trans_total">P0.00</h4></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <hr>

                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#menu1">Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#menu3">Discounts Applied</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">

                                    <div class="tab-pane active" id="menu1">

                                        <table class="table table-hover table-striped" id="trans_det_tbl" style="width:100%;">

                                            <thead class="bg-light text-uppercase">
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>

                                            <tbody class="table-bordered"></tbody>

                                        </table>

                                    </div>

                                    <div class="tab-pane container fade" id="menu3">

                                        <table class="table table-hover table-striped" id="discounts_tbl" style="width:100%;">

                                            <thead class="bg-light text-uppercase">
                                                <tr>
                                                    <th>Discount</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>

                                            <tbody class="table-bordered"></tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>

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

            totalTransc('total_transc', '', '')
            totalCredits('total_credit', '', '')
            totalCash('total_cash', '', '')
            
            empTrans('emp_trans_tbl', '', '')

        })

        

        function empTrans(id, date_fil1, date_fil2){

            var dataTable = $('#'+id).DataTable({

                "responsive": true,
                "processing": true,
                "serverSide": true,
                "bSort": false,
                "bInfo":false,
                "order" : [],
                "ajax" : {
                    url:"datatables/emp_transc_tbl2.php",
                    type: "POST",
                    data:{
                        datefil1:date_fil1,
                        datefil2:date_fil2,
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

        

        function filterByDate(){

            var date1 = $('#date_fil1').val()
            var date2 = $('#date_fil2').val()

            if(date1 != '' && date2 != ''){

                $('#dateFilMod').modal('hide')

                totalTransc('total_transc', date1, date2)
                totalCredits('total_credit', date1, date2)
                totalCash('total_cash', date1, date2)

                $('#emp_trans_tbl').DataTable().destroy()

                empTrans('emp_trans_tbl', date1, date2)

                $('#trans_date').html(formatDate(date1) + " to " + formatDate(date2))

                discountCards('discounts_card', 'date_range', date1, date2)

            }
        }

        

        function transDetails(id, trans_id){

            var dataTable = $('#'+id).DataTable({

                "responsive": true,
                "processing": true,
                "serverSide": true,
                "bSort": false,
                "bInfo":false,
                "order" : [],
                "ajax" : {
                    url:"datatables/trans_det_tbl.php",
                    type: "POST",
                    data:{
                        transid:trans_id
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

        

        function viewTransDet(trans_id){

            orderInfo(trans_id)

            $('#trans_det_tbl').DataTable().destroy()
            transDetails('trans_det_tbl', trans_id)


            $('#transc_id').html("("+ trans_id.slice(0, 10) +")")


            // $('#cust_amount_tbl').DataTable().destroy()
            // custAmounts('cust_amount_tbl', trans_id)


            $('#discounts_tbl').DataTable().destroy()
            discountsTbl('discounts_tbl', trans_id)
        }



        function discountsTbl(id, trans_id){

            var dataTable = $('#'+id).DataTable({

                "responsive": true,
                "processing": true,
                "serverSide": true,
                "bSort": false,
                "bInfo":false,
                "order" : [],
                "ajax" : {
                    url:"datatables/discounts_tbl.php",
                    type: "POST",
                    data:{
                        transid:trans_id
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



        function orderInfo(trans_id){

            $.ajax({
                type: "POST",
                url: "exec/fetch.php",
                data: {
                    transid:trans_id,
                    action:"order_info"
                },
                dataType: "JSON",
                success: function (response) {
                    
                    $('#emp_trans_date').html(response.DateMod)
                    $('#emp_name').html(response.Fname +" "+ response.Lname)
                    $('#trans_total').html("P"+response.GTotal)
                    $('#cash_amount').html(response.Payment)
                    $('#cash_change').html(response.PChange)
                    $('#payment').html(response.PMethod)
                }
            })
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

                    totalTransc('total_transc', response.FirstDate, response.LastDate)
                    totalCredits('total_credit', response.FirstDate, response.LastDate)
                    totalCash('total_cash', response.FirstDate, response.LastDate)

                    $('#emp_trans_tbl').DataTable().destroy()

                    empTrans('emp_trans_tbl', response.FirstDate, response.LastDate)

                    if(co_val == 'Today'){
                        
                        $('#trans_date').html(formatDate(response.FirstDate))
                    }

                    else{

                        $('#trans_date').html(formatDate(response.FirstDate) + " to " + formatDate(response.LastDate))
                    }

                    discountCards('discounts_card', co_val, '', '')
                }
            })
        }

        

        function totalCredits(id, date_fil1, date_fil2){

            $.ajax({
                type: "POST",
                url: "exec/fetch.php",
                data: {
                    datefil1:date_fil1,
                    datefil2:date_fil2,
                    action:"total_credits"
                },
                dataType: "JSON",
                success: function (response) {
                    
                    $('#'+id).html("P"+response)
                }
            })
        }



        function totalCash(id, date_fil1, date_fil2){

            $.ajax({
                type: "POST",
                url: "exec/fetch.php",
                data: {
                    datefil1:date_fil1,
                    datefil2:date_fil2,
                    action:"total_cash"
                },
                dataType: "JSON",
                success: function (response) {
                    
                    $('#'+id).html("P"+response)
                }
            })
        }



        function totalTransc(id, date_fil1, date_fil2){

            $.ajax({
                type: "POST",
                url: "exec/fetch.php",
                data: {
                    datefil1:date_fil1,
                    datefil2:date_fil2,
                    action:"count_c_transc"
                },
                dataType: "JSON",
                success: function (response) {
                    
                    $('#'+id).html(response)
                }
            })
        }



        // function DiscCards(id, date_fil1, date_fil2){

        //     $.ajax({
        //         type: "POST",
        //         url: "exec/fetch.php",
        //         data: {
        //             datefil1:date_fil1,
        //             datefil2:date_fil2,
        //             action:"discounts_card"
        //         },
        //         dataType: "JSON",
        //         success: function (response) {
                
        //             $('#'+id).html(response)
        //         }
        //     })
        // }



        function discountCards(id, cutoff_val, date_fil1, date_fil2){

            $.ajax({
            type: "POST",
            url: "exec/fetch.php",
            data: {
                cutoffval:cutoff_val,
                date1:date_fil1,
                date2:date_fil2,
                action:"discount_cards"
            },
            dataType: "JSON",
            success: function (response) {
                
                $('#'+id).html(response)
            }
            })

        }



    </script>

    
  </body>

</html>
