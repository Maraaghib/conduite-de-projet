<table class="responsive-table striped">
    <thead>
        <tr>
            <th>Sprint</th>
            <th>Date début</th>
            <th>Date fin</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($listSprint as list($id, $projectName, $startDate)) {
            $parts = explode('-', $startDate);
            $startDateFr  = "$parts[2]-$parts[1]-$parts[0]";
            $endDate = date_create($startDate)->add(date_interval_create_from_date_string("$sprintDuration days"));
            $endDateFr = $endDate->format("d-m-Y");
            echo "<tr> <td><a href=../task/listTasks.php>$projectName</a></td> <td>$startDateFr</td> <td>$endDateFr</td> </tr>";
        }
        ?>
    </tbody>
</table>
<div class="center-align" style="margin-top: 35px;">
    <a id="newSprint" href="/sprint/newSprint.php?projectName=<?php echo $project['projectName'] ?>" class="btn waves-effect waves-light"><i class="material-icons left">add</i>Ajouter un sprint</a>
</div>
