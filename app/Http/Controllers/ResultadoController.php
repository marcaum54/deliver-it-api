<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResultadoRequest;

class ResultadoController extends Controller
{
    public function __construct(ResultadoRequest $request)
    {
        $this->request = $request;
    }
}
