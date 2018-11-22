<?php
    require_once('Database.php');

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
            $this->dateProject = "";
        }

        public static function newProject($projectName, $description, $sprintDuration, $dateProject) {
            $instance = new self();
            $instance->setProjectName($projectName);
            $instance->setDescription($description);
            $instance->setSprintDuration($sprintDuration);
            $instance->setDateProject($dateProject);

            return $instance;
        }

        public function hydrate($data) {
            if(isset($data['projectName'])) {
                $this->projectName = $data['projectName'];
            }
            if(isset($data['description'])) {
                $this->description = $data['description'];
            }
            if(isset($data['sprintDuration'])) {
                $this->sprintDuration = $data['sprintDuration'];
            }
            if(isset($data['dateProject'])) {
                $this->dateProject = $data['dateProject'];
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
                "projectName" => $projectName
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
            $errors = [];

            $query = $db->prepare("INSERT INTO project SET
                projectName     = :projectName,
                description     = :description,
                sprintDuration  = :sprintDuration,
                dateProject     = :dateProject
            ");

            $data = [
                'projectName'   => $this->getProjectName(),
                'description'   => $this->getDescription(),
                'sprintDuration'=> $this->getSprintDuration(),
                'dateProject'   => $this->getDateProject()
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
            $errors = [];

            $query = $db->prepare("UPDATE project SET projectName=:newProjectName WHERE projectName=:oldProjectName");
            $data = [
                "newProjectName" => $newProjectName,
                "oldProjectName" => $oldProjectName
            ];
            $result = $query->execute($data);
        }

        /**
        * Permet de mettre à jour la description d'un projet
        */
        public function updateProjectDescription($projectName, $description) {
            $db = Database::getDBConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $errors = [];

            $query = $db->prepare("UPDATE project SET description = \"$description\" WHERE projectName = \"$projectName\"");
            return $query->execute();
        }

        /**
        * Permet de mettre à jour la durée des sprints d'un projet
        */
        public function updateSprintDuration($projectName, $sprintDuration) {
            $db = Database::getDBConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $errors = [];

            $query = $db->prepare("UPDATE project SET sprintDuration = \"$sprintDuration\" WHERE projectName = \"$projectName\"");
            return $query->execute();
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

?>
