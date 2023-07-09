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
    <link rel="stylesheet" href="header.css">
    <title>secrch page</title>
</head>
<body>
    <?php
        require 'header.php';
    ?>
    <section>
        <div class="container-fluid heading">
            <div class="container">
                <div class="row">
                    <h1>SEARCH</h1>
                    <span><a href="home.php">home</a> / search </span>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid search_container">
        <div class="container">
            <div class="row">
                <form action="" method="post" class="input-group mb-3">
                    <input type="search" name="search" placeholder="Search products....." class="form-control search_bar">
                    <input type="submit" name="submit_search" value="Search" class="btn search_btn">
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid">
            <div class="container products_container">
                <div class="row">
                    <?php
                        if(isset($_POST['submit_search'])){
                            $search_item = $_POST['search'];
                        
                        $select_products = mysqli_query($db, "SELECT * FROM `products` WHERE name LIKE '%{$search_item}%'");
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
                            echo "<p class='empty'id='empty'>Search items not found!</p>";
                        };
                    }else echo "<p class='empty' id='empty'>Search something!</p>"
                    ?>
                </div>
            </div>
        </div>
    <?php
        require 'footer.php';
    ?>
</body>
</html>