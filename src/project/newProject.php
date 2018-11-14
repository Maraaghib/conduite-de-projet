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
                                        <form class="col s12" action="/data/Project.php" method="post">
                                            <h5 style="text-align: center;">Créer un nouveau projet</h5>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="projectName" name="projectName" type="text" class="validate" maxlength="50" data-length="50" required>
                                                    <label for="projectName">Nom</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <textarea id="projectDescription" name="projectDescription" class="materialize-textarea"></textarea>
                                                    <label for="projectDescription">Description</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input id="sprintDuration" name="sprintDuration" type="tel" class="validate" required>
                                                    <label for="sprintDuration">Durée</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <select required>
                                                        <option value="" disabled selected>Choisissez l'unité</option>
                                                        <option value="1">Jours</option>
                                                        <option value="2">Semaines</option>
                                                        <option value="3">Mois</option>
                                                    </select>
                                                    <label>Unité de temps</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s6">
                                                    <button type="submit" name="createProject" class="btn waves-effect waves-light">
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
