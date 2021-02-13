<?php

class Product extends DatabaseConnection
{

    public function registerProduct()
    {
        $name = $_POST['name'];
        $code = $_POST['code'];
        $bulk = $_POST['bulk'];
        $qty = $_POST['qty'];
        $unit = $_POST['unit'];

        // name 	code 	bulk 	qty 
        if ($name != "" && $code != "" && $bulk != "" && $qty != "") {

            $check = $this->connect()->prepare("SELECT * FROM products WHERE name = ?");
            $check->execute([$name]);

            if ($check->rowCount() == 0) {
                $stmt = $this->connect()->prepare("INSERT INTO products (name,code,bulk,qty,unit) VALUES(?,?,?,?,?)");
                if ($stmt->execute([$name, $code, $bulk, $qty, $unit])) {
                    // echo"New product added successfully";
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                echo 3;
            }
        } else {
            echo 2;
        }
    }

    public function fetchProducts()
    {
        $data = $this->connect()->prepare("SELECT * FROM products");
        $data->execute();
        return $data->fetchAll();
    }

    public function fetchStock()
    {
        $data = $this->connect()->prepare("SELECT * FROM stock");
        $data->execute();
        return $data->fetchAll();
    }

    public function fetchPurchases()
    {
        $data = $this->connect()->prepare("SELECT * FROM purchases");
        $data->execute();
        return $data->fetchAll();
    }

    public function productData($id)
    {
        $data = $this->connect()->prepare("SELECT * FROM products WHERE id = $id");
        $data->execute();
        return $data->fetch();
    }

    public function stockData($id)
    {
        $data = $this->connect()->prepare("SELECT * FROM stock WHERE product_id = $id");
        $data->execute();
        return $data->fetch();
    }
    public function stockRowData($id)
    {
        $data = $this->connect()->prepare("SELECT * FROM stock WHERE id = $id");
        $data->execute();
        return $data->fetch();
    }

    public function addStock()
    {
        $id = $_POST['productId'];
        $qty = $_POST['qty'];
        $rsaleprice = $_POST['rsaleprice'];
        $wsaleprice = $_POST['wsaleprice'];
        $bprice = $_POST['bprice'];
        $rdiscount = $_POST['rdiscount'];
        $wdiscount = $_POST['wdiscount'];
        // product_id 	qty 	bprice 	rsaleprice 	wsaleprice 
        $numberOfItems = $this->productData($id);
        $bulk = $numberOfItems['qty'];
        $items = $bulk * $qty;
        $stmt = $this->connect()->prepare("INSERT INTO purchases (product_id,qty,bprice,rsaleprice,wsaleprice) VALUES(?,?,?,?,?)");
        $stmt->execute([$id, $qty, $bprice, $rsaleprice, $wsaleprice]);

        $check = $this->connect()->prepare("SELECT * FROM stock WHERE product_id = ?");
        $check->execute([$id]);

        if ($check->rowCount() == 1) {
            $data = $check->fetch();
            $newQty = $data['quantity'] + $items;
            $stmt = $this->connect()->prepare("UPDATE stock SET quantity = ?, bprice = ?, rsale_price = ? , wsale_price = ?,rdiscount = ?,wdiscount = ? WHERE product_id = $id");
            if ($stmt->execute([$newQty, $bprice, $rsaleprice, $wsaleprice, $rdiscount, $wdiscount])) {
                // echo"New product added successfully";
                echo 1;
            } else {
                echo 0;
            }
        } else {
            $stmt = $this->connect()->prepare("INSERT INTO stock (product_id,quantity,bprice,rsale_price,wsale_price,rdiscount,wdiscount) VALUES(?,?,?,?,?,?,?)");
            if ($stmt->execute([$id, $items, $bprice, $rsaleprice, $wsaleprice, $rdiscount, $wdiscount])) {
                // echo"New product added successfully";
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    public function updateProduct()
    {
        // name	code	unit	bulk	qty 
        $name = $_POST['name'];
        $code = $_POST['code'];
        $bulk = $_POST['bulk'];
        $qty = $_POST['qty'];
        $unit = $_POST['unit'];
        $productId = $_POST['productId'];

        $stmt = $this->connect()->prepare("UPDATE products SET name = ? , code = ?, unit = ?, bulk = ? , qty = ? WHERE id = $productId");
        if ($stmt->execute([$name, $code, $unit, $bulk, $qty])) {
            // echo"New product added successfully";
            echo 1;
        } else {
            echo 0;
        }
    }

    public function deleteProduct()
    {
        $id = $_POST['productId'];
        $delPurchases = $this->connect()->prepare("DELETE FROM purchases WHERE product_id = $id");
        $delPurchases->execute();
        $delstock = $this->connect()->prepare("DELETE FROM stock WHERE product_id = $id");
        $delstock->execute();

        $delproducts = $this->connect()->prepare("DELETE FROM products WHERE id = $id");
        if ($delproducts->execute()) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function updatePurchases()
    {
        $id = $_POST['id'];
        $productId = $_POST['productId'];
        $oldqty = $_POST['oldqty'];
        $qty = $_POST['qty'];
        $rsaleprice = $_POST['rsaleprice'];
        $wsaleprice = $_POST['wsaleprice'];
        $bprice = $_POST['bprice'];
        // you need to check if it exists in the stock
        $stockData = $this->stockData($productId);
        if ($stockData['quantity'] > $oldqty) {
            $sum = $stockData['quantity'] - $oldqty;
            $newQty = $sum + $qty;
        } else {
            $newQty = $stockData['quantity'];
        }

        //product_id,qty,bprice,rsaleprice,wsaleprice
        $stmt = $this->connect()->prepare("UPDATE stock SET quantity = ? WHERE product_id = $productId");
        $stmt->execute([$newQty]);
        $stmt = $this->connect()->prepare("UPDATE purchases SET qty = ?, bprice = ?, rsaleprice = ? , wsaleprice = ? WHERE id = $id");
        if ($stmt->execute([$qty, $bprice, $rsaleprice, $wsaleprice])) {
            // echo"New product added successfully";
            echo 1;
        } else {
            echo 0;
        }
    }

    public function updateStock()
    {
        $id = $_POST['id'];
        $qty = $_POST['qty'];
        $rsaleprice = $_POST['rsaleprice'];
        $wsaleprice = $_POST['wsaleprice'];
        $bprice = $_POST['bprice'];
        $rdiscount = $_POST['rdiscount'];
        $wdiscount = $_POST['wdiscount'];

        // $numberOfItems = $this->productData($id);
        // $bulk = $numberOfItems['qty'];
        // $items = $bulk * $qty;

        $stmt = $this->connect()->prepare("UPDATE stock SET quantity = ?, bprice = ?, rsale_price = ? , wsale_price = ?,rdiscount = ?,wdiscount = ? WHERE id = $id");
        if ($stmt->execute([$qty, $bprice, $rsaleprice, $wsaleprice, $rdiscount, $wdiscount])) {
            // echo"New product added successfully";
            echo 1;
        } else {
            echo 0;
        }
    }

    public function addTocart()
    {
        // 	id 	product_id 	qty 	selling_price 	total_price 	created_at 	type 	recept_num discount
        $id = $_POST['productId'];
        $from = $_POST['from'];
        $dataId = $_POST['dataId'];
        $check = $this->connect()->prepare("SELECT * FROM `cat` WHERE type = '$from'");
        $check->execute();
        $stockData = $this->stockRowData($dataId); //id 	product_id 	quantity 	bprice 	rsale_price 	wsale_price 	rdiscount 	wdiscount 
        if ($from == 'wsale') {
            $price = $stockData['wsale_price'];
        }
        if ($from == 'rsale') {
            $price = $stockData['rsale_price'];
        }
        if ($check->rowCount() == 0) {
            $stmt = $this->connect()->prepare("INSERT INTO cat (product_id,qty,selling_price,total_price,type,recept_num) VALUES(?,?,?,?,?,?)");
            $stmt->execute([$id, 1,$price, $price,$from,random_int(100,10000)]);
            $this->cartData($from);
        } else {
            $checkExist = $this->connect()->prepare("SELECT * FROM `cat` WHERE product_id = $id ");
            $checkExist->execute();
            if ($checkExist->rowCount() > 0) {
                echo 1;
            }else {
                $checkRecept = $this->connect()->prepare("SELECT * FROM `cat` ORDER BY id DESC LIMIT 1 ");
                $checkRecept->execute();
                $recept = $checkRecept->fetch();
                $stmt = $this->connect()->prepare("INSERT INTO cat (product_id,qty,selling_price,total_price,type,recept_num) VALUES(?,?,?,?,?,?)");
                $stmt->execute([$id, 1,$price, $price,$from,$recept['recept_num']]);

                $this->cartData($from);
            }
            
        }
       
        
        
    }

    public function cartData($from){
        $cartData = $this->connect()->prepare("SELECT * FROM `cat` WHERE type = '$from'");
        $cartData->execute();

        if ($cartData->rowCount() > 0) {
            
            $Total = $this->connect()->prepare("SELECT SUM(total_price) AS total FROM cat WHERE type = '$from' ");
            $Total->execute();
            $cartTotalCost = $Total->fetch();
                echo '
                   <input hidden type="hidden" name="saleProduct" value="1">
                   <input hidden type="hidden" name="from" value="'.$from.'">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Quantity</th>
                                <th>Sub-Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    <tbody>
                ';
            foreach ($cartData->fetchAll() as $value) {
                $productData = $this->productData($value['product_id']);
                echo '
                           
                                    <tr>
                                        <td>'.$productData['name'].'</td>
                                        <td>'.$value['selling_price'].'</td>
                                        <td><input id="input-discount'.$value['product_id'].'" type="number" min="0" qty="'.$value['qty'].'" from = "'.$value['type'].'" productId = "'.$value['product_id'].'"  value="'.$value['discount'].'" name="discount" class="form-control input-discount" style="width: 100px !important;height: 35px !important;" autofocus ></td>
                                        <td><input id="input-qty'.$value['product_id'].'" type="number" min="1" discount="'.$value['discount'].'" from = "'.$value['type'].'" productId = "'.$value['product_id'].'" value="'.$value['qty'].'" name="qty" class="form-control input-qty" style="width: 100px !important;height: 35px !important;" autofocus></td>
                                        <td><b>'.$value['total_price'].'</b></td>
                                        <td><button title="Remove" from = "'.$value['type'].'" dataId = '.$value['id'].' class="btn btn-danger btn-sm deleteFromCart">X</button></td>
                                    </tr>
                              
                ';
            }
            echo '
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-6"><h6 class="ml-5">Total: <b>'.$cartTotalCost['total'].' Tshs</b></h3></div>
                    <div class="col-md-6"><button  class="btn btn-primary float-right w-75 sale-btn">Sale</button></div>
                </div>
            ';
        } else {
            echo '<p class="text-muted ml-5">No any product added into cart </p>';
        }
    }

    public function deleteFromCart(){
        $id = $_POST['dataId'];
        $from = $_POST['from'];
        $delete = $this->connect()->prepare("DELETE  FROM cat WHERE id = $id AND type = '$from'");
        $delete->execute();
        echo 1;
    }

    public function bulkWithIterms($quantity,$qty){
        $remainder=$quantity % $qty;
        $number=explode('.',($quantity / $qty));
        $answer=$number[0];
        return $answer.'<small> with: </small>'.$remainder;
    }

    public function bulkWithItermsDoc($quantity,$qty,$id){
        $productData = $this->productData($id);
        $remainder=$quantity % $qty;
        $number=explode('.',($quantity / $qty));
        $answer=$number[0];
        return $answer.' '.$productData['bulk'].' and '.$remainder .' items';
    }

    public function bulkWithItermsStock($quantity,$qty,$id){
        $productData = $this->productData($id);
        $remainder=$quantity % $qty;
        $number=explode('.',($quantity / $qty));
        $answer=$number[0];
        return '<b>'.$answer.'</b> <small>'.$productData['bulk'].' and </small><b>'.$remainder .'<b> <small>items</small>';
    }

    public function bulkWithName($productId,$quantity){
        $data = $this->productData($productId);
        $number=explode('.',($quantity / $data['qty']));
        $answer=$number[0];
        return '<b>'.$answer.'</b>  '.$data['bulk'];
    }

    public function bulkAvailable($quantity,$qty){
        $number=explode('.',($quantity / $qty));
        $answer=$number[0];
        return $answer;
    }

    public function saleDiscount(){
        $from = $_POST['from'];
        $discount = $_POST['amount'];
        $productId = $_POST['productId'];
        $qty = $_POST['qty'];
        
        // let check if its wsale or rsale
        if ($from == 'wsale') {
            $discountColumn = 'wdiscount';
            $saleColumn ='wsale_price';
        }
        if ($from == 'rsale') {
            $discountColumn = 'rdiscount';
            $saleColumn ='rsale_price';
        }
        // get stock data
        $stockData = $this->stockData($productId);
        //  check amount if meet the condition
        $totalDiscount = $stockData[$discountColumn] * $qty;
        if ($discount > $totalDiscount) {
            echo 5;
        }else {
            // process data => update cart
            $priceAfterDeduct = $stockData[$saleColumn] - $discount;
            $totalPriceAfterDeduct = $priceAfterDeduct * $qty;
            $updateDiscount = $this->connect()->prepare("UPDATE cat SET selling_price = $priceAfterDeduct,discount = $discount, total_price = $totalPriceAfterDeduct WHERE product_id = ? ");
            $updateDiscount->execute([$productId]);
            
            echo 1;
        }
        
        
    }

    public function saleQty(){
        $from = $_POST['from'];
        $discount = $_POST['amount'];
        $productId = $_POST['productId'];
        $qty = $_POST['qty'];

        // let check if its wsale or rsale => declare varible => get actual quantity
        if ($from == 'wsale') {
            // get its quantity from product per bulk and its quantity from stock
            $productData = $this->productData($productId);
            $stockData = $this->stockData($productId);
            $qtyPerBulk = $productData['qty'];
            $stockQuantinty = $stockData['quantity'];

            // let check if requested quantity is available for now
               if ($qty > $this->bulkAvailable($stockQuantinty,$qtyPerBulk)) {
                   echo 5;
               }else {
                    $saleColumn ='wsale_price';
                    $priceAfterDeduct = $stockData[$saleColumn] - $discount;
                    $totalPriceAfterDeduct = $priceAfterDeduct * $qty;
                    $updateDiscount = $this->connect()->prepare("UPDATE cat SET qty= $qty, selling_price = $priceAfterDeduct,discount = $discount, total_price = $totalPriceAfterDeduct WHERE product_id = ? ");
                    $updateDiscount->execute([$productId]);
                    echo 1;
               }

            // process total qty => deduct in stock =>on sale you must check wsale qty

        }

        if ($from == 'rsale') {
            // get  quantity from stock
            
            $stockData = $this->stockData($productId);
            $stockQuantinty = $stockData['quantity'];

            // let check if requested quantity is available for now
               if ($qty > $stockQuantinty) {
                   echo 5;
               }else {
                    $saleColumn ='rsale_price';
                    $priceAfterDeduct = $stockData[$saleColumn] - $discount;
                    $totalPriceAfterDeduct = $priceAfterDeduct * $qty;
                    $updateDiscount = $this->connect()->prepare("UPDATE cat SET qty= $qty, selling_price = $priceAfterDeduct,discount = $discount, total_price = $totalPriceAfterDeduct WHERE product_id = ? ");
                    $updateDiscount->execute([$productId]);
                    echo 1;
               }

            // process total qty => deduct in stock

        }
    }

    public function salingProduct(){
        // sales table field => user_id product_id 	qty bulk price discount recept type
        // cat table field => roduct_id	qty	selling_price discount total_price created_at type recept_num 	
        session_start();
        $from = $_POST['from'];
        $check = $this->connect()->prepare("SELECT * FROM cat WHERE type = '$from'");
        $check->execute();
        if ($check->rowCount() > 0) {
            foreach ($check->fetchAll() as $value) {
               
                if ($value['type'] == 'rsale') {
                    $bulk = 1;
                    $NumberBulk = 0;
                } 
        
                if ($value['type'] == 'wsale') {
                    $productData = $this->productData($value['product_id']);
                    $bulk = $productData['qty'];
                    $NumberBulk = $bulk;
                }

                $insertSales = $this->connect()->prepare("INSERT INTO sales (user_id,product_id,qty,bulk,price,total_price,discount,type,recept) VALUES(?,?,?,?,?,?,?,?,?)");
                $insertSales->execute([$_SESSION['userID'],$value['product_id'], $value['qty'],$NumberBulk,$value['selling_price'],$value['total_price'],$value['discount'],$value['type'],$value['recept_num'] ]);

                $stockData = $this->stockData($value['product_id']);
                $oldStockQty = $stockData['quantity'];
                $newStockQty = $oldStockQty - ($value['qty'] * $bulk );

                $stmt = $this->connect()->prepare("UPDATE stock SET quantity = ? WHERE product_id = ?");
                $stmt->execute([$newStockQty, $value['product_id'] ]);
            }

                // $stmt = $this->connect()->prepare("TRUNCATE TABLE `cat`");
                $stmt = $this->connect()->prepare("DELETE FROM cat WHERE type = '$from'");
                $stmt->execute();

            echo 1;
        }else {
            echo 0;
        }
       
    }

    public function todaySalesData(){
        $todayDate = date('y-m-d', time());
        $data = $this->connect()->prepare("SELECT * FROM sales WHERE dateSaved = '$todayDate'");
        $data->execute();
        return $data->fetchAll();
    }

    public function fetchSalesInterval($from,$to){
        $data = $this->connect()->prepare("SELECT * FROM sales WHERE dateSaved BETWEEN '$from' AND '$to'");
        $data->execute();
        return $data->fetchAll();
    }

    public function fetchSalesWholesaleSummaryInterval($from,$to){
        $data = $this->connect()->prepare("SELECT sales.dateSaved, SUM(sales.total_price) AS salesTotal, SUM(stock.bprice * sales.qty) AS kutoa , 
                                                SUM(sales.qty) AS quantity FROM `sales`,products,stock
                                                WHERE sales.type = 'wsale' AND sales.product_id = products.id 
                                                AND stock.product_id = products.id AND dateSaved BETWEEN '$from' AND '$to' GROUP BY sales.dateSaved");
        $data->execute();
        return $data->fetchAll();
    }

    public function fetchSalesRetailsaleSummaryInterval($from,$to){
        $data = $this->connect()->prepare("SELECT sales.dateSaved, SUM(sales.total_price) AS salesTotal, 
                 SUM((stock.bprice / products.qty)*sales.qty) AS kutoa , 
                 SUM(sales.qty) AS quantity FROM `sales`,products,stock  WHERE sales.type = 'rsale' 
                AND sales.product_id = products.id AND stock.product_id = products.id 
                AND dateSaved BETWEEN '$from' AND '$to' GROUP BY sales.dateSaved");
        $data->execute();
        return $data->fetchAll();
    }


    public function fetchSalesProfitInterval($from,$to){
        $data = $this->connect()->prepare("SELECT * FROM sales WHERE dateSaved BETWEEN '$from' AND '$to'");
        $data->execute();
         $profit = 0;
         foreach ($data->fetchAll() as  $datas) {
                $productData = $this->productData($datas['product_id']);
                $stock = $this->stockData($datas['product_id']);
                $profit = $datas['total_price'] - ($stock['bprice'] * $datas['qty']);
                if ($datas['type'] == 'rsale') {
                    $profit = $datas['total_price'] - (($stock['bprice'] / $productData['qty']) * $datas['qty']);
                }

                $profit += $profit;
         }

         return $profit;
    }

    public function sumSalesInterval($from,$to){
        $data = $this->connect()->prepare("SELECT SUM(total_price) AS totalSale FROM sales WHERE dateSaved BETWEEN '$from' AND '$to'");
        $data->execute();
        $total = $data->fetch();
        return $total['totalSale'];
    }

    public function fetchPurchasesInterval($from,$to){
        $data = $this->connect()->prepare("SELECT * FROM purchases WHERE dateSaved BETWEEN '$from' AND '$to'");
        $data->execute();
        return $data->fetchAll();
    }
    
    public function sumPurchasesInterval($from,$to){
        $data = $this->connect()->prepare("SELECT SUM(bprice) AS totalSale FROM purchases WHERE dateSaved BETWEEN '$from' AND '$to'");
        $data->execute();
        $total = $data->fetch();
        return $total['totalSale'];
    }

    public function productCount(){
        $data = $this->connect()->prepare("SELECT count(*) AS totalProduct FROM products");
        $data->execute();
        $total = $data->fetch();
        return $total['totalProduct'];
    }

    public function totalTodaySales(){
        $todayDate = date('Y-m-d');
        $data = $this->connect()->prepare("SELECT SUM(total_price) AS totalSale FROM sales WHERE dateSaved = '$todayDate'");
        $data->execute();
        $total = $data->fetch();
        return $total['totalSale'];
    }

    public function totalTodayPurchases(){
        $todayDate = date('Y-m-d');
        $data = $this->connect()->prepare("SELECT SUM(bprice * qty) AS totalPurchases FROM purchases WHERE dateSaved = '$todayDate'");
        $data->execute();
        $total = $data->fetch();
        return $total['totalPurchases'];
    }
    public function fetchTodayPurchases(){
        
            $todayDate = date('y-m-d', time());
            $data = $this->connect()->prepare("SELECT * FROM purchases WHERE dateSaved = '$todayDate'");
            $data->execute();
        return $data->fetchAll();
    }

    public function wSaleOutStock(){
        $data = $this->connect()->prepare("SELECT * FROM stock");
        $data->execute();
        $totalAvailable = 0;
        if ($data->rowCount() > 0) {
            foreach ($data->fetchAll() as  $value) {
                $productData = $this->productData($value['product_id']);
                if ($this->bulkAvailable($value['quantity'], $productData['qty']) == 0 ) {
                    $totalAvailable += 1;
                }else {
                    $totalAvailable += 0;
                }
            }
        }

        return $totalAvailable;
    }

    public function rSaleOutStock(){
        $data = $this->connect()->prepare("SELECT COUNT(*) AS totalAvailable FROM stock WHERE quantity = 0");
        $data->execute();
        $available = $data->fetch();
        return $available['totalAvailable'];
    }
    
}


// BACKUP DATABASE testDB
// TO DISK = 'D:\backups\testDB.bak'
// WITH DIFFERENTIAL; 

// TRUNCATE TABLE `cat` 