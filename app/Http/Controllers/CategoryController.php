<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('cards.index', compact('categories'));
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
    public function store(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user?->isAdmin()) {
            abort(403, 'Toegang geweigerd.');
        }

        $request->validate([
            'edition' => 'required|string'
        ]);

        $category = new Category();

        $category->edition = $request->input('edition');
        $category->save();

        return redirect()->route('cards.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user?->isAdmin()) {
            abort(403, 'Toegang geweigerd. Je bent geen admin.');
        }

        return view('cards.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user?->isAdmin()) {
            abort(403, 'Toegang geweigerd. Your are not an admin.');
        }

        $category->update($request->validated());

        return redirect()->route('cards.index')->with('success', 'Kaart succesvol bijgewerkt!');
    }
}
