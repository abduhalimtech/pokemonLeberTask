<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;

    protected $fillable = [
        'pokemon_id', 'name_en', 'name_ru', 'image',
    ];

    public function pokemon()
    {
        return $this->belongsTo(Pokemon::class);
    }
}
