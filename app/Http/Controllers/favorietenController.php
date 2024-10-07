<?php

namespace App\Http\Controllers;

use App\Models\Favorieten;
use App\Models\Vakantiehuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class favorietenController extends Controller
{
    /**
     * Display a listing of the user's favorites.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $favorieten = $user->favorieten;

        return view('favorieten.index', compact('favorieten'));
    }

    /**
     * Toggle the favorite status of a vacation house.
     *
     * @param int $vakantiehuisId
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggle($vakantiehuisId)
    {
        $userId = Auth::id();
        $favorite = Favorieten::where('user_id', $userId)
            ->where('vakantiehuis_id', $vakantiehuisId)
            ->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            Favorieten::create([
                'user_id' => $userId,
                'vakantiehuis_id' => $vakantiehuisId,
            ]);
        }

        // Redirect back to the previous page
        return redirect()->back();
    }
}
