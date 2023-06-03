<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.5.0/js/bootstrap.bundle.min.js"></script>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}">
<link rel="stylesheet" href="{{asset('fontawesome-free-6.4.0-web\css\all.min.css')}}">
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
            <li class="nav-item active">
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
            @if(auth()->check())
            @if(auth()->user()->status == 'High')
            <li class="nav-item" >
                <a class="nav-link " href="{{route ('show_admin')}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span style="font-size:20px;">Admin </span>
                </a>
                
           
            </li>
            @endif
            @endif
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
                <a class="nav-link" href="{{ route('tables')}}">
                    <i class="fas fa-fw fa-table"></i>
                    <span style="font-size:20px;">Tables</span></a>
            </li></div>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
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
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                       <!-- Nav Item - Alerts -->
@if(auth()->user()->status == 'High' || auth()->user()->status == 'Medium')

<li class="nav-item dropdown no-arrow mx-1" >
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="badge badge-danger badge-counter">{{ auth()->user()->unreadNotifications->count() }}</span>
        @endif
@endif

    </a>
    <!-- Dropdown - Alerts -->
   
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" style="width: 650px !important;">
    <h6 class="dropdown-header">
        Alerts Center
    </h6>
    <!-- Rest of the dropdown menu content -->
    <div style="max-height: 380px; overflow-y: auto;">
        @foreach(auth()->user()->unreadNotifications as $notification)
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            @if ($notification->data['image'] != NULL)
                                <img src="{{ asset('uploads/' . $notification->data['image']) }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                            @elseif ($notification->data['Gender'] === 'Homme')
                                <img src="{{ asset('uploads/empty_man.png') }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                            @elseif ($notification->data['Gender'] === 'Femme')
                                <img src="{{ asset('uploads/empty_woman1.png') }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                            @endif
                        </div>
                </div>
                <div class="d-flex justify-content-between align-items-center flex-grow-1">
                    <div>
                        <div class="small text-gray-500">{{ $notification->created_at->format('F d, Y') }}</div>
                        <span class="font-weight-bold">{{ $notification->data['message'] }}</span>
                    </div>
                    <div class="form-inline">
    <div class="button-container">
        <form action="{{ route('confirm-user', ['id' => $notification->data['unconfirmed_user_id']]) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Are you sure you want to confirm?')">Confirm</button>
        </form>
    </div>&nbsp;&nbsp;
    <div class="button-container">
        <form action="{{ route('deletenotif', ['id' => $notification->data['unconfirmed_user_id']]) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to Delete?')">Delete</button>
        </form>
    </div>
</div>



                </div>
            </a>
        @endforeach
    </div>
    <a class="dropdown-item text-center small text-gray-500" style="cursor:pointer;" id="okay">Show All Alerts</a>
</div>
</li>
                            
                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Users Registered</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $userCount }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Trash Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $userTrash }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-trash fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Unconfirmed Users
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$userunconfirmed}}</div>
                                                </div>
                                                <div class="col">
                                                    <!-- <div class="progress progress-sm mr-2"> -->
                                                        <!-- <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div> -->
                                                    <!-- </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Requests</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                            <div class="container" style="display:none;" id="confirmall">
                    <h6 class="mt-4">Alerts Center</h6>
                    <div style="max-height: 500px; overflow-y: auto;">
                    @foreach(auth()->user()->unreadNotifications as $notification)
                        <div class="card mb-3">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        @if ($notification->data['image'] != NULL)
                                            <img src="{{ asset('uploads/' . $notification->data['image']) }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                            @elseif ($notification->data['Gender'] === 'Homme')
                                <img src="{{ asset('uploads/empty_man.png') }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                            @elseif ($notification->data['Gender'] === 'Femme')
                                <img src="{{ asset('uploads/empty_woman1.png') }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                            @endif
                        </div>

                    </div>
                    <div class="flex-grow-1">
                        <div class="small text-gray-500">{{ $notification->created_at->format('F d, Y') }}</div>
                        <span class="font-weight-bold">{{ $notification->data['message'] }}</span>
                    </div>
                    <div class="ml-4">
                        <form action="{{ route('confirm-user', ['id' => $notification->data['unconfirmed_user_id']]) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary">Confirm</button>
                        </form>
                        <form action="{{ route('deletenotif', ['id' => $notification->data['unconfirmed_user_id']]) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to Delete?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <form action="{{ route('confirmAllUsers') }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Are you sure you want to confirm all users?')">Confirm all</button>
</form>
<form action="{{ route('deleteall') }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete all users?')">Delete all</button>
</form>
   <a class="btn btn-sm btn-danger" id="back"style="cursor:pointer;width:100px;"><i class="fa-solid fa-arrow-left"></i> back</a>

</div>



                                <!-- Card Header - Dropdown -->
                        <div  id="bar">
                                <div 
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary" >Earnings Overview</h6>
                                    
                               
                                </div>

                                <!-- Card Body -->
                                <div class="card-body" >
                                    <div class="chart-area">
<div style="width: 900px; height: 320px;">
  <canvas id="myChart" style="width: 100%; height: 100%;"></canvas>
</div>
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
    const labels = <?php echo '["' . implode('", "', $labels) . '"]'; ?>;
    const createdData = <?php echo '[' . implode(', ', $createdData) . ']'; ?>;
    const deletedData = <?php echo '[' . implode(', ', $deletedData) . ']'; ?>;
    const unconfirmedUsersData = <?php echo '[' . implode(', ', $unconfirmedUsersData) . ']'; ?>;

    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Users Registered',
                    data: createdData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Green color
                    borderColor: 'rgba(75, 192, 192, 1)', // Green color
                    borderWidth: 1,
                },
                {
                    label: 'Trash Users',
                    data: deletedData,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Red color
                    borderColor: 'rgba(255, 99, 132, 1)', // Red color
                    borderWidth: 1,
                },
                {
                    label: 'Unconfirmed Users',
                    data: unconfirmedUsersData,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)', // Purple color
                    borderColor: 'rgba(153, 102, 255, 1)', // Purple color

                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
