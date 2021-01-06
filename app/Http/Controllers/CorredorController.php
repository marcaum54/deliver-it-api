<?php

namespace App\Http\Controllers;

use App\Http\Requests\CorredorRequest;

class CorredorController extends Controller
{
    public function __construct(CorredorRequest $request)
    {
        $this->request = $request;
    }
}
