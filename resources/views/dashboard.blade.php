
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            Dashboard
        </h2>
    </x-slot>

    <div class="min-h-screen bg-black px-6 py-10 text-white">
        <div class="mx-auto max-w-4xl">

            <h1 class="mb-3 text-3xl font-bold">
                Welcome back!
            </h1>

            <p class="mb-8 text-gray-300">
                What would you like to do today?
            </p>

            <div class="grid gap-6 sm:grid-cols-2">

                <div class="rounded-xl border border-gray-700 bg-gray-900 p-6 shadow-lg">
                    <h2 class="mb-3 text-xl font-bold">
                        My Cards
                    </h2>

                    <p class="mb-6 text-gray-300">
                        Explore the mysterious stories and try to solve them.
                    </p>

                    <a href="{{ route('cards.index') }}"
                       class="inline-block rounded-lg bg-[#D3222C] px-4 py-2 font-semibold text-white transition hover:bg-red-800">
                        View cards
                    </a>
                </div>

                <div class="rounded-xl border border-gray-700 bg-gray-900 p-6 shadow-lg">
                    <h2 class="mb-3 text-xl font-bold">
                        My Favorites
                    </h2>

                    <p class="mb-6 text-gray-300">
                        Find the cards you have saved as favorites.
                    </p>

                    <a href="{{ route('cards.favorites') }}"
                       class="inline-block rounded-lg bg-[#D3222C] px-4 py-2 font-semibold text-white transition hover:bg-red-800">
                        View favorites
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>

