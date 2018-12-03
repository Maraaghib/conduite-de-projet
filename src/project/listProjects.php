<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/session.php');
    require_once('../data/Project.php');
    require_once('../date.php');
    $project = new Project;
    if (isset($_SESSION['email'])) {
        $user = $_SESSION['email'];
        $projects = $project->listProjects($user);
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
        <title>Liste des Projets</title>

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
        <script type="text/javascript">
            console.log(document.querySelector('.collapsible-header'));
            document.querySelector('.collapsible-header').removeAttribute('href');
            document.querySelector('.collapsible li').removeAttribute('class');
        </script>
        <main>
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col s12">
                            <div>
                                <div id="grid-container" class="section scrollspy">
                                    <h3>Liste de vos projects</h3>
                                    <div class="row">
                                        <?php
                                        if (empty($projects)) {
                                        ?>
                                            <h1>Aucun projet pour l'instant !</h1>
                                            <a href="/project/newProject.php" class="btn waves-effect waves-light"><i class="material-icons left" aria-hidden="true">add</i>Créer un nouveau Projet</a>
                                        <?php
                                        }
                                        else {
                                            foreach ($projects as $project) {
                                            ?>
                                                <div class="col s12 m6 l12 xl4">
                                                <div class="card">
                                                    <div class="card-content">
                                                        <span class="card-title">
                                                            <a href="/project/viewProject.php?projectName=<?php echo $project['projectName']; ?>"><?php echo $project['projectName']; ?></a>
                                                        </span>
                                                        <p class="ellipse-text"><?php echo $project['description']; ?></p>
                                                        <div class="read-more">

                                                        </div>
                                                        <a href="/project/viewProject.php?projectName=<?php echo $project['projectName']; ?>#tab-swipe-6" class="btn-floating halfway-fab waves-effect waves-light" title="Modifier" style="bottom: 36px;"><i class="material-icons" aria-hidden="true">edit</i></a>
                                                    </div>
                                                    <div class="card-reveal">
                                                      <span class="card-title"><a href="#"><?php echo $project['projectName']; ?></a><i class="material-icons right" aria-hidden="true">close</i></span>
                                                      <p><?php echo $project['description']; ?></p>
                                                    </div>
                                                    <div class="card-action">
                                                        <div class="row" style="margin-bottom: 0px;">
                                                            <div class="col s6">
                                                                <span>Hamza SEYE</span>
                                                            </div>
                                                            <div class="col s6">
                                                                <span><?php echo convertDate($project['dateProject']); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                        } ?>
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
