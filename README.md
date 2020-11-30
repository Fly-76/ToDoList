# Projet AFPA - S21 : Application de gestion projets

## Objectif : 
Réalisation d’une application métier pour un client travaillant dans le bâtiment
Gérer le dérouler des projets de construction et les différentes deadlines pour les étapes du chantier. 

## Compétences mises en oeuvre : 
- Framework Symfony 5
- Créé une base de données
- Utilisation de la commande generate crud est autorisé
- Sécurité de l’application gérée avec le bundle de sécurité Symfony
- Idéalement vous générez les données à l’aide de fixtures
- JavaScript ES6

## Description : 
Concevoir une application qui permet à l’utilisateur de :
- Se connecter avec son compte personnel ou de s’inscrire s’il n’a pas de compte
- Voir tous les projets de cet utilisateur sur une page
- Créer un nouveau projet via un formulaire
- Voir le détail d’un projet, c’est-à-dire le projet avec ses tâches quand il clique dessus
- Créer des tâches liées à un projet particulier via un formulaire
- Supprimer les projets et les tâches comme il le désire
- Modifier les projets et les tâches comme il le désire
- Indiquer si une tâche est terminée
- Distinguer visuellement les tâches finies des tâches en cours
- Voir projets et tâches classées par ordre de deadline
- Archiver un projet
- Voir les projets archivés
- Utiliser l’application sur les chantiers via une tablette ou un smartphone

L’application est également visuellement enrichie afin d’offrir à l’utilisateur une expérience la plus intuitive possible. 
Par exemple :
- Au survol d’un projet tous les autres projets sauf celui-ci se grisent
- L’utilisateur peut choisir de cacher temporairement un projet ou une tâche d’un projet

Quelques information supplémentaires :
- Un utilisateur se connecte avec un email et un mot de passe
- Un projet est composé à minima d’un nom, d’une description, d’une date de création, d’une deadline et d’un statut
- Une tâche est composée à minima d’un nom, d’une description, d’une date de création, d’une deadline et d’un statut