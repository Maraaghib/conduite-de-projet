<?php
    require_once('../data/Database.php');

    function testProjectName($projectName)
    {
        return is_string($projectName) && $projectName !== "";
    }

    function isIdUnique($id, $db, $projectName)
    {
        $idUsProject = $db->prepare("SELECT id FROM backlog WHERE projectName=:projectName");
        $data = [
            "projectName" => $projectName
        ];
        $idUsProject->execute($data);
        while ($dbId = $idUsProject->fetch()["id"]) {
            if ($id === $dbId) {
                $idUsProject->closeCursor();
                return false;
            }
        }
        $idUsProject->closeCursor();
        return true;
    }

    function isUserStoryExist ($id, $projectName)
    {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = $db->prepare("SELECT count(*) FROM backlog WHERE projectName=:projectName AND id=:id");
        $data = [
            "projectName" => $projectName,
            "id" => $id
        ];
        $req->execute($data);
        $test = $req->fetch();
        return $test !=0;
    }

    function getBackLog($projectName) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $backlog = $db->prepare("SELECT * FROM backlog WHERE projectName=:projectName   ORDER BY id");
        $data = [
            "projectName" => $projectName
        ];
        $backlog->execute($data);

        return $backlog->fetchAll();
    }

    function getNonPlanUserStories($projectName) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $backlog = $db->prepare("SELECT * FROM backlog WHERE projectName=:projectName AND idSprint IS NULL  ORDER BY id");
        $data = [
            "projectName" => $projectName
        ];
        $backlog->execute($data);

        return $backlog->fetchAll();
    }

    function getListSprint($projectName) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $listSprint = $db->prepare("SELECT * FROM sprint WHERE projectName=:projectName ORDER BY id");
        $data = [
            "projectName" => $projectName
        ];
        $listSprint->execute($data);

        return $listSprint->fetchAll();
    }
?>
