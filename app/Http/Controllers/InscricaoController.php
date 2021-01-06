<?php

namespace App\Http\Controllers;

use App\Http\Requests\InscricaoRequest;

class InscricaoController extends Controller
{
    public function store(InscricaoRequest $request)
    {
        return $request->store();
    }
}
