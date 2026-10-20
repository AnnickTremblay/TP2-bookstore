<?php
// Classe mère des modèles (communique avec la base de données).
namespace App\Models;

// abstract : on ne peut pas faire new CRUD.
// extends \PDO : CRUD est une connexion à la base de données.
abstract class CRUD extends \PDO {

    // Ouvre la connexion à la base bookstore (les enfants ne peuvent pas la modifier: final).
    final public function __construct() {
        parent::__construct('mysql:host=localhost; dbname=bookstore; port=3306; charset=utf8', 'root', 'MOT_DE_PASSSE');
    }

    // Retourne toutes les lignes de la table (triées par la clé primaire si $field est vide).
    final public function select($field = null, $order = "ASC"):array {
         if($field == null) {
            $field = $this->primaryKey;
         }
        $sql = "SELECT * FROM $this->table ORDER BY $field $order";
        $stmt = $this->query($sql);
        // fetchAll : retourne un tableau de tableaux.
        return $stmt->fetchAll();
    }

    // Retourne une ligne avec sa clé primaire (false si elle n'existe pas).
    final public function selectId(int|string $value):bool|array {
        // :id est une case vide (protège contre l'injection SQL).
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        $stmt = $this->prepare($sql);
        // bindValue : remplit la case vide avec la valeur reçue.
        $stmt->bindValue(":$this->primaryKey", $value);
        $stmt->execute();

        // rowCount : nombre de lignes trouvées.
        $count = $stmt->rowCount();
        if($count === 1) {
            return $stmt->fetch();
        }else{
            return false;
        }
    }

    // Ajoute une ligne.
    // $data contient les valeurs (exemple: ['name' => 'Marcos', 'email' => 'a@b.com']).
    public function insert(array $data) {
        // Garde seulement les colonnes permises dans $fillable.
        $data_keys = array_fill_keys($this->fillable, '');
        $data = array_intersect_key($data, $data_keys);

        // Fabrique les colonnes (exemple: name, email) et les cases vides (exemple: :name, :email).
        $fieldName = implode(', ', array_keys($data));
        $fieldBindValue = ":".implode(', :', array_keys($data));

        $sql = "INSERT INTO $this->table ($fieldName) VALUES ($fieldBindValue)";
        $stmt = $this->prepare($sql);

        foreach($data as $key=>$value) {
            $stmt->bindValue(":$key", $value);
        }

        if($stmt->execute()) {
            // lastInsertId : retourne l'id de la nouvelle ligne.
            return $this->lastInsertId();
        }else{
            return false;
        }
    }

    // Modifie une ligne.
    // $data contient les nouvelles valeurs et l'id pour le WHERE (exemple: ['id' => 5, 'title' => 'Dune']).
    public function update(array $data):bool {
        // Fabrique la partie SET (exemple: title = :title, isbn = :isbn, ).
        $fieldName = null;
        foreach($data as $key=>$value) {
            $fieldName .= "$key = :$key, ";
        }
        // rtrim : enlève la virgule de trop à la fin.
        $fieldName = rtrim($fieldName, ', ');

        $sql = "UPDATE $this->table SET $fieldName WHERE $this->primaryKey = :$this->primaryKey;";
        $stmt = $this->prepare($sql);

        foreach($data as $key=>$value) {
            $stmt->bindValue(":$key", $value);
        }

        if($stmt->execute()) {
            return true;
        }else{
            return false;
        }
    }

    // Supprime une ligne avec sa clé primaire.
    public function delete(int|string $value):bool {
        // WHERE obligatoire (sans lui toutes les lignes = supprimées).
        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $value);

        if($stmt->execute()) {
            return true;
        }else{
            return false;
        }
    }
}