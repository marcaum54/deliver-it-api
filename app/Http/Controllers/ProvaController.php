<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProvaRequest;

class ProvaController extends Controller
{
    public function store(ProvaRequest $request)
    {
        return $request->store();
    }
}
