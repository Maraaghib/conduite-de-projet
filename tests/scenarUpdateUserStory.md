# Scénario pour le test de la modification d'une userStory

## Sur la page du viewProject.php dans l'onglet Backlog

- l'utilisateur clique sur le bouton *MODIFIER*

## Sur la page du formulaire de modification de l'user story

- L'utilisateur modifie chaque champ correctement et clique sur *MODIFIER*
- l'utilisateur laisse un champ inchangé mais modifie les autres correctement et clique sur *MODIFIER*
- l'utilisateur rentre un nombre incorrect dans le champ priorité (>3 ou négatif) et clique sur *MODIFIER*
- l'utilisateur rentre une chaîne de caractères dans le champ priorité et clique sur *MODIFIER*
- l'utilisateur ne renseigne pas un ou plusieurs champs obligatoires et clique sur *MODIFIER*
- l'utilisateur supprime l'argument URI ("?projectName=[nomDuProjet]") et rafraîchit la page
- l'utilisateur supprime la valeur de l'argument URI et rafraîchit la page
- l'utilisateur modifie l'argument URI par celui d'un projet qui n'existe pas et rafraîchit la page
- L'utilisateur clique sur le bouton *ANNULER*
