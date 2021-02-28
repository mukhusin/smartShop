<?php 
    include '../string.php';
    include '../config/session.php';
    include '../config/Database.php';
    include '../action/Product.php';

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
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
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
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
   <!-- DataTables -->
   <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
   <!-- custom css -->
   <link rel="stylesheet" href="../css/mukhusin.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

 <!-- Navbar -->
 <?php include 'partials/nav.php' ?>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Manager</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
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
                  <i class="fas fa-stock mr-1"></i>
                  Stock Management
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#product-data" data-toggle="tab">products</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#add-stock" data-toggle="tab">Add stock</a>
                    </li>
                   
                    <li class="nav-item">
                      <a class="nav-link" href="#purchase-stock" data-toggle="tab">purchases</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#stock" data-toggle="tab">Stock</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <div class="tab-pane active" id="product-data" >
                    <button data-toggle="modal" data-target="#register-product"  class="btn btn-sm btn-primary float-left">Add product</button>
                    <table id="product-data-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>product name</th>
                              
                                <th>Bulk type</th>
                                <th>Items</th>
                                <th>Unit@each</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                               
                                foreach($product->fetchProducts() as $item){
                                     echo '
                                         <tr>
                                              <td>'.$item['name'].'</td>
                                          
                                              <td>'.$item['bulk'].'</td>
                                              <td>'.$item['qty'].'</td>
                                              <td>'.$item['unit'].'</td>
                                              <td>
                                                   <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit-product'.$item['id'].'">Edit</button>
                                                   <button data-toggle="modal" data-target="#delete-product-modal'.$item['id'].'" class="btn btn-sm btn-danger">Delete</button>
                                              </td>
                                         </tr>
                                     ';
                                }
                            ?>
                        </tbody>
                    </table>
                  </div>
                  <div class="tab-pane" id="add-stock" >
                    <!-- <button data-toggle="modal" data-target="#register-product"  class="btn btn-sm btn-primary float-left">Add product</button> -->
                    <table id="add-stock-data-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>product name</th>
                                <th>product code</th>
                                <th>Bulk type</th>
                                <th>Items</th>
                                <th>Unit@each</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                               
                                foreach($product->fetchProducts() as $item){
                                     echo '
                                         <tr>
                                              <td>'.$item['name'].'</td>
                                              <td>'.$item['code'].'</td>
                                              <td>'.$item['bulk'].'</td>
                                              <td>'.$item['qty'].'</td>
                                              <td>'.$item['unit'].'</td>
                                              <td>
                                                   <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-stock'.$item['id'].'">Add</button>
                                              </td>
                                         </tr>
                                     ';
                                }
                            ?>
                        </tbody>
                    </table>
                  </div>
                
                  <div class="tab-pane" id="purchase-stock">
                    <table id="purchase-data-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>product name</th>
                                    <th>bulk</th>
                                    <th>quantity</th>
                                    <th>buying price</th>
                                    <th>Retail price</th>
                                    <th>Wholesale price</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                  
                                    foreach($product->fetchPurchases() as $item){
                                        $productData = $product->productData($item['product_id']);
                                        echo '
                                            <tr>
                                                  <td>'.$item['created_at'].'</td>
                                                  <td>'.$productData['name'].'</td>
                                                  <td>'.$productData['bulk'].'</td>
                                                  <td>'.$item['qty'].'</td>
                                                  <td>'.number_format($item['bprice']).'</td>
                                                  <td>'.number_format($item['rsaleprice']).'</td>
                                                  <td>'.number_format($item['wsaleprice']).'</td>
                                                  <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#purchase'.$item['id'].'" >Edit</button></td>
                                            </tr>
                                        ';
                                    }
                                ?>
                            </tbody>
                     </table>
                  </div>

                  <div class="tab-pane" id="stock">
                    <table id="stock-data-table" class="table table-bordered table-hover">
                          <thead>
                              <tr>
                                  <th>product name</th>
                                  <th>quantity</th>
                                  <th>buying price</th>
                                  <th>Retail price</th>
                                  <th>Wholesale price</th>
                                  <th>Discount price</th>
                                  <th>action</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php 
                                
                                  foreach($product->fetchStock() as $item){
                                      $productData = $product->productData($item['product_id']);
                                      echo '
                                          <tr>
                                                <td>'.$productData['name'].'</td>
                                                <td>'.$product->bulkWithItermsStock($item['quantity'],$productData['qty'],$item['product_id']).'</td>
                                                <td>'.number_format($item['bprice']).'</td>
                                                <td>'.number_format($item['rsale_price']).'</td>
                                                <td>'.number_format($item['wsale_price']).'</td>
                                                <td><small>Retail</small>: <b>'.number_format($item['rdiscount']).'</b><small> Wholesale</small>: <b>'.number_format($item['wdiscount']).'</b></td>
                                                <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#stock-update'.$item['id'].'" >Edit</button></td>
                                          </tr>
                                      ';
                                  }
                              ?>
                          </tbody>
                    </table>
                  </div> 

                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

          </section>
          <!-- /.Left col -->
        
        </div>
        <!-- /.row (main row) -->
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
<?php
   include 'partials/modal.php';
?>
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

