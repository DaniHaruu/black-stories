
<x-app-layout>
    <div class="min-h-screen bg-black px-6 py-10 text-white">
        <div class="mx-auto max-w-4xl">

            <h1 class="mb-8 text-3xl font-bold">
                My Favorites
            </h1>

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

                        <a href="{{ route('cards.show', $card->id) }}"
                           class="inline-block rounded-lg bg-[#D3222C] px-4 py-2 font-semibold text-white transition hover:bg-red-800">
                            See back
                        </a>

                        <div class="mt-6 border-t border-gray-700 pt-4">
                            <form method="POST" action="{{ route('cards.toggleFavorite', $card->id) }}">
                                @csrf
                                <button type="submit"
                                        class="inline-block rounded-lg bg-gray-700 px-4 py-2 text-white transition hover:bg-gray-600">
                                    Remove favorite
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($cards->isEmpty())
                <p class="text-gray-300">
                    You haven't added any favorites yet.
                </p>
            @endif

            <a href="{{ route('cards.index') }}"
               class="mt-5 inline-block rounded-lg bg-[#D3222C] px-4 py-2 text-white transition hover:bg-red-800">
                Back to cards
            </a>

        </div>
    </div>
</x-app-layout>

