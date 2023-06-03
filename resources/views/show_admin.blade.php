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
            <li class="nav-item active" >
                <a class="nav-link " href="{{route ('show_admin')}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span style="font-size:20px;">Admin </span>
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
            <li class="nav-item ">
                <a class="nav-link" href="{{ route ('tables')}}">
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
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <form method="GET" action="{{ route('admin') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Home
                                    </button>
                                </form>
                                <form method="GET" action="{{ route('profile.show') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </button>
                                </form>
                                    @if(auth()->check())
                                    @if(auth()->user()->status=='High') 
                                    <a class="dropdown-item" href="{{'show_admin'}}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Edit Admin
                                </a>
                                @endif
                                @endif
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

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
        }, 7000); // 7000 milliseconds = 7 seconds
    </script>
@endif
@if(session()->has('info_admin'))
    <div id="success-message" class="container alert alert-primary">
        {{ session()->get('info_admin') }}
    </div>
    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.remove();
            }
        }, 7000); // 7000 milliseconds = 7 seconds
    </script>
@endif
@if(session()->has('success_admin'))
    <div id="success-message" class="container alert alert-success">
        {{ session()->get('success_admin') }}
    </div>
    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.remove();
            }
        }, 7000); // 7000 milliseconds = 7 seconds
    </script>
@endif
@if(session()->has('delete_admin'))
    <div id="success-message" class="container alert alert-danger">
        {{ session()->get('delete_admin') }}
    </div>
    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.remove();
            }
        }, 7000); // 7000 milliseconds = 7 seconds
    </script>
@endif
@if(session()->has('restored'))
    <div id="success-message" class="container alert alert-success">
        {{ session()->get('restored') }}
    </div>
@endif

@if(session()->has('restoreall'))
    <div id="success-message" class="container alert alert-success">
        {{ session()->get('restoreall') }}
    </div>
@endif

@if(session()->has('delete3'))
    <div id="success-message" class="container alert alert-danger">
        {{ session()->get('delete3') }}
    </div>
@endif

@if(session()->has('delete4'))
    <div id="success-message" class="container alert alert-success">
        {{ session()->get('delete4') }}
    </div>
@endif

@if(session()->has('success'))
    <div id="success-message" class="container alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

@if(session()->has('delete'))
    <div id="success-message" class="container alert alert-danger">
        {{ session()->get('delete') }}
    </div>
@endif

@if(session()->has('delete2'))
    <div id="success-message" class="container alert alert-danger">
        {{ session()->get('delete2') }}
    </div>
@endif

@if(session()->has('empty'))
    <div id="success-message" class="container alert alert-danger">
        {{ session()->get('empty') }}
    </div>
@endif

<script>
    setTimeout(function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.remove();
        }
    }, 7000); // 7000 milliseconds = 7 seconds
</script>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            
                        <div class="d-flex justify-content-between">
  <h1 class="m-0 font-weight-bold text-primary mx-auto">Management Admin</h1>
  <a href="{{ route('register')}}" class="btn btn-primary"style="height: 50px; padding: 13px;" name="admin" id="admin"><i class="fa-solid fa-user-plus"></i> Add Admin</a>&nbsp;&nbsp;
  <a class="btn btn-success" style="height: 50px; padding: 13px;" id="upgrade"><i class="fa-solid fa-user-pen"></i> Edit Admin</a>
</div>
</div>                       
<div class="card-body">
    <div class="table-responsive">
        <table id="example" class="display nowrap" style="width:100%">      
        <thead>
            <tr>
   
                <th class="text-center">ID</th>
                <th class="text-center">Name</th>
                <th class="text-center">E-mail</th>
                <th class="text-center">Status</th>
                <th class="text-center">Image</th>
    
            </tr>
        </thead>
        <tbody>
            @foreach($users as $t)
                <tr>
                    <td class="text-center">{{$t->id}}</td></form>
                    <td class="text-center">{{$t->name}}</td>
                    <td class="text-center">{{$t->email}}</td>
                    <td class="text-center">{{$t->status}}</td>
                    <td class="text-center">
                        @if(isset($t->profile_photo_path))
                            <a href="{{ asset('./storage/'.$t->profile_photo_path) }}" download>Download Image</a>
                        @else
                            File not available
                        @endif
                    </td>                   
                 
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
 
               
</div>
</div></div>
<div  id="table2" style="display:none;">                            
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            
                        <div class="d-flex justify-content-between">
  <h1 class="m-0 font-weight-bold text-primary mx-auto">Edit Admin</h1>

</div>
</div>                       
<div class="card-body">
    <div class="table-responsive">
        <table id="example2" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">E-mail</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>

                </tr>
            </thead>
            <tbody>
           
            @foreach($users as $t)
    <tr>
        <td class="text-center">{{$t->id}}</td>
        <td class="text-center">
    <form action="{{ route('up', $t->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to edit this user?')">
        @csrf
        <input type="text" class="form-control" name="name" value="{{$t->name}}">
</td>
        <td class="text-center">
            <input type="email" class="form-control" name="email" value="{{$t->email}}">
        </td>
        <td class="text-center">
            <select class="form-control" name="status">
                <option value="High" {{$t->status == 'High' ? 'selected' : ''}}>High</option>
                <option value="Medium" {{$t->status == 'Medium' ? 'selected' : ''}}>Medium</option>
                <option value="Low" {{$t->status == 'Low' ? 'selected' : ''}}>Low</option>
            </select>
        </td>
        <td class="text-center">
            <button type="submit" class="btn btn-warning">Edit</button>
            </form>
        </td>
        <td class="text-center">
                            <form id="{{$t->id}}" action="{{ route('delete_admin', $t->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                </form>
                            <button onclick="event.preventDefault(); if (confirm('Are You Sure?')) document.getElementById('{{ $t->id }}').submit();" class="btn btn-danger" type="submit">Delete</button>
                    </td>
    </tr>

@endforeach
</tbody>
        </table>
        <div class="text-center" >
            <br><br>
            <a class="btn btn-danger" style="width:100px;" id="back"><i class="fa-solid fa-arrow-left"></i> Back</a>
    </form>
</div>

    </div>
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
    // Handle the click event on the notification icon or trigger
    $('.dropdown-toggle').on('click', function(e) {
        e.preventDefault();
        $(this).next('.dropdown-menu').toggle();
    });
    
    // Close the dropdown menu when clicking outside of it
    $(document).on('click', function(e) {
        var target = e.target;
        if (!$(target).is('.dropdown-toggle') && !$(target).parents().is('.dropdown-toggle')) {
            $('.dropdown-menu').hide();
        }
    });
});
</script>
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
    var  upgrade = document.getElementById("upgrade");
  var table1 = document.getElementById("table1");
  var table2= document.getElementById("table2");
  var back= document.getElementById("back");



  upgrade.addEventListener("click", function() {
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
  
</script>
<script>
  var table1 = document.getElementById("table1");
  var table2= document.getElementById("table2");
  var back= document.getElementById("back");



  back.addEventListener("click", function() {
    if (table2.style.display === "none" ) {
      table2.classList.add("fade-in");
      table2.style.display = "block";
      table1.style.display = "none";
      table1.classList.add("fade-in");
     
    } else {
        table2.classList.add("fade-in");
      table2.style.display = "none";
      table1.style.display = "block";
      table1.classList.add("fade-in");

  }});
  table1.addEventListener("animationend", function() {
    table1.classList.remove("fade-in");
  }); 
  table2.addEventListener("animationend", function() {
    table2.classList.remove("fade-in");
  });
  
</script>
</html>