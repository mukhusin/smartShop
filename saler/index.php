
<?php 
    include '../string.php';
    include '../config/session.php';
    include '../config/Database.php';
    include '../action/Product.php';
    if ($_SESSION['role'] != 'Saler') {
       session_destroy();
       header('location: ../');
    }
    $product = new Product();
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo $project.' '.$subname ?>  | <?php echo $_SESSION['role'] ?></title>

 <!-- Font Awesome -->
 <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
     <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <?php include 'partials/nav.php' ?>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <?php include 'partials/header.php' ?>
    <!-- /.content-header -->

     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
      
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 col-sm-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Shop Activities
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#wholesale-data" data-toggle="tab">Wholesale</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="retail-sale.php" >Retail Sale</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                  <div class="tab-content p-0">
                        <!-- Morris chart - Sales -->
                      <div class="chart tab-pane active" id="wholesale-data">
                          <div class="row">
                              <div class="col-md-7">
                                  <table id="wholesale-data-table" class="table table-bordered table-hover">
                                          <thead>
                                              <tr>
                                                  <th>product name</th>
                                                  <th>bulk</th>
                                                  <th>unit</th>  
                                                  <th>Price</th>
                                                  <th>Discount</th>
                                                  <th>action</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php 
                                                  // check if the product has enough quantity
                                                  foreach($product->fetchStock() as $item){
                                                      $productData = $product->productData($item['product_id']);
                                                      echo '
                                                          <tr>
                                                                <td>'.$productData['name'].'</td>
                                                                <td><b>'.$product->bulkAvailable($item['quantity'],$productData['qty']).'</b> '.$productData['bulk'].'</td>
                                                                <td>'.$productData['unit'].'</td>
                                                                <td><b>'.$item['wsale_price'].'</b></td>
                                                                <td><b>'.$item['wdiscount'].'</b></td>
                                                                <td>';
                                                                  if ($product->bulkAvailable($item['quantity'],$productData['qty']) > 0) {
                                                                      echo '<button from="wsale" dataId = '.$item['id'].' productId = '.$item['product_id'].' title="Add to cart" class="btn btn-sm btn-success addTocartBtn"  >Add</button>';
                                                                  } else {
                                                                      echo '<button disabled  title="check your stock" class="btn btn-sm btn-danger"  >Add</button>';
                                                                  }
                                                                  
                                                      echo     '</td>
                                                          </tr>
                                                      ';
                                                  }
                                              ?>
                                          </tbody>
                                    </table>      
                              </div>              
                              <div class="col-md-5">
                                  <div class="alert alert-info mt-1">Wholesale Summary</div>
                                  <!-- <form id="saleWholesale-form" action="../route/web.php" method="POST" class="cat-data"> -->
                                  <div class="cat-data"><?php $product->cartData('wsale') ?></div>
                                        
                                  <!-- </form> -->
                              </div>             
                          </div> 
                      </div>
                    
                    </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

          </section>
          <!-- /.Left col -->
        
        </div>
        <!-- /.row (main row) -->

        <!-- Small boxes (Stat box) -->
        <div class="row mt-5">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Today - <b><?php echo date('d, M Y') ?></b> Sales Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="todaySales" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Time</th>
                      <th>Product name</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Discount</th>
                      <th>Total Price</th>
                      <th>Profit</th>
                    </tr>
                  </thead>
                  <tbody>
                     <!-- 	id	user_id	product_id	qty	bulk
                      	price	total_price	discount	recept	type	created_at -->
                      <?php 
                         foreach ($product->todaySalesData() as $value) {
                           $productData = $product->productData($value['product_id']);
                           $stock = $product->stockData($value['product_id']);
                           $profit = $value['total_price'] - ($stock['bprice'] * $value['qty']);
                           if ($value['type'] == 'rsale') {
                               $profit = $value['total_price'] - (($stock['bprice'] / $productData['qty']) * $value['qty']);
                           }
                            echo '
                                <tr>
                                    <td>'.$value['created_at'].'</td>
                                    <td>'.$productData['name'].'</td>';
                                    if ($value['type'] == 'wsale') {
                                        echo '<td><b>'.$value['qty'].'</b> '.$productData['bulk'].'</td>';
                                    }
                                    if ($value['type'] == 'rsale') {
                                      echo '<td>'.$value['qty'].'</td>';
                                    }
                            echo '        
                                    <td>'.$value['price'].'</td>
                                    <td>'.$value['discount'].'</td>
                                    <td>'.$value['total_price'].'</td>
                                    <td>'.$profit.'</td>
                                </tr>
                            ';
                         }
                      ?>
                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Time</th>
                        <th>Product name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Total Price</th>
                        <th>Profit</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           
          </div>
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->
   <?php
      include 'partials/modal.php';
    ?>
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline text-danger">
      Not yet paid
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date('Y') ?> <a href="mailto:mukhusinsiraji@gmail.com" >MS</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- SweetAlert2 -->
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../plugins/toastr/toastr.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<script src="../js/jquery.form.js"></script>
<!-- <script src="../js/klikod.js"></script> -->
<script>
      jQuery.fn.putCursorAtEnd = function() {

      return this.each(function() {
        
        // Cache references
        var $el = $(this),
            el = this;

        // Only focus if input isn't already
        if (!$el.is(":focus")) {
        $el.focus();
        }

        // If this function exists... (IE 9+)
        if (el.setSelectionRange) {

          // Double the length because Opera is inconsistent about whether a carriage return is one character or two.
          var len = $el.val().length * 2;
          
          // Timeout seems to be required for Blink
          setTimeout(function() {
            el.setSelectionRange(len, len);
          }, 1);
        
        } else {
          
          // As a fallback, replace the contents with itself
          // Doesn't work in Chrome, but Chrome supports setSelectionRange
          $el.val($el.val());
          
        }

        // Scroll to the bottom, in case we're in a tall textarea
        // (Necessary for Firefox and Chrome)
        this.scrollTop = 999999;

      });

      };
