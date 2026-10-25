@foreach ($cards as $card)
    <tr>
        <div>
            <td>Title: {{$card->title}}</td>
        </div>
        <div>
            <td>Front: {{$card->front}}</td>
        </div>
        <div>
            <td>
                <a href="/detail.blade.php?id={{$card->id}}">
                    See back
                </a>
            </td>
        </div>
    </tr>

    <form method="post" action="{{route('cards.destroy', $card)}}">
        @method('DELETE')
        <button type="submit" class="text-red-700">Delete card</button>
    </form>

    @if(auth()->user()?->role === 'admin')
        <div>
            <a href="{{ route('cards.edit', $card->id) }}">Bewerken</a>

            <form action="{{ route('cards.destroy', $card->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Weet je zeker dat je deze kaart wilt verwijderen?')">
                    Verwijderen
                </button>
            </form>
        </div>
    @endif

@endforeach
<div>
    <x-responsive-nav-link :href="route('cards.create')">
        Create a new card
    </x-responsive-nav-link>
</div>


