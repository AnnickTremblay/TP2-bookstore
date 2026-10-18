<?php
// Classe qui compare l'adresse demandée avec les routes de web.php et appelle le bon contrôleur.
namespace App\Routes;

class Route {

    // Garde en mémoire les routes déclarées dans web.php.
    private static $routes = [];

    // Déclare une route en GET (exemple: 'BookController@index').
    static public function get(string $url, string $controller):void{
        self::$routes[] = ['url' => $url, 'controller' => $controller, 'method' => 'GET'];
    }

    // Déclare une route en POST (envoi de formulaire).
    static public function post(string $url, string $controller):void{
        self::$routes[] = ['url' => $url, 'controller' => $controller, 'method' => 'POST'];
    }

    // Trouve la route qui correspond à l'adresse et appelle le contrôleur.
    static public function dispatch(){

        // Adresse demandée (exemple: /book/show?id=3).
        $url = $_SERVER['REQUEST_URI'];
        // Sépare le chemin [0] des paramètres [1].
        $urlSegments = explode('?', $url);
        $urlPath = $urlSegments[0];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach(self::$routes as $route){

            // La route correspond si le chemin et la méthode sont les mêmes.
            if(BASE.$route['url'] == $urlPath && $route['method'] == $method){
                // Sépare 'BookController@index' en ['BookController', 'index'].
                $controllerSegments = explode('@', $route['controller']);
                $controllerName = 'App\\Controllers\\'.$controllerSegments[0];
                $methodName = $controllerSegments[1];

                $controllerInstance = new $controllerName();

                if($method == "GET"){
                    if(isset($urlSegments[1])){
                        // Transforme 'id=3' en tableau (exemple: $queryParams['id'] = '3').
                        parse_str($urlSegments[1], $queryParams);
                        $controllerInstance->$methodName($queryParams);
                    }else{
                        $controllerInstance->$methodName();
                    }

                }elseif($method == "POST"){
                    if(isset($urlSegments[1])){
                        parse_str($urlSegments[1], $queryParams);
                        // 1er paramètre : le formulaire, 2e paramètre : l'adresse (l'id).
                        $controllerInstance->$methodName($_POST, $queryParams);
                    }else{
                        $controllerInstance->$methodName($_POST);
                    }
                }
                return;
            }
        }

        // Aucune route ne correspond : erreur 404.
        http_response_code(404);
        echo "404 Page not found!";
    }
}