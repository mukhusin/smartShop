
<!-- The Modal -->
<div class="modal fade" id="register-product">
  <div class="modal-dialog">
    <div class="modal-content">
      <div id="productwaiting"></div>
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Register Product</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="registerproduct-form" method="POST" action="../route/web.php">
            <input hidden name="registerProduct" value="1" type="text">
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter product name" id="name" required>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="code">Product Code:</label>
                    <input type="text" name="code" class="form-control" placeholder="Enter product code" id="code" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                      <label for="code">Product unit:</label>
                      <input type="text" name="unit" class="form-control" placeholder="Enter product unit" id="code" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7">
                <div class="form-group">
                  <label for="sel1">Select Bulk:</label>
                  <select name="bulk" class="form-control" id="sel1" required>
                    <option value="">...select...</option>
                    <option>Crete</option>
                    <option>Dozen</option>
                    <option>Carton</option>
                    <option>Item</option>
                    <option>Kg</option>
                    <option>Litter</option>
                  </select>
                </div> 
              </div>
              <div class="col-md-5">
                <div class="form-group">
                    <label for="code">Quantity <small>per</small> Bulk:</label>
                    <input type="number" min="0" name="qty" class="form-control" placeholder="Enter quantity" id="qty" required>
                </div>
              </div>
            </div>
            <div class="row" id="productmessage"></div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form> 
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<?php 
  foreach($product->fetchProducts() as $item){?>
     <div class="modal fade" id="edit-product<?php echo $item['id'] ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div id="productwaiting<?php echo $item['id'] ?>"></div>
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit Product</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <form id="update-product-form<?php echo $item['id'] ?>" method="POST" action="../route/web.php">
                  <input hidden name="updateProduct" value="1" type="text">
                  <input hidden name="productId" value="<?php echo $item['id'] ?>" type="text">
                  <div class="form-group">
                      <label for="name">Product Name:</label>
                      <input type="text" name="name" value="<?php echo $item['name'] ?>" class="form-control" placeholder="Enter product name" id="name" required>
                  </div>
                 <div class="row">
                   <div class="col-md-6">
                      <div class="form-group">
                          <label for="code">Product Code:</label>
                          <input type="text" name="code" value="<?php echo $item['code'] ?>" class="form-control" placeholder="Enter product code" id="code" required>
                      </div>
                   </div>
                   <div class="col-md-6">
                    <div class="form-group">
                        <label for="code">Unit:</label>
                        <input type="text" name="unit" value="<?php echo $item['unit'] ?>" class="form-control" placeholder="Enter product unit" id="code" required>
                    </div>
                   </div>
                 </div>
                  <div class="row">
                    <div class="col-md-7">
                      <div class="form-group">
                        <label for="sel1">Select Bulk:</label>
                        <select name="bulk" class="form-control" id="sel1" required>
                          <option value="<?php echo $item['bulk'] ?>"><?php echo $item['bulk'] ?></option>
                          <option>Crete</option>
                          <option>Dozen</option>
                          <option>Carton</option>
                          <option>Item</option>
                          <option>Kg</option>
                          <option>Litter</option>
                        </select>
                      </div> 
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                          <label for="code">Items:</label>
                          <input type="number" min="0" name="qty" value="<?php echo $item['qty'] ?>" class="form-control" placeholder="Enter quantity" id="qty" required>
                      </div>
                    </div>
                  </div>
                  <div class="row" id="updatemessage<?php echo $item['id'] ?>"></div>
                  <button type="submit" productId="<?php echo $item['id'] ?>" class="btn btn-primary update-product-btn">save changes</button>
              </form> 
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>    
<?php
  }
?>

<!-- <div class="form-group">
    <label for="bprice">Buying Price:</label>
    <input type="number" min="0" name="bprice" class="form-control" placeholder="Enter Buying Price" id="bprice" required>
</div>
<div class="form-group">
    <label for="rsale">Retail Sale Price:</label>
    <input type="number" min="0" name="rsaleprice" class="form-control" placeholder="Enter Retail Sale Price" id="rtr" required>
</div>
<div class="form-group">
    <label for="code">Wholesale Price:</label>
    <input type="number" min="0" name="wsaleprice" class="form-control" placeholder="Enter Wholesale Price" id="cdfdfode" required>
</div> -->

