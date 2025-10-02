<!-- resources/views/login.blade.php -->
@extends('layouts.master')
@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css"/>
</head>
<body class="container mt-5">

<h1>Connexion</h1>

<form method="POST" action="{{ url('/verifierConnexion') }}">
    @csrf

    <div class="mb-3">
        <label for="login" class="form-label">Identifiant</label>
        <input type="text" class="form-control" id="login" name="login" required>
    </div>

    <div class="mb-3">
        <label for="mdp" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="mdp" name="mdp" required>
    </div>

    <button type="submit" class="btn btn-primary">Se connecter</button>

    @if(isset($erreur))
        <div class="alert alert-danger mt-3">{{ $erreur }}</div>
    @endif
</form>

</body>
</html>
@endsection
