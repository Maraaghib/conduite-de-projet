# Scénario pour le test de la création d'un sprint

## Sur la page du viewProject.php dans l'onglet Sprints

- L'utilisateur clique sur le bouton *AJOUTER UN SPRINT*

## Sur la page du formulaire d'ajout d'un sprint

- L'utilisateur renseigne chaque champs correctement et clique sur *CRÉER*
- L'utilisateur rentre une information incorrecte (date passé ou date déjà prise dans l'intervale d'un autre sprint du même projet) dans le champ *Date de début* et clique sur *CRÉER* () 
- L'utilisateur ne renseigne pas un ou plusieurs champs obligatoire et clique sur *CRÉER*
- L'utilisateur supprime l'argument URI ("?projectName=[nomDuProjet]") et raffraichit la page
- L'utilisateur supprime la valeur de l'agument URI et raffraichit la page
- L'utilisateur modifie l'agument URI par celui d'un projet qui n'existe pas et raffraichit la page
- L'utilisateur rentre une information incorrecte dans le champs *User Stories*
- L'utilisateur clique sur le bouton *ANNULER*
- L'utilisateur essaye de rentrer des user story incorrecte (qui n'éxiste ou qui sont affecté à d'autre sprints)