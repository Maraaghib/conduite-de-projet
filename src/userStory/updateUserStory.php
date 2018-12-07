<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/session.php');
require_once('userStory.php');
require_once('../data/Project.php');
require_once('userStory.php');

define("ID_US_ARG_URI", "idUserStory");

$project = new Project;

$cdpDb = Database::getDBConnection();
$cdpDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET[PROJECT_NAME_ARG]) && isset($_GET[ID_US_ARG_URI]) && testProjectName($_GET[PROJECT_NAME_ARG]) && !empty($_GET[ID_US_ARG_URI])) {
    $projectName = htmlspecialchars($_GET[PROJECT_NAME_ARG]);
    $author = $_SESSION['email'];
    $projectID = $project->getProjectID($author, $projectName);
    if (!$project->isProjectExist($projectName)) {
        redirect(ERROR_URL);
    }
    $id = htmlspecialchars($_GET[ID_US_ARG_URI]);
    if (!is_numeric($id) && !isUserStoryExist($id, $projectID)) {
        redirect(ERROR_URL);
    }
    $selectUserStory = "SELECT description, difficulty, priority FROM backlog WHERE projectID=:projectID AND id=:id";
    $toFetch = $cdpDb->prepare($selectUserStory);
    $data = [
        "projectID" => $projectID,
        "id" => $id
    ];
    $toFetch->execute($data);
    $gres = $toFetch->fetch(PDO::FETCH_ASSOC);
    $gdesc = $gres["description"];
    $gdiff = $gres["difficulty"];
    $gprio = $gres["priority"];

} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $projectName = htmlspecialchars($_GET[PROJECT_NAME_ARG]);
    $author = $_SESSION['email'];
    $projectID = $project->getProjectID($author, $projectName);
    if (!$project->isProjectExist($projectName)) {
        redirect(ERROR_URL);
    }
    $id = htmlspecialchars($_POST[ID_US_ARG_URI]);
    $desc = htmlspecialchars($_POST["descUserStory"]);
    $diff = $_POST["diffUserStory"];
    $prio = $_POST["prioUserStory"];
    if ($prio == null) {
        $sql = "UPDATE backlog SET
            description = :description,
            difficulty = :difficulty
            WHERE projectID = $projectID AND id = $id";
        $data = [
            'description' => $desc,
            'difficulty' => $diff
        ];
    } else {
        $sql = "UPDATE backlog SET
            description = :description,
            priority = :priority,
            difficulty = :difficulty
            WHERE projectID = $projectID AND id = $id";
        $data = [
            'description' => $desc,
            'priority' => $prio,
            'difficulty' => $diff
        ];
    }
    $updateUserStory = $cdpDb->prepare($sql);
    $updateUserStory->execute($data);
    redirect("/project/viewProject.php?projectName=$projectName#tab-swipe-2");
} else {
    redirect(ERROR_URL);
}

?>


<!DOCTYPE html>
<html>

<head lang="fr">
    <meta charset="utf-8" />
    <title>Ajout de user story</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" media="screen,projection"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js" defer></script>
    <script type="text/javascript" src="/js/scripts.js" defer></script>
</head>

<body>
    <?php include($_SERVER['DOCUMENT_ROOT']."/header.php") ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col s12 m8 offset-m2">
                    <div id="grid-container" class="section scrollspy">
                        <form class="col s12" method="post" action="updateUserStory.php?projectName=<?php echo $_GET[PROJECT_NAME_ARG] ?>">
                          <input type="hidden" name="projectName" value=<?php echo $_GET[PROJECT_NAME_ARG] ?>>
                          <input type="hidden" name="idUserStory" value=<?php echo  $id; ?>>
                            <h5 style="text-align: center;">Modifier une User Story </h5>
                            <div class="row">
                                <p>
                                    Veuillez entrer les informations de votre user story</br>
                                    (les champs précédé d'un * sont obligatoire):</br>
                                </p>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="idUserStory">Id *</label>
                                    <input class="validate" type="number" name="idUserStory" min=0 value="<?php echo $id; ?>" disabled />
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="descUserStory">Description *</label>
                                    <textarea class="materialize-textarea" name="descUserStory" maxlength="500" data-length="500" required><?php echo $gdesc; ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <label for="diffUserStory">Difficulté *</label>
                                    <input class="validate" type="number" name="diffUserStory" min=1 required value="<?php echo $gdiff; ?>" required/>
                                    <span class="helper-text" data-error="Entrez un nombre" data-success="right"></span>
                                </div>
                                <div class="input-field col s6">
                                    <label for="prioUserStory">Priorité *</label>
                                    <input class="validate" type="number" name="prioUserStory" min=1 max=3 value="<?php echo $gprio; ?>"/>
                                    <span class="helper-text" data-error="Entrez un nombre entre 1 et 3" data-success="right">1=Haut,
                                        2=Moyen et 3=Bas</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6">
                                    <button type="submit" name="updateUserStory" class="btn waves-effect waves-light">
                                        Modifier
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
