Résultats de sonar:

[![quality gate](https://sonarcloud.io/api/project_badges/measure?project=Maraaghib_conduite-de-projet&metric=alert_status)](https://sonarcloud.io/dashboard?id=Maraaghib_conduite-de-projet)
[![code smells](https://sonarcloud.io/api/project_badges/measure?project=Maraaghib_conduite-de-projet&metric=code_smells)](https://sonarcloud.io/dashboard?id=Maraaghib_conduite-de-projet)
[![bugs](https://sonarcloud.io/api/project_badges/measure?project=Maraaghib_conduite-de-projet&metric=bugs)](https://sonarcloud.io/dashboard?id=Maraaghib_conduite-de-projet)

Build travis:

[![Build Travis Status](https://travis-ci.com/Maraaghib/conduite-de-projet.svg?branch=master)](https://travis-ci.com/Maraaghib/conduite-de-projet)

# Backlog:
La difficulté est noté de manière croissante suivant une suite de Fibonacci (1,2,3,5...) : 1 étant facile et 5 étant difficile. </br>
La priorité est noté de la manière suivante: 1 = haute, 2 = moyenne et 3 = basse.

| Id  | Description | Difficulté | Priorité | Sprint |
| --- | ----------- | -------- | ----------- | ----------- |
| #1 | **En tant que** visiteur, </br>**je veux** pouvoir créer un compte en renseignant obligatoirement un e-mail, mon nom et un mot de passe </br>**afin de** devenir développeur et pouvoir accéder à des projets existants ou en créer | 2 | 2 | 3 |
| #2 | **En tant que** développeur, </br>**je veux** pouvoir me connecter en renseignant mon e-mail et mon mot de passe </br>**afin d'** accéder à mon espace personnel | 2 | 2 | 3 |
| #3 | **En tant que** développeur, </br>**je veux** pouvoir me déconnecter </br>**afin de** terminer ma session | 1 | 2 | 3 |
| #4 | **En tant que** développeur, </br>**je veux** pouvoir créer un nouveau projet avec obligatoirement un nom (comme identifiant unique) et une durée pour les sprints et optionnellement une description avec la génération d'un backlog vide </br>**afin de** démarrer l'organisation de mon projet | 2 | 1 | 1 |
| #5 | **En tant que** développeur, </br>**je veux** pouvoir supprimer un projet en renseignant mon mot de passe pour confirmation </br>**afin d'** y mettre fin ou l'abandonner | 2 | 1 | 3 |
| #6 | **En tant que** développeur, </br>**je veux** pouvoir ajouter d'autres développeurs à un projet existant </br>**afin de** constituer une équipe pour ce projet | 2 | 2 | 3 |
| #7 | **En tant que** développeur, </br>**je veux** pouvoir retirer un développeur d'un projet </br>**afin qu'** il ne puisse plus y accéder | 2 | 2 | 3 |
| #8 | **En tant que** développeur, </br>**je veux** pouvoir lister les projets existants auxquels j'appartiens </br>**afin d'** y accéder | 1 | 2 | 1 |
| #9 | **En tant que** développeur, </br>**je veux** pouvoir ajouter un user story avec obligatoirement un identifiant unique, une descripion, une priorité et une difficulté dans le backlog </br>**afin d'** exprimer un nouveau besoin d'un projet existant | 3 | 1 | 1 |
| #10 | **En tant que** développeur, </br>**je veux** pouvoir supprimer un user story existant </br>**afin de** le retirer définitivement du backlog | 2 | 1 | 2 |
| #11 | **En tant que** développeur, </br>**je veux** pouvoir afficher le backlog du projet </br>**afin de** lister touts les user stories | 1 | 1 | 1 |
| #12 | **En tant que** développeur, </br>**je veux** pouvoir modifier un user story du backlog </br>**afin de** le mettre à jour | 3 | 1 | 2 |
| #13 | **En tant que** développeur, </br>**je veux** pouvoir créer un sprint dans un projet avec obligatoirement les usre stories à réaliser créant automatiquement les tâches de tests (écriture du test et execution du test) reliés aux user stories </br>**afin de** planifier le projet | 5 | 3 | 2 |
| #14 | **En tant que** développeur, </br>**je veux** avoir un burndown chart (graphique représentant la difficulté cumulée des user stories non terminée en fonction du temps) automatisé dans chacun de mes projets qui s'actualisera a la fin de chaque sprint </br>**afin d'** observer facilement l'évolution de mes projets | 5 | 3 | 3 |
| #15 | **En tant que** développeur, </br>**je veux** pouvoir ajouter une tâche dans un sprint avec obligatoirement un Identifiant, une description, le temps estimé, l'avancement de la tâche et la lier à un des user stories et optionnellement sa (ses) dépendance(s) aux autres tâches </br>**afin d'** organiser le travail d'un sprint | 3 | 3 | 3 |
| #16 | **En tant que** développeur, </br>**je veux** pouvoir supprimer une tâche </br>**afin de** la retirer d'un sprint | 2 | 3 | 3 |
| #17 | **En tant que** développeur, </br>**je veux** pouvoir glisser une tâche d'une cellule ``TASKS`` à ``TODO``, à ``DOING`` et à ``DONE`` </br>**afin d'** exprimer respectivement le fait qu'une tâche n'est pas encore faite, qu'elle est en train d'être faite et qu'elle est déjà faite. | 4 | 3 | 3 |
| #18 | **En tant que** développeur, </br>**je veux** lister les tâches d'un sprint </br>**afin d'** y accéder | 1 | 3 | 2 |
| #19 | **En tant que** développeur, </br>**je veux** lister les sprints d'un projet </br>**afin d'** y accéder | 1 | 3 | 2 |
| #20 | **En tant que** développeur, </br>**je veux** pouvoir visualiser un projet afin d'accéder à ses différentes informations: Nom, Description, Auteur, développeurs colloborateurs, date de création, liens vers le backlog, les sprints, le burndown chart et paramètres (pour la modification et la suppression) </br>**afin d'** y accéder | 1 | 2 | 2 |
| #21 | **En tant que** développeur, </br>**je veux** pouvoir modifier les informations d'un projet: Nom, Description, Durée des sprints </br>**afin d'** y accéder | 2 | 3 | 2 |


### Difficulté totale: 47
