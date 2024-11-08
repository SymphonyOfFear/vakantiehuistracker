<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
      // Geeft de contactpagina weer
    public function index()
    {
        return view('contact.index');
    }
}
