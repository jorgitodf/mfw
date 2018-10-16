<?php

namespace App\Models;

use App\Mfw\Model;

class FlagCards extends Model
{
    protected $table = 'flag_cards';
    
    public function getTable() 
    {
        return $this->table;
    }
}