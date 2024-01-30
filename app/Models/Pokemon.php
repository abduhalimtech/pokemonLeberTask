<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'sorting_index', 'form', 'location',
    ];

    public function abilities()
    {
        return $this->hasMany(Ability::class);
    }
}
