<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cosecha extends Model
{
    use HasFactory;
    protected $fillable = [
        'cultivo_id',
        'Recolectado',
        'Medida',
        'FechaCosecha',
    ];
    public function cultivo()
    {
        return $this->belongsTo(Cultivo::class);
    }
}
