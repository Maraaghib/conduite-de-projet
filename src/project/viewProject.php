<?php
    require_once('../data/Project.php');
    require_once('../userStory/userStory.php');

    $instance = new Project;
    // @TODO Test if the project with this name EXISTS
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["projectName"])) {
        $projectName = htmlspecialchars($_GET["projectName"]);

        $project = $instance->getProject($projectName);
        $backlog = getBackLog($projectName);
    }
    else {
        header("Location: /project/listProjects.php");
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
        <link type="text/css" rel="stylesheet" href="/css/materialize.css"  media="screen,projection"/>
        <link rel="stylesheet" href="/css/styles.css">

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title><?php echo $project['name']; ?></title>

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <?php
            $activeMenu2 = "class=\"active\"";
            require_once $_SERVER['DOCUMENT_ROOT'].'/headerUserStory.php';
        ?>
        <main>
            <div class="row" style="margin: 20px;">
                <div class="col s12">
                    <div>
                        <?php
                        if (empty($project)) {
                            echo "<h1>Ce projet n'existe pas !</h1>";
                        }
                        else {

                        ?>
                        <h3><?php echo $project['name']; ?></h3>
                        <div class="row">
                            <ul class="tabs">
                                <li class="tab col s2"><a class="active" href="#tab-swipe-1">Description</a></li>
                                <li class="tab col s2"><a href="#tab-swipe-2">Backlog</a></li>
                                <li class="tab col s2"><a href="#tab-swipe-3">Sprints</a></li>
                                <li class="tab col s2"><a href="#tab-swipe-4">Burndown chart</a></li>
                                <li class="tab col s2"><a href="#tab-swipe-5">Contributeurs</a></li>
                                <li class="tab col s2"><a href="#tab-swipe-6">Paramètres</a></li>
                            </ul>
                            <div id="tab-swipe-1" class="col s12 transp-blue">
                                <div class="container">
                                    <div class="row" style="margin: 10px;">
                                        <div class="col s12">
                                            <h4>Description</h4>
                                            <p style="margin-bottom: 50px;">
                                                <?php echo $project['description']; ?>
                                            </p>
                                        </div>
                                        <div class="col s12">
                                            <div class="chip">
                                                <img src="/img/avatar.png" alt="Propriétaire du projet" title="Propriétaire du projet">
                                                Hamza SEYE
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
                                        <table class="responsive-table striped">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Description</th>
                                                    <th>Priorité</th>
                                                    <th>Difficulté</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($backlog as list($pn, $id, $desc, $prio, $diff)) {
                                                    echo "<tr> <td>$id</td> <td>$desc</td> <td>$prio</td> <td>$diff</td> <td>";
                                                ?>
                                                <button class="btn waves-effect waves-light" onclick="openForm(<?php echo $id ?>)"><i class="material-icons">delete</i></button>
                                                <form id="askConfirm<?php echo $id?>" class="form-popup" action="/userStory/removeUserStory.php" method="post">
                                                    <input type="hidden" name="projectName" value=<?php echo $_GET["projectName"] ?>>
                                                    <input type="hidden" name="idUserStory" value=<?php echo  $id?>>
                                                    <div class="card">
                                                        <div class="card-content row">
                                                            <span class="card-title">
                                                                Suppression
                                                            </span>
                                                        <div class="row">Est-tu sur de vouloir supprimer l'User Story <?php echo $id ?></div>
                                                        <button class="btn waves-effect waves-light" type="submit">
                                                        Valider
                                                        <i class="material-icons left">check_circle</i>
                                                        </button>
                                                        <button type="button" name="cancel" class="btn waves-effect waves-light" onclick="closeForm(<?php echo $id ?>)">
                                                        Annuler
                                                        <i class="material-icons left">cancel</i>
                                                        </button>
                                                    </div>
                                                </form>
                                                <?php
                                                echo "</td> </tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-swipe-3" class="col s12 transp-green">
                                <div class="row" style="margin: 10px;">
                                    <div class="s12">
                                        <h4>Sprints</h4>
                                        <p>
                                            <h4>La durée des sprint est de: <?php echo $project['sprintDuration']; ?></h4>
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt umtest labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
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
                                <div class="row" style="margin: 10px;">
                                    <div class="s12">
                                        <h4>Contributeurs</h4>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt umtest labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt umtest labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-swipe-6" class="col s12 transp-orange">
                                <div class="row" style="margin: 10px;">
                                    <div class="s12">
                                        <h4>Paramètres</h4>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt umtest labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt umtest labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } // End Else ?>
                    </div>
                </div>
            </div>
        </main>

        <!--JavaScript at end of body for optimized loading-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="/js/materialize.min.js"></script>
        <script type="text/javascript" src="/js/scripts.js"></script>
        <script>
            function openForm(id) {
                document.getElementById("askConfirm" + id).style.display = "block";
            }

            function closeForm(id) {
                document.getElementById("askConfirm" + id).style.display = "none";
            }
        </script>
    </body>
</html>
