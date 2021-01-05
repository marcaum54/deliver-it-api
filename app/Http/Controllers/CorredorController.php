<?php

namespace App\Http\Controllers;

use App\Http\Requests\CorredorRequest;

class CorredorController extends Controller
{
    public function store(CorredorRequest $request)
    {
        return $request->store();
    }
}
