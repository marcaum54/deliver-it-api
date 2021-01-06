<?php

namespace App\Http\Controllers;

use App\Http\Requests\InscricaoRequest;

class InscricaoController extends Controller
{
    public function __construct(InscricaoRequest $request)
    {
        $this->request = $request;
    }
}
