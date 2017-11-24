<?php
session_start();
require_once"connect.php";
if(isset($_SESSION['username']))
    header("Location: index.php");
$error = false;
if(isset($_POST['btn-register'])){
    $firstname = $_POST['firstname'];
    $firstname = strip_tags($firstname);
    $firstname = htmlspecialchars($firstname);

    $lastname = $_POST['lastname'];
    $lastname = strip_tags($lastname);
    $lastname = htmlspecialchars($lastname);

    //clean user input to prevent sql injection
    $username = $_POST['username'];
    $username = strip_tags($username);
    $username = htmlspecialchars($username);

    $email = $_POST['email'];
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $password = $_POST['password'];
    $password = strip_tags($password);
    $password = htmlspecialchars($password);

    $mobile = $_POST['mobile'];
    $mobile = strip_tags($mobile);
    $mobile = htmlspecialchars($mobile);

    if(empty($firstname)){
        $error = true;
        $errorFirstname = 'Please input firstname';
    }

    if(empty($lastname)){
        $error = true;
        $errorLastname = 'Please input lastname';
    }

    //validate
    if(empty($username)){
        $error = true;
        $errorUsername = 'Please input username';
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = true;
        $errorEmail = 'Please input a valid email';
    }

    if(empty($password)){
        $error = true;
        $errorPassword = 'Please password';
    }elseif(strlen($password) < 4){
        $error = true;
        $errorPassword = 'Password must at least 6 characters';
    }

    //encrypt password with md5
    $password = md5($password);

    if(empty($mobile)){
        $error = true;
        $errorMobile = 'Please input mobile number';
    }

    //insert data if no error
    $results = mysqli_query($conn, "select * from register where username='$username'");
   if(mysqli_num_rows($results)>0)
        {
        $error=true;
        $errorUsername="Username Already Exists";
    }
    $results = mysqli_query($conn, "select * from register where email='$email'");
    if(mysqli_num_rows($results)>0)
    {
        $error=true;
        $errorUsername="Email Already Exists";
    }

    if(!$error){
        $sql = "insert into register (firstname,lastname,username,email,password,mobile) values('$firstname','$lastname','$username', '$email', '$password', '$mobile')";
        if(mysqli_query($conn, $sql)){

            $successMsg = 'Registration successfully. <a href="login.php">click here to login</a>';
            //header('location: login.php');
        }else{
            echo 'Error '.mysqli_error($conn);
        }
    }

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body  style="background: #1abc9c">

<nav class="navbar navbar-default">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">AUCTION</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <?php

            if(!isset($_SESSION['username'])) {
                ?>
                <li ><a href="register.php">Register</a></li>
                <li ><a href="login.php">Login</a></li>
                <li ><a href="admin.php">Admin</a></li>
                <?php
            }else{
                if(isset($_SESSION['name'])){?>
                    <li><a href="view_products.php">View Products</a></li>
                    <?php
                }
                if(isset($_SESSION['status'])) {
                    ?>
                    <li ><a href="upload.php">Upload</a></li>

                    <?php
                }
            }
            ?>
        </ul>

        <?php
        if(isset($_SESSION['username'])) {
            ?>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <?php
                        if(isset($_SESSION['status'])){
                            ?>
                            Admin
                            <?php
                        }
                        else echo $_SESSION['name'];
                        ?>

                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>

            <?php
        }
        ?>
    </div><!-- /.navbar-collapse -->

</nav>





<div class="container">
    <div class="row ">
        <div class="col-md-5 col-md-offset-3 well">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                <h2 align="center">Register</h2>

                <?php
                    if(isset($successMsg)){
                 ?>
                        <div class="alert alert-success">
                            <span class="glyphicon glyphicon-info-sign"></span>
                            <?php echo $successMsg; ?>
                        </div>
                <?php
                    }
                ?>
                <div class="form-group">
                    <label for="firstname" class="control-label">Firstname</label>
                    <input placeholder="firstname" type="text" name="firstname" class="form-control" autocomplete="on">
                    <span class="text-danger"><?php if(isset($errorFirstname)) echo $errorFirstname; ?></span>
                </div>
                <div class="form-group">
                    <label for="lastname" class="control-label">Lastname</label>
                    <input placeholder="lastname" type="text" name="lastname" class="form-control" autocomplete="on">
                    <span class="text-danger"><?php if(isset($errorLastname)) echo $errorLastname; ?></span>
                </div>
                <div class="form-group">
                    <label for="username" class="control-label">Username</label>
                    <input placeholder="username" type="text" name="username" class="form-control" autocomplete="on">
                    <span class="text-danger"><?php if(isset($errorUsername)) echo $errorUsername; ?></span>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input placeholder="email" type="text" name="email" class="form-control" autocomplete="on">
                    <span class="text-danger"><?php if(isset($errorEmail)) echo $errorEmail; ?></span>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input placeholder="password" type="password" name="password" class="form-control" autocomplete="off">
                    <span class="text-danger"><?php if(isset($errorPassword)) echo $errorPassword; ?></span>
                </div>
                <div class="form-group">
                    <label for="mobile" class="control-label">Mobile</label>
                    <input placeholder="01" type="number" name="mobile" class="form-control" autocomplete="on">
                    <span class="text-danger"><?php if(isset($errorMobile)) echo $errorMobile; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" name="btn-register" value="Register" class="btn btn-primary btn-block">
                </div>
            </form>
        </div>
    </div>
</body>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>