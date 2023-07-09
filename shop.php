<?php
    require 'config.php';

    if(isset($_POST['cart'])){
        $id_to_select = $_POST['id'];
        $user_id = $_POST['user_id'];
        $quantity = $_POST['quantity'];
        $select_product = mysqli_query($db, "SELECT * FROM `products` WHERE id = '$id_to_select'");
        $fetch_products = mysqli_fetch_assoc($select_product);
        $image = $fetch_products['image'];
        $price = $fetch_products['price'];
        $name = $fetch_products['name'];

        $select_cart = mysqli_query($db, "SELECT * FROM `cart` WHERE user_id = '$user_id' AND name = '$name'");
        if(mysqli_num_rows($select_cart) > 0){
            $massage[] = "This book is already exist in cart!";
        }else{
            mysqli_query($db, "INSERT INTO `cart` (user_id, name, price, quantity, image) VALUES ('$user_id', '$name', '$price', $quantity, '$image')");
            $massage[] = $name. 'was added in cart!';
        };
    };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
</head>
<body>
    <?php
        if(isset($massage)){
            foreach($massage as $massage){
                echo '<div class="container-fluid" style="position: fixed; top: 0; z-index: 9999;">
                        <div class="container  alert alert-danger alert_massage">
                            <span> '.$massage.' </span>
                            <i class="bi bi-x" onclick="this.parentElement.remove()"></i>
                        </div>
                    </div>';
            };
        };      
    ?>
    <?php
        require 'header.php';
    ?>
    <section class="about">
        <div class="container-fluid heading">
            <div class="container">
                <div class="row">
                    <h1>OUR SHOP</h1>
                    <span><a href="home.php">home</a> / shop </span>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container-fluid">
            <div class="container products_container">
                <div class="row">
                    <h3>LASTEST PRODUCT</h3>
                    <?php
                        $select_products = mysqli_query($db, "SELECT * FROM `products`");
                        if(mysqli_num_rows($select_products) > 0){
                            while($fetch_products = mysqli_fetch_assoc($select_products)){
                    ?>
                        <div class="col product_child_container">
                            <div class="product">
                                <form action="" method="post">
                                    <img src="uploaded_img/<?php echo $fetch_products['image']?>" alt="">
                                    <h5><?php echo $fetch_products['name']?></h5>
                                    <div class="price">$<?php echo $fetch_products['price']?>/-</div>
                                    <input type="hidden" name="id" value='<?php echo $fetch_products['id']?>'>
                                    <input type="number" name="quantity" min="1" value="1" class="number">
                                    <input type="submit" name="cart" value="Add to cart" class="btn cart_btn">
                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">
                                </form>
                            </div>
                        </div>
                    <?php            
                            };
                        }else{
                            echo "<p class='empty'>There is no any product!</p>";
                        };
                    ?>
                </div>
            </div>
        </div>
    </section>

    <?php
        require 'footer.php';
    ?>
</body>
</html>