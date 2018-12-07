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
            $instance->author = $author;
            $instance->projectName = $projectName;
            $instance->description = $description;
            $instance->sprintDuration = $sprintDuration;
            $instance->dateProject = $dateProject;
            $instance->timeUnitSprint = $timeUnitSprint;

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
            $stmt1 = $db->prepare("SELECT * FROM project WHERE author=:user ORDER BY idAI ASC", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt2 = $db->prepare("SELECT * FROM project WHERE idAI=(SELECT projectID FROM collaboration WHERE userEmail=:user)", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

            $data = [
                'user' => $user
            ];
            $stmt1->execute($data);
            $stmt2->execute($data);

            $projects = [];
            while ($result = $stmt1->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                $projects[] = $result;
            }
            while ($result = $stmt2->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
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
                'author'        => $this->author,
                'projectName'   => $this->projectName,
                'description'   => $this->description,
                'sprintDuration'=> $this->sprintDuration,
                'dateProject'   => $this->dateProject,
                'timeUnitSprint'=> $this->timeUnitSprint
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
