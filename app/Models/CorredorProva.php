<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CorredorProva extends Pivot
{
    public function prova()
    {
        return $this->belongsTo(Prova::class);
    }

    public function corredor()
    {
        return $this->belongsTo(Corredor::class);
    }
}
