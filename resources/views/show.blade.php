@extends('master.html')

@section('body')
    <div class="container alert alert-dark my-5 text-center">
        <h1>View</h1>
        <hr>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Salary</th>
                <th>Image</th>
                <th>Added By</th>
                <th>Edited By</th>


            </tr>
            <tr>
                <th>{{$post->id}}</th>
                <th>{{$post->name}}</th>
                <th>{{$post->age}}</th>
                <th>{{$post->salary}}</th>
                <td><img src="{{ asset('./uploads/'.$post->image) }}" width="100" style="border-radius:30px;"></td>
                <th style="color:red;">{{$post->user1 ? $post->user1->name : null}}</th>
                <th style="color:red;">{{$post->user2 ? $post->user2->name : null}}</th>

            </tr>
        </table>
        <a href="{{ route('home') }}" class="btn btn-danger">Retour</a>
@endsection