<?php
// Liste des routes du site (chaque adresse est associée à une méthode d'un contrôleur).

// Importe les classes utilisées.
use App\Routes\Route;
use App\Controllers\HomeController;
use App\Controllers\BookController;

// Page d'accueil ('/' et '/home').
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

// Page des statistiques.
Route::get('/stats', 'HomeController@stats');

// Liste des livres.
Route::get('/books', 'BookController@index');

// Détail d'un livre (exemple: /book/show?id=3).
Route::get('/book/show', 'BookController@show');

// Ajout : GET affiche le formulaire, POST l'enregistre.
Route::get('/book/create', 'BookController@create');
Route::post('/book/create', 'BookController@store');

// Modification : GET affiche le formulaire, POST l'enregistre (même adresse).
Route::get('/book/edit', 'BookController@edit');
Route::post('/book/edit', 'BookController@update');

// Suppression : en POST seulement (un simple lien ne doit pas pouvoir effacer).
Route::post('/book/delete', 'BookController@delete');

// Doit être la dernière ligne : cherche la route qui correspond à l'adresse.
Route::dispatch();