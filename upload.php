<?php
session_start();
if(!isset($_SESSION['username']))
    header("Location: index.php");
if(!isset($_SESSION['status']))
    header("Location: index.php");
require_once"connect.php";
$msg = "";

if (isset($_POST['upload'])) {
    $target = "images/".basename($_FILES['image']['name']);

    $price=$_POST['price'];
    $name=$_POST['name'];
    $starting_time=$_POST['starting_time'];
    $ending_time=$_POST['ending_time'];
    $image = $_FILES['image']['name'];
    $image_text = mysqli_real_escape_string($conn, $_POST['image_text']);


    $sql = "INSERT INTO product (image, description,price,name,starting_time,ending_time) VALUES ('$image', '$image_text',$price,'$name','$starting_time','$ending_time')";
    mysqli_query($conn, $sql);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload</title>
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
    <div class="row well">
        <div class="col-md-6 col-md-offset-3">
            <form method="POST" action="upload.php" enctype="multipart/form-data">
                <label for="name">Enter product Name</label>
                <input type="text" class="form-control" name="name">
                <br>
                <input type="hidden" name="size" value="1000000">
                <label for="image">Upload an Image</label>
                    <input type="file" class="form-control" name="image">
                <br>
                <label for="image_text">Enter Product description</label>
                    <textarea class="form-control" id="text" cols="40" rows="4" name="image_text" placeholder="Say something about this image..."></textarea>

                <br>
                <label for="price">Enter product price</label>
                <input type="number" class="form-control" name="price">
                <br>
                <label for="starting_time">Start Time</label>
                <input type="datetime-local" class="form-control" name="starting_time">
                <br>
                <label for="ending_time">Start Time</label>
                <input type="datetime-local" class="form-control" name="ending_time">

                <br>
                    <button type="submit" class="form-control btn-info btn-block" name="upload">POST</button>
                <br>
            </form>
        </div>
    </div>
</div>
</body>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>