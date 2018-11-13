<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $id = htmlspecialchars($_POST['idUserStory']);
    $projectName = htmlspecialchars($_POST['projectName']);
    try {
        $removeUserStory = $cdpDb->prepare("DELETE FROM backlog WHERE id=:id AND projectName=:projectName");
        $data = [
            'id' => $id,
            'projectName' => $projectName
        ];
    } catch (Exception $ex) {
        die('Erreur : ' . $ex->getMessage());
        header('location: /userStory/error.php');
    }
    if ($removeUserStory->execute($data)) {
        header("location: listBacklog.php?projectName=$projectName");
    }
} else {
    header('location: /userStory/error.php');
}
