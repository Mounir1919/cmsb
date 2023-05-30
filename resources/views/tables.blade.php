<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Users</title>

    <!-- Custom fonts for this template -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}">
<link rel="stylesheet" href="{{asset('fontawesome-free-6.4.0-web\css\all.min.css')}}">


    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <!-- Custom styles for this page -->
    <style>
    .fade-in {
    animation-name: fadeIn;
    animation-duration: 1.5s;
  }
</style>
</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                @if(auth()->check())

                <div class="sidebar-brand-text mx-3">Welcome  {{ auth()->user()->name }}</div>
            </a>@endif

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <div>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span style="font-size:20px;">Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading" style="font-size:20px;">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span style="font-size:20px;">Components</span>
                </a>
                
           
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span style="font-size:20px;">Utilities</span>
                </a>
             
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading" style="font-size:20px;">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span style="font-size:20px;">Pages</span>
                </a>
        
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span style="font-size:20px;">Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span style="font-size:20px;">Tables</span></a>
            </li></div>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                   

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(auth()->check())
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><h1 style="font-size:20px;"><b>{{ auth()->user()->name }}</b></h1></span>
                               
                                <img class="img-profile rounded-circle" style="height:50px;width:50px;"
                                    src="{{auth()->user()->profile_photo_url}}">
                            </a> @endif
                            
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    
                    <div id="table1">                            
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
        }, 7000); // 7000 milliseconds = 5 seconds
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
        }, 7000); // 7000 milliseconds = 5 seconds
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
        }, 7000); // 7000 milliseconds = 5 seconds
    </script>
@endif
@if(session()->has('delete3'))
    <div id="success-message" class="container alert alert-danger">
        {{ session()->get('delete3') }}
    </div>
    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.remove();
            }
        }, 7000); // 7000 milliseconds = 5 seconds
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
        }, 7000); // 7000 milliseconds = 5 seconds
    </script>
@endif
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
        }, 7000); // 7000 milliseconds = 5 seconds
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
        }, 7000); // 7000 milliseconds = 5 seconds
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
        }, 7000); // 7000 milliseconds = 5 seconds
    </script>
        @endif
       
 
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            
                        <div class="d-flex justify-content-between">
  <h1 class="m-0 font-weight-bold text-primary mx-auto">Management Users</h1>
  <form action="{{ route('users.download') }}" method="GET">
    <button type="submit" class="dt-button buttons-print" name="download" id="download"><i class="fa-solid fa-file" style="font-size:20px;"></i>Excel F-Table</button>
  </form>
</div>
</div>

                        
                        
                        <div class="card-body">
                            <div class="table-responsive">
                            <form id="delete-multiple-form" action="{{ route('post.deleteMultiple') }}" method="post">
        @csrf
        @method('DELETE')
                                    
                                   

        <table id="example" class="display nowrap" style="width:100%">
       
        <thead>
            <tr>
                @if(auth()->check())
                    @if(auth()->user()->is_admin || auth()->user()->is_admin3)
                    <td class="text-center">
                <input type="checkbox" id="selectAllCheckbox" onclick="selectAllCheckboxes()" />
            </td>                    @endif
                @endif
                <th class="text-center">ID</th>
                <th class="text-center">Name</th>
                <th class="text-center">Age</th>
                <th class="text-center">Salary</th>
                <th class="text-center">Image</th>
                <th class="text-center">View</th>
                @if(auth()->check())
                    @if(auth()->user()->is_admin || auth()->user()->is_admin3)
                        <th class="text-center">Delete</th>
                        <th class="text-center">Edit</th>
                    @endif
                    
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $t)
                <tr>
<td class="text-center">
                <input type="checkbox" name="selected_ids[]" value="{{$t->id}}" />
            </td>                    <td class="text-center">{{$t->id}}</td></form>
                    <td class="text-center">{{$t->name}}</td>
                    <td class="text-center">{{$t->age}}</td>
                    <td class="text-center">{{$t->salary}}</td>
                    <td class="text-center"><img src="{{ asset('./uploads/'.$t->image) }}" width="100" style="border-radius:30px;"></td>
                    <td class="text-center"><a href="{{ route('post.show', $t->id) }}" class="btn btn-primary" target="_blank">Show</a></td>
                    <td class="text-center">
                        @if(auth()->check() && (auth()->user()->is_admin || auth()->user()->is_admin3))
                            <form id="{{$t->id}}" action="{{ route('post.delete', $t->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                </form>
                            <button onclick="event.preventDefault(); if (confirm('Are You Sure?')) document.getElementById('{{ $t->id }}').submit();" class="btn btn-danger" type="submit">Delete</button>
                        @endif
                    </td>
                    <td class="text-center"><a href="{{ route('post.edit', $t->id) }}" class="btn btn-warning" style="text-align:center;">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- <div class="d-flex justify-content-center">
        </div> -->
        @if($softDeletedUserCount > 0)
        <button type="button" id="delusers"class="btn btn-primary">Deleted Users</button></div>
                    @endif
        @if(auth()->check())
                        @if(auth()->user()->is_admin || auth()->user()->is_admin3)
                        <div class="text-center"> <button id="delete-selected-button" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete selected users?')) document.getElementById('delete-multiple-form').submit();" class="btn btn-danger" disabled type="submit">Delete Selected</button></div>
    </form>

