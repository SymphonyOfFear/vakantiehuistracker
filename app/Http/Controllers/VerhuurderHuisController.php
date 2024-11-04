<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Image;
use App\Models\Vakantiehuis;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Requests\VerhuurderHuisRequest;
use App\Models\User;

class VerhuurderHuisController extends Controller
{
    public function dashboard()
    {
        // Hier kun je alle benodigde data ophalen voor het dashboard
        // Bijvoorbeeld huizen van de verhuurder:
        $huisjes = Vakantiehuis::where('user_id', Auth::id())->get();
    
        // Geef een view terug voor het dashboard
        return view('verhuurder.dashboard', compact('huisjes'));
    } 
        return view('verhuurder.dashboard');
    }

    public function index()
    {
        $huizen = Vakantiehuis::where('verhuurder_id', Auth::id())->with('images')->get();
        return view('verhuurder.huizen.index', compact('huizen'));
    }

    public function create()
    {
        return view('verhuurder.huizen.create');
    }

    public function store(VerhuurderHuisRequest $request)
    {
        // Valideer de invoer en controleer of 'fotos' een array is
        $validatedData = $request->validate([
            'naam' => 'required|string|max:255',
            'prijs' => 'required|numeric',
            'beschrijving' => 'nullable|string',
            'slaapkamers' => 'required|integer',
            'stad' => 'required|string',
            'straatnaam' => 'required|string',
            'postcode' => 'required|string',
            'huisnummer' => 'required|string',
            'fotos' => 'required|array',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // Maak een nieuw vakantiehuis aan
            $vakantiehuis = Vakantiehuis::create([
                'verhuurder_id' => Auth::id(),
                'naam' => $validatedData['naam'],
                'prijs' => $validatedData['prijs'],
                'beschrijving' => $validatedData['beschrijving'],
                'slaapkamers' => $validatedData['slaapkamers'],
                'stad' => $validatedData['stad'],
                'straatnaam' => $validatedData['straatnaam'],
                'postcode' => $validatedData['postcode'],
                'huisnummer' => $validatedData['huisnummer'],
                'latitude' => null,
                'longitude' => null,
                'wifi' => $request->has('wifi'),
                'zwembad' => $request->has('zwembad'),
                'parkeren' => $request->has('parkeren'),
                'speeltuin' => $request->has('speeltuin'),
                'beschikbaarheid' => $request->boolean('beschikbaarheid'),
            ]);

            // Verwerk de geüploade afbeeldingen
            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $foto) {
                    if ($foto->isValid()) {
                        $path = $foto->store('public/fotos');
                        $url = Storage::url($path);

                        // Sla de URL op in de images-tabel
                        Image::create([
                            'url' => $url,
                            'vakantiehuis_id' => $vakantiehuis->id,
                        ]);
                    }
                }
            }

            // Redirect naar de indexpagina met succesbericht
            return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol toegevoegd.');
        } catch (\Exception $e) {
            // Log fouten
            Log::error("Fout bij opslaan van vakantiehuis: " . $e->getMessage());
            return back()->with('error', 'Er is een fout opgetreden bij het opslaan van het vakantiehuis: ' . $e->getMessage());
        }
    }

    // Functie om een specifiek vakantiehuis weer te geven
    public function show($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);
        return view('verhuurder.huizen.show', compact('vakantiehuis'));
    }

    // Functie om de edit-pagina van een vakantiehuis weer te geven
    public function edit($id)
    {
        $vakantiehuis = Vakantiehuis::with('images')->findOrFail($id);
        return view('verhuurder.huizen.edit', compact('vakantiehuis'));
    }

    public function update(VerhuurderHuisRequest $request, $id)
    {
        $validatedData = $request->validated();
        $vakantiehuis = Vakantiehuis::findOrFail($id);
        $vakantiehuis->update($validatedData);

        if ($request->hasFile('fotos')) {
            foreach ($vakantiehuis->images as $image) {
                $imagePath = public_path($image->url);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
                $image->delete();
            }

            foreach ($request->file('fotos') as $foto) {
                if ($foto->isValid()) {
                    $fileName = md5(uniqid() . time()) . '.' . $foto->getClientOriginalExtension();
                    $publicPath = public_path('images/huizen');
                    if (!File::exists($publicPath)) {
                        File::makeDirectory($publicPath, 0755, true);
                    }
                    $foto->move($publicPath, $fileName);
                    $url = '/images/huizen/' . $fileName;
                    Image::create([
                        'vakantiehuis_id' => $vakantiehuis->id,
                        'url' => $url,
                    ]);
                }
            }
        }

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol bijgewerkt.');
    }

    public function deleteImage($id)
    {
        $image = Image::findOrFail($id);
        $imagePath = public_path($image->url);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $image->delete();
        return response()->json(['success' => 'Afbeelding succesvol verwijderd.']);
    }

    public function show($id)
    {
        $vakantiehuis = Vakantiehuis::with('images')->findOrFail($id);
        return view('verhuurder.huizen.show', compact('vakantiehuis'));
    }

    public function destroy($id)
    {
        $vakantiehuis = Vakantiehuis::findOrFail($id);
        $vakantiehuis->delete();

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Huisje succesvol verwijderd!');
    }
  
}
