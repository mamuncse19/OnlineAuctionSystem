<!DOCTYPE html>
<?php  session_start();?>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .navbar{
            background-colo: rgba(255,255,255,.8);
            border: none;
            border-radius: inherit;
        }


    </style>
</head>



<body  style="background: linear-gradient(rgba(0,0,0,.30),rgba(0,0,0,.30)),url('images/img.jpg');width: 100%;height: auto;">



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
                         <li ><a href="contact.php">Contact</a></li>
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






</body>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>