<?php
session_start();
require_once"connect.php";
if(isset($_SESSION['username']))
    header("Location: index.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .well{
            text-align: left;
            text-decoration: none;
            line-height: 10px;
            font-size: 16px;
            font-family: sans-serif;
            font-style: italic;

        }

    </style>
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
                <img src="pic.jpg" class=" center-block ">
                <br>
                <div class="well">
                <p> Mamun Hossain</p>
                <p>B.Sc Engg. in CSE</p>
                <p>Bangladesh University of Business and Technology</p>
                <p>Email: mamunhossaincse15@gmail.com</p>
                </div>

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

            </form>
        </div>
    </div>
</body>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>