<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/uploads/laravel.png">
    <link href="/dist/output.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <title>Document</title>
  
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('home') }}">My Laravel App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Home</a>
            </li>
           
            <!-- Add more menu items as needed -->
            @if(auth()->check())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.show') }}">
                    {{ auth()->user()->name }}
                </a>
            </li>
@if(auth()->user()->is_admin || auth()->user()->is_admin3 )
            <li class="nav-item">
                <a class="nav-link" href="{{ route('add') }}">Add</a>
            </li>
            @endif
@else
<li class="nav-item">
                <a class="nav-link" href="{{ url('/register') }}">Inscription</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/login') }}">Connexion</a>
            </li>
            @endif
        </ul>
    </div>
</nav>

@yield('body')
@yield('show')
<!-- Bootstrap JS script tag -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

</body>
</html>
