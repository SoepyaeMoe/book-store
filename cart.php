<?php
    require 'config.php';

    if(isset($_GET['delete'])){
        $id_to_delete = $_GET['delete'];
        mysqli_query($db, "DELETE FROM `cart` WHERE id = '$id_to_delete'");
        header('location: cart.php');
    };

    if(isset($_POST['update'])){
        $id_to_update = $_POST['id'];
        $quantity = $_POST['quantity'];
        mysqli_query($db, "UPDATE `cart` SET quantity = '$quantity' WHERE id = $id_to_update");
    };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>cart</title>
</head>
<body>
    <?php
        require 'header.php'; 
        $user_id = $_SESSION['user_id'];

        if(isset($_GET['delete_all'])){
            mysqli_query($db, "DELETE FROM `cart` WHERE user_id = '$user_id'");
            header('location: cart.php');
        };
    ?>
    <section>
        <div class="container-fluid heading">
            <div class="container">
                <div class="row">
                    <h1>CART</h1>
                    <span><a href="home.php">home</a> / cart </span>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid">
            <div class="container products_container cart">
                <div class="row">
                    <?php
    
                        $select_cart = mysqli_query($db, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
                        if(mysqli_num_rows($select_cart) > 0){
                            while($fecth_cart = mysqli_fetch_assoc($select_cart)){
                    ?>
                        <div class="col product_child_container cart_container">
                            <div class="product added_cart">
                                <form action="" method="post">
                                    <img src="uploaded_img/<?php echo $fecth_cart['image']?>" alt="">
                                    <p><?php echo $fecth_cart['name']?></p>
                                    <input type="number" class="form-control" value="<?php echo $fecth_cart['quantity']?>" min="1" name="quantity">
                                    <input type="submit" class="btn update_btn" value="Update" name="update">
                                    <input type="hidden" value="<?php echo $fecth_cart['id']?>" name="id">
                                    <div class="close"><a href="cart.php?delete=<?php echo $fecth_cart['id']?>" onclick='return confirm("Are you sure to delete from cart")'><span class="material-symbols-outlined">close</span></a></div>
                                    <input type="hidden" name="user_id" value="<?php echo $user_id?>">
                                </form>
                            </div>
                        </div>
                    <?php            
                            }
                        }else{
                            echo "There is no cart!";
                        }
                    ?>
                    <form action="" method="post" class="delete_all_container">
                        <a href="cart.php?delete_all=<?php echo $user_id?>?>" class="delete_all btn" onclick="return confirm('Are you sure to delete all?')">Delete All</a>
                    </form>   
                </div>
            <div class="row">
                <div class="col total_container">
                    <div class="total">
                        <?php
                            $total_price = 0;
                            $select_cart = mysqli_query($db, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
                            if(mysqli_num_rows($select_cart) > 0){
                                while($fecth_cart = mysqli_fetch_assoc($select_cart)){
                                    $quantity = $fecth_cart['quantity'];
                                    $total_price += $fecth_cart['price'] * $quantity;
                                }
                        ?>
                        <p>grand total: <span>$<?php echo $total_price?></span></p>
                        <div class="total_btn">
                            <a href="shop.php" class="btn continute_btn">Continute Shopping</a>
                            <a href="checkout.php" class="btn checkout_btn">Proceed To Checkout</a>
                        </div>
                        <?php
                            }else{
                        ?>
                        <p>grand total: <span>$<?php echo $total_price?></span></p>
                        <div class="total_btn">
                            <a href="shop.php" class="btn continute_btn">Continute Shopping</a>
                            <a href="checkout.php" class="btn checkout_btn">Proceed To Checkout</a>
                        </div>
                        <script>
                            const checkoutBtn = document.getElementsByClassName("checkout_btn")[0];
                            const deleteAllBtn = document.getElementsByClassName("delete_all")[0];
                            
                            deleteAllBtn.classList.add("disabled");
                            checkoutBtn.classList.add("disabled");
                            
                        </script>
                        <?php        
                            }
                        ?>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>

    <?php
        require 'footer.php';
    ?>
</body>
</html>