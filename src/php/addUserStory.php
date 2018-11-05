<!DOCTYPE html>
<html>

<head lang="fr">
    <meta charset="utf-8" />
    <title>Ajout de user story</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <form method="post" action="test.php">

        <p>
            Veuillez entrer les informations de votre user story</br>
            (les champs précédé d'un * sont obligatoire):</br>
        </p>
        Id: * <input type="number" name="idUserStory" min=0 placeholder="Id unique" required /></br>
        Description: * <textarea name="descUserStory" cols="40" rows="5" required></textarea></br>
        Difficulté: * <select name="diffUserStory">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="5">5</option>
            <option value="8">8</option>
            <option value="13">13</option>
        </select></br>
        Priorité: <input type="number" name="prioUserStory" min=1 /></br>
        <input type="submit" value="Valider" />

    </form>
</body>

</html>
