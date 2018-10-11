<?php

namespace App\Models;

use App\Mfw\Model;

class Categories extends Model
{
    protected $table = 'categories';

    public function getTable() 
    {
        return $this->table;
    }
}


