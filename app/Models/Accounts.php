<?php

namespace App\Models;

use App\Mfw\Model;

class Accounts extends Model
{
    protected $table = 'accounts';

    
    public function getTable() 
    {
        return $this->table;
    }
}



