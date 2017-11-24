<?php
if(!isset($_GET['id'])){
    header('Location: index.php');
}
else{
    $id=$_GET['id'];
}
session_start();
require_once"connect.php";
if(!isset($_SESSION['name']))
    header("Location: index.php");
$user_id=$_SESSION['username'];

$results = mysqli_query($conn, "SELECT * FROM product WHERE  id=$id");
date_default_timezone_set("Asia/Dhaka");

foreach ($results as $result) {
    extract($result);
}
if(strtotime("now")>=strtotime($starting_time) && strtotime("now")<strtotime($ending_time))
    echo "";
else
    header("Location: index.php");
$resu = mysqli_query($conn, "SELECT id FROM  orders WHERE  product_id=$id");
if(mysqli_num_rows($resu)<1){
    $r = mysqli_query($conn, "insert into orders (user_id,product_id,current_price,sold) VALUES (0,$id,$price,0)");
}
?>
<!DOCTYPE html>
<html>
<head>
    <script>
        tm=<?php echo json_encode($ending_time);?>;
        id=<?php echo json_encode($id)?>;
        user_id=<?php echo json_encode($user_id)?>;
    </script>
    <title>Auction</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>



<body style="background: #1abc9c">

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





<p id="demo" class="well text-danger">Remaining Time:</p>
<p id="price" class="well text-info">Current Price: <?php echo $price?></p>
<p id="name" class="well text-primary">Current Winner: <?php echo ""?></p>
<div class="container" style="min-height: 100vh">

        <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                                Product name: <?php echo $name?>
                            <p class="pull-right">Bid Start Price: <?php echo $price?></p>
                        </div>
                        <div class="panel-body">
                            <img src="images/<?php echo $image?>" class="center-block" style="width: 400px;height: 400px" alt="">
                            Product Description:
                            <br>
                            <?php echo $description?>
                            <br>
                            <br>
                            <button class="btn btn-block btn-danger" onclick="update(100)">
                                Bid 100 Tk
                            </button>
                            <button class="btn btn-block btn-danger" onclick="update(200)">
                                Bid 200 Tk
                            </button>
                            <button class="btn btn-block btn-danger" onclick="update(500)">
                                Bid 500 Tk
                            </button>
                            <button class="btn btn-block btn-danger" onclick="update(1000)">
                                Bid 1000 Tk
                            </button>
                            <button class="btn btn-block btn-danger"onclick="update(5000)">
                                Bid 5000 Tk
                            </button>
                            <button class="btn btn-block btn-danger" onclick="update(10000)">
                                Bid 10000 Tk
                            </button>
                            <button class="btn btn-block btn-danger" onclick="update(50000)">
                                Bid 50000 Tk
                            </button>
                            <button class="btn btn-block btn-danger" onclick="update(100000)">
                                Bid 100000 Tk
                            </button>
                        </div>
                    </div>
                </div>
        </div>
</div>
</body>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>

    // Set the date we're counting down to
    var countDownDate = new Date(tm).getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = "Remaining Time "+days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";

        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);
            window.location = "view_result.php?id="+id;
        }
        check(id);
    }, 1000);
    function update(tk){
        $.ajax({url: "update_order.php?id="+id+"&price="+tk+"&user="+user_id, success: function(result){

            document.getElementById("price").innerHTML = "Current Price: "+result;
            alert("You have Bid Current Price by "+tk+" Tk");
        }});
    }
    function check(id){
        $.ajax({url: "view_current_price.php?id="+id, success: function(result){
            v=result.split("/");
            document.getElementById("price").innerHTML = "Current Price: "+v[0];
            document.getElementById("name").innerHTML = "Current Winner: "+v[1];
        }});
    }



</script>

</html>