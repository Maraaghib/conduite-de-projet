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
    $projectName = htmlspecialchars($_GET["projectname"]);
    $rep = $cdpDb->query('SELECT * FROM backlog WHERE projectName = \"$projectName\"');
} else {
  header('location: /userStory/error.php');
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
  <table>
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
      	echo "<tr> <td>$id</td> <td>$desc</td> <td>$prio</td> <td>$diff</td> <tr>";
      }
      ?>

    </tbody>
</table>
</body>
