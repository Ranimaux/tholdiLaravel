<!doctype html>
<html lang="fr">
    <head>

        <title>THOLDI</title>
        <!-- Bootstrap core CSS & JS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

        <!-- Custom CSS -->
        <link href="{!! asset('css/custom.css') !!}" rel="stylesheet">
        <!-- Custom JS -->
        <script src="{{ asset('js/custom.js')}}"></script>
        <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    </head>
    <body> 
        <img src="{{ asset('images/logo_tholdi.png')}}"  class="   img-fluid rounded-pill  " 
             alt="Responsive image">  
        <br>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="">
            <div class="container-fluid serif">
                <span class="navbar-brand fantasy"></span>
                <div class="collapse navbar-collapse" id="navbarsExample05">
                    @if(Session::has('utilisateur')==true)
                    <ul class="navbar-nav  mb-2 ">
                        <li class="nav-item">
                            <a class="nav-link active  " aria-current="page" href="#">Accueil</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Réservation</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Effectuer une réservation</a></li>
                                <li><a class="dropdown-item" href="#">Consulter vos réservations</a></li>
                                <li><a class="dropdown-item" href="#">Rechercher une réservation</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Devis</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Consulter vos devis</a></li>
                                <li><a class="dropdown-item" href="#">Rechercher un devis</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Tableau de bord</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Nombre de réservations (par mois)</a></li>
                                <li><a class="dropdown-item" href="#">Répartition géographique (par lieu de mise à disposition)</a></li>
                            </ul>
                        </li>
                    </ul>         
                </div>
                <div class="me-3 ">
                    <a class="btn btn-primary btn-sm" href="{{route('r-deconnexion')}}" role="button">Déconnexion</a>

                </div>
                @endif
            </div>
        </nav>
        @if(Session::has('utilisateur')==false)
        <div class="container ">

            <form name="form-authentification" method="post" action="{{ route('r-authentification') }}">
                @csrf
                <div class="row mt-3 ">
                    <div class="col-5"> 
                    </div>
                    <div class="col-2 me-2"> 

                        <input type="text" name="identifiant" id="identifiant" placeholder="Identifiant">
                    </div>
                    <div class="col-2 me-2" >

                        <input type="password" name="password"  id="password" placeholder="Password">
                    </div>

                    <div class="col-2 ">

                        <button type="submit" class="btn btn-primary  "  
                                style="--bs-btn-padding-y: .30rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .85rem;
                                --bs-btn-font-family:serif">
                            S'authentifier
                        </button>
                    </div>
                </div>

            </form>
            <hr class="border border-dark border-1  me-2 opacity-50 w-75 float-end">
        </div>
        @endif      
        <div class="container ">

            <h1 class="display-4">@yield("title")</h1>
            <p class="lead"> 
                @yield("content")
            </p>
        </div>
    </body>
</html>