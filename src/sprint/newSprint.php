<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/session.php');
require_once('../data/Project.php');
require_once('../userStory/userStory.php');
require_once('../date.php');

$project = new Project;
$db = Database::getDBConnection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (!isset($_GET[PROJECT_NAME_ARG])) {
    header(ERROR_URL);
} elseif (isset($_GET[PROJECT_NAME_ARG])) {
    $projectName = htmlspecialchars($_GET[PROJECT_NAME_ARG]);
    if (!$project->isProjectExist($projectName)) {
        header(ERROR_URL);
    }
}
$projectInfo = $project->getProject($projectName);
$backlog = getBacklog($projectName);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sqlDate  = convertDate(htmlspecialchars($_POST["startDate"]));
    if (isPastDate($sqlDate)) {
        $invalidDate = "Vous ne pouvez pas choisir une date passée";
    } elseif (!isValidDate($sqlDate, $projectName, $projectInfo)) {
        $invalidDate = "La date chevauche celle d'un autre sprint";
    } else {
        $newSprint = $db->prepare(
            "INSERT INTO sprint SET projectName=:projectName, startDate=:startDate"
        );
        $data = [
            "projectName" => $projectName,
            "startDate" => $sqlDate
        ];
        $newSprint->execute($data);
        // Get the id of the last inserted sprint
        $req = $db->prepare("SELECT max(id) FROM sprint");
        $req->execute();
        $idSprint = $req->fetchColumn();
        // Update idSprint in backlog
        $listUserStory = $_POST["listUserStory"];
        $numberUserStory = count($listUserStory);
        for ($i = 0; $i < $numberUserStory; $i++) {
            $idUserStory = $listUserStory[$i];
            if (!isUserStoryExist($idUserStory, $projectName)) {
                header(ERROR_URL);
            }
            $updateBacklog = $db->prepare("UPDATE backlog SET idSprint=:idSprint WHERE id=:idUserStory AND projectName=:projectName");
            $data = [
                "idSprint" => $idSprint,
                "idUserStory" => $idUserStory,
                "projectName" => $projectName
            ];
            $updateBacklog->execute($data);
        }
        header("location: /project/viewProject.php?projectName=$projectName#tab-swipe-3");
    }

} elseif ($_SERVER["REQUEST_METHOD"] != "GET") {
    header(ERROR_URL);
}
?>
<!DOCTYPE html>
<html>

<head lang="fr">
    <meta charset="utf-8" />
    <title>Créaton d'un sprint</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" media="screen,projection"/>
    <link rel="stylesheet" href="/css/styles.css">
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
                        <form class="col s12" method="post" action="newSprint.php?projectName=<?php echo $_GET[PROJECT_NAME_ARG] ?>">
                            <h5 style="text-align: center;">Créer un nouveau Sprint</h5>
                            <div class="row">
                                <p>
                                    Veuillez entrer les informations de votre sprint</br>
                                    (les champs précédé d'un * sont obligatoire):</br>
                                </p>
                            </div>
                            <div class="row">
                                <?php echo $invalidDate ?>
                                <div class="input-field col s12">
                                    <input id="pickadate" class="datepicker" type="text" name="startDate" required />
                                    <label>Date de début *</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <select class="mdb-select md-form" name="listUserStory[]" multiple required>
                                        <?php
                                        foreach ($backlog as list($pn, $id, $desc, $prio, $diff)) {
                                        ?>
                                        <option value="<?php echo $id ?>"><?php echo $id ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label for="listUserStory[]">User Stories *</label>
                                    <span class="helper-text" data-error="Vous devez choisir un ou des User Stories" data-success="Saisie correcte"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6">
                                    <button type="submit" name="newUserStory" class="btn waves-effect waves-light">
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
