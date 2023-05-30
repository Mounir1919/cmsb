<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            @if(auth()->check())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.show') }}">
                    {{ auth()->user()->name }}
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('add') }}">Add</a>
            </li>
            <!-- Add more menu items as needed -->
        </ul>
    </div>
</nav>
<div class="container alert alert-dark my-5 text-center">
        <h1>Add User</h1>
        <hr>
        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">

    <label for="name">Name:</label>
<input type="text" value="{{ old('name') }}"class="form-control @error('name') is-invalid @enderror" width="300px" id="name" name="name">
@error('name')<p class="text-danger">{{ $message }}</p>@enderror
            </div>
            <div class="mb-3">

<label for="age">Age:</label>
<input type="number" value="{{ old('age') }}" class="form-control @error('age') is-invalid @enderror" width="300px" id="age" name="age">
@error('age')<p class="text-danger">{{ $message }}</p>@enderror
            </div>
            <div class="mb-3">

<label for="salary">Salary:</label>
<input type="number" value="{{ old('salary') }}" class="form-control @error('salary') is-invalid @enderror" width="300px" id="salary" name="salary">
@error('salary')<p class="text-danger">{{ $message }}</p>@enderror
            </div>
            <div class="mb-3">

<label for="image">Image:</label>
<input type="file" value="{{ old('image') }}" class="form-control @error('image') is-invalid @enderror" width="300px" id="image" name="image">
@error('image')<p class="text-danger">{{ $message }}</p>@enderror
            </div>
            <div class="mb-3">
            <label for="gender">Gender:</label>
  <select id="Gender" name="Gender" class="form-control @error('Gender') is-invalid @enderror" style="width: 300px;">
    <option value=""></option>
    <option value="Homme" type="text">Homme</option>
    <option value="Femme" type="text">Femme</option>
  </select>
@error('Gender')<p class="text-danger">{{ $message }}</p>@enderror
</div>        
<br><br>
<button type="submit"class="btn btn-success" style="width:100px;"> Add</button>

        <a href="{{ route('home') }}" class="btn btn-danger"style="width:100px;">Retour</a>
        
<!-- Bootstrap JS script tag -->
</form>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

</body>
</html>
