<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/session.php');
    redirectIfNotConnected();
    require_once('../data/Project.php');
    require_once('../userStory/userStory.php');
    include_once('../user/user.php');

    $instance = new Project;
    $errorMessage = '';
    $deleteProjectMessage = "<strong style=\"color: #c37a0d\"><i class=\"material-icons left\">warning</i> La supression est définitive ! Une fois que vous supprimez un projet, vous ne pouvez plus revenir en arrière. S'il vous plaît soyez certain.</strong>";

    /* RETRIEVAL OF PROJECT'S INFOS AND ITS BACKLOG */
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET[PROJECT_NAME_ARG])) {
        $projectName = htmlspecialchars($_GET[PROJECT_NAME_ARG]);
        $project = $instance->getProject($projectName);
        $author = $project['author'];
        $projectID = $instance->getProjectID($author, $projectName);
        $backlog = getBackLog($projectID);
        $listSprints = getListSprints($projectID);
        $sprintDuration = $project['sprintDuration'];

        if (isset($_GET["error"]) && $_GET["error"] === "delete") {
            $deleteProjectMessage = "<strong style=\"color: red\"><i class=\"material-icons left\">warning</i>Le nom de projet que vous avez saisi est incorrect ! Veuillez réessayer avec le bon nom de ce projet.</strong>";
        }
    }

    /* UPDATE OF THE PROJECT'S NAME */
    elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateProjectName'])) {
        $oldProjectName = $_POST['oldProjectName'];
        $newProjectName = $_POST['newProjectName'];

        if ($instance->isProjectExist($newProjectName)) {
            redirect(BASE_URL_VIEW_PROJECT.$oldProjectName.'#tab-swipe-6');
?>
<?php
        }
        else {
            $instance->updateProjectName($oldProjectName, $newProjectName);
            redirect(BASE_URL_VIEW_PROJECT.$newProjectName);
        }
    }

    /* UPDATE OF THE PROJECT'S DESCRIPTION */
    elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateProjectDescription'])) {
        $projectName = $_POST['projectName'];
        $description = $_POST['projectDescription'];
        $instance->updateProjectDescription($projectName, $description);
        redirect(BASE_URL_VIEW_PROJECT.$projectName);
    }

    /* UPDATE OF THE PROJECT'S SPRINTS DURATION */
    elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateSprintDuration'])) {
        $projectName = $_POST['projectName'];
        $sprintDuration = (int) $_POST['sprintDuration'];
        $timeUnitSprint = $_POST['timeUnitSprint'];
        $instance->updateSprintDuration($projectName, $sprintDuration, $timeUnitSprint);
        redirect(BASE_URL_VIEW_PROJECT.$projectName);
    }

    /* DELETE A PROJECT */
    elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteProjectBtn'])) {
        $projectName = $_POST['projectName'];
        $confirmProjectName = $_POST['confirmProjectName'];
        if (strtolower($projectName) === strtolower($confirmProjectName)) {
            $instance->deleteProject($projectName);
            redirect('/project/listProjects.php');
        } else {
            redirect(BASE_URL_VIEW_PROJECT.$projectName.'&error=delete#tab-swipe-6');
        }
    }

    /* UPDATE THE PROGRESS AND SPRINT OF A TASK */
    elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateTaskSprintAndProgress'])) {
        $projectName = $_POST['projectName'];
        $idOldSprintArray = explode(',', $_POST['idOldSprintArray']);
        $idNewSprintArray = explode(',', $_POST['idNewSprintArray']);
        $idTaskArray = explode(',', $_POST['idTaskArray']);
        $progressArray = explode(',', $_POST['progressArray']);

        for ($i=0; $i < count($idTaskArray); $i++) {
            updateTaskSprintAndProgress(intval($idOldSprintArray[$i]), $idTaskArray[$i], intval($idNewSprintArray[$i]), $progressArray[$i]);
        }
        redirect(BASE_URL_VIEW_PROJECT.$projectName.'#tab-swipe-3');
    }

    /* ADD/REMOVE A COLLABORATOR IN/FROM A PROJECT */
    elseif ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST['addCollaborator']) || isset($_POST['removeCollaborator']))) {
        $projectID = $_POST['projectID'];
        $projectName = $_POST['projectName']; // Used only for redirection
        $collabEmail = $_POST['collabEmail'];

        if (isset($_POST['addCollaborator'])) {
            addCollaborator($projectID, $collabEmail);
        }
        if (isset($_POST['removeCollaborator'])) {
            removeCollaborator($projectID, $collabEmail);
        }

        redirect(BASE_URL_VIEW_PROJECT.$projectName.'#tab-swipe-5');
    }

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" media="screen,projection"/>
        <link rel="stylesheet" href="/css/styles.css">
        <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js" defer></script>
        <script type="text/javascript" src="/js/scripts.js" defer></script>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title><?php echo $project['projectName']; ?></title>

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <?php
            $activeMenu3 = "class=\"active\"";
            require_once $_SERVER['DOCUMENT_ROOT'].'/header.php';
        ?>
        <main>
            <div class="row" style="margin: 20px;">
                <div class="col s12">
                    <div>
                        <?php
                        if (empty($project)) {
                            echo "Ce projet n'existe pas !</h1>";
                        }
                        else {

                        ?>
                        <h3><?php echo $project['projectName']; ?></h3>
                        <div class="row">
                            <ul class="tabs">
                                <li class="tab col s2"><a class="active" href="#tab-swipe-1">Description</a></li>
                                <li class="tab col s2"><a href="#tab-swipe-2">Backlog</a></li>
                                <li class="tab col s2"><a href="#tab-swipe-3">Sprints</a></li>
                                <li class="tab col s2"><a href="#tab-swipe-4">Burndown chart</a></li>
                                <li class="tab col s2"><a href="#tab-swipe-5">Collaborateurs</a></li>
                                <li class="tab col s2"><a href="#tab-swipe-6">Paramètres</a></li>
                            </ul>
                            <div id="tab-swipe-1" class="col s12 transp-blue">
                                <div class="container">
                                    <div class="row" style="margin: 10px;">
                                        <div class="col s12">
                                            <h4>Description</h4>
                                            <blockquote style="margin-bottom: 50px;">
                                                <?php echo $project['description']; ?>
                                            </blockquote>
                                        </div>
                                        <div class="col s12">
                                            <div class="chip">
                                                <img src="/img/avatar.png" alt="Propriétaire du projet" title="Propriétaire du projet">
                                                <?php
                                                    $email = $project['author'];
                                                    $author = getUser($email);
                                                    echo $author['name'];
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col s12">
                                            <div class="chip">
                                                <img src="/img/date.png" alt="Date de création" title="Date de création">
                                                <?php echo $project['dateProject']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-swipe-2" class="col s12 transp-red">
                                <div class="row" style="margin: 10px;">
                                    <div class="s12">
                                        <h4>Backlog</h4>
                                        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/userStory/listBacklog.php'; ?>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-swipe-3" class="col s12 transp-green" style="min-width: 1195px;">
                                <div class="row" style="margin: 10px;">
                                    <div class="s12">
                                        <h4>Sprints</h4>
                                        <div class="row">
                                        <p>
                                            <h4>La durée de chaque sprint pour ce projet est de <?php echo $sprintDuration; ?> <?php echo timeUnitSprintToStr($project['timeUnitSprint'])?></h4>
                                        </p>
                                            <?php include_once $_SERVER['DOCUMENT_ROOT'].'/sprint/listSprints.php'; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-swipe-4" class="col s12 transp-yellow">
                                <div class="row" style="margin: 10px;">
                                    <div class="s12">
                                        <h4>Burndown chart</h4>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt umtest labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt umtest labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-swipe-5" class="col s12 transp-cyan">
                                <div class="container">
                                    <div class="row" style="margin: 10px;">
                                        <h4>Collaborateurs</h4>
                                        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/project/collaborators.php'; ?>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-swipe-6" class="col s12 transp-orange">
                                <div class="container">
                                    <h4>Paramètres</h4>
                                    <?php
                                        if (strcmp($project['author'], $_SESSION['email']) !== 0) {
                                            echo "<h5 style='color: red'>Vous n'avez pas le droit d'accès car vous n'êtes pas le propriétaire de ce projet !</h5>";
                                        }
                                        else {
                                            include_once $_SERVER['DOCUMENT_ROOT'].'/project/editProject.php';
                                            include_once $_SERVER['DOCUMENT_ROOT'].'/project/deleteProject.php';
                                        }
                                    ?>
                                </div>
                                </div>
                            </div>
                        </div>
                        <?php } // End Else ?>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
