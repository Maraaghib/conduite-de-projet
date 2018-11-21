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
        <title>Erreur</title>

    </head>
    <body>
        <?php
            require_once $_SERVER['DOCUMENT_ROOT'].'/header.php';
        ?>
        <main>
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col s12">
                            <p>Un problème est survenu lors de la requête de cette page... Peut-être n'êtes vous pas censé vous trouvez ici ?</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!--JavaScript at end of body for optimized loading-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type="text/javascript" src="/js/scripts.js"></script>
    </body>
</html>
