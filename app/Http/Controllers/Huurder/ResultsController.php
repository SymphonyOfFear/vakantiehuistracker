<?php

namespace App\Http\Controllers\Huurder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function dashboard()
    {
        return view('huurder.dashboard');
    }
}
