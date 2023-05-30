@extends('master.html')

@section('body')
@if(session()->has('success'))
    <div id="success-message" class="container alert alert-success">
        {{ session()->get('success') }}
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
        {{ session()->get('info') }}
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
        {{ session()->get('delete') }}
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
@if(session()->has('restored'))
    <div id="success-message" class="container alert alert-success">
        {{ session()->get('restored') }}
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
@if(session()->has('restoreall'))
    <div id="success-message" class="container alert alert-success">
        {{ session()->get('restoreall') }}
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
@if(session()->has('delete3'))
    <div id="success-message" class="container alert alert-success">
        {{ session()->get('delete3') }}
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
@if(session()->has('delete4'))
    <div id="success-message" class="container alert alert-success">
        {{ session()->get('delete4') }}
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
 
        <table class="table">
            <tr>
                @if(auth()->check())
                    @if(auth()->user()->is_admin || auth()->user()->is_admin3)
                        <th>Select All</th>
                    @endif
                @endif
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Salary</th>
                <th>Image</th>
                <th>View</th>
                @if(auth()->check())
                    @if(auth()->user()->is_admin || auth()->user()->is_admin3)
                        <th>Delete</th>
                        <th>Edit</th>
                    @endif
                    @if($softDeletedUserCount > 0)
                        <th><a href="{{ route('deleted') }}" class="btn btn-dark">Deleted Users</a></th>
                    @endif
                @endif
            </tr>
            @foreach($posts as $t)
                <tr> <form id="delete-multiple-form" action="{{ route('post.deleteMultiple') }}" method="post">
        @csrf
        @method('DELETE')
                    <td><input type="checkbox" name="selected_ids[]" value="{{$t->id}}" /></td>
                    <td>{{$t->id}}</td>
                    <td>{{$t->name}}</td>
                    <td>{{$t->age}}</td>
                    <td>{{$t->salary}}</td>
<td>
    @if ($t->image)
        <img src="{{ asset('uploads/'.$t->image) }}" width="100" style="border-radius:30px;">
    @else
        @if ($t->Gender === 'Homme')
            <img src="{{ asset('uploads/empty_man.png') }}" width="100" style="border-radius:30px;">
        @elseif ($t->Gender === 'Femme')
            <img src="{{ asset('uploads/empty_woman1.png') }}" width="100" style="border-radius:30px;">
        @endif
    @endif
</td>
                    <td><a href="{{ route('post.show', $t->id) }}" class="btn btn-primary">show</a></td>
                    <td>
                        @if(auth()->check())
                            @if(auth()->user()->is_admin || auth()->user()->is_admin3)
                                <form action="{{ route('post.delete', $t->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                <button  class="btn btn-danger" type="submit">Delete</button>
                            @endif
                        @endif                                </form>

                    </td>
                    <td><a href="{{ route('post.edit',$t->id) }}" class="btn btn-warning">edit</a></td>
                </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
            {{$posts->links()}}
        </div>
       
        @if(auth()->check())
            @if(auth()->user()->is_admin || auth()->user()->is_admin3)
                <button id="delete-selected-button" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete selected users?')) document.getElementById('delete-multiple-form').submit();" class="btn btn-danger" disabled type="submit">Delete Selected</button>
            @endif
        <button onclick="selectAllCheckboxes()" class="btn btn-primary" type="button">Select All</button>
        <button onclick="selectAllCheckboxes1()" class="btn btn-primary" type="button">Unselect All</button>
    @endif    

</div></form>


<script>
    function selectAllCheckboxes() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var allSelected = true;
        
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = true;
            if (!checkboxes[i].checked) {
                allSelected = false;
            }
        }

        var deleteSelectedButton = document.getElementById('delete-selected-button');
        if (deleteSelectedButton) {
            deleteSelectedButton.disabled = !allSelected;
        }
    }

    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].onclick = function() {
            var deleteSelectedButton = document.getElementById('delete-selected-button');
            if (deleteSelectedButton) {
                deleteSelectedButton.disabled = !isAnyCheckboxSelected();
            }
        };
    }

    function isAnyCheckboxSelected() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                return true;
            }
        }
        return false;
    }
</script>

<script>
        function selectAllCheckboxes1() {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var allSelected = false;
        
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = false;
            if (!checkboxes[i].checked) {
                allSelected = false;
            }
        }

        var deleteSelectedButton = document.getElementById('delete-selected-button');
        if (deleteSelectedButton) {
            deleteSelectedButton.disabled = !allSelected;
        }
        }
</script>




@endsection
