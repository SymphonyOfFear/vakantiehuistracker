<?php

namespace App\Http\Controllers;

use App\Models\Reservering;
use App\Models\Vakantiehuis;
use Illuminate\Http\Request;

class ReserveringenController extends Controller
{
    public function index()
    {
        $reserveringen = Reservering::all();
        return view('reserveringen.index', compact('reserveringen'));
    }

    public function create()
    {
        $huizen = Vakantiehuis::all();
        return view('reserveringen.create', compact('huizen'));
    }

    public function store(Request $request)
    {
        Reservering::create($request->all());
        return redirect()->route('reserveringen.index');
    }

    public function show(Reservering $reservering)
    {
        return view('reserveringen.show', compact('reservering'));
    }

    public function edit(Reservering $reservering)
    {
        $huizen = Vakantiehuis::all();
        return view('reserveringen.edit', compact('reservering', 'huizen'));
    }

    public function update(Request $request, Reservering $reservering)
    {
        $reservering->update($request->all());
        return redirect()->route('reserveringen.index');
    }

    public function destroy(Reservering $reservering)
    {
        $reservering->delete();
        return redirect()->route('reserveringen.index');
    }
}
