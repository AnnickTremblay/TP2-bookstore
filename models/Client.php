<?php
// Modèle de la table client.
namespace App\Models;

// Importe CRUD pour en hériter.
use App\Models\CRUD;

// Hérite de CRUD (select, selectId, insert, update, delete).
class Client extends CRUD {
    // Nom de la table.
    protected $table = 'client';
    // Clé primaire de la table.
    protected $primaryKey = 'id';
    // Colonnes qui peuvent être insérées ou modifiées.
    protected $fillable = ['name', 'address', 'zip_code', 'phone', 'email'];
}