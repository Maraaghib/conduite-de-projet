<?php
    require_once('../data/Project.php');
    $project = new Project;
    $projects = $project->listProjects();

    if (empty($projects)) {
        header('Location: /project/newProject.php');
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
                                                    <a class="btn-floating halfway-fab waves-effect waves-light" style="bottom: 36px;"><i class="material-icons">edit</i></a>
                                                </div>
                                                <div class="card-reveal">
                                                  <span class="card-title"><a href="#"><?php echo $project['projectName']; ?></a><i class="material-icons right">close</i></span>
                                                  <p><?php echo $project['description']; ?></p>
                                                </div>
                                                <div class="card-action">
                                                    <div class="row" style="margin-bottom: 0px;">
                                                        <div class="col s6">
                                                            <span>Hamza SEYE</span>
                                                        </div>
                                                        <div class="col s6">
                                                            <!-- Faire une fonction JavaScript qui cnvertit la date en XX mmm YYYY -->
                                                            <span><?php echo $project['dateProject']; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
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
