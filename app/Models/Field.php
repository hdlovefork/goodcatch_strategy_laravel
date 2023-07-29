<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Field extends Model
{
    use HasFactory;

    public function operators()
    {
        return $this->belongsToMany(Operator::class);
    }
}