</div>
@endif
@endif 
               
</div>
</div></div>
<div  id="table2" style="display:none;">                            
<div class="card shadow mb-4">
    
                        <div class="card-header py-3">
                      
                            <h1 class="m-0 font-weight-bold text-primary" style="text-align:center" >Management Trash</h1>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">                      
        <table id="example2" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Name</th>
                <th class="text-center">Age</th>
                <th class="text-center">Salary</th>
                <th class="text-center">Image</th>
                <th class="text-center">View</th>
                <th class="text-center">Delete Permanently</th>
                <th class="text-center">Restore</th>
            </tr>
            </thead>
        <tbody>
            @foreach($deletedUsers as $t)
    <tr>
        <td class="text-center">{{$t->id}}</td>
        <td class="text-center">{{$t->name}}</td>
        <td class="text-center">{{$t->age}}</td>
        <td class="text-center">{{$t->salary}}</td>
        <td class="text-center"><img src="{{ asset('./uploads/'.$t->image) }}" width="100" style="border-radius:30px;"></td>
        <td class="text-center"><a href="{{ route('post.show2', $t->id) }}" class="btn btn-primary" target="_blank">Show</a></td>
        <form id="{{$t->id}}" action="{{ route('post.perma', $t->id) }}" method="post">
            @csrf
            @method('DELETE')
        </form>
       
            @if(auth()->check())
                @if(auth()->user()->is_admin || auth()->user()->is_admin3)
                <td class="text-center"><button onclick="event.preventDefault(); if (confirm('Are You Sure?')) document.getElementById('{{ $t->id }}').submit();" class="btn btn-danger" type="submit">Delete Permanently</button></td>
                    <form id="restore{{$t->id}}" action="{{ route('post.restore', $t->id) }}" method="put" style="display: inline;">
                        @csrf
                        @method('PUT')
                        </form>
                        <td class="text-center"><button onclick="event.preventDefault(); if (confirm('Are You Sure?')) document.getElementById('restore{{$t->id}}').submit();"
                        class="btn btn-success" type="submit">Restore</button></td>
                @endif
            @endif
    </tr>
@endforeach
</tbody>
        </table>
  
    <div class="text-center">
    <form id="deleteAllForm" action="{{ route('post.permaall') }}" method="put" style="display: inline;">
        @csrf
        @method('DELETE')
        <button onclick="event.preventDefault(); if (confirm('Are You Sure?')) document.getElementById('deleteAllForm').submit();" class="btn btn-danger" type="submit">Delete All Users Permanently</button></th>
    </form>
    <form id="restoreAllForm" action="{{ route('post.restoreall') }}" method="put" style="display: inline;">
        @csrf
        @method('PUT')
        <button onclick="event.preventDefault(); if (confirm('Are You Sure?')) document.getElementById('restoreAllForm').submit();" class="btn btn-warning" type="submit">Restore All Users</button></th>
    </form></div><br>
    <button type="button" class="btn btn-danger" style="width:100px;" id="back">Back</button>
    
    <script>
    var selectAllCheckbox = document.getElementById("selectAllCheckbox");
var checkboxes = document.querySelectorAll('input[type="checkbox"]:not(#selectAllCheckbox)');
var deleteSelectedButton = document.getElementById('delete-selected-button');

if (selectAllCheckbox) {
    selectAllCheckbox.onclick = function() {
        var isChecked = selectAllCheckbox.checked;
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = isChecked;
        }
        updateDeleteButtonState();
    };
}

for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].onclick = function() {
        updateDeleteButtonState();
    };
}

