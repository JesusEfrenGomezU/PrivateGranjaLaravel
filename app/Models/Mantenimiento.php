<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    public function parcela() {
        return $this->belongsTo(Parcela::class);
    }

}
