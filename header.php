<?php 
    require 'config.php';
    session_start();
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
        header('location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="header.css">
    <title>Header</title>
</head>
<body>
    <div class="container-fluid top_header_container">
        <div class="container">
            <div class="row top_header">
                <div class="col icons_container">
                    <div class="icons">
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-twitter"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                        <a href=""><i class="bi bi-google"></i></a>
                    </div>
                </div>
                <div class="col login_out_container">
                    <div class="login_out">
                        <span>new <a href="login.php">Login</a> |
                        <a href="register.php">register</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid header_container">
        <div class="container">
            <div class="row">
                <div class="col-3 logo">
                    <h4>Bookly.</h4>
                </div>
                <div class="col-6 menu">
                    <a href="home.php">home</a>
                    <a href="about.php">about</a>
                    <a href="shop.php">shop</a>
                    <a href="contact.php">contact</a>
                    <a href="orders.php">orders</a>
                </div>
                <?php 
                    $select_cart = mysqli_query($db, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
                    $cart_number = mysqli_num_rows($select_cart);
                ?>
                <div class="col-3 tool_icons">
                    <span class="material-symbols-outlined" id="menu">menu</span>
                    <div class="search_div"><a href="search.php"><span class="material-symbols-outlined" id="search">search</span></a></div>
                    <span class="material-symbols-outlined" id="preson">person</span>
                    <div class="cart_div"><a href="cart.php"><span class="material-symbols-outlined" id="cart">garden_cart</span></a><div class="cart_number"><?php echo $cart_number?></div></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container user_box_container">
        <div class="user_info_box">
            <p>user name: <span><?php echo $_SESSION['user_name']?><span></p>
            <p>email: <span><?php echo $_SESSION['user_email']?><span></p>
            <a href="login.php" class="btn logout_btn">Logout</a>
        </div>
    </div>

    <div class="container-fluid menu_items_parent">
        <div class="container">
            <div class="row menu_items_container">
                <div class="col-12 menu_items">
                    <a href="home.php">home</a>
                    <a href="about.php">about</a>
                    <a href="shop.php">shop</a>
                    <a href="contact.php">contact</a>
                    <a href="orders.php">orders</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="header.js"></script>
</html>