<!DOCTYPE html>
<html>

<head lang="fr">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Erreur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" media="screen,projection"/>
    <link rel="stylesheet" href="/css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js" defer></script>
    <script type="text/javascript" src="/js/scripts.js" defer></script>
</head>
<body>
    <div class="navbar-fixed">
        <nav class="top-nav">
            <div class="container">
                <div class="nav-wrapper">
                    <div class="row">
                        <div class="center">
                            <h5 class="header">Erreur d'activation</h5>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-m2">
                 <p>
                    Une erreur c'est produite lors de l'activation de votre compte.

                    Veuillez réessayer de vous connecter:
                </p>
            </div>
            <div class="col s12 m8 offset-m2">
                <a href="login.php?email=<?php echo $email ?>" name="login" class="btn waves-effect waves-light">
                    Aller sur la page de connexion
                    <i class="material-icons left" aria-hidden="true">check_circle</i>
                </a>
            </div>
            <div class="col s12 m8 offset-m2">
                 <p>
                    Si l'erreur persiste veuillez essayer de recréer un compte.
                </p>
            </div>
        </div>
    </div>
</body>
</html>