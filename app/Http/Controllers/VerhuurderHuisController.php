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
use Illuminate\Support\Facades\Hash;

class VerhuurderHuisController extends Controller
{
    public function dashboard()
    {
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
        $validatedData = $request->validated();

        $vakantiehuis = Vakantiehuis::create([
            'verhuurder_id' => Auth::id(),
            'naam' => $validatedData['naam'],
            'prijs' => $validatedData['prijs'],
            'beschrijving' => $validatedData['beschrijving'] ?? '',
            'slaapkamers' => $validatedData['slaapkamers'] ?? 0,
            'stad' => $validatedData['stad'],
            'straatnaam' => $validatedData['straatnaam'],
            'postcode' => $validatedData['postcode'],
            'huisnummer' => $validatedData['huisnummer'],
            'wifi' => $request->boolean('wifi'),
            'zwembad' => $request->boolean('zwembad'),
            'parkeren' => $request->boolean('parkeren'),
            'speeltuin' => $request->boolean('speeltuin'),
            'beschikbaarheid' => $request->boolean('beschikbaarheid'),
        ]);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                if ($foto->isValid()) {
                    $fileName = time() . '_' . $foto->getClientOriginalName();


                    $fileName
                        = Str::uuid()->toString();
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

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol toegevoegd.');
    }

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
                    $fileName = time() . '_' . $foto->getClientOriginalName();
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
        $image = $id;
        $vakantiehuisId = Vakantiehuis::findOrFail($image->vakantiehuis);
        Log($vakantiehuisId);
        try {
            $image = Image::findOrFail($id);
            $imagePath = base_path($image->url);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            $image->delete();
            return response()->json(['success' => 'Afbeelding succesvol verwijderd.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Er is een fout opgetreden bij het verwijderen van de afbeelding.'], 500);
        }
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

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol verwijderd.');
    }
}
