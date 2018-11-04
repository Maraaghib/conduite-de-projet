| Id  | Description | Issue lié | Dépendances | Temps estimé | Avancement |
| --- | ----------- | --------- | ----------- | ------------ | ---------- |
| T0 | Création de la base de données avec une table contenant:</br> **projectName**, **Id**, **description**, **priority** et **difficulty**</br>   | * |  | 1/2 jh | To do |
| T1 |  Création du dockercompose.yaml contenant un container apache et un container mysql | * |  |  1/2 jh |  Done |
| T2a | Interface du fichier addIssue.php, qui s'occupera de l'ajout d'issue au backlog | #9 | T0 | 1/2 jh | Done |
| T2b | Ajout d'un bouton "add issue" sur la page du backlog. Une fois que l'on clique dessus on est renvoyé sur la page du formulaire pour la création d'une issue avec les champs à remplir et un bouton cancel pour annuler et un bouton OK pour terminer la création. L'utilisateur ne doit pouvoir valider que si tous les champs obligatoires (marqué avec une astérisque) sont remplis et que l'identifiant est bien unique.| #9 | T2a| 1,5 jh | Doing |
| T3a | Interface du fichier removeIssue.js, qui supprimera une issue du backlog | #10 | T0 | 1/2 jh | To do |
| T3b | Ajout d'un bouton en forme de corbeille à côté de chaque issue dans le backlog. Lorsque l'on clique dessus un popup s'affiche avec l'id de l'issue associé et qui demande confirmation pour la suppression. Un bouton ok permet de valider la suppression et un bouton cancel permet de l'annuler | #10 |T3a| 1 jh | To do |
| T4a | Ecriture d'un scénario de test pour l'ajout d'issue | #9 |  | 1/2 jh | To do |
| T4b | Exécution du test d'ajout d'issue  et ajout des résultats dans l'historique des tests| #9 | T4a, T2b| 1/2 jh | To do |
| T5a | Ecriture d'un scénario de test pour la suppression d'une issue. | #10 |  | 1/2 jh | To do |
| T5b | Exécution du test de suppression d'une issue et ajout des résultats dans l'historique des tests | #10 | T5a, T3b| 1/2 jh | To do |
