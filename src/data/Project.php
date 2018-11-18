<?php
    require_once('Database.php');

    /**
     * Classe Project contenant les inormations d'un projet
     */
    class Project {

        private $projectName;
        private $description;
        private $sprintDuration;
        private $dateProject;

        public function __construct() {
            $this->projectName         = "";
            $this->description  = "";
            $this->sprintDuration     = "";
            $this->dateProject  = "";
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
            $stmt = $db->prepare("SELECT * FROM project WHERE projectName='$projectName'");
            $stmt->execute();

            $project = $stmt->fetch();

            return $project;
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

            $query = $db->prepare("UPDATE project SET projectName = \"$newProjectName\" WHERE projectName = \"$oldProjectName\"");
            $result = $query->execute();

            return $result;
        }

        /**
        * Permet de mettre à jour la description d'un projet
        */
        public function updateProjectDescription($projectName, $description) {
            $db = Database::getDBConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $errors = [];

            $query = $db->prepare("UPDATE project SET description = \"$description\" WHERE projectName = \"$projectName\"");
            $result = $query->execute();

            return $result;
        }

        /**
        * Permet de mettre à jour la durée des sprints d'un projet
        */
        public function updateSprintDuration($projectName, $sprintDuration) {
            $db = Database::getDBConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $errors = [];

            $query = $db->prepare("UPDATE project SET sprintDuration = \"$sprintDuration\" WHERE projectName = \"$projectName\"");
            $result = $query->execute();

            return $result;
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
            $nbProjects = $query->fetch()["numProjectName"];

            return $nbProjects;
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

?>
