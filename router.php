<?php
// Remplace le .htaccess avec le serveur intégré de PHP.
// Pour le lancer dans le dossier librairie-mvc : php -S localhost:8000 router.php

// Récupère le chemin sans les paramètres (exemple: /book/show?id=3 devient /book/show).
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Chemin complet du fichier demandé (__DIR__ : dossier où se trouve router.php).
$file = __DIR__ . $path;

// Si c'est un vrai fichier (css, image, js), return false l'envoie tel quel au navigateur.
if($path !== '/' && is_file($file)) {
    return false;
}

// Sinon, toutes les autres adresses passent par index.php.
require __DIR__ . '/index.php';