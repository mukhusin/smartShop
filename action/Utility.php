<?php 
 
 class TableFlush extends DatabaseConnection
 {
     function flushTable(){
        $cat = $this->connect()->prepare("TRUNCATE TABLE `cat`");
        $cat->execute();

        $products = $this->connect()->prepare("TRUNCATE TABLE `products`");
        $products->execute();

        $purchases = $this->connect()->prepare("TRUNCATE TABLE `purchases`");
        $purchases->execute();

        $sales = $this->connect()->prepare("TRUNCATE TABLE `sales`");
        $sales->execute();

        $stock = $this->connect()->prepare("TRUNCATE TABLE `stock`");
        $stock->execute();
       
     }
 }
 
   
?>