@extends('layouts.default')

@section('title')

<h1> Réservation (étape 2) </h1>

@endsection

@section('content')

<form action="{{route("r-ajouterLigneReservation")}}" method="post">
    {{ csrf_field() }}
    <div class="row justify-content-around">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    Sélection d'une quantité de container
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="container">Liste des containers</label>
                        <select class="custom-select" id="container" name="container" required>
                            @foreach($typeContainer as $unTypeContainer) 
                            <option  value="{{ $unTypeContainer->getNumtypecontainer() }}"> 
                                {{ $unTypeContainer->getLibelletypecontainer() }}</option>
                            @endforeach 
                        </select>   


                    </div>

                    <div class="form-group">
                        <label class="control-label" for="quantite">Quantité</label>
                        <input type="number"  id="quantite" name="quantite" class="form-control" placeholder="Saisir la quantité" required min="1">
                    </div>  
                    <br>
                    <div class="form-group float-right">
                        <button type="submit" id="buttonAddContainer" name="buttonAddContainer" class="btn btn-primary btn-lg">Ajouter container</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    Lignes de réservation
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>

                                <th scope="col">Type de container</th>
                                <th scope="col">Quantité</th>

                            </tr>
                        </thead>
                        <tbody>
                            @isset($collectionReserver)
                            @foreach($collectionReserver as $reserver)

                            <tr>
                                <td>{{ $reserver->getTypecontainer()->getLibelletypecontainer() }}</td>
                                <td>{{ $reserver->getQtereserver() }}</td>
                            </tr>

                            @endforeach
                            @endisset

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
</form> 
<br><br>

<div class="row">
    <div class="col-lg-8">

    </div>
    <div class="col-lg-4">
        @isset($collectionReserver)
        <form action="{{ route("r-finaliserLaReservation") }}" method="post" >
            {{ csrf_field() }}
            <button type="submit" id="buttonAddReservation" name="buttonAddReservation" class="btn btn-primary btn-lg">
                Valider la demande de réservation
            </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </form>
        @endisset
    </div>
</div>

<script>
</script>




@endsection

