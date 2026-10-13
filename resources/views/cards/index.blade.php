<?php

@foreach ($cards as $card)
    <tr>
        <td>{{$card->title}}</td>
        <td>{{$card->front}}</td>
        <td>
            //<a href="detail.php?id={{$product->id}}">
                //    Details
                //</a>
            //</td>
    </tr>
@endforeach

