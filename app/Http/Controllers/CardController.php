<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = Card::all();
        return view('cards.index', compact('cards'));
//        $card = new Card();
//        $card->title = 'Rode Smurrie';
//        $card->front = 'Er lag een dode man op de stoep, in rode smurrie.';
//        $card->back = 'De man ergerde zich aan het lawaai van zijn feestvierende buren op het balkon onder hem. Hij besloot met behulp van een paar goed gemikte tomaten een einde aan hun feestje te maken. Om de feestvierders te kunnen raken, moest hij ver over de balkonreling leunen. Hij verloor zijn evenwicht en viel samen met de groente naar beneden.';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCardRequest $request, Card $card)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        //
    }
}
