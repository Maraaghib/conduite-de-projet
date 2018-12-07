# Scénario pour le test de l'ajout d'une tâche

## Sur la page du viewProject.php dans l'onglet Sprints

- l'utilisateur clique sur un sprint
- l'utilisateur clique sur le bouton *AJOUTER UNE TÂCHE*

## Sur la page du formulaire d'ajout de tâche

- L'utilisateur renseigne chaque champ correctement et clique sur *CRÉER*
- l'utilisateur laisse le champ liste de dépendances vide mais remplit les autres correctement et clique sur *CRÉER*
- l'utilisateur laisse le champ US liés vide mais remplit les autres correctement et clique sur *CRÉER*
- l'utilisateur laisse les champs liste de dépendances et US liés vide mais remplit les autres correctement et clique sur *CRÉER*
- l'utilisateur tente d'ajouter une tâche avec un id déjà présent dans la base de données et clique sur *CRÉER*
- l'utilisateur rentre un nombre incorrect dans le champ temps estimé (négatif) et clique sur *CRÉER*
- l'utilisateur rentre une chaîne de caractères dans le champ temps estimé et clique sur *CRÉER*
- l'utilisateur ne renseigne pas un ou plusieurs champs obligatoires et clique sur *CRÉER*
- l'utilisateur supprime l'argument URI ("?projectName=[nomDuProjet]") et rafraîchit la page
- l'utilisateur supprime la valeur de l'argument URI et rafraîchit la page
- l'utilisateur modifie l'argument URI par celui d'un projet qui n'existe pas et rafraîchit la page
- L'utilisateur clique sur le bouton *ANNULER*
