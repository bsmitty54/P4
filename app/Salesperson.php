<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesperson extends Model
{
    public function salestransaction() {
        # Salesperson has many salestransactions
        # Define a one-to-many relationship.
        return $this->hasMany('\App\Sales_transaction');
    }
}
