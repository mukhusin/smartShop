<?php  if ($_GET['type'] == "today_purchases") {?>
        <table id="todaySales" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Time</th>
                <th>Product name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Total Price</th>
            </tr>
            </thead>
            <tbody>
                <!-- 	id	user_id	product_id	qty	bulk
                price	total_price	discount	recept	type	created_at -->
                <?php 
                    foreach ($product->todaySalesData() as $value) {
                    $productData = $product->productData($value['product_id']);
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
            </tr>
            </tfoot>
        </table>
  <?php } ?>



 <?php  if ($_GET['type'] == "whole_out") {?>
         
  <?php }?>

  <?php if ($_GET['type'] == "retail_out") {?>
       
 <?php  }
   
  
?>