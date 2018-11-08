<?php
try {
    $cdpDb = new PDO(
        'mysql:host=database;port=3306;dbname=Cdp2018;charset=utf8',
        'root',
        'pass'
    );
    $cdpDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) {
    die('Erreur : ' . $ex->getMessage());
}
$id = $_POST['idDeleteUserStory'];
$removeUserStory = "DELETE FROM backlog WHERE id=$id";
$cdpDb->exec($removeUserStory);
header('location: listBacklog.php');
?>
