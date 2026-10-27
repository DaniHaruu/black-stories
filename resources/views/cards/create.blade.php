<x-app-layout>
<form method="POST" action="{{route('cards.index')}}">
    <div>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="{{old('title')}}">
        @error('title')
        <span class="text-red-700">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="front">Front</label>
        <input type="text" id="front" name="front">
        @error('front')
        <span class="text-red-700">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="back">Back</label>
        <input type="text" id="back" name="back">
        @error('back')
        <span class="text-red-700">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <button type="submit">Send</button>
    </div>
</form>
</x-app-layout>
