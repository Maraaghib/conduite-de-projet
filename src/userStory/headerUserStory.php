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
        <li class="logo">
            <a id="logo-container" href="/" class="brand-logo"></a>
        </li>
        <li <?php echo $activeMenu1; ?>>
            <a href="/project/newProject.php"><i class="material-icons left">add</i>Nouveau Projet</a>
        </li>
        <li <?php echo $activeMenu2; ?>>
            <a href="/project/listProjects.php"><i class="material-icons left">list</i>Liste des Projets</a>
        </li>
        <li <?php echo $activeMenu3; ?>>
            <a href="/userStory/addUserStory.php?projectName=<?php echo $projectName ?>"><i class="material-icons left">add</i>Ajouter une user Story</a>
        </li>
        <li <?php echo $activeMenu4; ?>>
            <a href="/userStory/listBacklog.php?projectName=<?php echo $projectName ?>"><i class="material-icons left">list</i>Backlog</a>
        </li>
    </ul>
</header>