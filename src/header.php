<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/data/Project.php');
    $instance = new Project;
    $projects = $instance->listProjects($_SESSION['email']);
?>

<header>
    <div class="navbar-fixed">
        <nav class="top-nav">
            <div class="container">
                <div class="nav-wrapper">
                    <div class="row">
                        <div class="col s12 m10 offset-m1">
                            <h5 class="header">Conduite de Projet</h5>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="container">
        <a href="#" data-target="mobile-demo" class="top-nav sidenav-trigger full hide-on-large-only"><i class="material-icons" aria-hidden="true">menu</i></a>
    </div>
    <ul class="sidenav sidenav-fixed" id="mobile-demo" style="overflow: auto; transform: translateX(0%);">
        <li>
            <div class="user-view">
                <div class="background">
                    <img src="/img/backgound.jpg" alt="SCRUM">
                </div>
                <a href="#user"><img class="circle" src="/img/avatar.png" alt="avatar"></a>
                <a href="#name"><span class="white-text name"><?php echo $_SESSION['username']; ?></span></a>
                <a href="#email"><span class="white-text email"><?php echo $_SESSION['email']; ?></span></a>
                <a href="/user/logout.php"><span class="white-text">Se déconnecter</span></a>
            </div>
        </li>
        <li <?php echo $activeMenu1; ?>>
            <a href="/" class="waves-effect waves-teal"><i class="material-icons left" aria-hidden="true">home</i>Accueil</a>
        </li>
        <li <?php echo $activeMenu2; ?>>
            <a id="newProject" href="/project/newProject.php" class="waves-effect waves-teal"><i class="material-icons left" aria-hidden="true">add</i>Nouveau Projet</a>
        </li>
        <li <?php echo $activeMenu3; ?>>
            <ul class="collapsible">
                <li <?php echo $activeMenu3; ?>>
                    <a id="listProjects" href="/project/listProjects.php" class="waves-effect waves-teal collapsible-header"><i class="material-icons left" aria-hidden="true">list</i>Liste des Projets</a>
                    <?php
                    if (!empty($projects)) {
                    ?>
                    <div class="collapsible-body">
                        <ul>
                            <?php
                            foreach ($projects as $singleProject) {
                            ?>
                            <li>
                                <a href="/project/viewProject.php?projectName=<?php echo $singleProject['projectName']; ?>"><i class="material-icons left" aria-hidden="true">chevron_right </i><?php echo $singleProject['projectName']; ?> </a>
                            </li>
                            <?php } ?>
                        </ul>

                    </div>
                    <?php } ?>
                </li>
            </ul>
        </li>
</header>
