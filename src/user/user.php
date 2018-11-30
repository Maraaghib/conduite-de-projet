<?php
    require_once('../data/Database.php');

    function getUser($email) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $getUser = $db->prepare("SELECT * FROM user WHERE email=:email");
        $data = [
            "email" => $email
        ];
        $getUser->execute($data);
        return $getUser->fetch();
    }

    function checkPassword($inputPassword, $dbPassword){
        return $inputPassword == $dbPassword;
    }
?>