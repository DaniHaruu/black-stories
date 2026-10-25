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
                <a href="{{ route('cards.show', $card->id) }}">
                    See back
                </a>
            </td>
        </div>
    </tr>

    @if(auth()->user()?->isAdmin())
        <div>
            <a href="{{ route('cards.edit', $card->id) }}">Bewerken</a>
        </div>
        <div>
            <form method="POST" action="{{ route('cards.destroy', $card->id) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-700" onclick="return confirm('Weet je zeker dat je deze kaart wilt verwijderen?')">
                    Delete card
                </button>
            </form>
        </div>
        <div>
            <x-responsive-nav-link :href="route('cards.create')">
                Create a new card
            </x-responsive-nav-link>
        </div>
    @endif
@endforeach



