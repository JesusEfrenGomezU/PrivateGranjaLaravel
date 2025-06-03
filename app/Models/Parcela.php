<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    use HasFactory; 
    protected $fillable = [
        'tamano',
        'ubicacion',
        'estado',
        'users',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id'); // Asegúrate de que 'users_id' sea el nombre correcto de la columna
    }
}
