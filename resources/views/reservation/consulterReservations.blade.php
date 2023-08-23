@extends('layouts.default')

@section('title')
<h1 > Vos réservations </h1>
@endsection

@section('content')



@if (count($collectionReservation)>0)
<div class="row justify-content-center">
    <div class="col-8 offset-2">
        @foreach ($collectionReservation as $reservationCourante)
        <div class="card ">  
            <div class="card-header bg-info">
                <h4>
                    NUMERO DE RESERVATION : {{
                    $reservationCourante->getCodereservation()
                    }}
                </h4> 
                <h6>
                    EFFECTUEE LE : {{ 
                    $reservationCourante->getDatereservation()->format('d/m/Y')
                    }}<br>

                </h6>
               
            </div>
            <div class="card-body ">
                <p>
                    MISE A DISPOSITION :
                    {{ 
                     
                        $reservationCourante
                                ->getVilleRelatedByCodevillemisedispo()
                                ->getNomville()
                        
                    }}
                    le {{ $reservationCourante->getDatefinreservation()->format('d/m/Y') }}
                    <br>
                    RESTITUTION :
                    {{ 
                     $reservationCourante
                                ->getVilleRelatedByCodevillemisedispo()
                                ->getNomville()
                        
                    }}
                    le {{ $reservationCourante->getDatefinreservation()->format('d/m/Y') }}
                </p>
                <table class="table table-sm table-striped">  
                    <thead class="thead-dark ">

                        <tr>
                            <th>Type de container</th>
                            <th>Quantité</th>

                        </tr> 

                        @foreach ($reservationCourante->getReservers() as $reserver)
                        {{-- dd($ligneDeReservation) --}}
                        <tr>
                            <td>{{ $reserver->getTypecontainer()->getLibelletypecontainer() }}</td>
                            <td>{{ $reserver->getQtereserver() }}</td>

                        </tr>  
                        @endforeach
                </table>
            </div>
        </div>
        <br>

        @endforeach
    </div>
</div>

@endif

@endsection