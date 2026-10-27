<x-app-layout>
    <div class="min-h-screen bg-black px-6 py-10 text-white">
        <div class="mx-auto max-w-4xl">

            <h1 class="mb-8 text-3xl font-bold">
                Edit card
            </h1>

            <form method="POST" action="{{route('cards.index')}}">
                <div>
                    <label for="title">New title</label>
                    <input type="text" id="title" name="title" value="{{old('title')}}" class="text-black">
                    @error('title')
                    <span class="text-red-700">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="front">New front</label>
                    <input type="text" id="front" name="front" class="text-black">
                    @error('front')
                    <span class="text-red-700">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="back">New back</label>
                    <input type="text" id="back" name="back" class="text-black">
                    @error('back')
                    <span class="text-red-700">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="mt-3 inline-block rounded-lg bg-[#D3222C] px-4 py-2 text-white transition hover:bg-red-800">Send</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