</script>

                          </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                                    
                                  
                                </div>
                                <!-- Card Body -->
                                <div class="card-body"  >
                                    <!-- Add this to your Laravel blade template -->

                                    <canvas id="doughnut-chart"></canvas>
<script>
    const userCount = <?php echo $userCount; ?>;
    const userTrash = <?php echo $userTrash; ?>;
    const userunconfirmed = <?php echo $userunconfirmed; ?>;

    const totalUsers = userCount + userTrash + userunconfirmed;

    const userCountPercentage = ((userCount / totalUsers) * 100).toFixed(1);
    const userTrashPercentage = ((userTrash / totalUsers) * 100).toFixed(1);
    const unconfirmedUsersPercentage = ((userunconfirmed / totalUsers) * 100).toFixed(1);

    new Chart(document.getElementById("doughnut-chart"), {
        type: 'doughnut',
        data: {
            labels: ['Users registered', 'Trash Users', 'Unconfirmed Users'],
            datasets: [{
                label: "User Data",
                backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(153, 102, 255, 0.2)'],
                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)', 'rgba(153, 102, 255, 1)'],
                data: [userCountPercentage, userTrashPercentage, unconfirmedUsersPercentage]
    

            }]
        },
        options: {
            title: {
                display: true,
                text: 'User Data Chart'
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return context.formattedValue + '%';
                        }
                    }
                }
            }
        }
    });
</script>

                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Server Migration <span
                                            class="float-right">20%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Sales Tracking <span
                                            class="float-right">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Customer Database <span
                                            class="float-right">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Payout Details <span
                                            class="float-right">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Account Setup <span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Color System -->
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-primary text-white shadow">
                                        <div class="card-body">
                                            Primary
                                            <div class="text-white-50 small">#4e73df</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow">
                                        <div class="card-body">
                                            Success
                                            <div class="text-white-50 small">#1cc88a</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">
                                            Info
                                            <div class="text-white-50 small">#36b9cc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-warning text-white shadow">
                                        <div class="card-body">
                                            Warning
                                            <div class="text-white-50 small">#f6c23e</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                            Danger
                                            <div class="text-white-50 small">#e74a3b</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-secondary text-white shadow">
                                        <div class="card-body">
                                            Secondary
                                            <div class="text-white-50 small">#858796</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-light text-black shadow">
                                        <div class="card-body">
                                            Light
                                            <div class="text-black-50 small">#f8f9fc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-dark text-white shadow">
                                        <div class="card-body">
                                            Dark
                                            <div class="text-white-50 small">#5a5c69</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/undraw_posting_photo.svg" alt="...">
                                    </div>
                                    <p>Add some quality, svg illustrations to your project courtesy of <a
                                            target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                                        constantly updated collection of beautiful svg images that you can use
                                        completely free and without attribution!</p>
                                    <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                                        unDraw &rarr;</a>
                                </div>
                            </div>

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                                </div>
                                <div class="card-body">
                                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                        CSS bloat and poor page performance. Custom CSS classes are used to create
                                        custom components and custom utility classes.</p>
                                    <p class="mb-0">Before working with this theme, you should become familiar with the
                                        Bootstrap framework, especially the utility classes.</p>
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
                        <span>Copyright &copy; Your Website 2021</span>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script>
    var  okay = document.getElementById("okay");
  var confirmall = document.getElementById("confirmall");
  var bar= document.getElementById("bar");



  okay.addEventListener("click", function() {
    if (bar.style.display === "none" ) {
      bar.classList.add("fade-in");
      bar.style.display = "block";
      confirmall.classList.add("fade-in");
      confirmall.style.display = "none";
     
    } else {
    confirmall.classList.add("fade-in");
    confirmall.style.display = "block";
      bar.style.display = "none";
      bar.classList.add("fade-in");

  }});
  bar.addEventListener("animationend", function() {
    bar.classList.remove("fade-in");
  }); 
  confirmall.addEventListener("animationend", function() {
    confirmall.classList.remove("fade-in");
  });
  
</script>
<script>
    var  back = document.getElementById("back");
  var confirmall = document.getElementById("confirmall");
  var bar= document.getElementById("bar");
  back.addEventListener("click", function() {
    if (confirmall.style.display === "none" ) {
      confirmall.classList.add("fade-in");
      confirmall.style.display = "block";
      bar.classList.add("fade-in");
      bar.style.display = "none";
     
    } else {
    bar.classList.add("fade-in");
    bar.style.display = "block";
      confirmall.style.display = "none";
      confirmall.classList.add("fade-in");

  }});
  bar.addEventListener("animationend", function() {
    bar.classList.remove("fade-in");
  }); 
  confirmall.addEventListener("animationend", function() {
    confirmall.classList.remove("fade-in");
  });
  
</script>
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src= href="{{ asset('js/sb-admin-2.min.js')}}" ></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.5.0/js/bootstrap.bundle.min.js"></script>

</body>

</html>