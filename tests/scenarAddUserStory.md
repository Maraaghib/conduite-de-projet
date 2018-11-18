# Scénario pour le test de l'ajout d'une userStory

## Sur la page du viewProject.php dans l'onglet Backlog

- l'utilisateur clique sur le bouton *AJOUTER UN USER STORY*

## Sur la page du formulaire d'ajout de l'user story

- L'utilisateur renseigne chaque champs correctement et clique sur *CRÉER*
- l'utilisateur laisse le champs priorité vide mais remplit les autres correctement et clique sur *CRÉER*
- l'utilisateur tente d'ajouter une User Story avec un id déjà présent dans la base de donnée et clique sur *CRÉER*
- l'utilisateur rentre un nombre incorrecte dans le champ priorité (>3 ou négatif) et clique sur *CRÉER*
- l'utilisateur rentre une chaine de caractère dans le champ priorité et clique sur *CRÉER*
- l'utilisateur ne renseigne pas un ou plusieurs champs obligatoire et clique sur *CRÉER*
- l'utilisateur supprime l'argument URI ("?projectName=[nomDuProjet]") et raffraichit la page
- l'utilisateur supprime la valeur de l'agument URI et raffraichit la page
- l'utilisateur modifie l'agument URI par celui d'un projet qui n'existe pas et raffraichit la page
- L'utilisateur clique sur le bouton *ANNULER*