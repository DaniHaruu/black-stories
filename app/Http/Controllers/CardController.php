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

        // Normal users only see active cards
        if (!$user->isAdmin()) {
            $cards->where('status', true);
        }

        // Search cards
        if ($request->filled('search')) {
            $search = $request->input('search');

            $cards->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('front', 'like', "%{$search}%")
                    ->orWhere('back', 'like', "%{$search}%");
            });
        }

        // Filter by edition
        if ($request->filled('edition')) {
            $cards->whereHas('category', function ($query) use ($request) {
                $query->where('edition', $request->input('edition'));
            });
        }

        // Filter by viewed or unviewed cards
        if ($request->input('viewed') === 'viewed') {
            $cards->whereIn('id', $user->seenCards()->select('cards.id'));
        } elseif ($request->input('viewed') === 'unviewed') {
            $cards->whereNotIn('id', $user->seenCards()->select('cards.id'));
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

        // Normal users cannot view inactive cards
        if (!$user->isAdmin() && !$card->status) {
            abort(404, 'This card does not exist.');
        }

        return view('cards.detail', compact('card'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        // Admins can always create cards
        if (!$user->isAdmin()) {
            $seenCards = $user->seenCards()->count();

            if ($seenCards < 3) {
                return redirect()->route('cards.index')
                    ->with('error', 'You must view at least 3 different cards before creating your own card.');
            }
        }

        return view('cards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        // Admins can always create cards
        if (!$user->isAdmin()) {
            $seenCards = $user->seenCards()->count();

            if ($seenCards < 3) {
                return redirect()->route('cards.index')
                    ->with('error', 'You must view at least 3 different cards before creating your own card.');
            }
        }

        $request->validate([
            'title' => 'required|string',
            'front' => 'required|string',
            'back' => 'required|string',
            'edition' => 'required|string',
        ]);

        // Find the category or create it
        $category = Category::firstOrCreate([
            'edition' => $request->input('edition'),
        ]);

        // Create the card
        $card = new Card();
        $card->title = $request->input('title');
        $card->front = $request->input('front');
        $card->back = $request->input('back');
        $card->category_id = $category->id;

        // Link the card to the logged-in user
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

        if ($card->user_id != $user->id) {
            abort(403, 'You may not edit this card.');
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

        if ($card->user_id != $user->id) {
            abort(403, 'You may not edit this card.');
        }

        $card->title = $request->input('title');
        $card->front = $request->input('front');
        $card->back = $request->input('back');

        // Find the category or create it
        $category = Category::firstOrCreate([
            'edition' => $request->input('edition'),
        ]);

        $card->category_id = $category->id;

        $card->save();

        return redirect()->route('cards.index')
            ->with('success', 'Card successfully updated!');
    }

    public function toggleStatus(Card $card)
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user?->isAdmin()) {
            abort(403, 'Access denied. You are not an admin.');
        }

        $card->status = !$card->status;
        $card->save();

        return redirect()->route('cards.index')
            ->with('success', 'The status has been updated!');
    }

    public function favorites()
    {
        $user = auth()->user();

        $cards = $user->favorites()
            ->with('category')
            ->when(!$user->isAdmin(), function ($query) {
                $query->where('status', true);
            })
            ->get();

        return view('cards.favorites', compact('cards'));
    }

    public function toggleFavorite(Card $card)
    {
        $user = auth()->user();

        if ($user->favorites()->where('cards.id', $card->id)->exists()) {
            $user->favorites()->detach($card->id);
        } else {
            $user->favorites()->attach($card->id);
        }

        return redirect()->back();
    }

    public function recordView(Card $card)
    {
        $user = auth()->user();

        // Normal users cannot view inactive cards
        if (!$user->isAdmin() && !$card->status) {
            abort(404, 'This card does not exist.');
        }

        // Register the viewed card for every user
        $user->seenCards()->syncWithoutDetaching([$card->id]);

        return redirect()->route('cards.show', $card);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        /** @var User $user */
        $user = auth()->user();

        if ($card->user_id != $user->id) {
            abort(403, 'You may not delete this card.');
        }

        $card->delete();

        return redirect()->route('cards.index')
            ->with('success', 'Card successfully deleted!');
    }
}
