<?php
    require_once('../data/Database.php');

    function testProjectName($projectName)
    {
        return is_string($projectName) && $projectName !== "";
    }

    function isIdUnique($id, $db, $projectName)
    {
        $rep = $db->query("SELECT id FROM backlog WHERE projectName='$projectName'");
        while ($dbId = $rep->fetch()["id"]) {
            if ($id === $dbId) {
                $rep->closeCursor();
                return false;
            }
        }
        $rep->closeCursor();
        return true;
    }

    function getBackLog($projectName) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("SELECT * FROM backlog WHERE projectName = '$projectName' ORDER BY id");
        $stmt->execute();

        $backlog = $stmt->fetchAll();

        return $backlog;
    }
?>
