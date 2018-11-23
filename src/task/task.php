<?php
    require_once('../data/Database.php');

    function testProjectName($projectName)
    {
        return is_string($projectName) && $projectName !== "";
    }

    function testIdSPrint($idSprint)
    {
        return is_int($idSprint) && $idSprint !== "";
    }

    function isIdUniqueTask($id, $idSprint, $db, $projectName)
    {
        $idTaskSprint = $db->prepare("SELECT idTask FROM sprint INNER JOIN task ON sprint.id=task.idSprint WHERE projectName=:projectName AND idSprint=:idSprint");
        $data = [
            'projectName' => $projectName,
            'idSprint' => $idSprint
        ];
        $idTaskSprint->execute($data);
        while ($dbId = $idTaskSprint->fetch()["idTask"]) {
            if ($id === $dbId) {
                $idTaskSprint->closeCursor();
                return false;
            }
        }
        $idTaskSprint->closeCursor();
        return true;
    }

    function isSprintExist ($projectName, $idSprint)
    {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = $db->prepare("SELECT count(*) FROM sprint WHERE id=:id AND projectName=:projectName");
        $data = [
            "id" => $idSprint,
            "projectName" => $projectName

        ];
        $req->execute($data);
        $test = $req->fetch();
        return $test !=0;
    }
?>
