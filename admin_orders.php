<?php 
    require 'config.php';
    session_start();

    if(isset($_GET['delete'])){
        $id_to_delete = $_GET['delete'];
        mysqli_query($db, "DELETE FROM `orders` WHERE id = '$id_to_delete'");
        header('loaction: admin_orders.php');
    }

    if(isset($_POST['update'])){
        $id_to_update =  $_POST['order_id'];
        $update_payment = $_POST['update_payment'];
        mysqli_query($db, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$id_to_update'");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>orders</title>
</head>
<body>
    <?php
        require 'admin_header.php';
    ?>

    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <?php
                    $select_order = mysqli_query($db, "SELECT * FROM `orders`");
                    if(mysqli_num_rows($select_order) > 0){
                        while($fecth_order = mysqli_fetch_assoc($select_order)){
                ?>
                    <div class="col order">
                        <div class="order_container">
                            <p>user id: <span class="info"><?php echo $fecth_order['user_id']?></span></p>
                            <P>user name: <span class="info"><?php echo $fecth_order['name']?></span></P>
                            <p>phone number: <span class="info"><?php echo $fecth_order['number']?></span></p>
                            <p>email: <span class="info"><?php echo $fecth_order['email']?></span></p>
                            <p>address: <span class="info"><?php echo $fecth_order['address']?></span></p>
                            <p>total products: <span class="info"><?php echo $fecth_order['total_products']?></span></p>
                            <p>order placed on: <span class="info"><?php echo $fecth_order['place_on']?></span></p>
                            <p>total price: <span class="info">$<?php echo $fecth_order['total_price']?></span></p>
                            <p>payment method: <span class="info"><?php echo $fecth_order['method']?></span></p>
                            <form action="" method="post">
                                <input type="hidden" name="order_id" value="<?php echo $fecth_order['id']?>">
                                <select class="form-select" name="update_payment" id="">
                                    <option value="" selected disabled><?php echo $fecth_order['payment_status']?></option>
                                    <option value="pending">pending</option>
                                    <option value="completed">completed</option>
                                </select>
                                <input type="submit" class="btn update_btn" value="Update" name="update">
                                <a href="admin_orders.php?delete=<?php echo $fecth_order['id']?>" class="btn delete_btn" onclick = 'return confirm("delete order?")'> Delete</a>
                            </form>
                        </div>
                    </div>
                <?php            
                        }
                    }else echo "<p class = 'empty'>There is no any order yet!<p>";
                ?>
            </div>
        </div>
    </div>
</body>
</html>