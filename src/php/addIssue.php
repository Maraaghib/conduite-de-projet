<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Ajout d'issue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <form method="post" action="test.php">

        <p>
            Veuillez entrez les informations de votre issue</br>
            (les champs précédé d'un * sont obligatoire):</br>
        </p>
        Id: * <input type="number" name="idIssue" min=0 placeholder="Id unique" required /></br>
        Description: * <textarea name="descIssue" cols="40" rows="5" required></textarea></br>
        Difficulté: * <select name="diffIssue">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="5">5</option>
            <option value="8">8</option>
            <option value="13">13</option>
        </select></br>
        Priorité: <input type="number" name="prioIssue" min=1 /></br>
        <input type="submit" value="Ok" />

    </form>
</body>

</html>