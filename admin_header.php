<?php 
    require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="admin_header.css">
    <title>Admin Panel</title>
</head>
<body>
    <?php
          if(isset($massage)){
            foreach($massage as $massage){
                echo '<div class="container-fluid" style="position: absolute; z-index: 99999;">
                        <div class="container  alert alert-warning alert_massage">
                            <span> '.$massage.' </span>
                            <i class="bi bi-x" onclick="this.parentElement.remove()"></i>
                        </div>
                     </div>';
            }
          }      
    ?>
    <div class="container-fluid main_header_container">
        <div class="container">
            <div class="row header_container">
                <div class="col-4 logo">
                    <h4>Admin<span>Panel</span></h4>
                </div>
                <div class="col-5 menu">
                    <a href="admin.php">home</a>
                    <a href="admin_product.php">product</a>
                    <a href="admin_orders.php">orders</a>
                    <a href="admin_user.php">user</a>
                    <a href="admin_massage.php">massage</a>
                </div>
                <div class="col-3 profile_icon">
                    <span class="material-symbols-outlined menu_icon">menu</span>
                    <span class="material-symbols-outlined person_icon">person</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container user_box_container">
            <div class="user_box">
                <p>user name: <span class="user_name"><?php echo $_SESSION['admin_name']?></span></p>
                <p>email: <span class="user_email"><?php echo $_SESSION['admin_email']?></span></p>
                <a href="login.php" class="btn">Logout</a>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="postition: relative;">
        <div class="container menu_icon_container">
            <div class="row menu_icon_menu">
                <div class="col-12 menu_item">
                    <a href="admin.php">home</a>
                </div>
                <div class="col-12 menu_item">
                    <a href="admin_product.php">product</a>
                </div>
                <div class="col-12 menu_item">
                    <a href="admin_orders.php">orders</a>
                </div>
                <div class="col-12 menu_item">
                    <a href="admin_user.php">user</a>
                </div>
                <div class="col-12 menu_item">
                    <a href="admin_massage.php">massage</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="admin_header.js"></script>
</html>