</script>
<script type="text/javascript">
  $(document).ready(function () {

    $("#retailsale-data-table").DataTable({
        responsive: true,
        autoWidth: false
    });

    $("#wholesale-data-table").DataTable({
        responsive: true,
        autoWidth: false
    });
    $("#todaySales").DataTable({
        responsive: true,
        autoWidth: false
    });
    


    $("body").delegate(".addTocartBtn", "click", function(){
        var productId = $(this).attr("productId");
        var from = $(this).attr("from");
        var dataId = $(this).attr("dataId");
        $.post('../route/web.php',   // url
          { addTocart: 1,productId: productId,from : from,dataId : dataId }, // data to be submit
          function(data, status, jqXHR) {// success callback
              // $('#cat-data').append('status: ' + status + ', data: ' + data);
             if (data == 1) {
                toastr.error("product already added !!");
             } else {
               $('.cat-data').html(data);
             }
          });
    });
    

    
    $("body").delegate(".deleteFromCart", "click", function(){
        var dataId = $(this).attr("dataId");
        var from = $(this).attr("from");
        
        $.post('../route/web.php',   // url
          { deleteFromCart: 1,dataId : dataId ,from:from}, // data to be submit
          function(data, status, jqXHR) {// success callback
              // $('#cat-data').append('status: ' + status + ', data: ' + data);
             if (data == 1) {
               location.reload();
                // toastr.success("product removed !!");
                // fetchCartData(from);
             } else {
                toastr.error("product not removed !!");
             }
          });
		});


    $("body").delegate(".input-discount", "keyup", function(e){
      e.preventDefault();
        var amount = $(this).val();
        var productId = $(this).attr('productId');
        var qty = $(this).attr('qty');
        var from = $(this).attr('from');
        $('.input-discount')
        $.post('../route/web.php',   // url
          { saleDiscount: 1,amount : amount,productId: productId, from : from,qty:qty }, // data to be submit
          function(data, status, jqXHR) {// success callback
              // $('#cat-data').append('status: ' + status + ', data: ' + data);
            if (data == 1) {
              fetchCartData(from,productId,"input-discount");
              // $("#"+inp+id).focus().val($("#"+inp+id).val());
             
            }
            if (data == 5) {
              toastr.error("Sorry discount is out of range !!");
            }
         
            
          });
		});


    $("body").delegate(".input-qty", "keyup", function(){
        var qty = $(this).val();
        var productId = $(this).attr('productId');
        var from = $(this).attr('from');
        var amount = $(this).attr('discount');

        $.post('../route/web.php',   // url
          { saleQty: 1,qty : qty,productId: productId, from: from ,amount:amount}, // data to be submit
          function(data, status, jqXHR) {// success callback
              // $('#cat-data').append('status: ' + status + ', data: ' + data);
              if (data == 1) {
                fetchCartData(from,productId,"input-qty");
              }
              if (data == 5) {
                toastr.error("Sorry quantity is out of range !!");
              }
              
          });
    });

  

    // saleWholesale-form
    $("#saleWholesale-form").ajaxForm({
          beforeSend: function() {
              $(".sale-btn").html(
                  ' <div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
              );
          },
          success: function(data) {
              if (data == 0) {
                  $(".sale-btn").html("sale");
                  toastr.error('Ooops! something went wrong');                 
              }
              if (data == 1) {                
                  toastr.success('success');
                  $(".sale-btn").html("sale");
                  location.reload();
              }
          }
    });

    $("body").delegate(".sale-btn", "click", function(){

        var from = $(this).attr('from');

        $.post('../route/web.php',   // url
          { saleProduct: 1, from: from }, // data to be submit
          function(data, status, jqXHR) {// success callback
              // $('#cat-data').append('status: ' + status + ', data: ' + data);
              if (data == 1) {
                 toastr.success('success');
                  // $(".sale-btn").html("sale");
                  location.reload();
              }
              if (data == 5) {
                 toastr.success('success');
                  // $(".sale-btn").html("sale");
                  location.reload();
              }
              
          });
    });



    $("#changepassword-form").ajaxForm({
        beforeSend: function() {
            $("#waiting-saving").html(
                ' <div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
            );
        },

        success: function(data) {
            if (data == 5) {
                $("#waiting-saving").html("");
                toastr.error('New password and Confirm password does not match !!');
                $("#changepassworsms").html(
                    '<p class="text-danger">New password and Confirm password does not match !!</p>'
                );
            }
            if (data == 4) {
                $("#waiting-saving").html("");
                toastr.error('Wrong current password !!');
                $("#changepassworsms").html(
                    '<p class="text-danger">Wrong current password !!</p>'
                );
            }
            if (data == 1) {
                $("#changepassword-form")[0].reset();
                toastr.success('Password changed successfully !!');
                $("#waiting-saving").html("");
                $("#changepassworsms").html(
                    '<p class="text-success">Password changed successfully !!</p>'
                );
            }
        }
    });
   
  }); 
  // end of document get ready

  $('form').on('focus', 'input[type=number]', function (e) {
      $(this).on('wheel.disableScroll', function (e) {
        e.preventDefault()
      })
    })
    $('form').on('blur', 'input[type=number]', function (e) {
      $(this).off('wheel.disableScroll')
    })

    function fetchCartData(from,id,inp){
      var from = from;
      $.post('../route/web.php',   // url
          { fetchCartData: 1,from: from }, // data to be submit
          function(data, status, jqXHR) {// success callback
              // $('#cat-data').append('status: ' + status + ', data: ' + data);
              $('.cat-data').html(data);
              var fieldInput = $("#"+inp+id);
              var fldLength= fieldInput.val().length;
              fieldInput.focus();
              fieldInput[0].setSelectionRange(fldLength, fldLength);
          });
    }

  </script>
</body>
</html>



<!-- // alert($("#"+inp+id).val())
              // $("#"+inp+id).focus();
              $("#"+inp+id).focus().val($("#"+inp+id).val());
              // var searchInput = $("#"+inp+id);

              // searchInput
              //   .putCursorAtEnd() // should be chainable
              //   .on("focus", function() { // could be on any event
              //     searchInput.putCursorAtEnd()
              // }); -->