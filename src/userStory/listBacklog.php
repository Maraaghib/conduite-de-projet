<table class="responsive-table striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Description</th>
            <th>Priorité</th>
            <th>Difficulté</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($backlog as list($pn, $id, $desc, $prio, $diff)) {
            echo "<tr> <td>#$id</td> <td>$desc</td> <td>$prio</td> <td>$diff</td> <td>";
        ?>
        <!-- Modal Trigger -->
        <a href="#delete-modal-<?php echo $id ?>" class="btn-floating waves-effect waves-light modal-trigger red"><i class="material-icons">delete</i></a>
        <!-- Modal Structure -->
        <div id="delete-modal-<?php echo $id ?>" class="modal">
            <div class="modal-content">
                <h4>Suppression</h4>
                <p>Êtes-vous sûr de vouloir supprimer le <strong>User Story #<?php echo $id; ?> ?</strong> </p>
            </div>
            <div class="modal-footer">
                <form action="/userStory/removeUserStory.php" method="post">
                    <input type="hidden" name="projectName" value=<?php echo $project['name'] ?>>
                    <input type="hidden" name="idUserStory" value=<?php echo  $id?>>
                    <button type="submit" class="modal-close waves-effect waves-red btn-flat">Supprimer<i class="material-icons left">check_circle</i></button>
                    <button type="button" class="modal-close waves-effect waves-green btn-flat">Annuler<i class="material-icons left">cancel</i></button>
                </form>
            </div>
        </div>
        <?php
        echo "</td> </tr>";
        }
        ?>
    </tbody>
</table>
