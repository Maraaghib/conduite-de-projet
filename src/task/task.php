<?php
    require_once('../data/Database.php');

    function testIdSPrint($idSprint)
    {
        return is_int($idSprint) && $idSprint !== "";
    }

    function isIdUniqueTask($id, $idSprint, $db, $projectID)
    {
        $idTaskSprint = $db->prepare("SELECT idTask FROM sprint INNER JOIN task ON sprint.id=task.idSprint WHERE projectID=:projectID AND idSprint=:idSprint");
        $data = [
            'projectID' => $projectID,
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

    function isSprintExist ($projectID, $idSprint)
    {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = $db->prepare("SELECT count(*) FROM sprint WHERE id=:id AND projectID=:projectID");
        $data = [
            "id" => $idSprint,
            "projectID" => $projectID

        ];
        $req->execute($data);
        $test = $req->fetch();
        return $test !=0;
    }

    function getNonPlanTask($idSprint) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $task = $db->prepare("SELECT * FROM task WHERE idSprint=:idSprint ORDER BY idTask");
        $data = [
            "idSprint" => $idSprint
        ];
        $task->execute($data);

        return $task->fetchAll();
    }
?>
