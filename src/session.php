<?php
session_start();
if(!isset($_SESSION['username'])){
    redirect("/user/login.php");
}

function redirect($url){
    header("location: $url");
    exit();
}
?>