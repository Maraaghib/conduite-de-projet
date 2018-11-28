| Id  | Description | US lié | Dépendances | Temps estimé | Avancement | Affectée à |
| --- | ----------- | ------ | ----------- | ------------ | ---------- | ---------- |
| T4b | Exécution du test d'ajout d'un user story  et ajout des résultats dans l'historique des tests| #9 | T4a, T2b | 1/2 jh | Doing | Guillaume |
| T17a | Ecriture d'un scénario de test pour la modification d'user story | #12 | | 1/2 jh | To do | Amelozara |
| T17b | Exécution du test de modification d'un user story et ajout des résultats dans l'historique des tests | #12 | T16b, T17a | 1/2 jh | To do | Amelozara |
| T18b | Exécution du test de création de sprint et ajout des résultats dans l'historique des tests | #13 | T12b, T18a | 1/2 jh | To do | Guillaume |
| T19a | Ecriture d'un scénario de test pour l'ajout de tâches dans un sprint | #15| | 1/2 jh | To do | Amelozara |
| T19b | Exécution du test d'ajout de tâches dans un sprint et ajout des résultats dans l'historique des tests | #15 | T19a, T24b | 1/2 jh | To do | Amelozara |
| T21b | Exécution du test de listage des sprints et ajout des résultats dans l'historique des tests | #19 | T15b, T21a | 1/2 jh | To do | Guillaume |
| T22a | Ecriture d'un scénario de test pour la visualisation d'un projet | #20 | | 1/2 jh | To do | Serigne | 
| T22b | Exécution du test de visualisation d'un projet et ajout des résultats dans l'historique des tests | #20 | T10b, T22a | 1/2 jh | To do | Serigne |
| T23a | Ecriture d'un scénario de test pour la modification d'un projet | #21 | | 1/2 jh | To do | Serigne |
| T23b | Exécution du test de modification d'un projet et ajout des résultats dans l'historique des tests | #21 | T14b, T23a | 1/2 jh | To do | Serigne |
| T24a | Interface du fichier ``addTask.php`` dans le répertoire ``src/task`` qui ajoutera une tâche à un sprint | #15 | T25, T26, T27 | 1/2 jh | To do | Amelozara |
| T24b | Implémentation d'un formulaire sur la page ``addTask.php`` contenant un champ pour l'identifiant, un pour la description, un pour le temps estimé, un pour l'avancement de la tâche et enfin un pour la lier à un ou des user stories et optionnellement un pour sa (ses) dépendance(s) aux autres tâches. Dans ce formulaire un bouton ``créer`` valide la création et renvois dans l'onglet ``Sprints`` de ``viewProject.php``, si tous les champs sont correct. Un bouton ``Annuler``, quant à lui, permet d'annuler la création de sprint et renvois à la page précédente. Ce formulaire sera accessible grâce à un bouton ``Ajouter un nouveau sprint`` diponible dans l'onglet ``Sprints``(au niveau du titre ``Sprints``) de la page ``viewProject.php``.  | #15 | T24a | 1/2 jh | Doing | Amelozara |
| T27| Création de la table ``User`` dans ``/Docker/createTable.sql`` contenant les champs ``email``(clé primaire), ``name``, ``password``(qui devra être hashé), ``key``(pour la vérification de compte) et ``active``(pour savoir si le compte à été vérifié).| #1, #2 | | 1/2 jh | Done | Guillaume |
| T28a | Interface du fichier ``register.php`` dans le répertoire ``user`` qui s'occupera de la création d'un compte dévelopeur pour un visiteur | #1 | T27 | 1/2 jh | To do | Guillaume |
| T28b | Implémentation d'un formulaire sur la page ``register.php`` contenant les champs ``email``, ``nom``, ``mot de passe`` et ``confirmer le mot de passe`` qui sont obligatoire. Un bouton ``Créer le compte`` permet de terminer la création si les champs sont rentré correctement et un bouton ``Annuler`` nous renvoit sur la page ``login.php``. Lorsque l'utilisateur valide la création du compte un email d'activation est envoyé à l'adresse mail précisé et une fois le compte activer avec le mail le visteur devient dévelopeur et est renvoyé sur la page ``listProject.php``. Le mot de passe devra être hashé avant d'être stocké afin de le sécuriser. La page est accessible via un bouton ``créer un compte`` présent sur la page ``login.php``. | #1 | T28a | 1.5 jh | To do | Guillaume |
| T28c | Ecriture d'un scénario de test pour la création d'un compte dévelopeur | #1 | | 1/2 jh | To do | Guillaume |
| T28d | Execution du test de création d'un compte dévelopeur et ajout des résultats dans l'historique des tests | #1 | T28c, T28b | 1/2 jh | To do | Guillaume |
| T29a | Interface du fichier ``login.php`` dans le répertoire ``src/user`` qui s'occupera de la connection d'un visiteur | #2 | T27 | 1/2 jh | To do | Guillaume |
| T29b | Implémentaion d'un formulaire sur la page ``login.php`` aves les champs ``mail`` et ``mot de passe`` obligatoire. Un bouton ``Connection`` en bas du formulaire de finaliser la connection de l'utilisateur si les champs entrée sont correct et que le visiteur à un compte actif. Si le compte n'éxiste pas alors il est renvoyé sur la page ``register.php`` avec le champ ``mail`` préremplis. Si le compte n'est pas actif il est renvoyer sur une page avec un message lui demandant d'activer son compte, avec le lien d'activation présent dans le mail qu'il à reçu lors de la création du compte, et si un bouton ``Renvoyer le lien d'activation`` est présent afin de revoyer le mail. Lorsqu'un visiteur tente d'accéder à une des pages de l'application, il est renvoyé sur la page ``login.php`` afin qu'il se connecte pour pouvoir accéder au reste de l'application. Lorsque qu'un dévelopeur est authentifié son nom apparait en haut à droite de chaque page. | #2 | T29a | 1 jh | To do | Guillaume |
| T29c | Ecriture d'un scénario de test pour la connection d'un visiteur  | #2 |  | 1/2 jh | To do | Guillaume |
| T29d | Execution du test de connection d'un visiteur et ajout des résultats dans l'historique des tests | #2 | T29c, T29b | 1/2 jh | To do | Guillaume |
| T30a | Interface du fichier ``logout.php`` dans le répertoire ``src/user`` qui s'occupera de la déconnection d'un dévelopeur | #3 | | 1/2 jh | To do | Guillaume |
| T30b | Implémentation du fichier ``logout.php`` qui à partir d'un bouton ``se déconnecter``, présent en haut à droite(à droite du nom) de chaque page accédé par un dévelopeur authentifié, déconnecte le developeur en le faisant redevenir visiteur et en le revoyant sur la page ``login.php``. | #3 | T30a | 1 jh | To do | Guillaume |
| T30c | Ecriture d'un scénario de test pour la déconnection d'un dévelopeur | #3 | | 1/2 jh | To do | Guillaume |
| T30d | Execution du test de déconnection d'un dévelopeur et ajout des résultats dans l'historique des tests | #3 | T30b | 1/2 jh | To do | Guillaume |
| T31a | Création d'un fichier nommé ``deleteProject.php`` dans le répertoire ``src/project`` pour implémenter la suppression d'un projet | #5 |  | XX jh | Done | Serigne |
| T31b | Sur la page de visualisation d'un projet, sous l'onglet ``PARAMETRES``, nous implémentons une section nommé ``SUPPRESSION`` dans laquelle il n'y a qu'un seul bouton ``SUPPRIMER CE PROJET``. Lorsque l'on clique sur ce dernier, un popup (modal) est ouvert avec deux champs de texte obligatoires: l'un pour confirmer le nom du projet à supprimer et l'autre  (de type ``password``) pour confirmer le mot de passe de l'utilisateur courant. En-dessous de ces deux champs, il y a deux boutons: l'un de type ``submit`` (appelé ``SUPPRIMER``) qui, reste désactivé tant que le nom saisi dans le premier champ est différent du nom du projet, permet de valider la suppression et l'autre de type ``reset`` (appelé ``ANNULER``) permet de réinitialiser tous les champs du formulaire, de fermer le popup et par conséquent, d'annuler la suppression du projet. | #5 | T0, T31a | 1/2 jh | Done | Serigne |
| T31c | Ecriture d'un scénario de test pour la suppression d'un projet | #5 |  | 1/2 jh | To do | Serigne |
| T31d | Exécution du test de suppression d'un projet et ajout des résultats dans l'historique des tests | #5 | T31b, T31c | 1/2 jh | To do | Serigne |
| T32a | Tâche de Conception | #6 | TXX | XX jh | To do | Non défini |
| T32b | Tâche d'Implémentation | #6 | TXX | XX jh | To do | Non défini |
| T32c | Tâche de Scénario de Test | #6 | TXX | XX jh | To do | Non défini |
| T32d | Tâche d'Exécution de Test | #6 | TXX | XX jh | To do | Non défini |
| T33a | Tâche de Conception | #7 | TXX | XX jh | To do | Non défini |
| T33b | Tâche d'Implémentation | #7 | TXX | XX jh | To do | Non défini |
| T33c | Tâche de Scénario de Test | #7 | TXX | XX jh | To do | Non défini |
| T33d | Tâche d'Exécution de Test | #7 | TXX | XX jh | To do | Non défini |
| T34a | Tâche de Conception | #14 | TXX | XX jh | To do | Non défini |
| T34b | Tâche d'Implémentation | #14 | TXX | XX jh | To do | Non défini |
| T34c | Tâche de Scénario de Test | #14 | TXX | XX jh | To do | Non défini |
| T34d | Tâche d'Exécution de Test | #14 | TXX | XX jh | To do | Non défini |
| T35a | Tâche de Conception | #16 | TXX | XX jh | To do | Non défini |
| T35b | Tâche d'Implémentation | #16 | TXX | XX jh | To do | Non défini |
| T35c | Tâche de Scénario de Test | #16 | TXX | XX jh | To do | Non défini |
| T35d | Tâche d'Exécution de Test | #16 | TXX | XX jh | To do | Non défini |
| T36a | Tâche de Conception | #17 | TXX | XX jh | To do | Non défini |
| T36b | Sur la partie de visualisation de la liste des tâches, nous implémentons la fonctionnalité de "Drag-and-Drop" (Glisser-Déposer, en français) des post-it de telle sorte que l'on peut changer l'avancement d'une tâche juste en la déposant dans une colonne: ``TO DO`` pour dire que cette tâche est à faire, ``DOING`` pour exprimer que cette tâche est en train d'être faite et ``DONE``pour spécifier que cette tâche est déjà faite. Nous implémentons aussi le fait de pouvoir déplacer une tâche dun sprint à un autre avec le "drag-and-drop". | #17 | T13b, T15b | 2 jh | Doing | Serigne |
| T36c | Ecriture d'un scénario de test pour le drag-and-drop des tâches et leurs modifications | #17 |  | 1/2 jh | To do | Serigne |
| T36d | Tâche d'Exécution de Test | #17 | TXX | XX jh | To do | Non défini |
| T37 | Création de la table ``collaboration`` dans ``/Docker/createTable.sql`` contenant le champ ``userEmail``, une clé étrangère vers le champ ``email`` de la table ``user`` mais contenant également le champ ``idProject``, une clé étrangère vers le champ ``idAI`` de la table ``project`` | #6, #7 | | 1/2 jh | To do | Non défini |
