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

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["projectName"]) && testProjectName($_GET["projectName"])) {
    $projectName = htmlspecialchars($_GET["projectName"]);
    $rep = $cdpDb->query("SELECT * FROM backlog WHERE projectName = '$projectName'");
} else {
    header('location: /userStory/error.php');
}
function testProjectName($projectName)
{
    return is_string($projectName) && $projectName!=="";
}
?>

<!DOCTYPE html>
<html>

<head lang="fr">
    <meta charset="utf-8" />
    <title>Affichage Backlog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.css" media="screen,projection" />
    <link rel="stylesheet" href="/css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" defer></script>
    <script type="text/javascript" src="/js/materialize.min.js" defer></script>
</head>

<body>
    <?php
        $activeMenu3 = "class=\"active\"";
        include_once($_SERVER['DOCUMENT_ROOT'].'/header.php');
    ?>
    <main>
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <h3>Le backlog</h3>
                        <table class="responsive-table striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>description</th>
                                    <th>priorité</th>
                                    <th>difficulté</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($rep as list($pn, $id, $desc, $prio, $diff)) {
                                        echo "<tr> <td>$id</td> <td>$desc</td> <td>$prio</td> <td>$diff</td> </tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!--JavaScript at end of body for optimized loading-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/materialize.min.js"></script>
    <script type="text/javascript" src="/js/scripts.js"></script>
</body>
