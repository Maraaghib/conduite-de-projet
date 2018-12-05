<div class="col s4">
    <div class="row box box-danger" data-type="progressColumn" data-column-progress="todo" style="min-height: 380px;" ondrop="drop(event)" ondragover="allowDrop(event)">
        <h5 class="center-align box-header box-header-danger">TO DO</h5>
        <?php
            define("COLUMN_TASK_FILE", "columnTask.php");
            $count = 0;
            $progress = 'todo';
            $tasks = getTasksBySprintAndProgress($id, $progress);
            require COLUMN_TASK_FILE
        ?>

    </div>
</div>

<div class="col s4">
    <div class="row box box-danger" data-type="progressColumn" data-column-progress="doing" style="min-height: 380px;" ondrop="drop(event)" ondragover="allowDrop(event)">
        <h5 class="center-align box-header box-header-danger">DOING</h5>
        <?php
            $progress = 'doing';
            $tasks = getTasksBySprintAndProgress($id, $progress);
            require COLUMN_TASK_FILE
        ?>
    </div>
</div>


<div class="col s4">
    <div class="row box box-danger" data-type="progressColumn" data-column-progress="done" style="min-height: 380px;" ondrop="drop(event)" ondragover="allowDrop(event)">
        <h5 class="center-align box-header box-header-danger">DONE</h5>
        <?php
            $progress = 'done';
            $tasks = getTasksBySprintAndProgress($id, $progress);
            require COLUMN_TASK_FILE
        ?>
    </div>
</div>
