<?php
require_once('../data/Database.php');
require_once('user.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/session.php');

redirectIfConnected();

$db = Database::getDBConnection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["email"]);
    if (getUser($email))
    {
        $mailAlreadyUsed = "Un compte est déjà associé a cet email";
    }
    else
    {
        $username = htmlspecialchars($_POST["name"]);
        $password = htmlspecialchars($_POST["password"]);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $createUser = $db->prepare("INSERT INTO user SET 
            name=:name,
            email=:email,
            password=:password
        ");
        $data = [
            'name' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ];
        $createUser->execute($data);
        header("location: login.php?email=$email");
        exit();
    }
}

?>
<!DOCTYPE html>
<html>
<head lang="fr">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>S'inscrire</title>
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
                        <h5 class="header">Inscription</h5>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="container">
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div id="grid-container" class="section scrollspy">
                <form class="col s12" method="post">
                    <div class="input-field col s12">
                        <label for="name">Nom *</label>
                            <input class="validate" type="text" name="name" required />
                    </div>
                    <div class="input-field col s12">
                        <label for="email">Email *</label>
                            <input class="validate" type="email" name="email" value="<?php echo $_GET["email"] ?>" required />
                            <span class="helper-text" data-error="Entrez une addresse mail valide" data-success="Saisie correcte"></span>
                            <?php echo $mailAlreadyUsed ?>
                    </div>
                    <div class="input-field col s12">
                        <label for="password">Mot de passe *</label>
                        <input class="validate" type="password" name="password" required />
                        <?php echo $incorrectPassword ?>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <button type="submit" name="createUser" class="btn waves-effect waves-light">
                                Créer le compte 
                                <i class="material-icons left" aria-hidden="true">check_circle</i>
                            </button>
                        </div>
                        <div class="col s6">
                            <a class="btn waves-effect waves-light" href="./login.php">Se connecter
                                <i class="material-icons left" aria-hidden="true">person</i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>