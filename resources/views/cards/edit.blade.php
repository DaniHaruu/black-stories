<x-app-layout>
    <div class="min-h-screen bg-black px-6 py-10 text-white">
        <div class="mx-auto max-w-4xl">

            <h1 class="mb-8 text-3xl font-bold">
                Edit card
            </h1>

            <form method="POST" action="{{ route('cards.update', $card) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title">New title</label>
                    <input type="text" id="title" name="title"
                           value="{{ old('title', $card->title) }}"
                           class="w-full rounded-lg border border-gray-700 bg-gray-900 px-3 py-2 text-white">
                    @error('title')
                    <span class="text-red-700">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="front">New front</label>
                    <textarea id="front" name="front" rows="6"
                              class="w-full rounded-lg border border-gray-700 bg-gray-900 px-3 py-2 text-white">{{ old('front', $card->front) }}</textarea>
                    @error('front')
                    <span class="text-red-700">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="back">New back</label>
                    <textarea id="back" name="back" rows="6"
                              class="w-full rounded-lg border border-gray-700 bg-gray-900 px-3 py-2 text-white">{{ old('back', $card->back) }}</textarea>
                    @error('back')
                    <span class="text-red-700">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="edition">Edition</label>
                    <input type="text" id="edition" name="edition"
                           value="{{ old('edition', $card->category->edition) }}"
                           class="w-full rounded-lg border border-gray-700 bg-gray-900 px-3 py-2 text-white">
                    @error('edition')
                    <span class="text-red-700">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                            class="mt-3 inline-block rounded-lg bg-[#D3222C] px-4 py-2 text-white transition hover:bg-red-800">
                        Save changes
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
