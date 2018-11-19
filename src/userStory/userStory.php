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

    function getBackLog($projectName) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("SELECT * FROM backlog WHERE projectName=:projectName   ORDER BY id");
        $data = [
            "projectName" => $projectName
        ];
        $stmt->execute($data);

        $backlog = $stmt->fetchAll();

        return $backlog;
    }
?>
