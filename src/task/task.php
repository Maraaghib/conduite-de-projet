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

    /**
     * Permet de récupérer toutes les tâches d'un sprint
     */
    function getTasksBySprintAndProgress($idSprint, $progress) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("SELECT * FROM task WHERE idSprint=:idSprint AND progress=:progress ORDER BY idTask ASC", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $data = [
            'idSprint' => $idSprint,
            'progress' => $progress
        ];
        $stmt->execute($data);
        $tasks = [];
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $tasks[] = $result;
        }
        return $tasks;
    }

    /**
     * Permet de récupérer toutes les dépendances d'une tâche grâce à son ID auto-increment
     */
    function getDependenceByID($idTask) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("SELECT * FROM dependence WHERE id=:id ORDER BY idTask ASC", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $data = [
            'id' => $idTask
        ];
        $stmt->execute($data);
        $tasks = [];
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $tasks[] = $result;
        }
        return $tasks;
    }

    /**
     * Permet de récupérer tous les user stories liés à une tâche grâce à son ID auto-increment
     */
    function getLinkedUSByID($idTask) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("SELECT * FROM linkedus WHERE idTask=:idTask ORDER BY idUS ASC", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $data = [
            'idTask' => $idTask
        ];
        $stmt->execute($data);
        $userStories = [];
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $userStories[] = $result;
        }
        return $userStories;
    }
?>
