<?php
require_once('../data/Database.php');
require_once('user.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["email"])) {
    $email = $_GET["email"];
    $user = getUser($email);
    if ($user["active"]) {
        require_once("accountAlreadyActivate");
        exit();
    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $email = $_POST["email"];
    getUser($email);
    if ($user["active"]) {
        require_once("accountAlreadyActivate");
        exit();
    }
    sendConfirmMail($email, $user["key"]);
    $mailSend = "Email envoyé à l'adresse $email";
}
?>
<!DOCTYPE html>
<html>

<head lang="fr">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Renvoyer email d'activation</title>
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
                            <h5 class="header">Compte non activé</h5>
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
                    Votre compte n'a pas encore été activé</br>
                    Un mail d'activation du compte à été envoyé</br>
                    à l'adresse mail <?php echo $email ?>.</br>

                    Si vous n'avez pas reçu de mail:
                </p>
                <form class="col s12" method="post">
                    <input name="email" value="<?php echo $email ?>" hidden />
                    <button type="submit" name="resendMail" class="btn waves-effect waves-light">
                        Renvoyer le mail d'activation
                        <i class="material-icons left" aria-hidden="true">check_circle</i>
                    </button>
                    <?php echo "</br>$mailSend"; ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>