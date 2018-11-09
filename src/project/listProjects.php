<?php
    include_once('../data/Project.php');
    $project = new Project;
    $projects = $project->listProjects();
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
        <title>Liste des Projets</title>

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <?php include($_SERVER['DOCUMENT_ROOT']."/header.htm") ?>
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
                                        <div class="col s12 m6 l4">
                                            <div class="card">
                                                <div class="card-content">
                                                    <span class="card-title">
                                                        <a href="#"><?php echo $project['name']; ?></a>
                                                    </span>
                                                    <p><?php echo $project['description']; ?></p>
                                                    <a class="btn-floating halfway-fab waves-effect waves-light" style="bottom: 36px;"><i class="material-icons">edit</i></a>
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
                                        <!-- <div class="col s12 m6 l4">
                                            <div class="card">
                                                <div class="card-content">
                                                    <span class="card-title">
                                                        <a href="#">Programation WEB</a>
                                                    </span>
                                                    <p>Il s'agit de faire un projet Web en utilisant les technologies en cours. Le choix du sujet vous et libre</p>
                                                    <a class="btn-floating halfway-fab waves-effect waves-light" style="bottom: 36px;"><i class="material-icons">edit</i></a>
                                                </div>
                                                <div class="card-action">
                                                    <div class="row" style="margin-bottom: 0px;">
                                                        <div class="col s6">
                                                            <span>Hamza SEYE</span>
                                                        </div>
                                                        <div class="col s6">
                                                            <span>Il y a 4 jours</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m6 l4">
                                            <div class="card">
                                                <div class="card-content">
                                                    <span class="card-title">
                                                        <a href="#">Programation WEB</a>
                                                    </span>
                                                    <p>Il s'agit de faire un projet Web en utilisant les technologies en cours. Le choix du sujet vous et libre</p>
                                                    <a class="btn-floating halfway-fab waves-effect waves-light" style="bottom: 36px;"><i class="material-icons">edit</i></a>
                                                </div>
                                                <div class="card-action">
                                                    <div class="row" style="margin-bottom: 0px;">
                                                        <div class="col s6">
                                                            <span>Hamza SEYE</span>
                                                        </div>
                                                        <div class="col s6">
                                                            <span>Il y a 4 jours</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m6 l4">
                                            <div class="card">
                                                <div class="card-content">
                                                    <span class="card-title">
                                                        <a href="#">Programation WEB</a>
                                                    </span>
                                                    <p>Il s'agit de faire un projet Web en utilisant les technologies en cours. Le choix du sujet vous et libre</p>
                                                    <a class="btn-floating halfway-fab waves-effect waves-light" style="bottom: 36px;"><i class="material-icons">edit</i></a>
                                                </div>
                                                <div class="card-action">
                                                    <div class="row" style="margin-bottom: 0px;">
                                                        <div class="col s6">
                                                            <span>Hamza SEYE</span>
                                                        </div>
                                                        <div class="col s6">
                                                            <span>Il y a 4 jours</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m6 l4">
                                            <div class="card">
                                                <div class="card-content">
                                                    <span class="card-title">
                                                        <a href="#">Programation WEB</a>
                                                    </span>
                                                    <p>Il s'agit de faire un projet Web en utilisant les technologies en cours. Le choix du sujet vous et libre</p>
                                                    <a class="btn-floating halfway-fab waves-effect waves-light" style="bottom: 36px;"><i class="material-icons">edit</i></a>
                                                </div>
                                                <div class="card-action">
                                                    <div class="row" style="margin-bottom: 0px;">
                                                        <div class="col s6">
                                                            <span>Hamza SEYE</span>
                                                        </div>
                                                        <div class="col s6">
                                                            <span>Il y a 4 jours</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m6 l4">
                                            <div class="card">
                                                <div class="card-content">
                                                    <span class="card-title">
                                                        <a href="#">Programation WEB</a>
                                                    </span>
                                                    <p>Il s'agit de faire un projet Web en utilisant les technologies en cours. Le choix du sujet vous et libre</p>
                                                    <a class="btn-floating halfway-fab waves-effect waves-light" style="bottom: 36px;"><i class="material-icons">edit</i></a>
                                                </div>
                                                <div class="card-action">
                                                    <div class="row" style="margin-bottom: 0px;">
                                                        <div class="col s6">
                                                            <span>Hamza SEYE</span>
                                                        </div>
                                                        <div class="col s6">
                                                            <span>Il y a 4 jours</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
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
        <script type="text/javascript" src="/js/materialize.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
            /* Initializations */
            $('.sidenav').sidenav();
            $('input#projectName').characterCounter();
            $('select').formSelect();
          });
        </script>
    </body>
</html>
