<?php

namespace App\Models;

use App\Mfw\Model;

class ExpensesCard extends Model
{
    protected $table = 'expenses_card';
    
    public function getTable() 
    {
        return $this->table;
    }
}