@extends('layouts.default')

@section('title')
<div class="row">
    <div class="col-5 offset-4  mb-4 mt-5">
        <h2> Réservation  le {{ date('d-m-Y') }}</h2>

    </div>
</div>
@endsection

@section('content')

<form action="{{ route("r-ajouterReservation") }}"  method="post">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-5 offset-4  mb-4 ">
            <div class="card">
                <div class="card-header bg-info">
                    <h5>Date de mise à disposition et de restitution</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col mb-2">
                            <label class="control-label" for="dateDebutReservation">Date de début</label>
                        </div>
                        <div class="col mb-2">
                            <input type="date"  min="{{date('Y-m-d')}}" id="dateDebutReservation" name="dateDebutReservation"  placeholder="date de début de la réservation" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label class="control-label" for="dateFinReservation">Date de fin</label>
                        </div>
                        <div class="col mb-2">
                            <input type="date" min="{{date('Y-m-d')}}"  id="dateFinReservation" name="dateFinReservation"  placeholder="date de fin de la réservation" required>
                        </div>  
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-5 offset-4  mb-4">
            <div class="card">
                <div class="card-header bg-info">
                    <h5> Mise à disposition et restitution </h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col mb-2">
                            <label for="codeVilleMiseDisposition">Ville de mise à disposition</label>
                        </div>
                        <div class="col mb-2">
                            <select class="custom-select" id="codeVilleMiseDisposition" name="codeVilleMiseDisposition" onchange="filterVilleArrivee()">
                                @foreach($collectionVilles as $uneVille) 
                                <option value="{{ $uneVille->getCodeville() }}"> 
                                    {{$uneVille->getNomville()}}
                                </option>
                                @endforeach 
                            </select>     </div>
                    </div>
                    <div class="row">
                        <div class="col mb-2">
                            <label for="codeVilleRendre">Ville de restitution</label>  </div>
                        <div class="col mb-2">
                            <select class="custom-select" id="codeVilleRendre" name="codeVilleRendre">
                                @foreach($collectionVilles as $uneVille) 
                                <option value="{{ $uneVille->getCodeville() }}"> 
                                    {{$uneVille->getNomville()}}
                                </option>
                                @endforeach 
                            </select>  </div>  
                    </div>




                </div>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-5 offset-4  mb-4">
            <div class="card">
                <div class="card-header bg-info">
                    <h5>Information(s) complémentaire(s)</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 mb-2">
                            <label class="control-label" for="volumeEstime">Volume estimé</label>
                        </div>
                        <div class="col-8 mb-2">
                            <input type="number"  id="volumeEstime" name="volumeEstime" class="form-control" placeholder="Saisir la valeur estimée" required>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-5 offset-4 text-center">
            <button type="submit" id="validerReservation" class="btn btn-primary btn-lg">Suivant</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
    </div>

</form>



@if (isset($message))

<div class="modal fade bd-example-modal-sm" id="message" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            {{ $message }}
        </div>
    </div>
</div>  
<script>
    $('#message').modal('show');
</script>

@endif

<script>
    function setDateDeFin() {
        var dateDebut = new Date(document.getElementById("dateDebutReservation").value);
        var dateFin = document.getElementById("dateFinReservation");

        dateDebut.setDate(dateDebut.getDate() + 7);
        var convertDate = dateDebut.toISOString().split('T')[0];
        dateFin.min = convertDate;
    }

    document.getElementById("dateDebutReservation").addEventListener("input", setDateDeFin);
    
    function filterVilleArrivee() {
        const villeDepart = document.getElementById("codeVilleMiseDisposition").value;  
        const villeArrivee = document.getElementById("codeVilleRendre"); 
        const parametre = villeArrivee.options;

        for (let i = 0; i < parametre.length; i++) {
            parametre[i].disabled = parametre[i].value === villeDepart && villeDepart !== "";
        }
    }
</script>

@endsection



