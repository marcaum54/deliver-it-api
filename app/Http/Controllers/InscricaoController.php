<?php

namespace App\Http\Controllers;

use App\Http\Requests\InscricaoRequest;

class InscricaoController extends Controller
{
    public function store(InscricaoRequest $request)
    {
        return response()->json($request->store(), 201);
    }
}