<script type="text/javascript">
  $(document).ready(function () {

    $("#product-data-table").DataTable({
        responsive: true,
        autoWidth: false
    });

    $("#stock-data-table").DataTable({
        responsive: true,
        autoWidth: false
    });

    $("#purchase-data-table").DataTable({
        responsive: true,
        autoWidth: false
    });

    $("#add-stock-data-table").DataTable({
        responsive: true,
        autoWidth: false
    });


    $("#registerproduct-form").ajaxForm({
        beforeSend: function() {
            $("#productwaiting").html(
                ' <div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
            );
        },

        success: function(response) {
            var data = response;
            
            if (data == 0) {
                $("#productwaiting").html("");
                toastr.error('product not inserted');
                $("#productmessage").html(
                    '<p class="text-danger">product not inserted</p>'
                );
            }
            if (data == 2) {
                $("#productwaiting").html("");
                toastr.error('all field are required');
                $("#shopmessage").html(
                    '<p class="text-danger">all feild are required</p>'
                );
            }
            if (data == 3) {
                $("#productwaiting").html("");
                toastr.error('product of the same name already added');
                $("#shopmessage").html(
                    '<p class="text-danger">product to the same name already added</p>'
                );
            }
            if (data == 1) {
                $("#registerproduct-form")[0].reset();
                toastr.success("product added successfully");
                $("#productwaiting").html("");
                $("#productmessage").html(
                    '<p class="text-success">product added successfully</p>'
                );
                location.reload();
            }
        }
    });
    // 

    $("body").delegate(".add-stock-btn", "click", function(event) {
        var productId = $(this).attr("productId");
        $("#add-stock-form" + productId).ajaxForm({
            beforeSend: function() {
                $("#addstockWainting"+productId).html(
                    ' <div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
                );
            },

            success: function(data) {
                if (data == 0) {
                    $("#addstockWainting"+productId).html("");
                    toastr.error('stock not added');
                    $("#stockmessage"+productId).html(
                        '<p class="text-danger">stock not added</p>'
                    );
                }
                if (data == 1) {

                    toastr.success("stock added successfully");
                    $("#addstockWainting"+productId).html("");
                    $("#stockmessage"+productId).html(
                        '<p class="text-success">stock added successfully</p>'
                    );
                    $("#add-stock-form" + productId)[0].reset();
                    location.reload();
                }
            }
        });

    });

    $("body").delegate(".delete-product-btn", "click", function(event) {
        var productId = $(this).attr("productId");
        $("#delete-product-form" + productId).ajaxForm({
            beforeSend: function() {
                $("#deletingWainting"+productId).html(
                    ' <div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
                );
            },

            success: function(data) {
                if (data == 0) {
                    $("#deletingWainting"+productId).html("");
                    toastr.error('product not deleted');
                    $("#deletemessage"+productId).html(
                        '<p class="text-danger">product not deleted</p>'
                    );
                }
                if (data == 1) {

                    toastr.success("product deleted successfully");
                    $("#deletingWainting"+productId).html("");
                    $("#deletemessage"+productId).html(
                        '<p class="text-success">product deleted successfully</p>'
                    );
                }
            }
        });

    });

    $("body").delegate(".update-product-btn", "click", function(event) {
          var productId = $(this).attr("productId");
          $("#update-product-form" + productId).ajaxForm({
              beforeSend: function() {
                  $("#productwaiting"+productId).html(
                      ' <div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
                  );
              },

              success: function(data) {
                  if (data == 0) {
                      $("#productwaiting"+productId).html("");
                      toastr.error('product not added');
                      $(".updatemessage").html(
                          '<p class="text-danger">product not updated</p>'
                      );
                      
                  }
                  if (data == 1) {
                      toastr.success("stock added successfully");
                      $("#productwaiting"+productId).html("");
                      $("#updatemessage"+productId).html(
                          '<p class="text-success">product updated successfully</p>'
                      );
                      location.reload();
                  }
              }
          });

      });


    $("body").delegate(".update-stock-btn", "click", function(event) {
          var productId = $(this).attr("productId");
          $("#update-stock-form" + productId).ajaxForm({
              beforeSend: function() {
                  $("#updatestockWainting"+productId).html(
                      ' <div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
                  );
              },

              success: function(data) {
                  if (data == 0) {
                      $("#updatestockWainting"+productId).html("");
                      toastr.error('Oops! stock not updated');
                      $("#updatestockmessage"+productId).html(
                          '<p class="text-danger">stock not updated</p>'
                      );
                      
                  }
                  if (data == 1) {
                      toastr.success("stock updated successfully");
                      $("#updatestockWainting"+productId).html("");
                      $("#updatestockmessage"+productId).html(
                          '<p class="text-success">stock updated successfully</p>'
                      );
                      location.reload();
                  }
              }
          });

      });

    $("body").delegate(".update-purchases-btn", "click", function(event) {
          var productId = $(this).attr("productId");
          $("#update-purchases-form" + productId).ajaxForm({
              beforeSend: function() {
                  $("#purchasesWainting"+productId).html(
                      ' <div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
                  );
              },

              success: function(data) {
                  if (data == 0) {
                      $("#purchasesWainting"+productId).html("");
                      toastr.error('Oops! purchases not updated');
                      $("#updatepurchasesmessage"+productId).html(
                          '<p class="text-danger">purchases not updated</p>'
                      );
                      
                  }
                  if (data == 1) {
                      toastr.success("purchases updated successfully");
                      $("#purchasesWainting"+productId).html("");
                      $("#updatepurchasesmessage"+productId).html(
                          '<p class="text-success">purchases updated successfully</p>'
                      );
                      location.reload();
                  }
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

    // disable mousewheel on a input number field when in focus
    // (to prevent Cromium browsers change the value when scrolling)
    $('form').on('focus', 'input[type=number]', function (e) {
      $(this).on('wheel.disableScroll', function (e) {
        e.preventDefault()
      })
    })
    $('form').on('blur', 'input[type=number]', function (e) {
      $(this).off('wheel.disableScroll')
    })


</script>

</body>
</html>
