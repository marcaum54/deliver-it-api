<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResultadoRequest;

class ResultadoController extends Controller
{
    public function store(ResultadoRequest $request)
    {
        return $request->store();
    }
}
