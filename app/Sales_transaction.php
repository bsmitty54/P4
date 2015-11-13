<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales_transaction extends Model
{
    public function salesperson() {
        # salestransaction belongs to salesperson
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('\App\Salesperson');
    }
    public function product() {
        # salestransaction belongs to product
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('\App\Product');
    }
}
