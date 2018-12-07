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

    /**
     * Permet de récupérer tous les utilisateurs de l'application
     */
    function getAllUsers($me) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("SELECT * FROM user WHERE email!=:myEmail ORDER BY name ASC", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $data = [
            "myEmail" => $me
        ];
        $stmt->execute($data);
        $allUsers = [];
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $allUsers[] = $result;
        }
        return $allUsers;
    }
?>
