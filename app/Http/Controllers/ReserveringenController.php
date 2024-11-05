<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveringRequest;
use App\Models\Reservering;
use App\Models\Vakantiehuis;
use Illuminate\Support\Facades\Auth;

class ReserveringenController extends Controller
{
    public function index()
    {

        $user = Auth::id();
        $reserveringen = Vakantiehuis::whereHas('reserveringen', function ($query) use ($user) {
            $query->where('huurder_id', $user);
        })->get();
        return view('reserveringen.index', compact('reserveringen'));
    }

    public function create()
    {
        $huizen = Vakantiehuis::all();
        return view('reserveringen.create', compact('huizen'));
    }

    public function store(ReserveringRequest $request)
    {
        $requestData = $request->validated();
        $requestData['huurder_id'] = Auth::id();
        Reservering::create($requestData);

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

    public function update(ReserveringRequest $request, Reservering $reservering)
    {
        $requestData = $request->validated();
        $requestData['huurder_id'] = Auth::id();
        $reservering->update($requestData);

        return redirect()->route('reserveringen.index');
    }

    public function destroy(Reservering $reservering)
    {
        $reservering->delete();
        return redirect()->route('reserveringen.index');
    }
}
