<?php
    require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>
</head>
<body>
    <?php
        require 'header.php';
        $user_id =  $_SESSION['user_id'];

        $select_cart =mysqli_query($db, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
        $total_product = [];
        $total_price = 0;

        if(mysqli_num_rows($select_cart) > 0){
            while($fecth_cart = mysqli_fetch_assoc($select_cart)){
                $price = $fecth_cart['price'];
                $quantity = $fecth_cart['quantity'];
                $total_product[] = $fecth_cart['name'].' '.'x'.' '.$fecth_cart['quantity'];
                $total_price += $price * $quantity;
            };
        };
        $total_products = implode(', ', $total_product);

        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $number = $_POST['number'];
            $address = $_POST['flat_no'].", ".$_POST['street'].", ". $_POST['city'].", ". $_POST['state'].", ". $_POST['country'];
            $method = $_POST['method'];
            $date = date("d,M,Y");
            $time = date('h:i:sa');
            $place_on = $date."-".$time;

            mysqli_query($db, "INSERT INTO `orders` (user_id, name, number, email, method, address, total_products, total_price, place_on)
            VALUES ('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$total_price', '$place_on')");
            mysqli_query($db, "DELETE FROM `cart` WHERE user_id = '$user_id'");
            header('location: cart.php');
            $massage[] = "Order was sent successfful!";
        }
    ?>

    <?php
        if(isset($massage)){
            foreach($massage as $massage){
                echo '<div class="container-fluid" style="position: fixed; top: 0;">
                        <div class="container  alert alert-danger alert_massage">
                            <span> '.$massage.' </span>
                            <i class="bi bi-x" onclick="this.parentElement.remove()"></i>
                        </div>
                    </div>';
            };
        };      
    ?>
    <section>
        <div class="container-fluid heading">
            <div class="container">
                <div class="row">
                    <h1>CHECKOUT</h1>
                    <span><a href="home.php">home</a> / checkout </span>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid">
        <div class="container">
            <div class="row name_price_container">
                <?php
                    $select_cart = mysqli_query($db, "SELECT * FROM `cart` WHERE user_id = $user_id");
                    if(mysqli_num_rows($select_cart) > 0){
                        foreach($select_cart as $fecth_cart){
                            $name = $fecth_cart['name'];
                            $price = $fecth_cart['price'];
                            $quantity = $fecth_cart['quantity'];
                ?>
                    <div class="col">
                        <div class="name_price">
                            <p><?php echo $name?><span>[$<?php echo $price?>/-x <?php echo $quantity?>]</span></p>
                        </div>
                    </div>    
                <?php            
                        }
                    }        
                ?>
            </div>
            <div class="row grand_total">
            <?php
                $total_price = 0;
                $select_cart = mysqli_query($db, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
                    if(mysqli_num_rows($select_cart) > 0){
                        while($fecth_cart = mysqli_fetch_assoc($select_cart)){
                            $quantity = $fecth_cart['quantity'];
                            $total_price += $fecth_cart['price'] * $quantity;
                        }
                    }
            ?>
                <p>grand total: <span>$<?php echo $total_price?></span></p>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container">
            <form action="" method="post">
                <div class="row order_form">
                    <h3>PLACE YOUT ORDER</h3>
                    <div class="col-md-6">
                        <div class="label">your name:</div>
                        <input type="text" name="name" class="form-control" required placeholder="enter your name">

                        <div class="label">your email:</div>
                        <input type="email" name="email" class="form-control" required placeholder="enter your email">

                        <div class="label">address line 01 :</div>
                        <input type="number" name="flat_no" class="form-control" required placeholder="e.g. flat no.">
                        
                        <div class="label">city:</div>
                            <input type="text" name="city" class="form-control" required placeholder="e.g. New York">

                        <div class="label">countrty:</div>
                        <input type="text" name="country" class="form-control" required placeholder="e.g. United State Of America">
                    </div>
                    <div class="col-md-6">
                        <div class="label">your number:</div>
                        <input type="number" min="1" name="number" class="form-control" required placeholder="enter your number">

                        <div class="label">payment method:</div>
                            <select name="method" id="" class="form-select">
                                <option value="cash on delivery">cash on delivery</option>
                                <option value="credit cart">credit cart</option>
                                <option value="paypal">paypal</option>
                                <option value="paymt">paymt</option>
                            </select>
                        
                        <div class="label">address line 01 :</div>    
                        <input type="text" name="street" class="form-control" required placeholder="e.g. street name">
                    
                        <div class="label">state :</div>
                        <input type="text" name="state" class="form-control" required placeholder="state">
                    
                        <div class="label">pincode:</div>
                        <input type="number" name="pincode" path="note" min="1" class="form-control" required placeholder="e.g. 12345">
                    </div>
                    <input type="submit" name="submit" value="Order Now" class="btn order_now">
                </div>
            </form>
        </div>
    </div>

    <?php
        require 'footer.php';
    ?>
</body>
</html>