<?php
    require 'config.php';
    session_start();

    if(isset($_GET['delete'])){
        $id_to_delete = $_GET['delete'];
        mysqli_query($db, "DELETE FROM `massage` WHERE id = $id_to_delete");
        header('location: admin_massage.php');
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Message</title>
</head>
<body>
    <?php
        require 'admin_header.php';
    ?>

<div class="body">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12 heading">
                    <h3>MESSAGE</h3>
                </div>
            </div>    
        </div>
    </div>

    <div class="container-fluid">
        <div class="contaier">
            <div class="row">
                <?php
                    $select_message = mysqli_query($db, "SELECT * FROM `massage`");
                    if(mysqli_num_rows($select_message) > 0){
                        while($fetch_meassage = mysqli_fetch_assoc($select_message)){
                ?>
                            <div class="col order">
                                <div class="order_container">
                                    <p>name: <span class="info"><?php echo $fetch_meassage['name']?></span></p>
                                    <p>email: <span class="info"><?php echo $fetch_meassage['email']?></span></p>
                                    <p>phone no.: <span class="info"><?php echo $fetch_meassage['number']?></span></p>
                                    <p>message: <span class="info"><?php echo $fetch_meassage['massage']?></span></p>
                                    <a href="admin_massage.php?delete=<?php echo $fetch_meassage['id']?>" class="btn delete_btn"onclick="return confirm('Are you sure to delete?')">Delete</a>
                                </div>
                            </div>
                <?php        
                        };
                    }else{
                        echo "<p class = 'empty'>There is no any message yet!<p>";
                    };
                ?>
                
            </div>
        </div>
    </div>
</body>
</html>