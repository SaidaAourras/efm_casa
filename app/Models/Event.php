<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'description', 'date_debut', 'date_fin', 'lieu', 'image', 'user_id'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
