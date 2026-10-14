@foreach ($cards as $card)
    <tr>
        <td>{{$card->back}}</td>
        <td>
            <a href="index.blade.php">
                Go back
            </a>
        </td>
    </tr>
@endforeach
