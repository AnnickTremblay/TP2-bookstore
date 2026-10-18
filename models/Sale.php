<?php
// Modèle de la table sale.
namespace App\Models;

// Importe CRUD pour en hériter.
use App\Models\CRUD;

// Hérite de CRUD (select, selectId, insert, update, delete).
class Sale extends CRUD {
    // Nom de la table.
    protected $table = 'sale';
    // Clé primaire de la table.
    protected $primaryKey = 'id';
    // Colonnes qui peuvent être insérées ou modifiées.
    protected $fillable = ['quantity', 'sold_date', 'unit_price', 'book_id', 'client_id'];
}