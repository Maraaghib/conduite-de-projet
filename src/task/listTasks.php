<div class="col s4">
    <div class="row box box-danger">
        <h5 class="center-align box-header box-header-danger">TO DO</h5>
        <?php
            $progress = 'todo';
            $tasks = getTasksBySprintAndProgress($id, $progress);
            foreach ($tasks as $task) {
        ?>
        <div class="col s12" style="padding: 20px;">
            <div class="quote-container card">
                <i class="pin"></i>
                <blockquote class="card-content note yellow">
                    <h5 class="center-align note-header"><span style="color: #ff0c00;" title="ID de la tâche"><?php echo $task['idTask']; ?></span>: <span style="color: #0316f9;" title="Temps estimé (Jour-Homme)"><?php echo $task['estimatedTime']; ?></span> jh</h5>
                    <p class="ellipse-text">
                        <?php echo $task['description']; ?>
                    </p>
                    <div class="read-more" style="margin-top: 0"></div>
                </blockquote>
                <blockquote class="card-reveal note yellow">
                    <span class="card-title"><h6 class="center-align" style="font-weight: bold;">Description</h6><i class="material-icons right">close</i></span>
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
                            <div class="chip purple lighten-2" title="Tâche <?php echo $dependence['idTask']; ?>">
                                <?php echo $dependence['idTask']; ?>
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
    </div>
</div>

<div class="col s4">
    <div class="row box box-danger">
        <h5 class="center-align box-header box-header-danger">DOING</h5>
        <?php
            $progress = 'doing';
            $tasks = getTasksBySprintAndProgress($id, $progress);
            foreach ($tasks as $task) {
        ?>
        <div class="col s12" style="padding: 20px;">
            <div class="quote-container card">
                <i class="pin"></i>
                <blockquote class="card-content note yellow">
                    <h5 class="center-align note-header"><span style="color: #ff0c00;" title="ID de la tâche"><?php echo $task['idTask']; ?></span>: <span style="color: #0316f9;" title="Temps estimé (Jour-Homme)"><?php echo $task['estimatedTime']; ?></span> jh</h5>
                    <p class="ellipse-text">
                        <?php echo $task['description']; ?>
                    </p>
                    <div class="read-more" style="margin-top: 0"></div>
                </blockquote>
                <blockquote class="card-reveal note yellow">
                    <span class="card-title"><h6 class="center-align" style="font-weight: bold;">Description</h6><i class="material-icons right">close</i></span>
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
                            <div class="chip purple lighten-2" title="Tâche <?php echo $dependence['idTask']; ?>">
                                <?php echo $dependence['idTask']; ?>
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
    </div>
</div>


<div class="col s4">
    <div class="row box box-danger">
        <h5 class="center-align box-header box-header-danger">DONE</h5>
        <?php
            $progress = 'done';
            $tasks = getTasksBySprintAndProgress($id, $progress);
            foreach ($tasks as $task) {
        ?>
        <div class="col s12" style="padding: 20px;">
            <div class="quote-container card">
                <i class="pin"></i>
                <blockquote class="card-content note yellow">
                    <h5 class="center-align note-header"><span style="color: #ff0c00;" title="ID de la tâche"><?php echo $task['idTask']; ?></span>: <span style="color: #0316f9;" title="Temps estimé (Jour-Homme)"><?php echo $task['estimatedTime']; ?></span> jh</h5>
                    <p class="ellipse-text">
                        <?php echo $task['description']; ?>
                    </p>
                    <div class="read-more" style="margin-top: 0"></div>
                </blockquote>
                <blockquote class="card-reveal note yellow">
                    <span class="card-title"><h6 class="center-align" style="font-weight: bold;">Description</h6><i class="material-icons right">close</i></span>
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
                            <div class="chip purple lighten-2" title="Tâche <?php echo $dependence['idTask']; ?>">
                                <?php echo $dependence['idTask']; ?>
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
    </div>
</div>
