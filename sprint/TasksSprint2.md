| Id  | Description | US lié | Dépendances | Temps estimé | Avancement | Affectée à |
| --- | ----------- | ------ | ----------- | ------------ | ---------- | ---------- |
| T3b | Ajout d'un bouton en forme de corbeille à côté de chaque user story dans le backlog. Lorsque l'on clique dessus un popup s'affiche avec l'id de l'user story associé et qui demande confirmation pour la suppression. Un bouton ``Supprimer`` permet de valider la suppression et un bouton  ``Annuler`` permet de l'annuler | #10 | T3a, T0 | 1 jh | Done | Guillaume |
| T4a | Ecriture d'un scénario de test pour l'ajout d'un user story | #9 |  | 1/2 jh | Done | Guillaume |
| T4b | Exécution du test d'ajout d'un user story  et ajout des résultats dans l'historique des tests| #9 | T4a, T2b | 1/2 jh | To do | Guillaume |
| T5a | Ecriture d'un scénario de test pour la suppression d'un user story. | #10 |  | 1/2 jh | To do | Guillaume |
| T5b | Exécution du test de suppression d'un user story et ajout des résultats dans l'historique des tests | #10 | T5a, T3b | 1/2 jh | To do | Guillaume |
| T7a | Ecriture d'un scénario de test pour la création d'un nouveau projet | #4 |  | 1/2 jh | To do | Serigne |
| T7b | Exécution du test de création d'un nouveau projet et ajout des résultats dans l'historique des tests  | #4 | T6b, T7a | 1/2 jh | To do | Serigne |
| T9a | Ecriture d'un scénario de test pour le listage de tous les projets | #8 |  | 1/2 jh | To do | Serigne |
| T9b | Exécution du test de listage de tous les projets et ajout des résultats dans l'historique des tests  | #8 | T8b, T9a | 1/2 jh | To do | Serigne |
| T10a | Création d'un fichier nommé ``viewProject.php`` dans le répertoire ``src/project`` pour implémenter la visualisation de tous les détails d'un projet | #20 |  | 1/2 jh | Done | Serigne |
| T10b | Implémentation d'une page ``viewProject.php`` avec six (6) ``tabs`` (onglets): ``Description``, ``Backlog``, ``Sprints``, ``Burndown chart``, ``Contributeurs`` et ``Paramètres``. Le tab ``Description`` est selectionné par défaut et affiche le nom du projet, sa description, son propriétaire (ou la personne qui l'a créé) et sa date de création. Ces deux dernières informations seront sous-forme d'un ``chips``; Le tab ``Backlog`` permet d'afficher le tableau des user stories; Le tab ``Sprints`` permet d'afficher le tableau des tâches; Le tab ``Burndown chart`` permet de visualiser le graphique d'avancement; Le tab ``Contributeurs``, si l'on clique dessus, affiche les différents développeurs du projets y compris le propriétaire et le tab ``Paramètres`` permet d'avoir le formulaire pour modifier les détails du projet et un bouton pour le supprimer  | #20 | T10a | 2 jh | Done | Serigne |
| T11 | Ajout de la création de la table sprint dans ``createTable.sql`` contenant les champs ``id``,``projectName``, ``dateDébut``, ``dateFin``. Le champs ``id`` est la clé primaire, le champs ``projectName`` est une clé étrangère sur le champs ``projectName`` de la table ``project``. Il faut s'assurer que la date de plusieurs sprints d'un même projets ne se chevauche pas. | #13 |  | 1/2 jh | To do |
| T12 | Ajout de la création de la table sprintUserStory dans ``createTable.sql`` contenant les champs ``projectName``, ``idSprint``, ``idUserStory`` avec ``projectName`` et ``idSprint`` des clés étrangères sur ``projectName``et ``id`` de la table sprint et ``idUserStory`` une clé étrangère sur ``id`` de la table backlog. Les clés étrangères on l'option ONDELETE CASCADE. | #13 | | 1/2 jh | To do |
| T13a | Création d'un fichier nommé ``newSprint.php`` dans le répertoire ``src/sprint`` pour la création de sprints | #13 | T11, T12 | 1/2 jh | To do |
| T13b | Implémentation de la page ``newSprint.php``. Ajouter un bouton ``Ajouter un sprint`` dans la visualisation des sprints dans ``viewProject.php`` qui renvoie vers un formulaire de la page ``newSprint.php`` pour la création d'un nouveau sprint. Le formulaire contient un champ date pour renseigner la date de début du sprint, qui ne devra pas être passé, et un champ pour sélectionner la ou les users stories à réaliser pendant le sprint. En bas du formulaire un bouton ``Valider`` permet de valider la création si les champs sont corrects et un bouton ``Annuler`` permet de l'annuler et de revenir sur la page précédente. | #13 | T13a | 2 jh |To do |
| | Ecriture d'un scénario de test pour la modification d'user story | #12 | | 1/2 jh | To do |  |
| | Exécution du test de modification d'un user story et ajout des résultats dans l'historique des tests | #12 | | 1/2 jh | To do |
| | Ecriture d'un scénario de test pour la création de sprint | #13| | 1/2 jh | To do |  |
| | Exécution du test de création de sprint et ajout des résultats dans l'historique des tests | #13 | | 1/2 jh | To do |
| | Ecriture d'un scénario de test pour l'ajout de taches dans un sprint | #15| | 1/2 jh | To do |  | 
| | Exécution du test d'ajout de taches dans un sprint et ajout des résultats dans l'historique des tests | #15 | | 1/2 jh | To do |
| | Ecriture d'un scénario de test pour le listage des taches d'un sprint | #18| | 1/2 jh | To do |  | 
| | Exécution du test de listage des taches d'un sprint et ajout des résultats dans l'historique des tests | #18 | | 1/2 jh | To do |
| | Ecriture d'un scénario de test pour le listage des sprints | #19 | | 1/2 jh | To do |  | 
| | Exécution du test de listage des sprints et ajout des résultats dans l'historique des tests | #19 | | 1/2 jh | To do |
| | Ecriture d'un scénario de test pour la visualisation d'un projet | #20 | | 1/2 jh | To do |  | 
| | Exécution du test de visualisation d'un projet et ajout des résultats dans l'historique des tests | #20 | | 1/2 jh | To do |
| | Ecriture d'un scénario de test pour la modification d'un projet | #21 | | 1/2 jh | To do |  |
| | Exécution du test de modification d'un projet et ajout des résultats dans l'historique des tests | #21 | | 1/2 jh | To do |
