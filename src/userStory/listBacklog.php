<table class="responsive-table striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Description</th>
            <th>Priorité</th>
            <th>Difficulté</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($backlog as list($pn, $id, $desc, $prio, $diff)) {
            echo "<tr> <td>$id</td> <td>$desc</td> <td>$prio</td> <td>$diff</td> <td>";
        ?>
        <button class="btn waves-effect waves-light" onclick="openForm(<?php echo $id ?>)"><i class="material-icons">delete</i></button>
        <form id="askConfirm<?php echo $id?>" class="form-popup" action="/userStory/removeUserStory.php" method="post">
            <input type="hidden" name="projectName" value=<?php echo $_GET["projectName"] ?>>
            <input type="hidden" name="idUserStory" value=<?php echo  $id?>>
            <div class="card">
                <div class="card-content row">
                    <span class="card-title">
                        Suppression
                    </span>
                <div class="row">Est-tu sur de vouloir supprimer l'User Story <?php echo $id ?></div>
                <button class="btn waves-effect waves-light" type="submit">
                Valider
                <i class="material-icons left">check_circle</i>
                </button>
                <button type="button" name="cancel" class="btn waves-effect waves-light" onclick="closeForm(<?php echo $id ?>)">
                Annuler
                <i class="material-icons left">cancel</i>
                </button>
            </div>
        </form>
        <?php
        echo "</td> </tr>";
        }
        ?>
    </tbody>
</table>