<!-- edit products -->
<?php 
  foreach($product->fetchProducts() as $item){?>
     <div class="modal fade" id="add-stock<?php echo $item['id'] ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div id="addstockWainting<?php echo $item['id'] ?>"></div>
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Add Stock</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <form id="add-stock-form<?php echo $item['id'] ?>" method="POST" action="../route/web.php">
                  <input hidden name="addStock" value="1" type="text">
                  <input hidden name="productId" value="<?php echo $item['id'] ?>" type="text">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                          <label for="name">Product Name:</label>
                      </div>
                      <div class="col-md-7">
                           <input disabled type="text" name="name" value="<?php echo $item['name'] ?>" class="form-control" placeholder="Enter product name" id="name" required>
                      </div>
                    </div>
                      
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                         <label for="code">Product Code:</label>
                      </div>
                      <div class="col-md-7">
                           <input disabled type="text" name="code" value="<?php echo $item['code'] ?>" class="form-control" placeholder="Enter product code" id="code" required>
                      </div>
                    </div>
                      
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-5">
                          <label for="code"><?php echo $item['bulk'] ?>:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="number" min="0" name="qty"  class="form-control" placeholder="Enter number of <?php echo $item['bulk'] ?>s" id="code" required>
                        </div>

                      </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-5">
                          <label for="bprice">Buying Price:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="number" min="0" name="bprice" class="form-control" placeholder="Enter Buying Price" id="bprice" required>
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-5">
                          <label for="rsale">Retail Sale Price:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="number" min="0" name="rsaleprice" class="form-control" placeholder="Enter Retail Sale Price" id="rtr" required>
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="row">
                        <div class="col-md-5">
                           <label for="code">Wholesale Price:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="number" min="0" name="wsaleprice" class="form-control" placeholder="Enter Wholesale Price" id="cdfdfode" required>
                        </div>
                      </div>         
                  </div>
                  <div class="form-group">
                      <div class="row">
                        <div class="col-md-5">
                           <label for="code">Maximum Discount Price:</label>
                        </div>
                        <div class="col-md-7">
                          <div class="row">
                             <div class="col-md-6">
                                  Retail: <input type="number" min="0" name="rdiscount" class="form-control" placeholder="Enter Discount Price" id="cdfdfode" required>
                             </div>
                             <div class="col-md-6">
                                  Wholesale: <input type="number" min="0" name="wdiscount" class="form-control" placeholder="Enter Discount Price" id="uuuu" required>
                             </div>
                          </div>
                            
                        </div>
                      </div>         
                  </div>
                  <div class="row" id="stockmessage<?php echo $item['id'] ?>" ></div>
                  <button type="submit" productId = "<?php echo $item['id'] ?>" class="btn btn-primary add-stock-btn">Add stock</button>
              </form> 
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>    
<?php
  }
?>

<!-- edit purchases -->
<?php 
  foreach($product->fetchPurchases() as $item){
    $productData = $product->productData($item['product_id']);
    ?>
  
     <div class="modal fade" id="purchase<?php echo $item['id'] ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div id="purchasesWainting<?php echo $item['id'] ?>"></div>
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit purchases of: <small class="text-muted"><?php echo $item['created_at'] ?></small></h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <form id="update-purchases-form<?php echo $item['id'] ?>" method="POST" action="../route/web.php">
                  <input hidden name="updatePurchases" value="1" type="text">
                  <input hidden name="productId" value="<?php echo $item['product_id'] ?>" type="text">
                  <input hidden name="id" value="<?php echo $item['id'] ?>" type="text">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                          <label for="name">Product Name:</label>
                      </div>
                      <div class="col-md-7">
                           <input disabled type="text" name="name" value="<?php echo $productData['name'] ?>" class="form-control" placeholder="Enter product name" id="name" required>
                      </div>
                    </div>
                      
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                         <label for="code">Product Code:</label>
                      </div>
                      <div class="col-md-7">
                           <input disabled type="text" name="code" value="<?php echo $productData['code'] ?>" class="form-control" placeholder="Enter product code" id="code" required>
                      </div>
                    </div>
                      
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-5">
                          <label for="code"><?php echo $productData['bulk'] ?>:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="number" min="0" name="qty" value="<?php echo $item['qty'] ?>" class="form-control" placeholder="Enter number of <?php echo $productData['bulk'] ?>s" id="code" required>
                            <input type="hidden" hidden min="0" name="oldqty" value="<?php echo $item['qty'] ?>" class="form-control" placeholder="Enter number of <?php echo $productData['bulk'] ?>s" id="code" required>
                        </div>

                      </div>
                  </div>
                  <p class="text-maroon">Buying , Retail sale and Wholesale price will not be updated in stock, If you want to update them then go the <b>Stock</b></p>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-5">
                          <label for="bprice">Buying Price:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="number" min="0" name="bprice"  value="<?php echo $item['bprice'] ?>" class="form-control" placeholder="Enter Buying Price" id="bprice" required>
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-5">
                          <label for="rsale">Retail Sale Price:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="number" min="0" name="rsaleprice"  value="<?php echo $item['rsaleprice'] ?>" class="form-control" placeholder="Enter Retail Sale Price" id="rtr" required>
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="row">
                        <div class="col-md-5">
                           <label for="code">Wholesale Price:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="number" min="0" name="wsaleprice"  value="<?php echo $item['wsaleprice'] ?>" class="form-control" placeholder="Enter Wholesale Price" id="cdfdfode" required>
                        </div>
                      </div>         
                  </div>
                  <div class="row" id="stockmessage<?php echo $item['id'] ?>" ></div>
                  <button type="submit" productId = "<?php echo $item['id'] ?>" class="btn btn-primary update-purchases-btn">Add stock</button>
              </form> 
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>    
<?php
  }
