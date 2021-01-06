<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corredor extends Model
{
    use HasFactory;

    protected $table = 'corredores';

    protected $fillable = ['nome', 'cpf', 'data_nascimento'];

    public function provas()
    {
        return $this->belongsToMany(Prova::class)->withPivot('id')->withTimestamps();
    }
}
