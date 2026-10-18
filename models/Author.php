<?php
// Modèle de la table author.
namespace App\Models;

// Importe CRUD pour en hériter.
use App\Models\CRUD;

// Hérite de CRUD (select, selectId, insert, update, delete).
class Author extends CRUD {
    // Nom de la table.
    protected $table = 'author';
    // Clé primaire de la table.
    protected $primaryKey = 'id';
    // Colonnes qui peuvent être insérées ou modifiées.
    protected $fillable = ['name', 'birthday'];
}