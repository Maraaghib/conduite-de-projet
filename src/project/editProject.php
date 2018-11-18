<div class="row box box-default">
    <h5 class="center-align box-header box-header-default">Mises à jour</h5>
    <div class="s12" style="padding: 20px;">
        <div class="section">
            <form action="" method="post">
                <div class="row">
                    <div class="input-field col s12 m8">
                        <input id="projectName" name="newProjectName" type="text" value="<?php echo $project['projectName']; ?>" class="validate" maxlength="50" data-length="50" required autofocus onfocusout="removeHelperText()">
                        <label for="projectName">Nom</label>
                        <span id="helper-text" class="helper-text" data-error="Le nom de votre projet est obligatoire et ne peut pas excéder 50 caractères" data-success="&#10004;">
                            <?php echo $errorMessage; ?>
                        </span>
                    </div>
                    <input type="hidden" name="oldProjectName" value="<?php echo $project['projectName']; ?>">
                    <div class="col s12 m4">
                        <button type="submit" name="updateProjectName" class="btn waves-effect waves-light">
                            Renommer
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="divider"></div>
        <div class="section">
            <form action="" method="post">
                <div class="row">
                    <div class="input-field col s12 m8">
                        <textarea id="projectDescription" name="projectDescription" class="materialize-textarea"><?php echo $project['description']; ?></textarea>
                        <label for="projectDescription">Description</label>
                    </div>
                    <input type="hidden" name="projectName" value="<?php echo $project['projectName']; ?>">
                    <div class="col s12 m4">
                        <button type="submit" name="updateProjectDescription" class="btn waves-effect waves-light">
                            Valider
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="divider"></div>
        <div class="section">
            <form action="" method="post">
                <div class="row">
                    <div class="input-field col s12 m4">
                        <input id="sprintDuration" name="sprintDuration" type="tel" value="<?php echo $project['sprintDuration']; ?>" class="validate" required>
                        <label for="sprintDuration">Durée</label>
                        <span class="helper-text" data-error="La durée des sprints est obligatoire et doit être supérieure ou égale à 1" data-success="&#10004;"></span>
                    </div>
                    <div class="input-field col s12 m4">
                        <select required>
                            <option value="1">Jours</option>
                            <option value="2" selected>Semaines</option>
                            <option value="3">Mois</option>
                        </select>
                        <label>Unité de temps</label>
                    </div>
                    <div class="col s12 m4">
                        <button type="submit" name="updateProjectDuration" class="btn waves-effect waves-light">
                            Valider
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row box box-danger">
    <h5 class="center-align box-header box-header-danger">Suppression</h5>
    <div class="s12" style="padding: 20px;">
        <div class="section">
            <form action="" method="post">
                <div class="row">
                    <div class="col s12 m8">
                        <strong>
                            Une fois que vous supprimez un projet, vous ne pouvez plus revenir en arrière. S'il vous plaît soyez certain.
                        </strong>
                    </div>
                    <div class="col s12 m4">
                        <button type="submit" name="updateProjectName" class="btn waves-effect waves-light red">
                        <i class="material-icons left">delete</i>
                            Supprimer ce projet
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
