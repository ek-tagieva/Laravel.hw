<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function plant() {
        return $this->hasOne(Plant::class, 'id', 'plant_id');
    }
}
