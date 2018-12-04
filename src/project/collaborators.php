<div class="section">
    <div class="s12">
        <div class="row">
            <div class="col s12 chip">
                <img class="collab-img" src="/img/avatar.png" alt="Propriétaire du projet" title="Propriétaire du projet">
                <strong class="collab-name">Hamza SEYE</strong>
                Ajouté(e) le: 04-12-2018
                <i data-target="remove-collab-modal" class="modal-trigger material-icons" title="Retirer">close</i>
                <!-- Modal Structure -->
                <div id="remove-collab-modal" class="modal">
                    <div class="modal-content">
                        <h4>Suppression</h4>
                        <p>Êtes-vous sûr de vouloir retirer <strong>{Collab-name}</strong> du projet <strong>{Project-name}</strong> ?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="" method="post">
                            <input type="hidden" name="projectID" value="<?php //echo $project['projectID']; ?>">
                            <input type="hidden" name="userEmail" value=<?php //echo $id?>>
                            <button name="confirmRemoveCollab" type="submit" class="modal-close waves-effect waves-red btn-flat">Retirer<i class="material-icons left" aria-hidden="true">check_circle</i></button>
                            <button type="button" class="modal-close waves-effect waves-green btn-flat">Annuler<i class="material-icons left" aria-hidden="true">cancel</i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="divider"></div>
<?php $allUsers = getAllUsers(); ?>
<div class="section">
    <div class="col s12">
        <form action="" method="post">
            <div class="row">
                <div class="input-field col s8" style="display: table-cell; padding: 0px; margin-top: 0px; margin-bottom: 30px;">
                    <i class="material-icons prefix">group_add</i>
                    <input type="email" id="autocomplete-input" class="autocomplete" name="collabEmail">
                    <label for="autocomplete-input">E-mail</label>
                    <?php
                        $author = $project['author'];
                        $projectName = $project['projectName'];
                        $projectID = $instance->getProjectID($author, $projectName);
                     ?>
                    <input type="hidden" name="projectID" value="<?php echo $projectID; ?>">
                    <input type="hidden" name="projectName" value="<?php echo $projectName; ?>">
                </div>
                <span style="display: table-cell;">
                    <button type="submit" class="btn waves-effect waves-light" name="addCollaborator">Ajouter collaborateur</button>
                </span>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var elem = document.querySelector('.autocomplete');
        var instance = M.Autocomplete.init(elem);
        instance.updateData({
            <?php foreach ($allUsers as $user) {
            ?>
                "<?php echo $user['email'] ?>": "/img/avatar.png",
            <?php
            }?>
        });
    });
</script>
