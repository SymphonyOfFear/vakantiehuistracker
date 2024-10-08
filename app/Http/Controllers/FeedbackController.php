<?php

// app/Http/Controllers/FeedbackController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Vakantiehuis;

class FeedbackController extends Controller
{
    public function index()
    {
        //     $huisje = Vakantiehuis::findOrFail($huisjeId);
        //     $feedbacks = Feedback::where('huisje_id', $huisjeId)->get();
        // $huisjes = Feedback::where('user_id', Auth::id())->get();
        return view(
            'verhuurder.feedback.index', //compact('huisje', 'feedbacks')
        );
    }
    public function store(Request $request, $huisjeId)
    {
        // Valideren van de gegevens
        $validatedData = $request->validate([
            'naam' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'feedback' => 'required|string',
        ]);

        // Opslaan van de feedback en koppel het aan het huisje
        Feedback::create([
            'huisje_id' => $huisjeId, // Hier koppel je de feedback aan het huisje
            'naam' => $validatedData['naam'],
            'email' => $validatedData['email'],
            'feedback' => $validatedData['feedback'],
        ]);

        // Terugkoppeling aan de gebruiker
        return redirect()->back()->with('success', 'Bedankt voor je feedback!');
    }
    public function show($huisjeId)
    {
        // Huisje en feedback ophalen
        $huisje = Vakantiehuis::findOrFail($huisjeId);
        $feedbacks = Feedback::where('huisje_id', $huisjeId)->get(); // Haalt feedback op voor dit specifieke huisje

        // View renderen met huisje en feedback
        return view('verhuurder.huizen.show', compact('huisje', 'feedbacks'));
    }
}
