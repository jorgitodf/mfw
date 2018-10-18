<?php

namespace App\Models;

use App\Mfw\Model;

class ExpenditureInstallments extends Model
{
    protected $table = 'expenditure_installments';
    
    public function getTable() 
    {
        return $this->table;
    }
}