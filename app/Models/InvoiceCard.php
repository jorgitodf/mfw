<?php

namespace App\Models;

use App\Mfw\Model;

class InvoiceCard extends Model
{
    protected $table = 'invoice_card';
    
    public function getTable() 
    {
        return $this->table;
    }
}