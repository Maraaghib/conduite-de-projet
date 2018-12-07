<?php
session_start();

function redirectIfNotConnected() {
    if(!isset($_SESSION['username'])){
        redirect("/user/login.php");
    }
}
function redirect($url){
    header("location: $url");
    exit();
}

function redirectIfConnected() {
    if(isset($_SESSION['username'])){
        redirect("/project/listProjects.php");
    }
}
?>