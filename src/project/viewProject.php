<?php
    require_once('../data/Project.php');
    $instance = new Project;
    // @TODO Test if the project with this name EXISTS
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["projectName"])) {
        $name = htmlspecialchars($_GET["projectName"]);

        $project = $instance->getProject($name);
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
            require_once $_SERVER['DOCUMENT_ROOT'].'/header.php';
        ?>
        <main>
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col s12">
                            <div>
                                <div id="grid-container" class="section scrollspy">
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
                                            <h4>Description</h4>
                                            <p>
                                                <?php echo $project['description']; ?>
                                            </p>
                                            <div class="row">
                                                <div class="col s6">
                                                    <span class="new badge" data-badge-caption="Hamza SEYE">Propriétaire:</span>
                                                </div>
                                                <div class="col s6">
                                                    <span class="new badge" data-badge-caption="'<?php echo $project['dateProject']; ?>'">Créé le:</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="tab-swipe-2" class="col s12 transp-red">
                                            <h4>Backlog</h4>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt umtest labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </p>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt umtest labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </p>
                                        </div>
                                        <div id="tab-swipe-3" class="col s12 transp-green">
                                            <h4>Sprints</h4>
                                            <p>
                                                <h4>La durée des sprint est de: <?php echo $project['sprintDuration']; ?></h4>
                                            </p>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt umtest labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </p>
                                        </div>
                                        <div id="tab-swipe-4" class="col s12 transp-yellow">
                                            <h4>Burndown chart</h4>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt umtest labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </p>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt umtest labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </p>
                                        </div>
                                        <div id="tab-swipe-5" class="col s12 transp-cyan">
                                            <h4>Contributeurs</h4>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt umtest labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </p>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt umtest labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </p>
                                        </div>
                                        <div id="tab-swipe-6" class="col s12 transp-orange">
                                            <h4>Paramètres</h4>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt umtest labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </p>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt umtest labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </p>
                                        </div>
                                    </div>
                                <?php } // End Else ?>
                                </div>
                            </div>
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
