<?php

namespace App\Models;

use App\Mfw\Model;

class Contas extends Model
{
    protected $table = 'accounts';

    public function getTable() 
    {
        return $this->table;
    }
}