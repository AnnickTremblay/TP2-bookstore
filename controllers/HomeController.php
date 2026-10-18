<?php
// Contrôleur de la page d'accueil.
namespace App\Controllers;

// Importe la classe View.
use App\Providers\View;

class HomeController {

    // Affiche la page d'accueil.
    public function index($queryParams = []) {
        return View::render('home');
    }
}