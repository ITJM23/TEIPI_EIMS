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

    <title>IMS | Dashboard</title>

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

          <div class="container-fluid"><br>

            <!--Start Dashboard Content-->

            <div class="row">

              <div class="col-lg-4">
                <h4><b>Hello <span class="emp_fname">Employee</span>, </b></h4>
                <p class="text-muted">Dashboard > Home</p>
              </div>

              <div class="col-lg-4"></div>

              <div class="col-lg-4 text-right">

                <button type="button" class="btn btn-light border-info" onclick="filterByDate('')">This Month</button>
                <button type="button" class="btn btn-light border-info" onclick="filterByDate('1st')">First cutoff</button>
                <button type="button" class="btn btn-light border-info" onclick="filterByDate('2nd')">Last cutoff</button>

              </div>

            </div>

            <hr> 
            
            <div class="row">

              <div class="col-12 col-lg-4 col-xl-4">

                <div class="card">

                  <div class="card-header">Credit Chart <span class="text-info">(<?php echo date('F', strtotime("now")); ?>)</span>
                  </div>
                  
                  <div class="card-body">
                    
                    <div class="chart-container-2">
                      <canvas id="credit_chart1"></canvas>
                    </div><br>
                    
                    <table class="table">
                      <tbody>
                        <tr>
                          <td><i class="fa fa-circle mr-2" style="color:#b9c2ca;"></i>First Cutoff</td>
                          <td><b id="cutoff_1">P0.00</b></td>
                        </tr>
                        <tr>
                          <td><i class="fa fa-circle mr-2" style="color:#e2e2e2;"></i>Last Cutoff</td>
                          <td><b id="cutoff_2">P0.00</b></td>
                        </tr>
                      </tbody>
                    </table>

                  </div>

                </div>

                <div class="card">
                  
                  <div class="card-body">

                    <div class="d-flex align-items-center">

                      <div class="" style="width:50%;">
                        <h3 class="font-weight-bold"><b id="health_dec">---</b></h3>
                        <p class="small-font">Declared Temperature</p>
                      </div>

                      <div class="text-right" style="width:50%;">
                        <h2><i class="fa-solid fa-suitcase-medical"></i></h2>
                      </div>

                    </div>

                  </div>

                </div>

              </div>

              <div class="col-12 col-lg-8 col-xl-8">

                <div class="row m-0" id="discounts_card"></div>

                <div class="col-lg-12">

                  <div class="card">

                    <div class="card-body">

                      <div class="table-responsive">
      
                        <table class="table table-bordered table-striped table-hover" id="emp_trans_tbl" style="width:100%;">
                          
                          <thead class="text-uppercase bg-light">
                            <tr>
                                <th>Date Added</th>
                                <th>Transaction ID</th>
                                <th>Employee</th>
                                <th>Grand Total</th>
                                <th>Payment</th>
                                <th></th>
                            </tr>
                          </thead>
      
                        </table>
      
                      </div>

                    </div>

                  </div>
                  
                </div>

              </div>

              <div class="col-12 col-lg-12 col-xl-12">

                <div class="card">

                  <div class="card-header">Weekly Summary</div>

                  <div class="card-body">
                    <ul class="list-inline" id="pm_tab">
                      <li class="list-inline-item"><i class="fa fa-circle mr-2" style="color:#e2e2e2;"></i>Cash</li>
                      <li class="list-inline-item"><i class="fa fa-circle mr-2" style="color:#91a3b2;"></i>Credit</li>
                    </ul>
                    <div class="chart-container-1">
                      <canvas id="chart1"></canvas>
                    </div>
                  </div>
              
                </div>

              </div>  

              <div class="col-12 col-lg-4 col-xl-4">

                <!-- <div class="card">

                  <div class="card-header">Credit Information</div>

                  <div class="card-body" id="credit_stat"><br>

                    <h3> <span class="text-warning">0</span> day/s</h3>
                    <p class="text-muted">before you can transact through credit</p>

                  </div>
              
                </div> -->

                <div class="card" id="non_credit">

                  
              
                </div>

              </div>
            
            </div><!--End Row-->



            <!-- ===================== Transaction Details =================== -->
              <div class="modal" id="transDetMod">

                <div class="modal-dialog">

                  <div class="modal-content bg-dark text-white">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h5>Transaction Details <span class="text-info" id="transc_id"></span></h5>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                      <table class="table">
                        <tbody>
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
                          <!-- <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#menu2">Custom Amounts</a>
                          </li> -->
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

                          <!-- <div class="tab-pane fade" id="menu2">

                              <table class="table table-hover table-striped" id="cust_amount_tbl" style="width:100%;">

                                  <thead class="bg-light text-uppercase">
                                      <tr>
                                          <th>Item</th>
                                          <th>Amount</th>
                                      </tr>
                                  </thead>

                                  <tbody class="table-bordered"></tbody>

                              </table>

                          </div> -->

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

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    </div>

                  </div>

                </div>

              </div>
            <!-- ===================== Transaction Details END =============== -->

            <!--End Dashboard Content-->
          
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

    <!-- sidebar-menu js -->
    <script src="../assets/js/sidebar-menu.js"></script>

    <!-- loader scripts -->
    <script src="../assets/js/jquery.loading-indicator.js"></script>

    <!-- Custom scripts -->
    <script src="../assets/js/app-script.js"></script>

    <!-- Chart js -->
    <script src="../assets/plugins/Chart.js/Chart.min.js"></script>

    <script src="../assets/js/functions.js"></script>


    <script>

        $(document).ready(function(){

          discountCards('discounts_card', '')

          credSummChart('credit_chart1')

          empTrans('emp_trans_tbl', '')

          healthDec('health_dec') 

          weeklySummChart()

          creditInfo('non_credit')
 
        })



        function empTrans(id, cutoff_val){

          var dataTable = $('#'+id).DataTable({

              "responsive": true,
              "processing": true,
              "serverSide": true,
              "bSort": false,
              "bInfo":false,
              "order" : [],
              "searching": false,
              "pageLength": 5,
              "ajax" : {
                  url:"datatables/emp_transc_tbl.php",
                  type: "POST",
                  data:{
                    cutoffval:cutoff_val
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



        function discountCards(id, cutoff_val){

          $.ajax({
            type: "POST",
            url: "exec/fetch.php",
            data: {
              cutoffval:cutoff_val,
              action:"discount_cards"
            },
            dataType: "JSON",
            success: function (response) {
              
              $('#'+id).html(response)
            }
          })

        }

        

        // ============== Transaction Details ================
          function viewTransDet(trans_id){

            $('#transDetMod').modal('show')

            orderInfo(trans_id)

            $('#trans_det_tbl').DataTable().destroy()
            transDetails('trans_det_tbl', trans_id)


            $('#transc_id').html("("+ trans_id.slice(0, 10) +")")


            $('#discounts_tbl').DataTable().destroy()
            discountsTbl('discounts_tbl', trans_id)
          }



          function transDetails(id, trans_id){

            var dataTable = $('#'+id).DataTable({

              "responsive": true,
              "processing": true,
              "serverSide": true,
              "bSort": false,
              "searching":false,
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



          function discountsTbl(id, trans_id){

            var dataTable = $('#'+id).DataTable({

              "responsive": true,
              "processing": true,
              "serverSide": true,
              "bSort": false,
              "bInfo":false,
              "searching": false,
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
                    
                    $('#emp_name').html(response.Fname +" "+ response.Lname)
                    $('#trans_total').html("P"+response.GTotal)
                    $('#cash_amount').html(response.Payment)
                    $('#cash_change').html(response.PChange)
                    $('#payment').html(response.PMethod)
                }
            })
          }
        // ============== Transaction Details END ============

        

        function credSummChart(id){

          $.ajax({
            type: "POST",
            url: "exec/fetch.php",
            data: {
              action:"cred_summ_chart"
            },
            dataType: "JSON",
            success: function (response) {
              
              var ctx = document.getElementById(id).getContext('2d');

              var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                  labels: ['First Cutoff', 'Last Cutoff'],
                  datasets: [{
                    backgroundColor: ["#b9c2ca", "#e2e2e2"],
                    data: response.DataSet,
                    borderWidth: [0, 0]
                  }]
                },
                options: {
                  maintainAspectRatio: false,
                  legend: {
                    position :"top",	
                    display: false,
                    labels: {
                      fontColor: '#ddd',  
                      boxWidth:15
                    }
                  },
                  tooltips: {
                    displayColors:false
                  }
                }

              })

              $('#cutoff_1').html("P"+response.Total1)
              $('#cutoff_2').html("P"+response.Total2)

            } 
          })

        }



        function filterByDate(cutoff_val){

          
          discountCards('discounts_card', cutoff_val)
          
          $('#emp_trans_tbl').DataTable().destroy()
          empTrans('emp_trans_tbl', cutoff_val)
        }



        function healthDec(id){

          $.ajax({
            type: "POST",
            url: "exec/fetch.php",
            data: {
              action:"health_dec_temp"
            },
            dataType: "JSON",
            success: function (response) {

              if(response.TempStat == 'Not Allowed'){

                $('#'+id).attr('class', 'text-danger')
              }
              
              else{
                
                $('#'+id).attr('class', 'text-success')
              }

              $('#'+id).html(response.TempVal)
            }

          })
        }

        

        function weeklySummChart(){

          $.ajax({
            type: "POST",
            url: "exec/fetch.php",
            data: {
              action:"weekly_summ_chart"
            },
            dataType: "JSON",
            success: function (response) {
              
              var ctx = document.getElementById('chart1').getContext('2d');

              var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: response.DaysArr,
                  datasets: [{
                    label: 'Cash',
                    data: response.CashArr,
                    backgroundColor: '#e2e2e2',
                    borderColor: "transparent",
                    pointRadius :"0",
                    borderWidth: 3
                  }, {
                    label: 'Credit',
                    data: response.CreditArr,
                    backgroundColor: "#91a3b2",
                    borderColor: "transparent",
                    pointRadius :"0",
                    borderWidth: 1
                  }]
                },
                options: {
                  maintainAspectRatio: false,
                  legend: {
                    display: false,
                    labels: {
                      fontColor: '#ddd',  
                      boxWidth:40
                    }
                  },
                  tooltips: {
                    displayColors:false
                  },	
                  scales: {
                    xAxes: [{
                      ticks: {
                        beginAtZero:true,
                        fontColor: '#ddd'
                      },
                      gridLines: {
                        display: true ,
                        color: "rgba(221, 221, 221, 0.08)"
                      },
                      stacked: true 
                    }],
                    yAxes: [{
                      ticks: {
                        beginAtZero:true,
                        fontColor: '#ddd'
                      },
                      gridLines: {
                        display: true ,
                        color: "rgba(221, 221, 221, 0.08)"
                      },
                      stacked: true
                    }]
                    }

                  }
                }
              )
            }
            
          })

        }



        function creditInfo(id){

          $.ajax({
            type: "POST",
            url: "exec/fetch.php",
            data: {
              action:"credit_info"
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
