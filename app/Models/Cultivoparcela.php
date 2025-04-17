<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cultivoparcela extends Model
{

    protected $fillable = [
        'Descripcion',
        'fecha_registro',
        'parcela_id',
        'cultivo_id',
    ];
    public function parcela()
    {
        return $this->belongsTo(Parcela::class);
    }

    /**
     * Retorna el cultivo asociado a este registro.
     */
    public function cultivo()
    {
        return $this->belongsTo(Cultivo::class);
    }
}
