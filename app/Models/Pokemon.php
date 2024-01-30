<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'sequence_number', 'form', 'location_id',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function abilities()
    {
        return $this->belongsToMany(Ability::class, 'pokemon_abilities');
    }
}
