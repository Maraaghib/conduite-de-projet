<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/session.php');
    require_once('../data/Project.php');
    $project = new Project;
    $errorMessage = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['createProject'])) {
        $projectName = $_POST['projectName'];
        $description = $_POST['projectDescription'];
        $sprintDuration = (int) $_POST['sprintDuration'];
        $timeUnit = $_POST['timeUnit'];
        $dateProject = date('Y-m-d');

        if ($project->isProjectExist($projectName)) {
            $errorMessage = 'Le projet <strong>'.$projectName.'</strong> existe déjà pour ce compte !';
?>
            <style>
                /* label focus color */
                .input-field #projectName:focus + label, #helper-text {
                    color: red !important;
                }

                /* label underline focus color */
                .row .input-field #projectName:focus {
                    border-bottom: 1px solid red !important;
                    box-shadow: 0 1px 0 0 red !important
                }
            </style>
<?php
        }
        else {
            $project = Project::newProject($projectName, $description, $sprintDuration, $dateProject, $timeUnit); // Crée une nouvelle instance de Project avec des paramètres

            $project->createProject();
        }
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js" defer></script>
        <script type="text/javascript" src="/js/scripts.js" defer></script>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Nouveau Projet</title>

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <?php
            $activeMenu2 = "class=\"active\"";
            require_once $_SERVER['DOCUMENT_ROOT'].'/header.php';
        ?>
        <main>
            <div class="row">

                <div class="container">
                    <div class="row">
                        <div class="col s12 m8 offset-m2">
                            <div>
                                <div id="grid-container" class="section scrollspy">
                                    <div class="row">
                                        <form class="col s12" action="" method="post">
                                            <h5 style="text-align: center;">Créer un nouveau projet</h5>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="projectName" name="projectName" type="text" value="<?php echo $projectName; ?>" class="validate" data-length="50" required autofocus onfocusout="removeHelperText()">
                                                    <label for="projectName">Nom</label>
                                                    <span id="helper-text" class="helper-text" data-error="Le nom de votre projet est obligatoire et ne peut pas excéder 50 caractères" data-success="Saisie correcte">
                                                        <?php echo $errorMessage; ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <textarea id="projectDescription" name="projectDescription" class="materialize-textarea"><?php echo $description; ?></textarea>
                                                    <label for="projectDescription">Description</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input id="sprintDuration" name="sprintDuration" type="number" value="<?php echo $sprintDuration; ?>" min=1 class="validate" required>
                                                    <label for="sprintDuration">Durée des sprints</label>
                                                    <span class="helper-text" data-error="La durée des sprints est obligatoire et doit être supérieure ou égale à 1" data-success="Saisie correcte"></span>
                                                </div>
                                                <div class="input-field col s6">
                                                    <select id="timeUnit" name="timeUnit" required>
                                                        <option value="1">Jours</option>
                                                        <option value="2" selected>Semaines</option>
                                                        <option value="3">Mois</option>
                                                    </select>
                                                    <label>Unité de temps</label>
                                                    <span class="helper-text" data-error="Vous devez choisir une unité" data-success="Saisie correcte"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <button type="submit" name="createProject" class="btn waves-effect waves-light">
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
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
