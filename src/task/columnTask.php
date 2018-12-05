<?php
define ("ID_TASK_ARG", "idTask");
foreach ($tasks as $task) {
        ?>
        <div id="task-<?php echo $count++; ?>-sprint-<?php echo $id; ?>" data-type="task" data-sprint-id="<?php echo $id; ?>" data-task-id="<?php echo $task['idTask']; ?>" class="col s12" style="padding: 20px; cursor: move;" draggable="true" ondragstart="drag(event)" title="Vous pouvez la glisser et la déposer dans une autre colonne">
            <div class="quote-container card">
                <i class="pin" aria-hidden="true"></i>
                <blockquote class="card-content note yellow">
                    <h5 class="center-align note-header"><span style="color: #ff0c00;" title="ID de la tâche"><?php echo $task[ID_TASK_ARG]; ?></span>: <span style="color: #0316f9;" title="Temps estimé (Jour-Homme)"><?php echo $task['estimatedTime']; ?></span> jh</h5>
                    <p class="ellipse-text">
                        <?php echo $task['description']; ?>
                    </p>
                    <div class="read-more" style="margin-top: 0"></div>
                </blockquote>
                <blockquote class="card-reveal note yellow">
                    <span class="card-title"><h6 class="center-align" style="font-weight: bold;">Description</h6><i class="material-icons right" aria-hidden="true">close</i></span>
                    <p>
                        <?php echo $task['description']; ?>
                    </p>
                </blockquote>
                <blockquote class="card-action note yellow">
                    <div class="row" style="margin-bottom: 0px;">
                        <div class="col s12">
                            <div class="chip chip-img" title="Personne à laquelle cette tâche est affectée">
                                <img src="/img/avatar.png" alt="Contact Person" style="float: left; margin: 0 8px 0 -12px; height: 32px; width: 32px;  border-radius: 50%;">
                                <?php echo "Author's ID: ".$task['affectedTo']; ?>
                            </div>
                        </div>
                    </div>
                </blockquote>
                <blockquote class="card-action note yellow">
                    <div class="row" style="margin-bottom: 0px;">
                        <div class="col s12">
                            <?php
                                $idTask = $task['idAI'];
                                $dependences = getDependenceByID($idTask);
                                foreach ($dependences as $dependence) {
                            ?>
                            <div class="chip purple lighten-2" title="Tâche <?php echo $dependence[ID_TASK_ARG]; ?>">
                                <?php echo $dependence[ID_TASK_ARG]; ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </blockquote>
                <blockquote class="card-action note yellow">
                    <div class="row" style="margin-bottom: 0px;">
                        <div class="col s12">
                            <?php
                                $idTask = $task['idAI'];
                                $userStories = getLinkedUSByID($idTask);
                                foreach ($userStories as $userStory) {
                            ?>
                            <div class="chip blue lighten-2" title="User Story #<?php echo $userStory['idUS']; ?>">
                                #<?php echo $userStory['idUS']; ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </blockquote>
            </div>
        </div>
<?php } ?>
