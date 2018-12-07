<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/session.php');
redirectIfNotConnected();
require_once('../data/Project.php');
require_once('../userStory/userStory.php');
require_once('task.php');
require_once('../user/user.php');
define ("ID_SPRINT_ARG_URI", "idSprint");
$project = new Project;

$db = Database::getDBConnection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET[PROJECT_NAME_ARG]) && testProjectName($_GET[PROJECT_NAME_ARG]) && isset($_GET[ID_SPRINT_ARG_URI])) {
    $projectName = htmlspecialchars($_GET[PROJECT_NAME_ARG]);
    $projectInfo = $project->getProject($projectName);
    $author = $projectInfo['author'];
    $projectID = $project->getProjectID($author, $projectName);
    $idSprint = htmlspecialchars($_GET[ID_SPRINT_ARG_URI]);
    if (!isSprintExist($projectID, $idSprint) || !$project->isProjectExist($projectName) ) {
        redirect(ERROR_URL);
    }
    $task = getNonPlanTask($idSprint);
    $backlog = getBacklog($projectID);
    $collaborators= getCollaborators($projectID);


} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET[PROJECT_NAME_ARG]) && testProjectName($_GET[PROJECT_NAME_ARG]) && isset($_GET[ID_SPRINT_ARG_URI])) {
    $projectName = htmlspecialchars($_GET[PROJECT_NAME_ARG]);
    $projectInfo = $project->getProject($projectName);
    $author = $projectInfo['author'];
    $projectID = $project->getProjectID($author, $projectName);
    $idSprint = htmlspecialchars($_GET[ID_SPRINT_ARG_URI]);
    if (!isSprintExist($projectID, $idSprint) || !$project->isProjectExist($projectName)) {
        redirect(ERROR_URL);
    }
    $idTask = $_POST["idTask"];
    if (!isIdUniqueTask($idTask, $idSprint, $db, $projectID)) {
        $idNotUnique = "L'id " . $idTask . " existe déjà";
        $task = getNonPlanTask($idSprint);
        $backlog = getBacklog($projectID);
        $collaborators= getCollaborators($projectID);
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

        $sqlDep = $db->prepare("SELECT idAI FROM task WHERE idTask=\"$idTask\" AND idSprint=$idSprint");
        $sqlDep->execute();
        $idAIDep=$sqlDep->fetchColumn();


        if($_POST["listDepTasks"]!=null){
            $sqlInsertDepPart = "INSERT INTO dependence SET
                            id = :id,
                            idTask = :idTask,
                            idSprint = :idSprint";
            $insertDepExec = $db->prepare($sqlInsertDepPart);
           foreach ($_POST["listDepTasks"] as $depTask) {
             $dataInsertDep = [
                              'id' => $idAIDep,
                              'idTask' => $depTask,
                              'idSprint' => $idSprint
             ];
             $insertDepExec->execute($dataInsertDep);
           }
        }

        if($_POST["listLinkedUS"]!=null){
            $backlog = getBacklog($projectID);

            $sqlInsertLinkedUS = "INSERT INTO linkedus SET
                                  idTask = :idTask,
                                  idUS = :idUS";
            $insertLinkedUSExec = $db->prepare($sqlInsertLinkedUS);

           foreach ($_POST["listLinkedUS"] as $linkedUS) {
             foreach ($backlog as list($pi, $id, $desc, $prio, $diff, $idSp, $idai)) {
               if($id==$linkedUS){
                 $sqlLinkedUS = $db->prepare("SELECT idAI FROM backlog WHERE projectID=\"$pi\" AND id=$linkedUS");
                 $sqlLinkedUS->execute();
                 $idAILinkedUS=$sqlLinkedUS->fetchColumn();
                 $dataInsertDep = [
                                  'idTask' => $idAIDep,
                                  'idUS' => $idAILinkedUS
                 ];
                 $insertLinkedUSExec->execute($dataInsertDep);
               }
             }
           }
        }

        redirect("/project/viewProject.php?projectName=$projectName#tab-swipe-3");
    }
} else {
    redirect(ERROR_URL);
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
                        <form class="col s12" method="post" action="addTask.php?projectName=<?php echo $_GET[PROJECT_NAME_ARG] ?>&idSprint=<?php echo $_GET[ID_SPRINT_ARG_URI] ?>">
                            <input type="hidden" name="progressTask" value="todo">
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
                                    <input class="validate" type="number" name="estimatedTimeTask" step=0.01 min=0 required/>
                                    <span class="helper-text" data-error="Durée incorrecte, veuillez rentrer une valeur positive" data-success="Saisie correcte"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <select class="mdb-select md-form" name="listDepTasks[]" multiple>
                                        <?php
                                        foreach ($task as list($taskIdSprint, $taskIdTask, $taskIdAI, $taskDesc, $taskEt, $taskProg, $taskAffTo)) {
                                        ?>
                                        <option value="<?php echo $taskIdTask ?>"><?php echo $taskIdTask ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label for="listDepTasks[]">Liste de dépendances </label>
                                    <span class="helper-text" data-error="Vous pouvez choisir un ou des tâches de dépendances" data-success="Saisie correcte"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <select class="mdb-select md-form" name="listLinkedUS[]" multiple>
                                        <?php
                                        foreach ($backlog as list($pn, $id, $desc, $prio, $diff)) {
                                        ?>
                                        <option value="<?php echo $id ?>"><?php echo $id ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label for="listLinkedUS[]">US liés </label>
                                    <span class="helper-text" data-error="Vous pouvez choisir un ou des US" data-success="Saisie correcte"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <select class="mdb-select md-form" name="affectedToTask" required>
                                        <option value=""></option>
                                        <?php
                                        foreach ($collaborators as $collaborator) {
                                        $user = getUser($collaborator['userEmail']);
                                        ?>
                                        <option value="<?php echo $user['email'] ?>"><?php echo $user['name'] ?></option>
                                        <?php
                                        }
                                        $author = getUser($projectInfo['author']);
                                        ?>
                                        <option value="<?php echo $author['email'] ?>"><?php echo $author['name'] ?></option>
                                    </select>
                                    <label for="affectedToTask">Affectée à *</label>
                                    <span class="helper-text" data-error="Vous devez choisir vous ou un collaborateur" data-success="Utilisateur correcte"></span>
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
