<?php
    require_once('Database.php');

    define("PROJECT_NAME_ARG", "projectName");
    define("DESCRIPTION_ARG", "description");
    define("SPRINT_DURATION_ARG", "sprintDuration");
    define("DATE_PROJECT_ARG", "dateProject");
    define("DAY", 1);
    define("WEEK", 2);
    define("MONTH", 3);

    const BASE_URL_VIEW_PROJECT = 'Location: /project/viewProject.php?projectName=';
    const ERROR_URL = 'location: /error.php';

    /**
     * Classe Project contenant les inormations d'un projet
     */
    class Project {

        private $projectName;
        private $description;
        private $sprintDuration;
        private $dateProject;

        public function __construct() {
            $this->projectName = "";
            $this->description = "";
            $this->sprintDuration = "";
            $this->timeUnitSprint = "";
            $this->dateProject = "";
        }

        public static function newProject($projectName, $description, $sprintDuration, $dateProject, $timeUnitSprint) {
            $instance = new self();
            $instance->setProjectName($projectName);
            $instance->setDescription($description);
            $instance->setSprintDuration($sprintDuration);
            $instance->setDateProject($dateProject);
            $instance->setTimeUnitSprint($timeUnitSprint);

            return $instance;
        }

        public function hydrate($data) {
            if(isset($data[PROJECT_NAME_ARG])) {
                $this->projectName = $data[PROJECT_NAME_ARG];
            }
            if(isset($data[DESCRIPTION_NAME_ARG])) {
                $this->description = $data[DESCRIPTION_NAME_ARG];
            }
            if(isset($data[SPRINT_DURATION_ARG])) {
                $this->sprintDuration = $data[SPRINT_DURATION_ARG];
            }
            if(isset($data[DATE_PROJECT_ARG])) {
                $this->dateProject = $data[DATE_PROJECT_ARG];
            }
        }

        /**
         * Permet de récupérer un projet (d'un user) via son identifiant
         */
        public function getProject(/*idUser*/ $projectName) {
            $db = Database::getDBConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            /* WHERE author = :author = ?? */
            $stmt = $db->prepare("SELECT * FROM project WHERE projectName=:projectName");
            $data = [
                'projectName' => $projectName
            ];
            $stmt->execute($data);

            return $stmt->fetch();
        }

        /**
         * Permet de récupérer tous les projets (d'un user)
         */
        public function listProjects(/*idUser*/) {
            $db = Database::getDBConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            /* WHERE author = :author = ?? */
            $stmt = $db->prepare("SELECT * FROM project ORDER BY idAI ASC", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            // $query->execute(['author' => $author]);
            // $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $projects = [];
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                $projects[] = $result;
            }
            return $projects;
        }

        /**
        * Permet de sauvegarder un nouveau projet
        */
        public function createProject() {
            $db = Database::getDBConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $db->prepare("INSERT INTO project SET
                projectName     = :projectName,
                description     = :description,
                sprintDuration  = :sprintDuration,
                dateProject     = :dateProject,
                timeUnitSprint  = :timeUnitSprint
            ");

            $data = [
                'projectName'   => $this->getProjectName(),
                'description'   => $this->getDescription(),
                'sprintDuration'=> $this->getSprintDuration(),
                'dateProject'   => $this->getDateProject(),
                'timeUnitSprint'=> $this->getTimeUnitSprint()
            ];

            $result = $query->execute($data);
            header('Location: /project/listProjects.php');
            return $result;
        }

        /**
        * Permet de mettre à jour le nom d'un projet
        */
        public function updateProjectName($oldProjectName, $newProjectName) {
            $db = Database::getDBConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $db->prepare("UPDATE project SET projectName=:newProjectName WHERE projectName=:oldProjectName");
            $data = [
                "newProjectName" => $newProjectName,
                "oldProjectName" => $oldProjectName
            ];
            $query->execute($data);
        }

        /**
        * Permet de mettre à jour la description d'un projet
        */
        public function updateProjectDescription($projectName, $description) {
            $db = Database::getDBConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $db->prepare("UPDATE project SET description = \"$description\" WHERE projectName = \"$projectName\"");
            return $query->execute();
        }

        /**
        * Permet de mettre à jour la durée des sprints d'un projet
        */
        public function updateSprintDuration($projectName, $sprintDuration, $timeUnitSprint) {
            $db = Database::getDBConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $db->prepare("UPDATE project SET 
                sprintDuration = :sprintDuration, 
                timeUnitSprint = :timeUnitSprint
                WHERE projectName = :projectName
            ");
            $data = [
                "sprintDuration" => $sprintDuration,
                "timeUnitSprint" => $timeUnitSprint,
                "projectName"    => $projectName
            ];
            return $query->execute($data);
        }

        /**
        * Permet de supprimer un projet
        */
        public function deleteProject($projectName /*idUser*/) {
            $db = Database::getDBConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $db->prepare("DELETE FROM project WHERE projectName = :projectName");
            $data = [
                'projectName' => $projectName
            ];

            return $query->execute($data);
        }

        /**
         * Permet de tester si un projet existe ou non
         */
         public function isProjectExist($projectName) {
            $db = Database::getDBConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $db->prepare("SELECT count(*) AS numProjectName FROM project WHERE projectName=:projectName");
            $data = [
                'projectName' => $projectName
            ];
            $query->execute($data);
            return $query->fetch()["numProjectName"];
        }

        /*************** Getters et setters ******************/
        public function setProjectName($projectName){
            $this->projectName = $projectName;
        }

        public function getProjectName(){
            return $this->projectName;
        }

        public function setDescription($description){
            $this->description = $description;
        }

        public function getDescription(){
            return $this->description;
        }

        public function setSprintDuration($sprintDuration){
            $this->sprintDuration = $sprintDuration;
        }

        public function getSprintDuration(){
            return $this->sprintDuration;
        }

        public function setDateProject($dateProject){
            $this->dateProject = $dateProject;
        }

        public function getDateProject(){
            return $this->dateProject;
        }

        public function setTimeUnitSprint($timeUnit){
            $this->timeUnitSprint = $timeUnit;
        }

        public function getTimeUnitSprint(){
            return $this->timeUnitSprint;
        }
    }

    /**
     * Permet de récupérer toutes les tâches d'un sprint
     */
    function getTasksBySprintAndProgress($idSprint, $progress) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        /* WHERE author = :author = ?? */
        $stmt = $db->prepare("SELECT * FROM task WHERE idSprint=:idSprint AND progress=:progress ORDER BY idTask ASC", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $data = [
            'idSprint' => $idSprint,
            'progress' => $progress
        ];
        $stmt->execute($data);
        $tasks = [];
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $tasks[] = $result;
        }
        return $tasks;
    }

    /**
     * Permet de récupérer l'unité de temps d'un sprint en chaine de charactère
     * (exemple: "semaine", "jour" ou "mois")
     */
    function timeUnitSprintToStr($timeUnitSprint){
        $strTimeUnit = "jours";
        if ($timeUnitSprint == WEEK){
            $strTimeUnit = "semaines";
        }
        if ($timeUnitSprint == MONTH){
            $strTimeUnit = "mois";
        }
        return $strTimeUnit;
    }

    /**
     * Permet de récupérer toutes les dépendances d'une tâche grâce à son ID auto-increment
     */
    function getDependenceByID($idTask) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("SELECT * FROM dependence WHERE id=:id ORDER BY idTask ASC", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $data = [
            'id' => $idTask
        ];
        $stmt->execute($data);
        $tasks = [];
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $tasks[] = $result;
        }
        return $tasks;
    }

    /**
     * Permet de récupérer tous les user stories liés à une tâche grâce à son ID auto-increment
     */
    function getLinkedUSByID($idTask) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("SELECT * FROM linkedus WHERE idTask=:idTask ORDER BY idUS ASC", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $data = [
            'idTask' => $idTask
        ];
        $stmt->execute($data);
        $userStories = [];
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $userStories[] = $result;
        }
        return $userStories;
    }

?>
