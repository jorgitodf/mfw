<?php

namespace App\Models;

use App\Mfw\Model;

class Extracts extends Model
{
    protected $table = 'extracts';

    
    public function getTable() 
    {
        return $this->table;
    }
}