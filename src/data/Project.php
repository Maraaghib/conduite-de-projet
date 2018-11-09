<?php
    include_once('Database.php');

    /**
     * Classe Project contenant les inormations d'un projet
     */
    class Project {

        private $name;
        private $description;
        private $sprintDuration;
        private $dateProject;

        public function __construct() {
            $this->name         = "";
            $this->description  = "";
            $this->sprintDuration     = "";
            $this->dateProject  = "";
        }

        public static function newProject($name, $description, $sprintDuration, $dateProject) {
            $instance = new self();
            $instance->setName($name);
            $instance->setDescription($description);
            $instance->setSprintDuration($sprintDuration);
            $instance->setDateProject($dateProject);

            return $instance;
        }

        public function hydrate($data) {
            if(isset($data['name'])) {
                $this->name = $data['name'];
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
         * Permet de récupérer tous les projets (d'un user)
         */
        public function listProjects(/*idUser*/) {
            $db = Database::getDBConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            /* WHERE author = :author = ?? */
            $stmt = $db->prepare("SELECT * FROM project ORDER BY iden DESC", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
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
        * Permet d sauvegarder un nouveau projet
        */
        public function saveProject() {
            $db = Database::getDBConnection();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $errors = [];

            $query = $db->prepare("INSERT INTO project SET
                name            = :name,
                description     = :description,
                sprintDuration  = :sprintDuration,
                dateProject     = :dateProject
            ");

            $data = [
                'name'          => $this->getName(),
                'description'   => $this->getDescription(),
                'sprintDuration'=> $this->getSprintDuration(),
                'dateProject'   => $this->getDateProject()
            ];

            $result = $query->execute($data);
            header('Location: /project/listProjects.php');
            return $result;
        }

        /*************** Getters et setters ******************/
        public function setName($name){
            $this->name = $name;
        }

        public function getName(){
            return $this->name;
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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['createProject'])) {
        $name = $_POST['projectName'];
        $description = $_POST['projectDescription'];
        $sprintDuration = (int) $_POST['sprintDuration'];
        $dateProject = date('Y,m,d');

        $project = Project::newProject($name, $description, $sprintDuration, $dateProject); // Crée une nouvelle instance de Project avec des paramètres

        // if ($project->alreadyExists()) {
        //     $projectExists = true;
        // }
        // else {
        //     $projectExists = false;
            $project->saveProject();
        // }

    }

?>
