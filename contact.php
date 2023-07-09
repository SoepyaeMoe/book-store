<?php
    require 'config.php';

    if(isset($_POST['sent_massage'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $msg = $_POST['massage'];
        $user_id = $_POST['user_id'];
        if(!empty($name) && !empty($email) && !empty($number) && !empty($msg)){
            mysqli_query($db, "INSERT INTO `massage` (user_id, name, email, number, massage) VALUES ('$user_id', '$name', '$email', '$number', '$msg')");
            $massage[] = "masssage was sent!";
        }else{
            $massage[] = "Something is fail to require!";
        }
    };
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact us</title>
</head>
<body>
    <?php
        if(isset($massage)){
            foreach($massage as $massage){
                echo '<div class="container-fluid" style="position: sticky; top: 0; z-index: 9999;">
                        <div class="container  alert alert-danger alert_massage">
                            <span> '.$massage.' </span>
                            <i class="bi bi-x" onclick="this.parentElement.remove()"></i>
                        </div>
                    </div>';
            }
        }      
        require 'header.php';
    ?>
    <section class="about">
        <div class="container-fluid heading">
            <div class="container">
                <div class="row">
                    <h1>CONTACT US</h1>
                    <span><a href="home.php">home</a> / contact </span>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid">
            <div class="container">
                <div class="row massage_container">
                    <div class="col-md-5 massage">
                        <h4>SAY SOMETHING!</h4>
                        <form action="" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">
                            <input type="text" class="form-control" name="name" required placeholder="enter your name">
                            <input type="email"class="form-control" name="email" required placeholder="enter your email">
                            <input type="number" class="form-control" min="1" name="number" required placeholder="enter your phone number">
                            <textarea type="text" class="form-control" name="massage" required placeholder="enter your massage"></textarea>
                            <input type="submit" class="btn" name="sent_massage" value="Sent Massage">
                        </form>
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