<?php 
function testProjectName($projectName)
{
    return is_string($projectName) && $projectName !== "";
}

function isIdUnique($id, $db, $projectName)
{
    $rep = $db->query("SELECT id FROM backlog WHERE projectName='$projectName'");
    while ($dbId = $rep->fetch()["id"]) {
        if ($id === $dbId) {
            echo $dbid;
            $rep->closeCursor();
            return false;
        }
    }
    $rep->closeCursor();
    return true;
}

function isProjectExist($projectName, $db)
{
    $getNbProject = $db->prepare("SELECT count(*) AS numProjectName FROM project WHERE name=:projectName");
    $data = [
        'projectName' => $projectName
    ];
    $getNbProject->execute($data);
    return $getNbProject->fetch()["numProjectName"];
}?>