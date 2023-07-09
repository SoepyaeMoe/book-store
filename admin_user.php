<?php
    require 'config.php';
    session_start();

    if(isset($_GET['delete'])){
        $id_to_delete = $_GET['delete'];
        mysqli_query($db, "DELETE FROM `register` WHERE id = '$id_to_delete'");
        header('location: admin_user.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Users</title>
</head>
<body>
    <?php
        require 'admin_header.php';
    ?>

    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <?php 
                    $select_user = mysqli_query($db, "SELECT * FROM `register`");
                    if(mysqli_num_rows($select_user) > 0){
                        while($fecth_user = mysqli_fetch_assoc($select_user)){
                ?>
                            <div class="col order">
                                <div class="user order_container"> 
                                    <p>user name: <span class="info"><?php echo $fecth_user['name']?></span></p>
                                    <p>email: <span class="info"><?php echo $fecth_user['email']?></span></p>
                                    <p>user type: <span class="info"><?php echo $fecth_user['user_type']?></span></p>
                                    <a href="admin_user.php?delete=<?php echo $fecth_user['id']?>" class="btn delete_btn" onclick="return confirm('Are you sure to delete?')">Delete</a>
                                 </div>
                            </div>
                <?php
                        };
                    };
                ?>
                
            </div>
        </div>
    </div>
</body>
</html>