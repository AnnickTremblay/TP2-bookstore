<?php
// Classe qui affiche les vues avec Twig (appelée par les contrôleurs).
namespace App\Providers;

// Importe les deux classes de Twig.
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View {

    // Affiche une vue Twig (exemple: 'home' pour views/home.php).
    // static : on l'appelle avec View::render(), sans faire new View.
    static public function render(string $template, $data = []) {
        // Indique à Twig où sont les vues (dossier views/).
        $loader = new FilesystemLoader('views');
        $twig = new Environment($loader);
        // Crée les variables {{ asset }} et {{ base }} dans toutes les vues (constantes de config.php).
        $twig->addGlobal('asset', ASSET);
        $twig->addGlobal('base', BASE);
        // Transforme la vue en HTML avec les données et l'affiche.
        echo $twig->render($template.".php", $data);
    }

    // Redirige l'utilisateur vers une autre page (exemple: 'books').
    static public function redirect(string $url) {
        // header('location:...') : dit au navigateur d'aller à cette adresse.
        header('location:'.BASE.'/'.$url);
    }
}