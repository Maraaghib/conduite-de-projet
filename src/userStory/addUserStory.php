<?php
try {
    $cdpDb = new PDO(
        'mysql:host=database;port=3306;dbname=Cdp2018;charset=utf8',
        'root',
        'pass'
    );
    $cdpDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) {
    die('Erreur : ' . $ex->getMessage());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["idUserStory"];
    if (!isIdUnique($id, $cdpDb)) {
        $idNotUnique = "L'id " . $id . " existe déjà";
    } else {
        $projectName = "Projet";
        $id = $_POST["idUserStory"];
        $desc = htmlspecialchars($_POST["descUserStory"]);
        $prio = $_POST["prioUserStory"];
        if ($prio == null) {
            $prio = 'NULL';
        }
        $diff = $_POST["diffUserStory"];
        $userStory = "INSERT INTO backlog(projectName, id, description, priority,
        difficulty)
        VALUES (\"$projectName\", $id, \"$desc\", $prio, $diff)";
        $cdpDb->exec($userStory);
        header('location: listBacklog.php');
    }
}
function isIdUnique($id, $db)
{
    $rep = $db->query('SELECT id FROM backlog');
    while ($dbId = $rep->fetch()["id"]) {
        if ($id === $dbId) {
            $rep->closeCursor();
            return false;
        }
    }
    $rep->closeCursor();
    return true;
}
?>
<!DOCTYPE html>
<html>

<head lang="fr">
    <meta charset="utf-8" />
    <title>Ajout de user story</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <form method="post" action="addUserStory.php">
        <p>
            Veuillez entrer les informations de votre user story</br>
            (les champs précédé d'un * sont obligatoire):</br>
        </p>
        <div><?php echo $idNotUnique; ?></div>
        Id: * <input type="number" name="idUserStory" min=0 placeholder="Id unique"
            required /></br>
        Description: * <textarea name="descUserStory" cols="40" rows="5"
            required></textarea></br>
        Difficulté: * <select name="diffUserStory">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="5">5</option>
            <option value="8">8</option>
            <option value="13">13</option>
            </select></br>
        Priorité: <input type="number" name="prioUserStory" min=1 /></br>
        <input type="submit" value="Valider" /><a href="index.php">annuler</a>
    </form>
</body>
</html>
