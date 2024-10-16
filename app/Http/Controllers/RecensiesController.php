<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecensieRequest;
use App\Models\Recensie;
use App\Models\Reservering;
use App\Models\Vakantiehuis;
use Illuminate\Support\Facades\Auth;

class RecensiesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $vakantiehuizen = Vakantiehuis::whereHas('reserveringen', function ($query) use ($user) {
            $query->where('huurder_id', $user->id);
        })->get();

        $recensies = Recensie::whereIn('vakantiehuis_id', $vakantiehuizen->pluck('id'))->get();

        return view('recensies.index', compact('vakantiehuizen', 'recensies'));
    }

    public function store(RecensieRequest $request, $vakantiehuisId)
    {
        try {
            $hasReservation = Reservering::where('huurder_id', Auth::id())
                ->where('vakantiehuis_id', $vakantiehuisId)
                ->exists();

            if (!$hasReservation) {
                return back()->with('error', 'U kunt alleen een recensie schrijven als u een reservering heeft.');
            }

            Recensie::create([
                'vakantiehuis_id' => $vakantiehuisId,
                'user_id' => Auth::id(),
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);

            return back()->with('success', 'Uw recensie is succesvol geplaatst.');
        } catch (\Exception $e) {
            return back()->with('error', 'Er is een fout opgetreden bij het plaatsen van uw recensie.');
        }
    }
}
