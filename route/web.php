 <?php
 include '../config/Database.php';
 include '../action/Product.php';
 include '../action/User.php';
 include '../action/Auth.php';

 $product = new Product();
 $user = new User();
 $auth = new Auth();
 
    if(isset($_POST['registerProduct'])){
          $product->registerProduct();
    }

    if(isset($_POST['addStock'])){
          $product->addStock();
    }

    if(isset($_POST['updateProduct'])){
          $product->updateProduct();
    }

    if(isset($_POST['deleteProduct'])){
          $product->deleteProduct();
    }

    if(isset($_POST['updateStock'])){
          $product->updateStock();
    }

    if(isset($_POST['updatePurchases'])){
          $product->updatePurchases();
    }

    if(isset($_POST['addUser'])){
          $user->addUser();
    }

    if(isset($_POST['updateUser'])){
          $user->updateUser();
    }
    
    if(isset($_POST['addTocart'])){
          $product->addTocart();
    }

    if(isset($_POST['deleteFromCart'])){
          $product->deleteFromCart();
    }

    if(isset($_POST['fetchCartData'])){
          $from = $_POST['from'];
          $product->cartData($from);
    }

    if(isset($_POST['saleDiscount'])){
          $product->saleDiscount();
    }

    if(isset($_POST['saleQty'])){
          $product->saleQty();
    }

    if(isset($_POST['saleProduct'])){
          $product->salingProduct();
    }

    if(isset($_POST['login'])){
          $auth->Authentication();
    }

    if(isset($_GET['auth-redirect'])){
          $auth->redirect();
    }

    if(isset($_POST['logout'])){
          $auth->logout();
    }

    if(isset($_POST['changePassword'])){
          $user->changePassword();
    }

    if(isset($_POST['deleteUser'])){
          $user->deleteUser();
    }

    if(isset($_POST['salesDoc'])){
          $from = $_POST['from'];
          $to = $_POST['to'];
          header('location: ../pdfDoc/salesDoc.php?from='.$from.'&to='.$to);
    }

    if(isset($_POST['purchasesDoc'])){
          $from = $_POST['from'];
          $to = $_POST['to'];
          header('location: ../pdfDoc/purchasesDoc.php?from='.$from.'&to='.$to);
    }

    if(isset($_POST['rsalesSummaryDoc'])){
          $from = $_POST['from'];
          $to = $_POST['to'];
          header('location: ../pdfDoc/rsales-summary-report.php?from='.$from.'&to='.$to);
    }

    if(isset($_POST['wsalesSummaryDoc'])){
          $from = $_POST['from'];
          $to = $_POST['to'];
          header('location: ../pdfDoc/wsales-summary-report.php?from='.$from.'&to='.$to);
    }


?>