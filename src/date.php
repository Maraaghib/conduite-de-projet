<?php
function isPastDate($date) {
    $now = new DateTime("now");
    $datetime = new DateTime($date);
    $now = new DateTime($now->format('Y-m-d'));
    return $datetime < $now;
}

function isValidDate($date, $projectName, $project) {
    $db = Database::getDBConnection();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sprintDuration = $project["sprintDuration"];
    $listSprintStartDate = $db->prepare("SELECT count(*) FROM sprint WHERE ABS(DATEDIFF(startDate, :date))<=:sprintDuration AND projectName=:projectName");
    $data = [
        "date" => $date,
        "sprintDuration" => $sprintDuration,
        "projectName" => $projectName
    ];
    $listSprintStartDate->execute($data);
    $nb = $listSprintStartDate->fetchColumn();
    return $nb == 0;
}

function convertDate($date) {
    $parts = explode('-', $date);
    return "$parts[2]-$parts[1]-$parts[0]";
}