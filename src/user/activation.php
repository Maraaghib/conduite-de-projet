<?php
require_once('../data/Database.php');
require_once('user.php');

$db = Database::getDBConnection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["email"]) && isset($_GET["key"])) {
    $key = $_GET["key"];
    $email = $_GET["email"];
    $user = getUser($email);
    $active = $user["active"];
    $dbKey = $user["keyMail"];
    if ($active) {
        require_once("accountAlreadyActivate.php");
        exit();
    }
    else {
        if ($key == $dbKey) {
            $activateAccount = $db->prepare("UPDATE user SET active = 1 WHERE email=:email");
            $data = [
                "email" => $email 
            ];
            $activateAccount->execute($data);
            header("location: accountActivate.php?email=$email");
            exit();
        }
        else {
            header("location: errorActivation.php");
            exit();
        }
    }

}
?>