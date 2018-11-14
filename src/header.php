<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/data/Project.php');
    $instance = new Project;
    $projects = $instance->listProjects();
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
        <a href="#" data-target="mobile-demo" class="top-nav sidenav-trigger full hide-on-large-only"><i class="material-icons">menu</i></a>
    </div>
    <ul class="sidenav sidenav-fixed" id="mobile-demo" style="overflow: auto; transform: translateX(0%);">
        <li>
            <div class="user-view">
                <div class="background">
                    <img src="/img/backgound.jpg">
                </div>
                <a href="#user"><img class="circle" src="/img/avatar.png"></a>
                <a href="#name"><span class="white-text name">Hamza SEYE</span></a>
                <a href="#email"><span class="white-text email">hamza.seye@gmail.com</span></a>
            </div>
        </li>
        <li <?php echo $activeMenu1; ?>>
            <a href="/" class="waves-effect waves-teal"><i class="material-icons left">home</i>Accueil</a>
        </li>
        <li <?php echo $activeMenu2; ?>>
            <a href="/project/newProject.php" class="waves-effect waves-teal"><i class="material-icons left">add</i>Nouveau Projet</a>
        </li>
        <li <?php echo $activeMenu3; ?>>
            <ul class="collapsible">
                <li <?php echo $activeMenu3; ?>>
                    <a href="/project/listProjects.php" class="waves-effect waves-teal collapsible-header"><i class="material-icons left">list</i>Liste des Projets</a>
                    <?php
                    if (!empty($projects)) {
                    ?>
                    <div class="collapsible-body">
                        <ul>
                            <?php
                            foreach ($projects as $singleProject) {
                            ?>
                            <li>
                                <a href="/project/viewProject.php?projectName=<?php echo $singleProject['name']; ?>"><i class="material-icons left">chevron_right</i><?php echo $singleProject['name']; ?></a>
                            </li>
                            <?php } ?>
                        </ul>

                    </div>
                    <?php } ?>
                </li>
            </ul>
        </li>
</header>
