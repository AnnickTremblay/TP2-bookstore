<?php
// Classe qui valide les champs d'un formulaire (utilisée dans les contrôleurs).
namespace App\Providers;

class Validator {

    // Les erreurs (exemple: ['title' => 'Title is required!']).
    private $errors = array();
    // Nom de l'input en cours de validation.
    private string $key;
    // Valeur saisie dans cet input.
    private string $value;
    // Nom affiché dans le message d'erreur.
    private string $name;

    // Déclare le champ à valider ($name est un alias optionnel pour le message).
    public function field(string $key, string $value, $name = null) {
        $this->key = $key;
        $this->value = $value;
        // ucfirst : met la première lettre en majuscule (exemple: 'title' => 'Title').
        if ($name == null) {
            $this->name = ucfirst($key);
        } else {
            $this->name = ucfirst($name);
        }
        // Retourne l'objet pour enchaîner les règles (exemple: ->required()->int()).
        return $this;
    }

    // Règle : le champ est obligatoire.
    public function required() {
        if (empty($this->value)) {
            $this->errors[$this->key] = "$this->name is required!";
        }
        return $this;
    }

    // Règle : longueur minimale (strlen : nombre de caractères).
    public function min(int $length) {
        if (strlen($this->value) < $length) {
            $this->errors[$this->key] = "$this->name must have at least $length characters!";
        }
        return $this;
    }

    // Règle : longueur maximale.
    public function max(int $length) {
        if (strlen($this->value) > $length) {
            $this->errors[$this->key] = "$this->name must have no more than $length characters!";
        }
        return $this;
    }

    // Retourne true quand il n'y a aucune erreur.
    public function isSuccess() {
        if (empty($this->errors)) return true;
    }

    // Retourne le tableau d'erreurs.
    public function getErrors() {
        if (!$this->isSuccess()) return $this->errors;
    }

    // Règle : le champ doit être un nombre entier (filter_var avec FILTER_VALIDATE_INT).
    public function int(){
        if(!filter_var($this->value, FILTER_VALIDATE_INT)) {
            $this->errors[$this->key]="$this->name must be an integer!";
        }
    }
}