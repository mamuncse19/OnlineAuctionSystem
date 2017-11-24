<!DOCTYPE html>
<html>
<head>
    <?php session_start()?>
    <title>Products</title>
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
<div class="container" >
        <div class="row well-lg">
            <div class="col-md-8 col-md-offset-2">
                <?php
                require_once"connect.php";
                $results = mysqli_query($conn, "SELECT * FROM product");
                date_default_timezone_set("Asia/Dhaka");
                    foreach ($results as $result){ extract($result)?>
                        <div class="panel panel-success">
                            <div class="panel-heading" style="font-size: 20px">
                                    <?php echo $name?>
                            </div>
                            <div class="panel-body">
                                <img src="images/<?php echo $image?>" class="center-block" style="max-width: 450px;height: 400px" alt="">

                                <br>
                               <h3 class="col-md-10 col-md-offset-1" style="background: #ecf0f1;display: block;overflow: hidden;text-justify: auto; font-family:sans-serif;font-size: 17px;font-weight: normal;line-height: 23px">
                                   Description: <br>
                                   <?php echo $description?>
                               </h3>

                                <div class="lead center-block col-md-12">

                                    <br><br>
                                    Bid Start at: <?php echo $price?>
                                </div>
                                <div class="col-md-12">
                                    <p class="pull-left">Start Time <?php echo $starting_time?></p>
                                    <p class="pull-right">End Time <?php echo $ending_time?></p>
                                </div>
                                <?php
                                if(strtotime("now")>=strtotime($starting_time) && strtotime("now")<strtotime($ending_time))
                                    echo "<div class=\"col-md-12\">
                                    <a href=\"auction.php?id=$id\">
                                        <button class=\"btn btn-block btn-success\">
                                            Goto Auction
                                        </button>
                                    </a>
                                </div>";

                                ?>
                                <?php
                                if(strtotime("now")>strtotime($ending_time) && $sold==1)
                                    echo "<div class=\"col-md-12\">
                                    <a href=\"view_result.php?id=$id\">
                                        <button class=\"btn btn-block btn-success\">
                                            Goto Details
                                        </button>
                                    </a>
                                </div>";

                                ?>


                            </div>

                        </div>




                        <?php
                    }
                ?>

            </div>
        </div>
</div>
</body>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>