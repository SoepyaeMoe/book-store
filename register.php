<?php 
    require "config.php";

    if(isset($_POST['register_btn'])){
        $name = $_POST['user_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user_type = $_POST['select'];
        $cpassword = $_POST['cpassword'];


        $select_user = mysqli_query($db, "SELECT * FROM  register WHERE email='$email' AND password='$password'") or die('querry failed');

        if(mysqli_num_rows($select_user) > 0){
            $massage[] = "user already exist please login!";
        }else{
            if($password != $cpassword){
                $massage[] = "confirm password not match!";
                $name = $_POST['user_name'];
                $email = $_POST['email'];
            }else{
                $query = "INSERT INTO register (name, email, password, user_type) VALUES ('$name', '$email', '$password', '$user_type')";
                mysqli_query($db, $query);
                header('location: login.php');
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="register.css">
    <title>Register Now</title>
</head>
<body>
    <?php
          if(isset($massage)){
            foreach($massage as $massage){
                echo '<div class="container-fluid" style="position: absolute;">
                        <div class="container  alert alert-warning alert_massage">
                            <span> '.$massage.' </span>
                            <i class="bi bi-x" onclick="this.parentElement.remove()"></i>
                        </div>
                     </div>';
            }
          }      
    ?>
    
    <div class="container-fluid">
        <div class="container form_container">
            <div class="row form_row">
                <div class="col-md-5 form_col">
                    <form action="" method="POST">
                        <h2>REGISTER NOW</h2>
                        <input class="form-control" type="text" name="user_name" required placeholder="enter your name" value="<?php if(!empty($name)){echo $name;}?>">
                        <input class="form-control" type="email" name="email" required placeholder="enter your email" value="<?php if(!empty($email)){echo $email;}?>">
                        <input class="form-control" type="password" name="password" required placeholder="enter your password">
                        <input class="form-control" type="password" name="cpassword" required placeholder="confirm your password">
                        <select class="form-control form-select" name="select" id="">
                            <option value="user">user</option>
                            <option value="admin">admin</option>
                        </select>
                        <input class="btn" type="submit" name="register_btn" value="Register Now"> 
                        <p>Do you have an account?<a href="login.php">Log In</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>