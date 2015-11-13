<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function salestransaction() {
        # Product has many salestransactions
        # Define a one-to-many relationship.
        return $this->hasMany('\App\Sales_transaction');
    }
}
