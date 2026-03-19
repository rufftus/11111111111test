<!doctype html>
<html lang="fr">

<head>
    <title>GSB Frais</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/assets/css/gsb.css"/>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>

    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }
    </style>
</head>

<body class="body">
<div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">GSBfrais</a>
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @if(session('id_visiteur'))
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/listerFrais') }}">Lister</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/ajouterFrais') }}">Ajouter</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{ url('/practicienA') }}">Practicien</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('/practicienB') }}">Top spécialités</a></li>
                                <li><a class="dropdown-item" href="{{ url('/FormulaireInvite') }}">Formulaire d'invité</a></li>
                                <li><a class="dropdown-item" href="{{ url('/Recherche') }}">Recherche</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/deconnecter') }}"> ({{session('visiteur')}}) Se déconnecter</a>
                        </li>
                    </ul>
                @else

                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/connexion') }}"> Se connecter</a>
                        </li>
                    </ul>
                @endif

            </div>
        </div>
    </nav>

</div>

<div class="container" style="margin-top: 80px;">
    @yield('content')
</div>

</body>

</html>
