<?php
    require_once('../data/Database.php');

    function testProjectName($projectName)
    {
        return is_string($projectName) && $projectName !== "";
    }

    function isIdUnique($id, $db, $projectID)
    {
        $idUsProject = $db->prepare("SELECT id FROM backlog WHERE projectID=:projectID");
        $data = [
            "projectID" => $projectID
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

    function isUserStoryExist ($id, $projectID)
    {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = $db->prepare("SELECT count(*) FROM backlog WHERE projectID=:projectID AND id=:id");
        $data = [
            "projectID" => $projectID,
            "id" => $id
        ];
        $req->execute($data);
        $test = $req->fetch();
        return $test !=0;
    }

    function getBackLog($projectID) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $backlog = $db->prepare("SELECT * FROM backlog WHERE projectID=:projectID   ORDER BY id");
        $data = [
            "projectID" => $projectID
        ];
        $backlog->execute($data);

        return $backlog->fetchAll();
    }

    function getListSprints($projectID) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $listSprints = $db->prepare("SELECT * FROM sprint WHERE projectID=:projectID ORDER BY startDate");
        $data = [
            "projectID" => $projectID
        ];
        $listSprints->execute($data);

        return $listSprints->fetchAll();
    }
?>
