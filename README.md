Bienvenue dans le projet de test Pumpkin !
==========================================

Ce test consiste en la conception et implémentation d'une API REST avec Symfony.

Installation
------------

Clonez ce projet et créez une branche nommée `{nom}-{prenom}`. Vous pusherez votre travail sur cette branche à la fin
de l'exercice. Installez les vendors à l'aide de composer.

Cahier des charges
------------------

Une librairie en ligne souhaite mettre en ligne une application mobile pour ses utilisateurs. Elle souhaite donc avoir 
une API REST exposant son contenu aux applications.

Les administrateurs pourront :
- Créer, éditer, supprimer et lister des catégories. Une catégorie est composée d'un nom et d'un tag.
- Créer, éditer, supprimer et lister des livres. Un livre est composé d'un titre, d'un synopsis, d'une description,
d'un auteur, d'un prix, d'une note de popularité notée sur cinq, et d'une ou plusieurs catégories.

Les applications mobiles devront proposer les deux vues suivantes :
- Liste des livres disponibles, affichant leur titre, leur auteur, leur prix et leur popularité.
    - Il sera possible de trier les livres par ordre alphabétique, prix et/ou note de popularité.
    - Il sera possible de filtrer les livres par catégorie.
- Vue de détails d'un livre, affichant toutes les informations d'un livre ainsi qu'une liste de commentaires triée par
date.
    - Il est également possible pour un lecteur de commenter sur le livre.

Exercice
--------

L'exercice consiste à écrire les contrats de service de cette API que les applications mobiles pourront utiliser pour 
commencer leurs développements en attendant d'avoir une API disponible, puis d'implémenter cette API.

- Écrivez les contrats de service de l'API dans le dossier `doc/api-contracts` de ce projet.
- Implémentez les endpoints décrits dans les contrats de service.

> En dehors de Symfony, vous êtes libres des choix techniques pour écrire les contrats de service et implémenter l'API.

### Conseils

- Il n'est pas nécessaire de gérer la partie sécurité de l'API : il n'est pas nécessaire de vérifier que l'utilisateur de
l'API est un administrateur ou un lecteur (ni même de vérifier qu'un utilisateur est connecté).
- Ne vous compliquez pas trop la tâche : pour les auteurs des livres et les utilisateurs liés aux commentaires, une simple
chaîne de caractères (nom / prénom, pseudo, email, etc...) suffit.
- Si vous avez peur de manquer de temps, concentrez-vous sur les contrats de service et l'implémentation de quelques 
endpoints. L'intérêt n'est pas tant d'avoir une API terminée correspondant au cahier des charges, que de voir votre 
façon de travailler. (Notez donc que plus les endpoints choisis seront complexes et/ou diversifiés, plus ce sera intéressant
pour nous !)
