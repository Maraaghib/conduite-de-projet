<?php
    require_once('../data/Database.php');
    require_once('vendor/autoload.php');

    function getUser($email) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $getUser = $db->prepare("SELECT * FROM user WHERE email=:email");
        $data = [
            "email" => $email
        ];
        $getUser->execute($data);
        return $getUser->fetch();
    }

    function checkPassword($inputPassword, $dbPassword){
        return $inputPassword == $dbPassword;
    }

    function sendConfirmMail($email, $key){
        $subject = "Activer votre compte";
        $message = "Bienvenue sur le gestionnaire de projets réalisé pour l'UE
conduite de projet.
        
Pour activer votre compte, veuillez cliquer sur le lien ci dessous:
        
http://localhost:8100/user/activation.php?email=".urlencode($email)."&key=".urlencode($key)."
 
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.";

        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
        ->setUsername('cdp2018gestionnairedeprojets@gmail.com')
        ->setPassword('Cdp2018GL');
        $mailer = new Swift_Mailer($transport);
        $mail = (new Swift_Message($subject))
        ->setFrom(['cdp2018gestionnairedeprojets@gmail.com' => 'Gestionnaire de projets'])
        ->setTo([$email])
        ->setBody($message);
        $mailer->send($mail);
    }
?>