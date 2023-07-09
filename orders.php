<?php
    require 'config.php';

    if(isset($_GET['deleted'])){
        $id_to_delete = $_GET['deleted'];
        mysqli_query($db, "DELETE FROM `orders` WHERE id = '$id_to_delete'");
        header('loaction: orders.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>order</title>
</head>
<body>
    <?php
        require 'header.php';

        $user_id = $_SESSION['user_id'];
    ?>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <?php
                    $select_order = mysqli_query($db, "SELECT * FROM `orders` WHERE user_id = '$user_id'");
                    if(mysqli_num_rows($select_order) > 0){
                        while($fecth_order = mysqli_fetch_assoc($select_order)){
                ?>
                    <div class="col order">
                        <div class="order_container">
                            <P>user name: <span class="info"><?php echo $fecth_order['name']?></span></P>
                            <p>phone number: <span class="info"><?php echo $fecth_order['number']?></span></p>
                            <p>email: <span class="info"><?php echo $fecth_order['email']?></span></p>
                            <p>address: <span class="info"><?php echo $fecth_order['address']?></span></p>
                            <p>total products: <span class="info"><?php echo $fecth_order['total_products']?></span></p>
                            <p>order placed on: <span class="info"><?php echo $fecth_order['place_on']?></span></p>
                            <p>total price: <span class="info">$<?php echo $fecth_order['total_price']?></span></p>
                            <p>payment method: <span class="info"><?php echo $fecth_order['method']?></span></p>
                            <p>status: <span class="info status"><?php echo $fecth_order['payment_status']?></span></p>
                            <form action="" method="post">
                                <a href="orders.php?deleted=<?php echo $fecth_order['id']?>" class="btn delete_btn" onclick = 'return confirm("delete order?")'> Delete</a>
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

    <?php
        require 'footer.php';
    ?>
</body>
</html>