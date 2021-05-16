<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Foodienator|Order Food Online</title>
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap.min.css';?>">
    <script src="<?php echo base_url().'assets/js/jquery-3.6.0.min.js';?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js';?>"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>public/front/css/style.css">
</head>

<body>
    <div class="container my-3" style="border: 2px solid orange;">
        <header class="mt-1 text-right">
        </header>
        <div class="invoice mb-3">
            <div class="row mb-3 p-3">
                <div class="col-6">
                    <img src="<?php echo base_url('public/front/img/logo.png');?>">
                </div>
                <div class="col-6">
                    <p class="lead font-weight-bold mb-0"><?php echo $order['r_name'] ?></p>
                    <p class="mb-0"><?php echo $order['r_email'] ?></p>
                    <p><?php echo $order['r_address'] ?></p>
                </div>
                <div class="col-6">
                    <h3>INVOICE</h3>
                    <p class="mb-0"><?php echo $order['f_name']." ".$order['l_name']?></p>
                    <p class="mb-0"><?php echo $order['address'] ?></p>
                    <p class="mb-0"><?php echo $order['email'] ?></p>
                    <p class="mb-0"><?php echo $order['phone'] ?></p>
                </div>
                <div class="col-6">
                    <br><br>
                    <p class="mb-0">Order Number: <?php echo "#".$order['o_id']; ?></p>
                    <?php $cDate = strtotime($order['success-date']); ?>
                    <p class="mb-0">Order Date: <?php echo date('d-M-Y',$cDate); ?></p>
                    <p class="mb-0">Payment mode: Cash on delivery</p>
                </div>
                <div class="col-12">
                    <table class="table responsive">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Restaurant</th>
                                <th>Dish</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $order['r_name']; ?></td>
                                <td><?php echo $order['d_name']; ?></td>
                                <td><?php echo $order['o_quantity']; ?></td>
                                <td><?php echo $order['d_price']; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td class="font-weight-bold">Total</td>
                                <td class="font-weight-bold"><?php echo $order['o_price'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <footer class="text-center">
            <p class="mb-0">Thanks for ordering food from us!</p>
            <p>For tersms & conditions Please visit www.foodienter.com</p>
        </footer>
    </div>
    <div class="container text-center">
        <a href="<?php echo base_url().'orders' ?>" class="btn btn-sm btn-warning p-2"><i class="fas fa-angle-left"></i>
            Back to Orders</a>
    </div>

</body>

</html>