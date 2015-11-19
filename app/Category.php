<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function product() {
        # Product has many salestransactions
        # Define a one-to-many relationship.
        return $this->hasMany('\App\Product');
    }
}
