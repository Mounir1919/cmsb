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
                <th>Deleted By</th>


            </tr>
            <tr>
                <th>{{$del->id}}</th>
                <th>{{$del->name}}</th>
                <th>{{$del->age}}</th>
                <th>{{$del->salary}}</th>
                <td><img src="{{ asset('./uploads/'.$del->image) }}" width="100" style="border-radius:30px;"></td>
                <th style="color:red;">{{$del->user1 ? $del->user1->name : null}}</th>
                <th style="color:red;">{{$del->user2 ? $del->user2->name : null}}</th>
                <th style="color:red;">{{$del->user3 ? $del->user3->name : null}}</th>

            </tr>
        </table>
        <a href="{{ route('deleted') }}" class="btn btn-danger">Retour</a>
@endsection