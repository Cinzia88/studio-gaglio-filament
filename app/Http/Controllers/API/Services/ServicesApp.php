<?php

namespace App\Http\Controllers\API\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServicesApp extends Controller
{
    public function show()
    {
        $services = Service::orderBy('id', 'desc')->paginate(5);
        return $services;
    }
}
