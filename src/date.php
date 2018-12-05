<?php
function isPastDate($date) {
    $now = new DateTime("now");
    $datetime = new DateTime($date);
    $now = new DateTime($now->format('Y-m-d'));
    return $datetime < $now;
}

function isValidDate($date, $projectID, $project) {
    $db = Database::getDBConnection();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sprintDuration = $project["sprintDuration"];
    $listSprintStartDate = $db->prepare("SELECT count(*) FROM sprint WHERE ABS(DATEDIFF(startDate, :date))<=:sprintDuration AND projectID=:projectID");
    $data = [
        "date" => $date,
        "sprintDuration" => $sprintDuration,
        "projectID" => $projectID
    ];
    $listSprintStartDate->execute($data);
    $nb = $listSprintStartDate->fetchColumn();
    return $nb == 0;
}

/**
 * Convert a date from (d-m-Y) to (Y-m-d) and inversely
*/
function convertDate($date) {
    $parts = explode('-', $date);
    return "$parts[2]-$parts[1]-$parts[0]";
}
