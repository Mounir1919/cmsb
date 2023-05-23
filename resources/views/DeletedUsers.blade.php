@extends('master.html')

@section('body')
@if(session()->has('success'))
        <div id="success-message" class="container alert alert-success">
            {{session()->get('success')}}
        </div>
        <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.remove();
            }
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>
        @endif
        @if(session()->has('info'))
        <div id="success-message" class="container alert alert-primary">
            {{session()->get('info')}}
        </div>
        <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.remove();
            }
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>
        @endif
        @if(session()->has('delete'))
        <div id="success-message" class="container alert alert-danger">
            {{session()->get('delete')}}
        </div>
        <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.remove();
            }
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>
        @endif
        @if(session()->has('delete2'))
        <div id="success-message" class="container alert alert-danger">
            {{session()->get('delete2')}}
        </div>
        <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.remove();
            }
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>
        @endif
 
    <div class="container alert alert-dark my-5 text-center">
        <h1>Management Users</h1>
        <hr>
        <table class="table" >
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Salary</th>
                <th>Image</th>
                <th>View</th>
                <th>Delete Permanently</th>
                <th>Restore</th>
                <th><form id="restoreAllForm" action="{{ route('post.restoreall') }}" method="put" style="display: inline;">
        @csrf
        @method('PUT')
        <button onclick="event.preventDefault(); if (confirm('Are You Sure?')) document.getElementById('restoreAllForm').submit();" class="btn btn-warning" type="submit">Restore All Users</button></th>
    </form>
    <th><form id="deleteAllForm" action="{{ route('post.permaall') }}" method="put" style="display: inline;">
        @csrf
        @method('DELETE')
        <button onclick="event.preventDefault(); if (confirm('Are You Sure?')) document.getElementById('deleteAllForm').submit();" class="btn btn-danger" type="submit">Delete All Users Permanently</button></th>
    </form>


            </tr>
            @foreach($deletedUsers as $t)
    <tr>
        <td>{{$t->id}}</td>
        <td>{{$t->name}}</td>
        <td>{{$t->age}}</td>
        <td>{{$t->salary}}</td>
        <td><img src="{{ asset('./uploads/'.$t->image) }}" width="100" style="border-radius:30px;"></td>
        <td><a href="{{ route('post.show2', $t->id) }}" class="btn btn-primary">Show</a></td>
        <form id="{{$t->id}}" action="{{ route('post.perma', $t->id) }}" method="post">
            @csrf
            @method('DELETE')
        </form>
       
            @if(auth()->check())
                @if(auth()->user()->is_admin || auth()->user()->is_admin3)
                <td><button onclick="event.preventDefault(); if (confirm('Are You Sure?')) document.getElementById('{{ $t->id }}').submit();" class="btn btn-danger" type="submit">Delete Permanently</button></td>
                    <form id="restore{{$t->id}}" action="{{ route('post.restore', $t->id) }}" method="put" style="display: inline;">
                        @csrf
                        @method('PUT')
                        </form>
                        <td><button onclick="event.preventDefault(); if (confirm('Are You Sure?')) document.getElementById('restore{{$t->id}}').submit();"
                        class="btn btn-success" type="submit">Restore</button></td>
                @endif
            @endif
    </tr>
@endforeach

        </table>
        <div class="d-flex justify-content-center">
        {{ $deletedUsers->links() }}
    </div>
@endsection
