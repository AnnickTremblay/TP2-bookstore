<?php
// Point d'entrée unique du site (toutes les adresses arrivent ici grâce au .htaccess).

// Charge l'autoload de Composer (plus besoin de require pour chaque classe).
require_once 'vendor/autoload.php';

// Charge les constantes BASE et ASSET.
require_once 'config.php';

// Charge la liste des routes (Route::dispatch() est appelé dans ce fichier).
require_once 'routes/web.php';