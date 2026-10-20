# Bookstore MVC

TP2 — Programmation Web avancée (582-31B-MA)
Annick Tremblay — Collège de Maisonneuve

Migration de la librairie du TP1 vers l'architecture MVC, en PHP orienté objet avec MySQL et Twig.

## Les tables

- `author` — les auteurs
- `book` — les livres, avec une clé étrangère vers `author`
- `client` — les clients
- `sale` — les ventes, qui relient un client et un livre

## Les dossiers

- `models` — `CRUD` et un modèle par table
- `views` — les vues Twig
- `controllers` — `HomeController` et `BookController`
- `routes` — `Route` et `web.php`
- `providers` — `View` et `Validator`

## Les fonctionnalités

CRUD sur la table `book` : liste, détail, ajout, modification et suppression, avec validation des formulaires.

Une page d'accueil statique et une page de statistiques (nombre de livres, d'auteurs, de clients et de ventes).

## Installation

1. Importer `sql/bookstore.sql` dans MySQL.
2. Mettre les informations de la base dans `models/CRUD.php`.
3. Lancer `composer install`.
4. Lancer `php -S localhost:8000 router.php`.