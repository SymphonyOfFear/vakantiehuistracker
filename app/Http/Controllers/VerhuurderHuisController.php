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
        $userId = Auth::id();
        $user = User::find($userId);

        if (!$role = $user->roles()->where('name', 'verhuurder')->first()) {
            return redirect()->back()->withErrors('Alleen verhuurders kunnen vakantiehuizen toevoegen.');
        }

        // Create vakantiehuis
        $vakantiehuis = Vakantiehuis::create([
            'verhuurder_id' => Auth::id(),
            'naam' => $validatedData['naam'],
            'prijs' => $validatedData['prijs'],
            'beschrijving' => $validatedData['beschrijving'] ?? '',
            'slaapkamers' => $validatedData['slaapkamers'] ?? 0,
            'stad' => $validatedData['stad'],
            'longitude' => $validatedData['longitude'] ?? null,
            'latitude' => $validatedData['latitude'] ?? null,
            'straatnaam' => $validatedData['straatnaam'],
            'postcode' => $validatedData['postcode'],
            'huisnummer' => $validatedData['huisnummer'],
            'wifi' => $request->boolean('wifi'),
            'zwembad' => $request->boolean('zwembad'),
            'parkeren' => $request->boolean('parkeren'),
            'speeltuin' => $request->boolean('speeltuin'),
            'beschikbaarheid' => $request->boolean('beschikbaarheid'),
        ]);

        // Handle image upload if any
        if ($request->hasFile('fotos')) {
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

        return redirect()->route('verhuurder.huizen.index')->with('success', 'Vakantiehuis succesvol verwijderd.');
    }
}
