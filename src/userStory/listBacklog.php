<table class="responsive-table striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Description</th>
            <th>Difficulté</th>
            <th>Priorité</th>
            <th>Sprint</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($backlog as list($pn, $id, $desc, $diff, $prio, $sprint)) {
            echo "<tr> <td id='id$id'>#$id</td> <td>$desc</td> <td>$diff</td> <td>$prio</td> <td>$sprint</td>";
        ?>
            <td>
                <a id="updateUserStory-<?php echo $id ?>" href="/userStory/updateUserStory.php?projectName=<?php echo $project['projectName']; ?>&idUserStory=<?php echo $id; ?>" class="btn-floating waves-effect waves-light modal-trigger amber accent-4"><i class="material-icons" aria-hidden="true">edit</i></a>
            </td>
            <td>
            <!-- Modal Trigger -->
            <a href="#delete-modal-<?php echo $id ?>" class="btn-floating waves-effect waves-light modal-trigger red"><i class="material-icons" aria-hidden="true">delete</i></a>
            <!-- Modal Structure -->
            <div id="delete-modal-<?php echo $id ?>" class="modal">
                <div class="modal-content">
                    <h4>Suppression</h4>
                    <p>Êtes-vous sûr de vouloir supprimer le <strong>User Story #<?php echo $id; ?> ?</strong> </p>
                </div>
                <div class="modal-footer">
                    <form action="/userStory/removeUserStory.php" method="post">
                        <input type="hidden" name="projectName" value="<?php echo $project['projectName']; ?>">
                        <input type="hidden" name="idUserStory" value=<?php echo $id?>>
                        <button name="confirmDelete" type="submit" class="modal-close waves-effect waves-red btn-flat">Supprimer<i class="material-icons left" aria-hidden="true">check_circle</i></button>
                        <button type="button" class="modal-close waves-effect waves-green btn-flat">Annuler<i class="material-icons left" aria-hidden="true">cancel</i></button>
                    </form>
                </div>
            </div>
        <?php
        }
        ?>
    </tbody>
</table>
<div class="center-align" style="margin-top: 35px;">
    <a id="addUserStory" href="/userStory/addUserStory.php?projectName=<?php echo $project['projectName'] ?>" class="btn waves-effect waves-light"><i class="material-icons left" aria-hidden="true">add</i>Ajouter un User Story</a>
</div>
