| Id  | Description | US lié | Dépendances | Temps estimé | Avancement |
| --- | ----------- | --------- | ----------- | ------------ | ---------- |
| T0 | Création de la base de données avec une table contenant:</br> **projectName**, **Id**, **description**, **priority** et **difficulty**</br>   | * |  | 1/2 jh | To do |
| T1 |  Création du dockercompose.yaml contenant un container apache et un container mysql | * |  |  1/2 jh | Done |
| T2a | Interface du fichier addUserStory.php, qui s'occupera de l'ajout d'un user story au backlog | #9 | | 1/2 jh | Done |
| T2b | Ajout d'un bouton ``Créer une user story`` sur la page du backlog. Une fois que l'on clique dessus on est renvoyé sur la page du formulaire pour la création d'un user story avec les champs à remplir et un bouton ``Annuler`` pour annuler et un bouton ``Valider`` pour terminer la création. L'utilisateur ne doit pouvoir valider que si tous les champs obligatoires (marqué avec une astérisque) sont remplis et que l'identifiant est bien unique.| #9 | T2a, T0 | 1,5 jh | Doing |
| T3a | Interface du fichier removeUserStory.php, qui supprimera un user story du backlog | #10 | | 1/2 jh | Done |
| T3b | Ajout d'un bouton en forme de corbeille à côté de chaque user story dans le backlog. Lorsque l'on clique dessus un popup s'affiche avec l'id de l'user story associé et qui demande confirmation pour la suppression. Un bouton ``Valider`` permet de valider la suppression et un bouton  ``Annuler`` permet de l'annuler | #10 | T3a, T0 | 1 jh | Doing |
| T4a | Ecriture d'un scénario de test pour l'ajout d'un user story | #9 |  | 1/2 jh | Doing |
| T4b | Exécution du test d'ajout d'un user story  et ajout des résultats dans l'historique des tests| #9 | T4a, T2b | 1/2 jh | To do |
| T5a | Ecriture d'un scénario de test pour la suppression d'un user story. | #10 |  | 1/2 jh | To do |
| T5b | Exécution du test de suppression d'un user story et ajout des résultats dans l'historique des tests | #10 | T5a, T3b | 1/2 jh | To do |
| T6a | Création d'un fichier nommé ``newProject.php`` dans le répertoire ``src/project`` pour implémenter la création d'un nouveau projet | #4 |  | 1/2 jh | Done |
| T6b | Implémentation d'un formulaire sur la page ``newProject.php`` avec un champ de texte pour le nom du projet, un autre (élément ``textarea`` de ``HTML``) pour la description, un autre pour la durée des sprints et un menu déroulant (élément ``select`` de ``HTML``) pour le choix de l'unité de la durée (semaines, mois, ...). En bas du formulaire, ajout de deux boutons ``Créer`` et ``Annuler`` qui, respectivement, valide (si tous les champs ont bien été repmlis) et annule (au quel cas on demande une confirmation par un popup) la création d'un  nouveau projet.   | #4 | T6a | 1 jh | Doing |
| T7a | Ecriture d'un scénario de test pour la création d'un nouveau projet | #4 |  | 1/2 jh | To do |
| T7b | Exécution du test de création d'un nouveau projet et ajout des résultats dans l'historique des tests  | #4 | T6b, T7a | 1/2 jh | To do |
| T8a | Création d'un fichier nommé ``listProjects.php`` dans le répertoire ``src/project`` pour implémenter l'affichage de tous les projets auxquels appartient un utilisateur | #8 |  | 1/2 jh | Done |
| T8b | Implémentation d'un ensemble de cards (carte utilisée sur Material Design) sur la page ``listProjects.php`` avec comme infomations sur chaque card: ``Nom du projet``, ``Description``, ``Propriétaire``, ``Modifié le`` et un bouton ``Ouvrir``. Les cards seront affichés les uns à la suite des autres (suivant la largeur de l'écran de l'utilisateur) et correspondent chacun à un projet. A chaque clique sur le bouton, une nouvelle page s'ouvre pour afficher tous les détails de ce projet  | #8 | T8a | 1,5 jh | Doing |
| T9a | Ecriture d'un scénario de test pour le listage de tous les projets | #8 |  | 1/2 jh | To do |
| T9b | Exécution du test de listage de tous les projets et ajout des résultats dans l'historique des tests  | #8 | T8b, T9a | 1/2 jh | To do |