?>

<!-- edit stock -->
<?php 
  foreach($product->fetchStock() as $item){
    $productData = $product->productData($item['product_id']);
    ?>
     <div class="modal fade" id="stock-update<?php echo $item['id'] ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div id="updatestockWainting<?php echo $item['id'] ?>"></div>
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit Stock</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <form id="update-stock-form<?php echo $item['id'] ?>" method="POST" action="../route/web.php">
                  <input hidden name="updateStock" value="1" type="text">
                  <input hidden name="id" value="<?php echo $item['id'] ?>" type="text">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                          <label for="name">Product Name:</label>
                      </div>
                      <div class="col-md-7">
                           <input disabled type="text" name="name" value="<?php echo $productData['name'] ?>" class="form-control" placeholder="Enter product name" id="name" required>
                      </div>
                    </div>
                      
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                         <label for="code">Product Code:</label>
                      </div>
                      <div class="col-md-7">
                           <input disabled type="text" name="code" value="<?php echo $productData['code'] ?>" class="form-control" placeholder="Enter product code" id="code" required>
                      </div>
                    </div>
                      
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-5">
                          <label for="code"><?php echo $productData['bulk'] ?>:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="number" min="0" name="qty" value="<?php echo $item['quantity'] ?>" class="form-control" placeholder="Enter number of <?php echo $productData['bulk'] ?>s" id="code" required>
                        </div>

                      </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-5">
                          <label for="bprice">Buying Price:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="number" min="0" name="bprice" value="<?php echo $item['bprice'] ?>" class="form-control" placeholder="Enter Buying Price" id="bprice" required>
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-5">
                          <label for="rsale">Retail Sale Price:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="number" min="0" name="rsaleprice" value="<?php echo $item['rsale_price'] ?>" class="form-control" placeholder="Enter Retail Sale Price" id="rtr" required>
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="row">
                        <div class="col-md-5">
                           <label for="code">Wholesale Price:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="number" min="0" name="wsaleprice" value="<?php echo $item['wsale_price'] ?>" class="form-control" placeholder="Enter Wholesale Price" id="cdfdfode" required>
                        </div>
                      </div>         
                  </div>
                  
                  <div class="form-group">
                      <div class="row">
                        <div class="col-md-5">
                           <label for="code">Maximum Discount Price:</label>
                        </div>
                        <div class="col-md-7">
                          <div class="row">
                             <div class="col-md-6">
                                  Retail: <input type="number" min="0" value="<?php echo $item['rdiscount'] ?>" name="rdiscount" class="form-control" placeholder="Enter Discount Price" id="cdfdfode" required>
                             </div>
                             <div class="col-md-6">
                                  Wholesale: <input type="number" min="0" value="<?php echo $item['wdiscount'] ?>" name="wdiscount" class="form-control" placeholder="Enter Discount Price" id="uuuu" required>
                             </div>
                          </div>
                            
                        </div>
                      </div>         
                  </div>
                  <div class="row" id="updatestockmessage<?php echo $item['id'] ?>" ></div>
                  <button type="submit" productId = "<?php echo $item['id'] ?>" class="btn btn-primary update-stock-btn">update stock</button>
              </form> 
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>    
<?php
  }
?>

