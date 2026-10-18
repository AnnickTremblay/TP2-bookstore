<?php
// Modèle de la table book.
namespace App\Models;

// Importe CRUD pour en hériter.
use App\Models\CRUD;

// Hérite de CRUD (select, selectId, insert, update, delete).
class Book extends CRUD {
    // Nom de la table.
    protected $table = 'book';
    // Clé primaire de la table.
    protected $primaryKey = 'id';
    // Colonnes qui peuvent être insérées ou modifiées (author_id -> clé étrangère).
    protected $fillable = ['title', 'isbn', 'description', 'price', 'author_id'];
}