 <div class="content-header">
    <div class="container">
    <div class="row mb-2">
        <div class="col-sm-12 col-md-12">
        <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item"><a href="#">Products <span class="badge badge-secondary"><?php echo $product->productCount() ?></span></a></li>
            <li class="breadcrumb-item"><a href="index.php">Today Sales <span class="badge badge-success"><?php echo number_format($product->totalTodaySales()) ?> Tshs</span></a></li>
            <li class="breadcrumb-item"><a href="details.php?type=today_purchases">Today Purchases <span class="badge badge-primary"><?php echo number_format($product->totalTodayPurchases()) ?> Tshs</span></a></li>
            <li class="breadcrumb-item"><a href="details.php?type=whole_out">Wholesale Out of Stock <span class="badge badge-danger"><?php echo $product->wSaleOutStock() ?></span></a></li>
            <li class="breadcrumb-item"><a href="details.php?type=retail_out">Retailsale Out of Stock <span class="badge badge-danger"><?php echo $product->rSaleOutStock() ?></span></a></li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
 </div>