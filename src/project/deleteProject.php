<div class="row box box-danger">
    <h5 class="center-align box-header box-header-danger">Suppression</h5>
    <div class="s12" style="padding: 20px;">
        <div class="section">
            <div class="row">
                <div class="col s12 m8">
                    <?php echo $deleteProjectMessage; ?>
                </div>
                <div class="col s12 m4">
                    <!-- Modal Trigger -->
                    <a id="modal-trigger" href="#delete-project-modal" class="btn waves-effect waves-light modal-trigger red"><i class="material-icons left" aria-hidden="true">delete</i>Supprimer ce projet</a>
                    <!-- Modal Structure -->
                    <div id="delete-project-modal" class="modal" style="width: 56%; min-height: 450px;">
                        <div class="modal-content">
                            <h4>Suppression</h4>
                            <p>Êtes-vous sûr de vouloir supprimer le projet <strong><?php echo $project['projectName']; ?></strong> ?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="" method="post" style="width: 100%; margin: 0px;">
                                <div class="row" style="width: 100%; margin: 0px;">
                                    <div class="input-field col s10 offset-s1 m8 offset-m2">
                                        <!-- Tant qu'il n'a pas saisi le bon nom, ne pas activer le bouton de suppression: A faire avec JS via onchange() -->
                                        <input id="confirmProjectName" name="confirmProjectName" type="text" value="" class="validate" data-length="50" required onfocusout="removeHelperText()" oninput="verifyProjectName()">
                                        <label for="confirmProjectName">Confirmer le nom du propjet</label>
                                        <span id="helper-text" class="helper-text" data-error="La confirmation du nom du projet est obligatoire et ne peut pas excéder 50 caractères" data-success="Saisie correcte">
                                            <?php echo $deleteProjectErrorMessage; ?>
                                        </span>
                                    </div>
                                    <div class="input-field col s10 offset-s1 m8 offset-m2">
                                        <!-- Add "required" attribute ! -->
                                        <input id="confirmPassword" name="confirmPassword" type="password" class="validate">
                                        <label for="confirmPassword">Confirmer votre mot de pass</label>
                                        <span id="helper-text" class="helper-text" data-error="Le mot de pass que vous avez saisi n'est pas correct" data-success="Saisie correcte">
                                        </span>
                                    </div>
                                    <input type="hidden" id="hiddenProjectName" name="projectName" value="<?php echo $project['projectName']; ?>">
                                    <input type="hidden" name="idUser" value=<?php echo ""?>>
                                    <div class="col s12" style="color: white;">
                                        <button id="deleteProjectBtn" name="deleteProjectBtn" type="submit" class="btn waves-effect waves-light red" disabled>Supprimer<i class="material-icons left" aria-hidden="true">check_circle</i></button>
                                        <button type="reset" class="modal-close btn waves-effect waves-light">Annuler<i class="material-icons left" aria-hidden="true">cancel</i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
