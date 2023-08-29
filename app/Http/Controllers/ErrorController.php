<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ErrorController extends Controller
{
    public function showErrorMaintenance()
    {
        return view('errors.503');
    }
}
