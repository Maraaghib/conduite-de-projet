<?php 
require_once('../data/Project.php');
require_once('../userStory/userStory.php');
$project = new Project;
$db = Database::getDBConnection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (!isset($_GET["projectName"])) {
    header('location: /userStory/error.php');
} elseif (isset($_GET["projectName"])) {
    $projectName = htmlspecialchars($_GET["projectName"]);
    if (!$project->isProjectExist($projectName)) {
        header('location: /userStory/error.php');
    }
}
$projectInfo = $project->getProject($projectName);
$backlog = getBackLog($projectName);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $listUserStory = $_POST["listUserStory"];
    $numberUserStory = count($listUserStory);
    for ($i = 0; $i < $numberUserStory; $i++) {
        if (!isUserStoryExist($listUserStory[$i], $projectName)) {
            header('location: /userStory/error.php');
        }
    }
    $startDate = htmlspecialchars($_POST["startDate"]);

    $parts = explode('/', $startDate);
    $sqlDate  = "$parts[2]-$parts[1]-$parts[0]";
    if (!isValidDate($sqlDate, $projectName, $projectInfo)) {
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
        header("location: /project/viewProject.php?projectName=$projectName#tab-swipe-3");
    }
    
} elseif ($_SERVER["REQUEST_METHOD"] != "GET") {
    header('location: /userStory/error.php');
} 

function isValidDate($date, $projectName, $project) {
    $db = Database::getDBConnection();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sprintDuration = $project["sprintDuration"];
    $listSprintStartDate = $db->prepare("SELECT count(*) FROM sprint WHERE ABS(DATEDIFF(startDate, :date))<=:sprintDuration");
    $data = [
        "date" => $date,
        "sprintDuration" => $sprintDuration
    ];
    $listSprintStartDate->execute($data);
    $nb = $listSprintStartDate->fetchColumn();
    return $nb == 0;  
}
?>
<!DOCTYPE html>
<html>

<head lang="fr">
    <meta charset="utf-8" />
    <title>Créaton d'un sprint</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.css" media="screen,projection" />
    <link rel="stylesheet" href="/css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" defer></script>
    <script type="text/javascript" src="/js/materialize.min.js" defer></script>
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
                        <form class="col s12" method="post" action="newSprint.php?projectName=<?php echo $_GET["projectName"] ?>">
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
                                    <label for="listUserStory[]">User Stories</label>     
                                    <span class="helper-text" data-error="Vous devez choisir un ou des User Stories" data-success="Saisie correcte"></span>
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
    <script type="text/javascript" src="/js/materialize.min.js"></script>
    <script type="text/javascript" src="/js/scripts.js"></script>
</body>

</html>
