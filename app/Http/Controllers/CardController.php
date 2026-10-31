<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Http\Requests\UpdateCardRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cards = Card::with('category');

        /** @var User $user */
        $user = auth()->user();

        // Normale gebruikers zien alleen actieve kaarten
        if (!$user->isAdmin()) {
            $cards->where('status', true);
        }

        if ($request->filled('search')) {
            $search = $request->input('search');

            $cards->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('front', 'like', "%{$search}%")
                    ->orWhere('back', 'like', "%{$search}%");
            });
        }

        if ($request->filled('edition')) {
            $cards->whereHas('category', function ($query) use ($request) {
                $query->where('edition', $request->input('edition'));
            });
        }

        $cards = $cards->get();
        $categories = Category::all();

        return view('cards.index', compact('cards', 'categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        /** @var User $user */
        $user = auth()->user();

        // Normale gebruikers mogen geen inactieve kaarten bekijken
        if (!$user->isAdmin() && !$card->status) {
            abort(404, 'Deze kaart bestaat niet.');
        }

        return view('cards.detail', compact('card'));
    }

/**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cards.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'front' => 'required|string',
            'back' => 'required|string',
            'edition' => 'required|string',
        ]);

        // Zoek de categorie op of maak hem aan
        $category = Category::firstOrCreate([
            'edition' => $request->input('edition'),
        ]);

        // Maak de kaart aan
        $card = new Card();
        $card->title = $request->input('title');
        $card->front = $request->input('front');
        $card->back = $request->input('back');
        $card->category_id = $category->id;

        // Koppel de kaart aan de ingelogde gebruiker
        $card->user_id = auth()->id();

        $card->save();

        return redirect()->route('cards.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user->isAdmin() && $card->user_id != $user->id) {
            abort(403, 'Je mag deze kaart niet bewerken.');
        }

        return view('cards.edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCardRequest $request, Card $card)
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user->isAdmin() && $card->user_id != $user->id) {
            abort(403, 'Je mag deze kaart niet bewerken.');
        }

        $card->title = $request->input('title');
        $card->front = $request->input('front');
        $card->back = $request->input('back');

        // Zoek de categorie op of maak hem aan
        $category = Category::firstOrCreate([
            'edition' => $request->input('edition'),
        ]);

        $card->category_id = $category->id;

        $card->save();

        return redirect()->route('cards.index')
            ->with('success', 'Kaart succesvol bijgewerkt!');
    }

    public function toggleStatus(Card $card)
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user?->isAdmin()) {
            abort(403, 'Toegang geweigerd. Je bent geen admin.');
        }

        $card->status = !$card->status;
        $card->save();

        return redirect()->route('cards.index')
            ->with('success', 'De status is aangepast!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user?->isAdmin()) {
            abort(403, 'Toegang geweigerd. Je bent geen admin.');
        }

        $card->delete();
        return redirect()->route('cards.index')->with('success', 'Kaart succesvol verwijderd!');
    }
}


