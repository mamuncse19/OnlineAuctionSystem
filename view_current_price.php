<?php
if(!isset($_GET['id']))
    header('Location: index.php');
else{
    $id=$_GET['id'];

}
session_start();
require_once 'connect.php';
//$results = mysqli_query($conn, "UPDATE orders set current_price=current_price+$price,user_id=$user WHERE sold=0 and product_id=$id");
$results = mysqli_query($conn, "select * from orders where product_id=$id");
foreach ($results as $result){
    echo $result['current_price']."/";
    $id=$result['user_id'];
    $rs=mysqli_query($conn,"select username from register where id='$id'");
    foreach ($rs as $r) {
        echo $r['username'];
    }

}
?>