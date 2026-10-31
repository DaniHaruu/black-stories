<x-app-layout>
    <div class="min-h-screen bg-black px-6 py-10 text-white">
        <div class="mx-auto max-w-4xl">

            <h1 class="mb-8 text-3xl font-bold">
                My Cards
            </h1>

            <!-- Search and filter -->
            <form method="GET" action="{{ route('cards.index') }}" class="mb-8 flex flex-wrap gap-3">
                <div>
                    <input type="text" name="search"
                           value="{{ request('search') }}"
                           placeholder="Search cards..."
                           class="rounded-lg px-3 py-2 text-black">
                </div>

                <div>
                    <select name="edition" class="rounded-lg px-3 py-2 text-black">
                        <option value="">All editions</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->edition }}"
                                {{ request('edition') == $category->edition ? 'selected' : '' }}>
                                {{ $category->edition }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit"
                        class="rounded-lg bg-[#D3222C] px-4 py-2 text-white transition hover:bg-red-800">
                    Search
                </button>

                <a href="{{ route('cards.index') }}"
                   class="rounded-lg bg-gray-700 px-4 py-2 text-white transition hover:bg-gray-600">
                    Reset
                </a>
            </form>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($cards as $card)
                    <div class="rounded-xl border border-gray-700 bg-gray-900 p-6 shadow-lg">
                        <h2 class="mb-4 border-b border-gray-700 pb-3 text-xl font-bold">
                            {{ $card->title }}
                        </h2>

                        <p class="mb-6 text-gray-300">
                            <span class="font-semibold text-white">Front:</span>
                            {{ $card->front }}
                        </p>

                        <p class="mb-6 text-gray-300">
                            <span class="font-semibold text-white">Edition:</span>
                            {{ $card->category->edition ?? 'Geen editie' }}
                        </p>

                        @if(auth()->user()?->isAdmin())
                            <p class="mb-6 text-gray-300">
                                <span class="font-semibold text-white">Status:</span>
                                {{ $card->status ? 'Active' : 'Inactive' }}
                            </p>
                        @endif

                        <a href="{{ route('cards.show', $card->id) }}"
                           class="inline-block rounded-lg bg-[#D3222C] px-4 py-2 font-semibold text-white transition hover:bg-red-800">
                            See back
                        </a>

                        @if(auth()->user()?->isAdmin() || $card->user_id == auth()->id())
                            <div class="mt-6 border-t border-gray-700 pt-4">
                                <div class="flex flex-wrap gap-3">

                                    <a href="{{ route('cards.edit', $card->id) }}"
                                       class="inline-block rounded-lg bg-[#D3222C] px-4 py-2 text-white transition hover:bg-red-800">
                                        Bewerken
                                    </a>

                                    @if(auth()->user()?->isAdmin())
                                        <form method="POST"
                                              action="{{ route('cards.destroy', $card->id) }}"
                                              onsubmit="return confirm('Weet je zeker dat je deze kaart wilt verwijderen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-block rounded-lg bg-[#D3222C] px-4 py-2 text-white transition hover:bg-red-800">
                                                Delete card
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('cards.toggleStatus', $card->id) }}">
                                            @csrf
                                            <button type="submit"
                                                    class="inline-block rounded-lg bg-[#D3222C] px-4 py-2 text-white transition hover:bg-red-800">
                                                {{ $card->status ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <a href="{{ route('cards.create') }}"
               class="mt-5 inline-block rounded-lg bg-[#D3222C] px-4 py-2 text-white transition hover:bg-red-800">
                Create a new card
            </a>

        </div>
    </div>
</x-app-layout>

