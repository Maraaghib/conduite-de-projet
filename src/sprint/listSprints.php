<?php
require_once("../date.php") 
?>
<ul class="collapsible">
    <?php
    $i = 1;
    foreach ($listSprints as list($id, $projectName, $startDate)) {
        $parts = explode('-', $startDate);
        $startDateFr  = "$parts[2]-$parts[1]-$parts[0]";
        $endDate = date_create($startDate)->add(date_interval_create_from_date_string("$sprintDuration days"));
        $endDateFr = $endDate->format("d-m-Y");
    ?>
    <li>
        <div class="collapsible-header"><h5><strong style="color: green;"><i class="material-icons">loop</i>Sprint <?php echo ($i++)."</strong>: ".$startDateFr." &rArr; ".$endDateFr; ?></h5></div>
        <div class="collapsible-body">
            <div class="row">
                <?php include_once $_SERVER['DOCUMENT_ROOT'].'/task/listTasks.php'; ?>
            </div>
        </div>
    </li>
    <?php } ?>
</ul>

<div class="center-align" style="margin-top: 35px;">
    <a id="newSprint" href="/sprint/newSprint.php?projectName=<?php echo $project['projectName'] ?>" class="btn waves-effect waves-light"><i class="material-icons left">add</i>Ajouter un sprint</a>
</div>
