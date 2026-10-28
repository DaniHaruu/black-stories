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
    public function index()
    {
//        $cards = Card::all();
        $cards = Card::with('category')->get();
        return view('cards.index', compact('cards'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        return view('cards.detail', compact('card'));
    }

/**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user?->isAdmin()) {
            abort(403, 'Toegang geweigerd. Je bent geen admin.');
        }

        return view('cards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
//    public function store(Request $request)
//    {
//        /** @var User $user */
//        $user = auth()->user();
//
//        if (!$user?->isAdmin()) {
//            abort(403, 'Toegang geweigerd.');
//        }
//
//        $request->validate([
//            'title' => 'required|string',
//            'front' => 'required|string',
//            'back' => 'required|string',
//        ]);
//
//        $card = new Card();
//
//        $card->title = $request->input('title');
//        $card->front = $request->input('front');
//        $card->back = $request->input('back');
//        $card->save();
//
//        return redirect()->route('cards.index');
//    }

    public function store(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user?->isAdmin()) {
            abort(403, 'Toegang geweigerd.');
        }

        $request->validate([
            'title' => 'required|string',
            'front' => 'required|string',
            'back' => 'required|string',
            'edition' => 'required|string'
        ]);

        //Zoek de editie op, of maak hem aan als hij nog niet bestaat
        $category = Category::firstOrCreate([
            'edition' => $request->input('edition')
        ]);

        $card = new Card();
        $card->title = $request->input('title');
        $card->front = $request->input('front');
        $card->back = $request->input('back');

        //Koppel de category_id aan de kaart vóór het opslaan
        $card->category_id = $category->id;
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

        if (!$user?->isAdmin()) {
            abort(403, 'Toegang geweigerd. Je bent geen admin.');
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

        if (!$user?->isAdmin()) {
            abort(403, 'Toegang geweigerd.');
        }

        // Update de gegevens van de kaart
        $card->title = $request->input('title');
        $card->front = $request->input('front');
        $card->back = $request->input('back');
        $card->save();
        
        $card->category->edition = $request->input('edition');
        $card->category->save();

        return redirect()->route('cards.index')
            ->with('success', 'Kaart succesvol bijgewerkt!');
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


