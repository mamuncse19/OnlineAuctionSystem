<?php
session_start();
require_once"connect.php";
if(isset($_SESSION['username']))
    header("Location: index.php");
$error = false;
if(isset($_POST['btn-login'])){
    $email = trim($_POST['email']);
    $email = htmlspecialchars(strip_tags($email));

    $password = trim($_POST['password']);
    $password = htmlspecialchars(strip_tags($password));

    if(empty($email)){
        $error = true;
        $errorEmail = 'Please input email';
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = true;
        $errorEmail = 'Please enter a valid email address';
    }

    if(empty($password)){
        $error = true;
        $errorPassword = 'Please enter password';
    }elseif(strlen($password)< 4){
        $error = true;
        $errorPassword = 'Password at least 6 character';
    }

    if(!$error){
        $password = md5($password);
        $sql = "select * from register where email='$email' ";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if($count==1 && $row['password'] == $password){
            $_SESSION['username'] = $row['id'];
            $_SESSION['name'] = $row['username'];
            header('location: index.php');
        }else{
            $errorMsg = 'Invalid Email or Password';
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Use Login</title>
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
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">


            <?php
            if(isset($errorMsg)){
                ?>
                <div class="alert alert-danger">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    <?php echo $errorMsg; ?>
                </div>
                <?php
            }
            ?>
            <div class="form-group">
                <img src="login.png" class="img-circle center-block ">
                <h2 align="center">Login</h2>
                <p>Email</p>
                <input placeholder="email" type="text" name="email" class="form-control" autocomplete="on">
                <span class="text-danger"><?php if(isset($errorEmail)) echo $errorEmail; ?></span>
            </div>
            <div class="form-group">
                <p>Password</p>
                <input placeholder="password" type="password" name="password" class="form-control" autocomplete="off">
                <span class="text-danger"><?php if(isset($errorPassword)) echo $errorPassword; ?></span>
            </div>
            <div class="form-group">
                <input align="center" type="submit" name="btn-login" value="Login" class="btn btn-primary form-control" >
            </div>

            <a style="text-decoration: none">Didn't register yet</a>  <a href="register.php" style="text-decoration: none">Register</a>
        </form>
    </div>
    </div>
</div>
</body>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>