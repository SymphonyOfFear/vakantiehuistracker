<?php

namespace App\Http\Controllers\Verhuurder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function index()
    {
        return view('verhuurder.dashboard');
    }
}
