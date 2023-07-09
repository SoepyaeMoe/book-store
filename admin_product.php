<?php
    require 'config.php';
    session_start();

    if(!isset($_SESSION['admin_id'])){
        header('location: login.php');
    };
    
    if(isset($_POST['add_product'])){
        $product_name = $_POST['porduct_name'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];
        $tmp_image = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_file = 'uploaded_img/'.$image;

        $select_query = mysqli_query($db, "SELECT name FROM `products` WHERE name = '$product_name'");

        if(mysqli_num_rows($select_query) > 0){
            $massage[] = "products is already exists!";
        }else{
            if($image_size > 200000){
                $massage[] = "image file  is too large!";
            }else{
                $add_product_query = mysqli_query($db, "INSERT INTO `products`(name, price, image) VALUES('$product_name', '$price', '$image')") or die('query failed');
                move_uploaded_file($tmp_image, $image_file);
                $massage[] = "product upload is success!";
            };
        };
    };

    if(isset($_GET['delete'])){
        $delete = $_GET['delete'];
        $select_image_to_delete = mysqli_query($db, "SELECT image FROM `products` WHERE id = '$delete'");
        $selected_image_to_delete = mysqli_fetch_assoc($select_image_to_delete);
        unlink('uploaded_img/'.$selected_image_to_delete['image']);
        $select_product_to_delete = mysqli_query($db, "DELETE FROM `products` WHERE id = '$delete'");
        header ('location: admin_product.php');
    };

    if(isset($_POST['update_product'])){
        $update_name = $_POST['update_porduct_name'];
        $update_price = $_POST['update_price'];
        $product_id_to_update = $_GET['update'];

        mysqli_query($db, "UPDATE `products` SET name = '$update_name', price = '$update_price' WHERE id = '$product_id_to_update' ");

        $update_image = $_FILES['update_image']['name'];
        $update_tmp_name = $_FILES['update_image']['tmp_name'];
        $update_image_size = $_FILES['update_image']['size'];
        $update_folder = 'uploaded_img/'.$update_image;
        $old_image = mysqli_query($db, "SELECT image FROM `products` WHERE id = '$product_id_to_update'");
        $old_image_to_remove = mysqli_fetch_assoc($old_image);

        if(!empty($update_image)){
            if($update_image_size > 200000){
                $massage[] = "file size is too large!";
            }else{
                mysqli_query($db, "UPDATE `products` SET image = '$update_image' WHERE id = '$product_id_to_update'");
                unlink('uploaded_img/'.$old_image_to_remove['image']);
                move_uploaded_file($update_tmp_name, $update_folder);
            };
        };
        header('location: admin_product.php');
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="admin.css">
    <title>Product</title>
</head>
<body>
    <?php
        require 'admin_header.php';
    ?>
<div class="container-fluid">
    <div class="container form_container">
            <div class="row form_row">
                <div class="col-md-5 form_col">
                    <form action="" method="post" enctype = "multipart/form-data">
                        <h2>ADD PRODUCT</h2>
                        <input class="form-control" type="text" name="porduct_name" placeholder="enter product name" required>
                        <input class="form-control" type="number" name="price" min = 0 placeholder="enter product price" required>
                        <input class="form-control" type="file" name="image" accept="image/jpg, image/jpeg, image/png" required>
                        <input class="btn" type="submit" name="add_product" value="Add Product">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="show">
    <div class="containeer-fluid">
        <div class="container">
            <div class="row">
                <?php
                    $select_product = mysqli_query($db, "SELECT * FROM `products`");
                    if(mysqli_num_rows($select_product) > 0){
                        foreach($select_product as $fetch_products){
                ?>
                    <div class="col show_products">
                        <div class="products">
                            <img src="uploaded_img/<?php echo $fetch_products['image'];?>" alt="">
                            <p class="name"><?php echo $fetch_products['name'];?></p>
                            <h4 class="price">$<?php echo $fetch_products['price'];?>/-</h4>
                            <a href="admin_product.php?update=<?php echo $fetch_products['id'];?>" class="btn update_btn">Update</a>
                            <a href="admin_product.php?delete=<?php echo $fetch_products['id'];?>" class="btn delete_btn" onclick="return confirm('Are you sure to delete?')">Delete</a>
                        </div>
                    </div>
                <?php            
                        }
                    }else {
                        echo "<p class = 'empty'>No products upload yet<p>";
                    }
                ?>
            </div>
        </div>
    </div>
</section>

<section class="update">
    <?php 
        if(isset($_GET['update'])){
            $product_id_to_update = $_GET['update'];
            $select_old_procuct = mysqli_query($db, "SELECT * FROM `products` WHERE id = '$product_id_to_update'");
            if(mysqli_num_rows($select_old_procuct) > 0){
                foreach($select_old_procuct as $value){
                    $old_procuct_name = $value['name'];
                    $old_procuct_price = $value['price'];
    ?>
        <div class="container-fluid update_post">
            <div class="container form_container">
                <div class="row form_row">
                    <div class="col-md-5 form_col">
                        <form action="" method="post" enctype = "multipart/form-data">
                            <h2>UPDATE PRODUCT</h2>
                            <input class="form-control" type="text" name="update_porduct_name" placeholder="enter product name" value="<?php echo $old_procuct_name; ?>" required>
                            <input class="form-control" type="number" name="update_price" min = 0 placeholder="enter product price" value="<?php echo $old_procuct_price; ?>" required>
                            <input class="form-control" type="file" name="update_image" accept="image/jpg, image/jpeg, image/png">
                            <input class="btn update_p_btn" type="submit" name="update_product" value="Update">
                            <input class="btn cancel_btn" type="button" name="cancel" value="Cancel"> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
                };
            };
        };
    ?>
</section>
</body>
<script src="admin_products.js"></script>
</html>