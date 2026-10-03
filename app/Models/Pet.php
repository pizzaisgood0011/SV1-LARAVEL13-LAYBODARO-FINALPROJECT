<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = ['species_id', 'name', 'age', 'status'];

    public function species()
    {
        return $this->belongsTo(Species::class);
    }
}