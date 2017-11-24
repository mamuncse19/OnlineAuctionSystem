<?php
if(!isset($_GET['id']) && !isset($_GET['price'])  && !isset($_GET['user']))
    header('Location: index.php');
else{
    $id=$_GET['id'];
    $price=$_GET['price'];
    $user=$_GET['user'];
}
session_start();
require_once 'connect.php';
$results = mysqli_query($conn, "UPDATE orders set current_price=current_price+$price,user_id=$user,sold=1 WHERE product_id=$id");
$results = mysqli_query($conn, "UPDATE product set sold=1 WHERE id=$id");
$results = mysqli_query($conn, "select * from orders where product_id=$id");
foreach ($results as $result){
    echo $result['current_price']."/".ucfirst($_SESSION['name']);
    $id=$result['user_id'];
    $rs=mysqli_query($conn,"select username from register where id='$id'");
    foreach ($rs as $r) {
        echo $r['username'];
    }
}
?>