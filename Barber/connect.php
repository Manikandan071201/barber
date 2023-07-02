<?php
$con=new mysqli('localhost','root','','login_signup');
if(!$con){
    die(mysqli_error($con));
}
?>