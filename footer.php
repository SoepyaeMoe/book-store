<?php
    require 'config.php';

    if(!isset($_SESSION['user_id'])){
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
</head>
<body>
    <section class="footer">
        <div class="container-fluid">
            <div class="container">
                <div class="row box_row">
                    <div class="col-md-3 box1">
                        <h5>QUICK LINKS</h5>
                        <a href="home.php">home</a>
                        <a href="about.php">about</a>
                        <a href="shop.php">shop</a>
                        <a href="contact.php">contact</a>
                        <a href="orders.php">orders</a>
                    </div>
                    <div class="col-md-3 box1">
                        <h5>EXTRA LINKS</h5>
                        <a href="login.php">login</a>
                        <a href="register.php">about</a>
                        <a href="cart.php">shop</a>
                        <a href="contact.php">cart</a>
                        <a href="orders.php">orders</a>
                    </div>
                    <div class="col-md-3 box1">
                        <h5>CONTACT INFO</h5>
                        <span><i class="fa-solid fa-phone"></i>+123-456-789</span>
                        <span><i class="fa-solid fa-phone"></i>+111-222-333</span>
                        <span><i class="fa-solid fa-envelope"></i>soepyae@gmail.com</span>
                        <span><i class="fa-solid fa-location-dot"></i>Yangon, Myanamar</span>
                    </div>
                    <div class="col-md-3 box1">
                        <h5>FOLLOW US</h5>
                        <span><i class="fa-brands fa-facebook"></i><a href="">facebook</a></span>
                        <span><i class="fa-brands fa-twitter"></i><a href="">twitter</a></span>
                        <span><i class="fa-brands fa-square-instagram"></i><a href="">instargram</a></span>
                        <span><i class="fa-brands fa-linkedin"></i><a href="">linkedin</a></span>
                    </div>
                </div>
                <div class="row end_footer">
                    <span><i class="fa-regular fa-copyright"></i>copyright @ 2023 by mr.soepyaemoe</span>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://kit.fontawesome.com/94c5eeb7f0.js" crossorigin="anonymous"></script>
</html>