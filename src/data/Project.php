<?php
    require_once('Database.php');

    define("AUTHOR_ARG", "author");
    define("PROJECT_NAME_ARG", "projectName");
    define("DESCRIPTION_ARG", "description");
    define("SPRINT_DURATION_ARG", "sprintDuration");
    define("DATE_PROJECT_ARG", "dateProject");
    define("DAY", 1);
    define("WEEK", 2);
    define("MONTH", 3);
    define("BASE_URL_VIEW_PROJECT",'/project/viewProject.php?projectName=');
    define("ERROR_URL", '/error.php');

    /**
     * Classe Project contenant les inormations d'un projet
     */
    class Project {

        private $author;
        private $projectName;
        private $description;
        private $sprintDuration;
        private $dateProject;

        public function __construct() {
            $this->author ="";
            $this->projectName = "";
            $this->description = "";
            $this->sprintDuration = "";
            $this->timeUnitSprint = "";
            $this->dateProject = "";
        }

        public static function newProject($author, $projectName, $description, $sprintDuration, $dateProject, $timeUnitSprint) {
            $instance = new self();
            $instance->setAuthor($author);
            $instance->setProjectName($projectName);
            $instance->setDescription($description);
            $instance->setSprintDuration($sprintDuration);
            $instance->setDateProject($dateProject);
            $instance->setTimeUnitSprint($timeUnitSprint);

            return $instance;
        }

        public function hydrate($data) {
            if(isset($data[AUTHOR_ARG])) {
                $this->author = $data[AUTHOR_ARG];
            }
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
         * Permet de récupérer l'id auto-increment d'un projet
         */
        public function getProjectID($author, $projectName) {
            $db = Database::getDBConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $db->prepare("SELECT idAI FROM project WHERE author=:author AND projectName=:projectName");
            $data = [
                'author'      => $author,
                'projectName' => $projectName
            ];
            $stmt->execute($data);

            $projectID = $stmt->fetch()['idAI'];
            return intval($projectID);
        }

        /**
         * Permet de récupérer tous les projets (d'un user)
         */
        public function listProjects($user) {
            $db = Database::getDBConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            /* WHERE author = :author = ?? */
            $stmt = $db->prepare("SELECT * FROM project WHERE author=:author ORDER BY idAI ASC", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $data = [
                'author' => $user
            ];
            $stmt->execute($data);
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
                author          = :author,
                projectName     = :projectName,
                description     = :description,
                sprintDuration  = :sprintDuration,
                dateProject     = :dateProject,
                timeUnitSprint  = :timeUnitSprint
            ");

            $data = [
                'author'        => $this->getAuthor(),
                'projectName'   => $this->getProjectName(),
                'description'   => $this->getDescription(),
                'sprintDuration'=> $this->getSprintDuration(),
                'dateProject'   => $this->getDateProject(),
                'timeUnitSprint'=> $this->getTimeUnitSprint()
            ];

            $query->execute($data);
            redirect('/project/listProjects.php');
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
        public function setAuthor($author){
            $this->author = $author;
        }

        public function getAuthor(){
            return $this->author;
        }

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

    /**
    * Permet de mettre à jour la progression et le sprint d'une tâche
    */
    function updateTaskSprintAndProgress($idOldSprint, $idTask, $idNewSprint, $progress) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $db->prepare("UPDATE task SET idSprint=:idNewSprint, progress=:progress WHERE idSprint=:idOldSprint AND idTask=:idTask");
        $data = [
            "idNewSprint" => $idNewSprint,
            "progress" => $progress,
            "idOldSprint" => $idOldSprint,
            "idTask" => $idTask
        ];
        $query->execute($data);
    }

    /**
     * Permet de récupérer tous les utilisateurs de l'application
     */
    function getAllUsers() {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("SELECT * FROM user ORDER BY name ASC", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt->execute();
        $allUsers = [];
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $allUsers[] = $result;
        }
        return $allUsers;
    }

    /**
     * Permet de récupérer tous les collaborateurs d'un projet
     */
    function getCollaborators($projectID) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare("SELECT * FROM collaboration WHERE projectID=:projectID ORDER BY dateAdded ASC", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $data = [
            'projectID' => $projectID
        ];
        $stmt->execute($data);
        $collaborators = [];
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $collaborators[] = $result;
        }
        return $collaborators;
    }

    /**
    * Permet d'ajouter un collaborateur à un projet
    */
    function addCollaborator($projectID, $userEmail) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $db->prepare("INSERT INTO collaboration SET
            projectID   = :projectID,
            userEmail   = :userEmail,
            dateAdded   = :dateAdded
        ");

        $data = [
            'projectID' => $projectID,
            'userEmail' => $userEmail,
            'dateAdded' => date('Y-m-d')
        ];

        $query->execute($data);
    }

    /**
    * Permet de retirer un collaborateur d'un projet
    */
    function removeCollaborator($projectID, $userEmail) {
        $db = Database::getDBConnection();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $db->prepare("DELETE FROM collaboration WHERE projectID = :projectID AND userEmail = :userEmail");

        $data = [
            'projectID' => $projectID,
            'userEmail' => $userEmail
        ];

        $query->execute($data);
    }

?>
