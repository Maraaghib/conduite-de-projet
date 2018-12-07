<?php
require_once("../date.php")
?>
<ul class="collapsible expandable">
    <?php
    $i = 1;
    foreach ($listSprints as list($id, $projectID, $startDate)) {
        $startDateFr  = convertDate($startDate);
        $endDate = date_create($startDate)->add(date_interval_create_from_date_string("$sprintDuration days"));
        $endDateFr = $endDate->format("d-m-Y");
    ?>
    <li data-type="sprint" data-sprint-id="<?php echo $id; ?>">
        <div class="collapsible-header"><h5><strong style="color: green;"><i class="material-icons" aria-hidden="true">loop</i>Sprint <?php echo ($i++)."</strong>: ".$startDateFr." &rArr; ".$endDateFr; ?></h5></div>
        <div class="collapsible-body">
            <div class="row">
                <?php include $_SERVER['DOCUMENT_ROOT'].'/task/listTasks.php'; ?>
            </div>
            <div class="center-align" style="margin-top: 35px;">
                <a id="addTask" href="/task/addTask.php?projectName=<?php echo $projectName ?>&idSprint=<?php echo $id ?>" class="btn waves-effect waves-light"><i class="material-icons left" aria-hidden="true">note_add</i>Ajouter une tâche</a>
            </div>
        </div>
    </li>
    <?php } ?>
</ul>

<div id="sprintButtonAction" class="center-align" style="margin-top: 35px;">
    <a id="newSprint" href="/sprint/newSprint.php?projectName=<?php echo $project['projectName'] ?>" class="btn waves-effect waves-light"><i class="material-icons left" aria-hidden="true">playlist_add</i>Ajouter un sprint</a>
    <form action="" method="post" style="display: none;">
        <input type="hidden" name="projectName" value="<?php echo $project['projectName'] ?>">
        <input type="hidden" id="idOldSprintArray" name="idOldSprintArray" value="">
        <input type="hidden" id="idNewSprintArray" name="idNewSprintArray" value="">
        <input type="hidden" id="idTaskArray" name="idTaskArray" value="">
        <input type="hidden" id="progressArray" name="progressArray" value="">
        <button type="submit" name="updateTaskSprintAndProgress" class="btn waves-effect waves-light yellow accent-4" style="color: black;">Enregistrer les modifications<i class="material-icons left" aria-hidden="true">save</i></button>'
    </form>
</div>
