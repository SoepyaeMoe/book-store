<?php
    require "config.php";
    session_start();

    if(isset($_POST['login_btn'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user_select = mysqli_query($db, "SELECT * FROM `register` WHERE email = '$email' AND password = '$password'");

        if(mysqli_num_rows($user_select) > 0){
            $row = mysqli_fetch_assoc($user_select);
            if($row['user_type'] == 'admin'){
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_email'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                header('location: admin.php');

            }elseif($row['user_type'] == 'user'){
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                header('location: home.php');
            } 
        }else{
            $massage[] = "login failed, incorrect email or password, try again!";
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
                    <div class="container  alert alert-danger alert_massage">
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
                        <h2>LOGIN NOW</h2>
                        <input class="form-control" type="email" name="email" required placeholder="enter your email">
                        <input class="form-control" type="password" name="password" required placeholder="enter your password">
                        <input class="btn" type="submit" name="login_btn" value="Login Now"> 
                        <p>Don'have an account?<a href="register.php">Register Now</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>