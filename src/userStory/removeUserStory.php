<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/session.php');

redirectIfNotConnected();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('../data/Project.php');
    require_once('userStory.php');
    $project = new Project;

    $cdpDb = Database::getDBConnection();
    $cdpDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = htmlspecialchars($_POST['idUserStory']);
    $projectName = htmlspecialchars($_POST['projectName']);
    $author = $_SESSION['email'];
    $projectID = $project->getProjectID($author, $projectName);
    $removeUserStory = $cdpDb->prepare("DELETE FROM backlog WHERE id=:id AND projectID=:projectID");
    $data = [
        'id' => $id,
        'projectID' => $projectID
    ];
    if ($removeUserStory->execute($data)) {
        redirect("/project/viewProject.php?projectName=$projectName#tab-swipe-2");
    }
} else {
    redirect(ERROR_URL);
}
