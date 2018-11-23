<?php
require_once('../data/Project.php');
require_once('task.php');
$project = new Project;

$db = Database::getDBConnection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["projectName"]) && testProjectName($_GET["projectName"]) && isset($_GET["idSprint"])) {
    $projectName = htmlspecialchars($_GET["projectName"]);
    $idSprint = htmlspecialchars($_GET["idSprint"]);
    if (!isSprintExist($projectName, $idSprint) || !$project->isProjectExist($projectName) ) {
        header(ERROR_URL);
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["projectName"]) && testProjectName($_GET["projectName"]) && isset($_GET["idSprint"])) {
    $projectName = htmlspecialchars($_GET["projectName"]);
    $idSprint = htmlspecialchars($_GET["idSprint"]);
    if (!isSprintExist($projectName, $idSprint) || !$project->isProjectExist($projectName)) {
        header(ERROR_URL);
    }
    $idTask = $_POST["idTask"];
    if (!isIdUniqueTask($idTask, $idSprint, $db, $projectName)) {
        $idNotUnique = "L'id " . $idTask . " existe déjà";
    } else {
        $idAI = $_POST["idAI"];
        $desc = htmlspecialchars($_POST["descTask"]);
        $ett = $_POST["estimatedTimeTask"];
        $prog = $_POST["progressTask"];
        $affto = $_POST["affectedToTask"];
            $sql = "INSERT INTO task SET
                idSprint = :idSprint,
                idTask = :idTask,
                description = :description,
                estimatedTime = :estimatedTime,
                progress = :progress,
                affectedTo = :affectedTo";
            $data = [
                'idSprint' => $idSprint,
                'idTask' => $idTask,
                'description' => $desc,
                'estimatedTime' => $ett,
                'progress' => $prog,
                'affectedTo' => $affto
            ];
        $addTask = $db->prepare($sql);
        $addTask->execute($data);
        header("location: /task/listTasks.php");
    }
} else {
    header(ERROR_URL);
}
?>
<!DOCTYPE html>
<html>

<head lang="fr">
    <meta charset="utf-8" />
    <title>Ajout de tâche</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" media="screen,projection"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js" defer></script>
    <script type="text/javascript" src="/js/scripts.js" defer></script>
</head>

<body>
    <?php
        require_once $_SERVER['DOCUMENT_ROOT'].'/header.php';
    ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col s12 m8 offset-m2">
                    <div id="grid-container" class="section scrollspy">
                        <form class="col s12" method="post" action="addTask.php?projectName=<?php echo $_GET["projectName"] ?>&idSprint=<?php echo $_GET["idSprint"] ?>">
                            <h5 style="text-align: center;">Créer une nouvelle tâche </h5>
                            <div class="row">
                                <p>
                                    Veuillez entrer les informations de votre tâche</br>
                                    (les champs précédé d'un * sont obligatoire):</br>
                                </p>
                            </div>
                            <div class="row">
                                <?php echo $idNotUnique; ?>
                                <div class="input-field col s12">
                                    <label for="idTask">Id tâche *</label>
                                    <textarea class="materialize-textarea" name="idTask" maxlength="30" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="descTask">Description *</label>
                                    <textarea class="materialize-textarea" name="descTask" maxlength="10000" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <label for="estimatedTimeTask">Temps estimé *</label>
                                    <input class="validate" type="number" name="estimatedTimeTask" step=0.01 required />
                                    <span class="helper-text" data-error="Entrez un nombre" data-success="Saisie correcte"></span>
                                </div>
                                <div class="input-field col s12">
                                    <label for="progressTask">Progrès </label>
                                    <textarea class="materialize-textarea" name="progressTask" maxlength="30">todo</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="affectedToTask">Utilisateur affectée</label>
                                    <input type="hidden" name="affectedToTask" value="0"></input>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6">
                                    <button type="submit" name="newTask" class="btn waves-effect waves-light">
                                        Créer
                                        <i class="material-icons left" aria-hidden="true">check_circle</i>
                                    </button>
                                </div>
                                <div class="col s6">
                                    <button type="button" name="cancel" class="btn waves-effect waves-light" onclick="window.history.back()">
                                        Annuler
                                        <i class="material-icons left" aria-hidden="true">cancel</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
