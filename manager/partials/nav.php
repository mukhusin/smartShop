<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="index.php" class="navbar-brand">
        <img src="../dist/img/AdminLTELogo.png" alt="<?php echo $project.' '.$subname ?>" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo $project.' '.$subname ?></span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index.php" class="nav-link active">Dashboard</a>
          </li>
          <li class="nav-item">
            <a href="index.php" class="nav-link">Sale</a>
          </li>
          <li class="nav-item">
            <a href="users.php" class="nav-link">Users</a>
          </li>
         
          <li class="nav-item">
            <a href="manage-stock.php" class="nav-link">Stock</a>
          </li>

          <li class="nav-item dropdown">
                <a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Reports</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                    <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#sales-doc-modal" >Sales Report </a></li>
                    <li><a href="../pdfDoc/productDoc.php" class="dropdown-item">Product Report </a></li>
                    <li><a href="#" class="dropdown-item"  data-toggle="modal" data-target="#purchases-doc-modal">Purchases Report</a></li>
                    <li><a href="../pdfDoc/stockDoc.php" target="_blank" class="dropdown-item">Stock Report</a></li>
                </ul>
               
           </li>
        </ul>

        <ul class="navbar-nav ml-auto">
         
          <li class="nav-item dropdown">
                <a id="dropdownSubMenu3" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><?php echo $_SESSION['username'] ?></a>
                <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                    <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#change-password" >Change Password </a></li>
                    <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#logout" >Logout </a></li>
                </ul>
        
           </li>
        </ul>

      </div>

    </div>
  </nav>