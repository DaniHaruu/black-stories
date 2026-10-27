<x-app-layout>
    <div class="min-h-screen bg-black px-6 py-10 text-white">
        <div class="mx-auto max-w-4xl">

            <h1 class="mb-8 text-3xl font-bold">
                Back of card:
            </h1>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-xl border border-gray-700 bg-gray-900 p-6 shadow-lg">

                    <h2 class="mb-4 border-b border-gray-700 pb-3 text-xl font-bold">
                        {{ $card->title}}
                    </h2>

                    <p class="mb-6 text-gray-300">
                        <span class="font-semibold text-white">Back:</span>
                        {{ $card->back}}
                    </p>

                    <a href="/../cards"
                       class="inline-block rounded-lg bg-[#D3222C] px-4 py-2 font-semibold text-white transition hover:bg-red-800">
                        Go back
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
