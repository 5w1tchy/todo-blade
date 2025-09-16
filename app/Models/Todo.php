<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use Hasfactory;
    protected $fillable = ['title', 'notes', 'is_done'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

}
