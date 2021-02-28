<?php
include '../config/session.php';
include '../string.php';
include '../config/Database.php';
include '../action/User.php';
include '../action/Product.php';
if ($_SESSION['role'] != 'Manager') {
  session_destroy();
  header('location: ../');
}

$product = new Product();

$user = new User();
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

  <title><?php echo $project . ' ' . $subname ?> | Manager</title>

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
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
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
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h4 class="m-0 text-dark">Dashboard</h4>
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
          <!-- Small boxes (Stat box) -->

          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 col-sm-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-users mr-1"></i>
                    Manage Users
                  </h3>

                </div><!-- /.card-header -->
                <div class="card-body">
                  <button data-toggle="modal" data-target="#register-user" class="btn btn-sm btn-primary float-left">Add user</button>
                  <table id="user-data-table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Full name</th>
                        <th>Phone number</th>
                        <th>Gender</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>action</th>
                      </tr>
                    </thead>
                    <tbody>
                     
                        <?php foreach ($user->fetchUser() as  $value) { ?>
                          <tr>
                            <td> <?php echo $value['name'] ?></td>
                            <td> <?php echo $value['phone'] ?></td>
                            <td> <?php echo $value['gender'] ?></td>
                            <td> <?php echo $value['username'] ?></td>
                            <td> <?php echo $value['role'] ?></td>
                            <td>
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#edit-user<?php echo $value['id'] ?>">Edit</button>
                                <!-- <button class="btn btn-sm btn-warning user_manage_btn" mode="deactivate" userId = <?php //echo $value['id'] ?> >Deactivate</button> -->
                                <?php 
                                    if ($value['id'] != $_SESSION['userID']) {?>
                                      <button class="btn btn-sm btn-danger user_manage_btn" mode = "delete" userId = <?php echo $value['id'] ?> >Delete</button>
                                <?PHP    }
                                ?>
                            </td>
                          </tr>
                        <?php } ?>
                    
                    </tbody>
                  </table>
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
      <strong>Copyright &copy; <?php echo date('Y') ?> <a href="mailto:mukhusinsiraji@gmail.com">MS</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <?php
    include 'partials/modal.php';
  ?>

  <?php
     include 'partials/static-modal.php';
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
    $(document).ready(function() {

      $("#user-data-table").DataTable({
        responsive: true,
        autoWidth: false
      });

      $("#registeruser-form").ajaxForm({
        beforeSend: function() {
          $("#userwaiting").html(
            ' <div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
          );
        },

        success: function(response) {
          var data = response;

          if (data == 0) {
            $("#userwaiting").html("");
            toastr.error('user not added');
            $("#usermessage").html(
              '<p class="text-danger">user not added</p>'
            );
          }
          if (data == 2) {
            $("#userwaiting").html("");
            toastr.error('all field are required');
            $("#usermessage").html(
              '<p class="text-danger">all feild are required</p>'
            );
          }
          if (data == 3) {
            $("#userwaiting").html("");
            toastr.error('user of the same name already added');
            $("#usermessage").html(
              '<p class="text-danger">user of the same name already added</p>'
            );
          }
          if (data == 4) {
            $("#userwaiting").html("");
            toastr.error('password does not match');
            $("#usermessage").html(
              '<p class="text-danger">password does not match</p>'
            );
          }
          if (data == 1) {
            $("#registeruser-form")[0].reset();
            toastr.success("user added successfully");
            $("#userwaiting").html("");
            $("#usermessage").html(
              '<p class="text-success">user added successfully</p>'
            );
            location.reload();
          }
        }
      });

      $("body").delegate(".update-user-btn", "click", function(event) {
        var userId = $(this).attr("userId");
        $("#update-user-form" + userId).ajaxForm({
            beforeSend: function() {
                $("#updateUserWainting"+userId).html(
                    ' <div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
                );
            },

            success: function(data) {
                if (data == 0) {
                    $("#updateUserWainting"+userId).html("");
                    toastr.error('something happend user not updated');
                    $("#updateUserMessage"+userId).html(
                        '<p class="text-danger">something happend user not updated</p>'
                    );
                }
                if (data == 1) {

                    toastr.success("user updated successfully");
                    $("#updateUserWainting"+userId).html("");
                    $("#updateUserMessage"+userId).html(
                        '<p class="text-success">user updated successfully</p>'
                    );
                    location.reload();
                }
            }
        });

      });

      $("body").delegate(".user_manage_btn", "click", function(event) {
        var userID = $(this).attr("userId");
        var mode = $(this).attr("mode");
        if (confirm('Are you sure you want to Delete this user ?')) {
          $.post('../route/web.php',   // url
              { deleteUser: 1,userID : userID,mode: mode}, // data to be submit
              function(data, status, jqXHR) {// success callback
                  // $('#cat-data').append('status: ' + status + ', data: ' + data);
                  if (data == 1) {
                    toastr.success('User deleted successfully !');
                    location.reload();
                  }
                  if (data != 1) { 
                    toastr.error("Ops something went wrong !!");
                  }
                  
              });
        }
       
      });

    });
  </script>
</body>

</html>