function updateDeleteButtonState() {
    var anyCheckboxSelected = isAnyCheckboxSelected();
    if (deleteSelectedButton) {
        deleteSelectedButton.disabled = !anyCheckboxSelected;
    }
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
</form>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>
<script charset="utf8" type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script charset="utf8" type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script charset="utf8" type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script charset="utf8" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script charset="utf8" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script charset="utf8" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script charset="utf8" type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script charset="utf8" type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    $('#example').DataTable({
        dom: 'lBfrtip',
        buttons: [
            'copy',

            {
                extend: 'excel',
                text: 'Excel',
                filename: 'Table Users',
                customize: function(xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    var data = sheet.getElementsByTagName('row');
                    
                    // Remove unwanted columns
                    for (var i = data.length - 1; i >= 0; i--) {
                        var cells = data[i].getElementsByTagName('c');
                        for (var j = cells.length - 1; j >= 0; j--) {
                            var cell = cells[j];
                            var column = cell.getAttribute('r').replace(/[0-9]/g, '');
                            
                            // Check if the column header is not in the allowed list
                            if (column !== 'A' && column !== 'B' && column !== 'C' && column !== 'D' && column !== 'E') {
                                data[i].removeChild(cell);
                            }
                        }
                    }
                    
                    xlsx.xl.worksheets['sheet1.xml'] = sheet;
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4] // Specify the column indexes to include (id, name, age, salary)
                }
            },
            {
                extend: 'print',
                text: 'Print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4] // Specify the column indexes to include (id, name, age, salary)
                }
            }
        ],
        lengthMenu: [5,10, 15, 20, 25, 50, 100, 200, 300]

    });
});
</script>
<script>
$(document).ready(function() {
    $('#example2').DataTable({
        dom: 'lBfrtip',
        buttons: [
            'copy',
            
            {
                extend: 'excel',
                text: 'Excel',
                filename: 'Trash Users',
                customize: function(xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    var data = sheet.getElementsByTagName('row');
                    
                    // Remove unwanted columns
                    for (var i = data.length - 1; i >= 0; i--) {
                        var cells = data[i].getElementsByTagName('c');
                        for (var j = cells.length - 1; j >= 0; j--) {
                            var cell = cells[j];
                            var column = cell.getAttribute('r').replace(/[0-9]/g, '');
                            
                            // Check if the column header is not in the allowed list
                            if (column !== 'A' && column !== 'B' && column !== 'C' && column !== 'D') {
                                data[i].removeChild(cell);
                            }
                        }
                    }
                    
                    xlsx.xl.worksheets['sheet1.xml'] = sheet;
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                exportOptions: {
                    columns: [0, 1, 2, 3] // Specify the column indexes to include (id, name, age, salary)
                }
            },
            {
                extend: 'print',
                text: 'Print',
                exportOptions: {
                    columns: [0, 1, 2, 3] // Specify the column indexes to include (id, name, age, salary)
                }
            }
        ],
        // pageLength: 5, // Display 5 records per page
        lengthMenu: [5,10, 15, 20, 25, 50, 100, 200, 300]

    });
});
</script>



<script>
    var  delusers = document.getElementById("delusers");
  var table1 = document.getElementById("table1");
  var table2= document.getElementById("table2");
  var back= document.getElementById("back");



  delusers.addEventListener("click", function() {
    if (table1.style.display === "none" ) {
      table1.classList.add("fade-in");
      table1.style.display = "block";
      table2.style.display = "none";
      table2.classList.add("fade-in");
     
    } else {
        table1.classList.add("fade-in");
      table1.style.display = "none";
      table2.style.display = "block";
      table2.classList.add("fade-in");

  }});
  table1.addEventListener("animationend", function() {
    table1.classList.remove("fade-in");
  }); 
  table2.addEventListener("animationend", function() {
    table2.classList.remove("fade-in");
  });
  var  delusers = document.getElementById("delusers");
  var table1 = document.getElementById("table1");
  var table2= document.getElementById("table2");
  var back= document.getElementById("back");



  back.addEventListener("click", function() {
    if (table2.style.display === "none" ) {
      table1.classList.add("fade-in");
      table1.style.display = "none";
      table2.style.display = "block";
      table2.classList.add("fade-in");
     
    } else {
        table1.classList.add("fade-in");
      table1.style.display = "block";
      table2.style.display = "none";
      table2.classList.add("fade-in");

  }});
  table1.addEventListener("animationend", function() {
    table1.classList.remove("fade-in");
  }); 
  table2.addEventListener("animationend", function() {
    table2.classList.remove("fade-in");
  });
</script>
</html>