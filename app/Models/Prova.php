<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prova extends Model
{
    use HasFactory;

    const TIPO_3KM = '3KM';
    const TIPO_5KM = '5KM';
    const TIPO_10KM = '10KM';
    const TIPO_21KM = '21KM';
    const TIPO_42KM = '42KM';

    const TIPOS = [
        self::TIPO_3KM,
        self::TIPO_5KM,
        self::TIPO_10KM,
        self::TIPO_21KM,
        self::TIPO_42KM,
    ];
}
