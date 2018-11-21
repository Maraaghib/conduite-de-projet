<?php
require_once('../data/Project.php');
require_once('userStory.php');
$project = new Project;

$db = Database::getDBConnection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["projectName"]) && testProjectName($_GET["projectName"])) {
    $projectName = htmlspecialchars($_GET["projectName"]);
    if (!$project->isProjectExist($projectName)) {
        header(ERROR_URL);
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["projectName"]) && testProjectName($_GET["projectName"])) {
    $projectName = htmlspecialchars($_GET["projectName"]);
    if (!$project->isProjectExist($projectName)) {
        header(ERROR_URL);
    }
    $id = $_POST["idUserStory"];
    if (!isIdUnique($id, $db, $projectName)) {
        $idNotUnique = "L'id " . $id . " existe déjà";
    } else {
        $id = $_POST["idUserStory"];
        $desc = htmlspecialchars($_POST["descUserStory"]);
        $prio = $_POST["prioUserStory"];
        $diff = $_POST["diffUserStory"];
        if ($prio == null) {
            $sql = "INSERT INTO backlog SET
                projectName = :projectName,
                id = :id,
                description = :description,
                difficulty = :difficulty";
            $data = [
                'projectName' => $projectName,
                'id' => $id,
                'description' => $desc,
                'difficulty' => $diff
            ];
        } else {
            $sql = "INSERT INTO backlog SET
                projectName = :projectName,
                id = :id,
                description = :description,
                priority = :priority,
                difficulty = :difficulty";
            $data = [
                'projectName' => $projectName,
                'id' => $id,
                'description' => $desc,
                'priority' => $prio,
                'difficulty' => $diff
            ];
        }
        $addUserStory = $db->prepare($sql);
        $addUserStory->execute($data);
        header("location: /project/viewProject.php?projectName=$projectName#tab-swipe-2");
    }
} else {
    header(ERROR_URL);
}
?>
<!DOCTYPE html>
<html>

<head lang="fr">
    <meta charset="utf-8" />
    <title>Ajout de user story</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.css" media="screen,projection" />
    <link rel="stylesheet" href="/css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" media="screen,projection"/>
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
                        <form class="col s12" method="post" action="addUserStory.php?projectName=<?php echo $_GET["projectName"] ?>">
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
                                    <label for="prioUserStory">Priorité *</label>
                                    <input class="validate" type="number" name="prioUserStory" min=1 max=3 />
                                    <span class="helper-text" data-error="Entrez un nombre entre 1 et 3" data-success="Saisie correcte">1=Haut,
                                        2=Moyen et 3=Bas</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6">
                                    <button type="submit" name="newUserStory" class="btn waves-effect waves-light">
                                        Créer
                                        <i class="material-icons left">check_circle</i>
                                    </button>
                                </div>
                                <div class="col s6">
                                    <button type="button" name="cancel" class="btn waves-effect waves-light" onclick="window.history.back()">
                                        Annuler
                                        <i class="material-icons left">cancel</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!--JavaScript at end of body for optimized loading-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js" defer></script>
    <script type="text/javascript" src="/js/scripts.js"></script>
</body>

</html>
