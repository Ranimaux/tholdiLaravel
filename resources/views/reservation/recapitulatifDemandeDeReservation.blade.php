@extends('layouts.default')

@section('title')

<h1> Récapitulatif de votre demande de réservation </h1>

@endsection

@section('content')



<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Code Type Container</th>
            <th scope="col"><a href="{{route('TrierRecapitulatif',"libelleTypeContainer")}}">Libellé Type Container</a></th>  
            <th scope="col">Longueur</th>
            <th scope="col">largueur</th>
            <th scope="col">poids</th>
            <th scope="col">tare</th>
            <th scope="col">capacité de charge</th>
            <th scope="col"><a href="{{route('TrierRecapitulatif',"qteReserver")}}">quantité réservée</a></th>            
        </tr>
    </thead>
    <tbody>

        @foreach($CollectionlignesReservation as $uneLigneDeReservation ) 
        <tr>
            <td>{{ $uneLigneDeReservation["codeTypeContainer"] }}</td>
            <td>{{ $uneLigneDeReservation["libelleTypeContainer"] }}</td>
            <td>{{ $uneLigneDeReservation["longueurCont"] }}</td>
            <td>{{ $uneLigneDeReservation["largeurCont"] }}</td>
            <td>{{ $uneLigneDeReservation["hauteurCont"] }}</td>
            <td>{{ $uneLigneDeReservation["poidsCont"] }}</td>
            <td>{{ $uneLigneDeReservation["tare"] }}</td>
            <td>{{ $uneLigneDeReservation["capaciteDeCharge"] }}</td>
            <td>{{ $uneLigneDeReservation["qteReserver"] }}</td>
        </tr>
        @endforeach


    </tbody>
</table>




@endsection