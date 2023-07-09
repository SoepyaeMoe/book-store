<?php 
    require 'config.php';
    session_start();

    if(!isset($_SESSION['admin_id'])){
        header('location: login.php');
    };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Admin</title>
</head>
<?php
    require 'admin_header.php';
?>
<body>
<div class="body">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12 heading">
                    <h3>DASHBOARD</h3>
                </div>
            </div>    
        </div>
    </div>
    <div class="container-fluid box-container">
        <div class="container">
            <div class="row">
                <div class="col box">
                    <?php
                        $total_pendings = 0;
                        $select_pendings = mysqli_query($db, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query_failed');
                        if(mysqli_num_rows($select_pendings) > 0){
                            while($fetch_pending = mysqli_fetch_assoc($select_pendings)){
                                $total_price = $fetch_pending['total_price'];
                                $total_pendings += $total_price;
                            }
                        };
                    ?>
                    <h3>$<?php echo $total_pendings?>/-</h3>
                    <p>total pendings</p>
                </div>

                <div class="col box">
                    <?php
                        $total_complete = 0;
                        $select_complete = mysqli_query($db, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query_failed');
                        if(mysqli_num_rows($select_complete) > 0){
                            while($fetch_complete = mysqli_fetch_assoc($select_complete)){
                                $total_price = $fetch_complete['total_price'];
                                $total_complete += $total_price;
                            }
                        };
                    ?>
                    <h3>$<?php echo $total_complete?>/-</h3>
                    <p>total complete</p>
                </div>

                <div class="col box">
                    <?php
                        $select_orders = mysqli_query($db, "SELECT * FROM `orders`");
                        $number_of_order = mysqli_num_rows($select_orders);
                    ?>
                    <h3><?php echo $number_of_order?></h3>
                    <p>order placed</p>
                </div>
            </div>
            <div class="row">
                <div class="col box">
                    <?php
                        $select_products = mysqli_query($db, "SELECT * FROM `products`");
                        $number_of_products = mysqli_num_rows($select_products);
                    ?>
                    <h3><?php echo $number_of_products?></h3>
                    <p>product added</p>
                </div>

                <div class="col box">
                    <?php
                        $select_normal_user = mysqli_query($db, "SELECT * FROM `register` WHERE user_type = 'user'");
                        $number_of_normal_user = mysqli_num_rows($select_normal_user);
                    ?>
                    <h3><?php echo $number_of_normal_user?></h3>
                    <p>Normal User</p>
                </div>

                <div class="col box">
                    <?php
                        $select_admin_user = mysqli_query($db, "SELECT * FROM `register` WHERE user_type = 'admin'");
                        $number_of_admin_user = mysqli_num_rows($select_admin_user);
                    ?>
                    <h3><?php echo $number_of_admin_user?></h3>
                    <p>Admin User</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>