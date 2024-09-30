<?php

// app/Http/Controllers/FeedbackController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback; 
use App\Models\Vakantiehuis;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        // Valideren van de gegevens
        $validatedData = $request->validate([
            'naam' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'feedback' => 'required|string',
        ]);

        // Opslaan van de feedback
        Feedback::create($validatedData);

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
