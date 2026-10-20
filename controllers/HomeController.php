<?php
// Contrôleur de la page d'accueil.
namespace App\Controllers;

// Importe les modèles (pour compter les lignes) et la classe View.
use App\Models\Book;
use App\Models\Author;
use App\Models\Client;
use App\Models\Sale;
use App\Providers\View;

class HomeController {

    // Affiche la page d'accueil.
    public function index($queryParams = []) {
        return View::render('home');
    }

    // Affiche la page des statistiques (nombre de livres, d'auteurs, de clients et de ventes).
    public function stats($queryParams = []) {
        $book = new Book;
        $author = new Author;
        $client = new Client;
        $sale = new Sale;

        // count : nombre de lignes retournées par select.
        return View::render('stats', [
            'nbBooks' => count($book->select()),
            'nbAuthors' => count($author->select()),
            'nbClients' => count($client->select()),
            'nbSales' => count($sale->select())
        ]);
    }
}
