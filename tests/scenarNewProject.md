# Scénario pour le test de la création d'un nouveau projet

## Sur la page d'accueil du site (index.php)

- l'utilisateur clique sur le bouton `NOUVEAU PROJET`

## Sur la page contenant le formulaire de la création du nouveau projet

- L'utilisateur renseigne tous les champs correctement et clique sur le bouton `CRÉER`
- l'utilisateur renseigne tous les champs correctement sauf le champ `Description` et clique sur le bouton `CRÉER`
- l'utilisateur ne renseigne pas le champ `Nom` et/ou le champ `Description` et/ou le champ `Durée des sprints` et clique sur le bouton `CRÉER`
- l'utilisateur saisit un nom de projet dépassant 50 caractères et clique sur le bouton `CRÉER`
- l'utilisateur tente d'ajouter un projet avec un nom déjà existant dans la base de données et clique sur le bouton `CRÉER`
- l'utilisateur renseigne un nombre strictement inférieur à 1 dans le champ `Durée des sprints` et clique sur le bouton `CRÉER`
- l'utilisateur renseigne une chaîne de caractères dans le champ `Durée des sprints` et clique sur le bouton `CRÉER`
- L'utilisateur clique sur le bouton `ANNULER`