<!-- Deleting product -->
<?php 
  foreach($product->fetchProducts() as $item){?>
     <div class="modal fade" id="delete-product-modal<?php echo $item['id'] ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div id="deletingWainting<?php echo $item['id'] ?>"></div>
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Deleting product</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
               <p class="text-maroon">Are you sure you want to delete <b><?php echo $item['name'] ?></b></p>
               <p class="text-muted">All details of <b><?php echo $item['name'] ?></b> will be permanent deleted</p>
              <form id="delete-product-form<?php echo $item['id'] ?>" method="POST" action="../route/web.php">
                  <input hidden name="deleteProduct" value="1" type="text">
                  <input hidden name="productId" value="<?php echo $item['id'] ?>" type="text">
                  <div class="row" id="deletemessage<?php echo $item['id'] ?>" ></div>
                  <button type="submit" productId = "<?php echo $item['id'] ?>" class="btn btn-danger delete-product-btn">Yes</button>
              </form> 
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
            </div>

          </div>
        </div>
      </div>    
<?php
  }
?>

<!-- sales-doc-modal  Try to check before accessing PDFDOC just change and use route/web with a function-->
<div class="modal fade" id="sales-doc-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div id="userwaiting"></div>
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Genarate Sales Report</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="registeruser-formLATER" method="POST" action="../route/web.php">
           <input type="hidden" hidden value="1" name="salesDoc">
            <div class="form-group">
                <label for="name">From Date:</label>
                <input type="date"  name="from" class="form-control"  id="from" required>
            </div>
            <div class="form-group">
                <label for="code">To Date:</label>
                <input type="date" name="to" class="form-control"  id="to" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Genarate Report <i class="fa fa-fa-file-pdf"></i></button>
        </form> 
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<!-- purchases-doc-modal -->

<div class="modal fade" id="purchases-doc-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div id="userwaiting"></div>
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Genarate Purchases Report</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="registeruser-formLATER" method="POST" action="../route/web.php">
           <input type="hidden" hidden value="1" name="purchasesDoc">
            <div class="form-group">
                <label for="name">From Date:</label>
                <input type="date"  name="from" class="form-control"  id="from" required>
            </div>
            <div class="form-group">
                <label for="code">To Date:</label>
                <input type="date" name="to" class="form-control"  id="to" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Genarate Report <i class="fa fa-fa-file-pdf"></i></button>
        </form> 
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="rsales-summary-doc-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div id="userwaiting"></div>
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Genarate RetailSales Summary Report per Date</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form  method="POST" action="../route/web.php">
           <input type="hidden" hidden value="1" name="rsalesSummaryDoc">
            <div class="form-group">
                <label for="name">From Date:</label>
                <input type="date"  name="from" class="form-control"  id="from" required>
            </div>
            <div class="form-group">
                <label for="code">To Date:</label>
                <input type="date" name="to" class="form-control"  id="to" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Genarate Report <i class="fa fa-fa-file-pdf"></i></button>
        </form> 
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="wsales-summary-doc-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div id="userwaiting"></div>
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Genarate WholeSales Summary Report per Date</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form  method="POST" action="../route/web.php">
           <input type="hidden" hidden value="1" name="wsalesSummaryDoc">
            <div class="form-group">
                <label for="name">From Date:</label>
                <input type="date"  name="from" class="form-control"  id="from" required>
            </div>
            <div class="form-group">
                <label for="code">To Date:</label>
                <input type="date" name="to" class="form-control"  id="to" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Genarate Report <i class="fa fa-fa-file-pdf"></i></button>
        </form> 
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="change-password">
  <div class="modal-dialog">
    <div class="modal-content">
      <div id="waiting-saving"></div>
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="changepassword-form" method="POST" action="../route/web.php">
           <input type="hidden" hidden value="1" name="changePassword">
            <div class="form-group">
                <label for="name">Current Password:</label>
                <input type="password"  name="oldpassword" class="form-control"  id="from" required>
            </div>
            <div class="form-group">
                <label for="code">New password:</label>
                <input type="password" minlength="8" name="newpassword" class="form-control"  id="newpass" required>
            </div>

            <div class="form-group">
                <label for="code">Confirm New password:</label>
                <input type="password" minlength="8" name="cpassword" class="form-control"  id="cpass" required>
            </div>

            <div id="changepassworsms"></div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form> 
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="logout">
  <div class="modal-dialog">
    <div class="modal-content">
      <div id="userwaiting"></div>
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Kill your Session</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form  method="POST" action="../route/web.php">
           <input type="hidden" hidden value="1" name="logout">
           
           <p class="text-dark">Are you sure you want to logout ?</p>
            
            <button type="submit" class="btn btn-primary">Yes</button>
        </form> 
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>