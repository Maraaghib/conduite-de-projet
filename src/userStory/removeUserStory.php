<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('../data/Project.php');
    require_once('userStory.php');
    $project = new Project;

    $cdpDb = Database::getDBConnection();
    $cdpDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = htmlspecialchars($_POST['idUserStory']);
    $projectName = htmlspecialchars($_POST['projectName']);
    $removeUserStory = $cdpDb->prepare("DELETE FROM backlog WHERE id=:id AND projectName=:projectName");
    $data = [
        'id' => $id,
        'projectName' => $projectName
    ];
    if ($removeUserStory->execute($data)) {
        header("location: /project/viewProject.php?projectName=$projectName#tab-swipe-2");
    }
} else {
    header(ERROR_URL);
}
