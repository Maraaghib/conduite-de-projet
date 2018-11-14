# Scénario pour le test de l'ajout d'une userStory

## Sur la page du backlog

L'utilisateur clique sur le bouton "ajouter une User Story" à partir du backlog

## Sur la page du formulaire d'ajout de l'user story

L'utilisateur renseigne chaque champs correctement et clique sur valider
L'utilisateur laisse le champs priorité vide mais remplit les autres correctement et clique sur valider
L'utilisateur tente d'ajouter une User Story avec un id déjà présent dans la base de donnée et clique sur valider
L'utilisateur rentre un nombre incorrecte dans le champ priorité (>3 ou négatif) et clique sur valider
L'utilisateur rentre une chaine de caractère dans le champ priorité et clique sur valider
L'utilisateur ne renseigne pas un ou plusieurs champs obligatoire et clique sur valider
L'utilisateur clique sur le bouton backlog et est rediriger vers la page du backlog du bon projet
L'utilisateur supprime l'argument URI ("?projectName=[nomDuProjet]") et raffraichit la page
L'utilisateur supprime la valeur de l'agument URI et raffraichit la page
L'utilisateur modifie l'agument URI par celui d'un projet qui n'existe pas et raffraichit la page