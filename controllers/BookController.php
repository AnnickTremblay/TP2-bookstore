<?php
// Déclaration du namespace du contrôleur, qui correspond à l'autoload PSR-4 de composer.json.
namespace App\Controllers;

// Importation des modèles et des classes de providers utilisées dans le contrôleur.
use App\Models\Book;
use App\Models\Author;
use App\Providers\View;
use App\Providers\Validator;

// Reçoit les demandes de la route, utilise les modèles et choisit la vue à afficher.
class BookController{

    // Récupère tous les livres avec le nom de leur auteur et envoie le tout à la vue book/index.
    public function index(){
        $crud = new Book;
        $books = $crud->select();
        if($books){
            $author = new Author;
            foreach($books as $key => $book){
                // Va chercher l'auteur du livre avec sa clé étrangère author_id.
                $selectAuthor = $author->selectId($book['author_id']);
                // Ajoute le nom de l'auteur au livre ('-' si pas trouvé).
                $books[$key]['author_name'] = $selectAuthor ? $selectAuthor['name'] : '-';
            }
            // Affiche la vue Twig en lui passant 'books'.
            return View::render('book/index', ['books' => $books]);
        }else{
            echo "error";
        }
    }

    // Affiche le détail d'un livre.
    // $data contient les paramètres de l'adresse (exemple: ?id=3).
    public function show($data = []) {
        // Vérifie qu'un id est passé dans l'adresse.
        if(isset($data['id']) && $data['id'] !== null) {
            $book = new Book;
            // Si le livre n'existe pas, retourne false.
            $selectId = $book->selectId($data['id']);
            if($selectId) {
                $author = new Author;
                $selectAuthor = $author->selectId($selectId['author_id']);
                $selectId['author_name'] = $selectAuthor ? $selectAuthor['name'] : '-';
                return View::render('book/show', ['book' => $selectId]);
            } else {
                // Affiche la vue d'erreur avec un message.
                return View::render('error', ['msg'=>'Book not found']);
            }
        }

        // Pas d'id dans l'adresse, affiche donc la vue d'erreur 404.
        return View::render('error', ['msg'=>'Code 404 - Page not found']);
    }

    // Affiche le formulaire d'ajout avec la liste des auteurs pour la liste déroulante.
    public function create() {
        $authors = new Author;
        $authors = $authors->select('name');
        return View::render('book/create', ['authors' => $authors]);
    }

    // Reçoit le formulaire ($data vient de $_POST), le valide avec Validator et enregistre le livre.
    public function store(array $data) {
        $valid = new Validator;
        // Validation de chaque champ du formulaire (le 3e paramètre = nom affiché dans le message d'erreur).
        $valid->field('title', $data['title'])->required();
        $valid->field('isbn', $data['isbn'], 'ISBN')->required();
        $valid->field('price', $data['price'])->required();
        $valid->field('author_id', $data['author_id'], 'Author')->required()->int();

        if($valid->isSuccess()){
            $book = new Book;
            // insert vient du CRUD et retourne l'id du nouveau livre.
            $insert = $book->insert($data);
            if($insert){
                // Redirige vers la page du livre qui vient d'être ajouté.
                return View::redirect('book/show?id='.$insert);
            } else {
                echo "error";
            }
        } else {
            // Récupère les erreurs sous forme de tableau associatif.
            $errors = $valid->getErrors();
            // Recharge les auteurs parce que la liste déroulante en a encore besoin.
            $authors = new Author;
            $authors = $authors->select('name');
            // Réaffiche le formulaire avec les erreurs et les valeurs déjà entrées.
            return View::render('book/create', ['errors' => $errors, 'book' => $data, 'authors' => $authors]);
        }
    }

    // Affiche le formulaire de modification déjà rempli avec les données du livre.
    public function edit($data = []) {
        if(isset($data['id'])) {
            $id = $data['id'];
            $crud = new Book;
            $book = $crud->selectId($id);

            if($book) {
                $authors = new Author;
                $authors = $authors->select('name');

                return View::render('book/edit', ['book' => $book, 'authors' => $authors]);
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    }

    // Valide le formulaire et modifie le livre.
    // $data vient de $_POST et $get contient l'id de l'adresse.
    public function update(array $data, array $get = []) {
        if(!isset($get['id'])) {
            echo "error";
            return;
        }
        $id = $get['id'];

        // Mêmes règles de validation que pour store.
        $valid = new Validator;
        $valid->field('title', $data['title'])->required();
        $valid->field('isbn', $data['isbn'], 'ISBN')->required();
        $valid->field('price', $data['price'])->required();
        $valid->field('author_id', $data['author_id'], 'Author')->required()->int();

        // Ajoute l'id au tableau parce que update du CRUD en a besoin pour le WHERE.
        $data['id'] = $id;

        if($valid->isSuccess()) {
            $book = new Book;
            // Retourne true si la modification a réussi.
            if($book->update($data)) {
                return View::redirect('book/show?id='.$id);
            } else {
                echo "error";
            }
        } else {
            $errors = $valid->getErrors();
            $authors = new Author;
            $authors = $authors->select('name');
            return View::render('book/edit', ['errors' => $errors, 'book' => $data, 'authors' => $authors]);
        }
    }

    // Efface le livre dont l'id est envoyé par le champ caché du formulaire ($data vient de $_POST).
    public function delete($data){
        $book = new Book;
        // La méthode delete n'est pas dans Book. Elle est héritée de CRUD.
        $delete = $book->delete($data['id']);
        if($delete){
            // Retourne à la liste des livres.
            return View::redirect('books');
        }else{
            echo "error";
        }
    }
}