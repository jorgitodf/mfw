<?php

namespace App\Models;

use App\Mfw\Model;

class CreditCards extends Model
{
    protected $table = 'credit_cards';
    
    public function getTable() 
    {
        return $this->table;
    }
}