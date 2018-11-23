# Scénario pour le test de l'ajout d'une userStory

## Sur la page du viewProject.php dans l'onglet Backlog

- l'utilisateur clique sur le bouton *AJOUTER UN USER STORY*

## Sur la page du formulaire d'ajout de l'user story

- L'utilisateur renseigne chaque champ correctement et clique sur *CRÉER*
- l'utilisateur laisse le champ priorité vide mais remplit les autres correctement et clique sur *CRÉER*
- l'utilisateur tente d'ajouter un User Story avec un id déjà présent dans la base de données et clique sur *CRÉER*
- l'utilisateur rentre un nombre incorrect dans le champ priorité (>3 ou négatif) et clique sur *CRÉER*
- l'utilisateur rentre une chaîne de caractères dans le champ priorité et clique sur *CRÉER*
- l'utilisateur ne renseigne pas un ou plusieurs champs obligatoires et clique sur *CRÉER*
- l'utilisateur supprime l'argument URI ("?projectName=[nomDuProjet]") et rafraîchit la page
- l'utilisateur supprime la valeur de l'argument URI et rafraîchit la page
- l'utilisateur modifie l'argument URI par celui d'un projet qui n'existe pas et rafraîchit la page
- L'utilisateur clique sur le bouton *ANNULER*
