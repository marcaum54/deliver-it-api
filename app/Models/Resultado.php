<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    use HasFactory;

    protected $fillable = ['hora_ini', 'hora_fim'];
    protected $hidden = ['corredorProva', 'corredor_prova_id'];

    protected $appends = ['prova_id', 'corredor_id', 'idade', 'nome_corredor'];

    public function corredorProva()
    {
        return $this->belongsTo(CorredorProva::class);
    }

    public function getProvaIdAttribute()
    {
        $id = $this->corredorProva->prova->id;
        return $id;
    }

    public function getCorredorIdAttribute()
    {
        $id = $this->corredorProva->corredor->id;
        return $id;
    }

    public function getIdadeAttribute()
    {
        $data_nascimento = date_create($this->corredorProva->corredor->data_nascimento);
        $diff = date_diff($data_nascimento, now());
        return $diff->y;
    }

    public function getNomeCorredorAttribute()
    {
        return $this->corredorProva->corredor->nome;
    }
}
