<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/session.php');
require_once('../data/Project.php');
require_once('userStory.php');
$project = new Project;

$db = Database::getDBConnection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET[PROJECT_NAME_ARG]) && testProjectName($_GET[PROJECT_NAME_ARG])) {
    $projectName = htmlspecialchars($_GET[PROJECT_NAME_ARG]);
    if (!$project->isProjectExist($projectName)) {
        redirect(ERROR_URL);
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET[PROJECT_NAME_ARG]) && testProjectName($_GET[PROJECT_NAME_ARG])) {
    $projectName = htmlspecialchars($_GET[PROJECT_NAME_ARG]);
    if (!$project->isProjectExist($projectName)) {
        redirect(ERROR_URL);
    }
    $author = $_SESSION['email'];
    $projectID = $project->getProjectID($author, $projectName);
    $id = $_POST["idUserStory"];
    if (!isIdUnique($id, $db, $projectID)) {
        $idNotUnique = "L'id " . $id . " existe déjà";
    } else {
        $id = $_POST["idUserStory"];
        $desc = htmlspecialchars($_POST["descUserStory"]);
        $prio = $_POST["prioUserStory"];
        $diff = $_POST["diffUserStory"];
        if ($prio == null) {
            $sql = "INSERT INTO backlog SET
                projectID = :projectID,
                id = :id,
                description = :description,
                difficulty = :difficulty";
            $data = [
                'projectID' => $projectID,
                'id' => $id,
                'description' => $desc,
                'difficulty' => $diff
            ];
        } else {
            $sql = "INSERT INTO backlog SET
                projectID = :projectID,
                id = :id,
                description = :description,
                priority = :priority,
                difficulty = :difficulty";
            $data = [
                'projectID' => $projectID,
                'id' => $id,
                'description' => $desc,
                'priority' => $prio,
                'difficulty' => $diff
            ];
        }
        $addUserStory = $db->prepare($sql);
        $addUserStory->execute($data);
        redirect("/project/viewProject.php?projectName=$projectName#tab-swipe-2");
    }
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
    <?php
        require_once $_SERVER['DOCUMENT_ROOT'].'/header.php';
    ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col s12 m8 offset-m2">
                    <div id="grid-container" class="section scrollspy">
                        <form class="col s12" method="post" action="addUserStory.php?projectName=<?php echo $_GET[PROJECT_NAME_ARG] ?>">
                            <h5 style="text-align: center;">Créer une nouvelle User Story </h5>
                            <div class="row">
                                <p>
                                    Veuillez entrer les informations de votre user story</br>
                                    (les champs précédé d'un * sont obligatoire):</br>
                                </p>
                            </div>
                            <div class="row">
                                <?php echo $idNotUnique; ?>
                                <div class="input-field col s12">
                                    <label for="idUserStory">Id *</label>
                                    <input class="validate" type="number" name="idUserStory" min=0 required />
                                    <span class="helper-text" data-error="Entrez un nombre" data-success="Saisie correcte">Id unique</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="descUserStory">Description *</label>
                                    <textarea class="materialize-textarea" name="descUserStory" maxlength="10000" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <label for="diffUserStory">Difficulté *</label>
                                    <input class="validate" type="number" name="diffUserStory" min=1 required />
                                    <span class="helper-text" data-error="Entrez un nombre" data-success="Saisie correcte"></span>
                                </div>
                                <div class="input-field col s6">
                                    <label for="prioUserStory">Priorité</label>
                                    <input class="validate" type="number" name="prioUserStory" min=1 max=3 />
                                    <span class="helper-text" data-error="Entrez un nombre entre 1 et 3" data-success="Saisie correcte">1=Haut,
                                        2=Moyen et 3=Bas</span>
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
