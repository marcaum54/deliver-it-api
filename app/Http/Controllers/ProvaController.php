<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProvaRequest;

class ProvaController extends Controller
{
    public function __construct(ProvaRequest $request)
    {
        $this->request = $request;
    }
}
