<!DOCTYPE html>
<html lang="en">

@include('dashboard.partials.head');

<body>
  <div id="preloader">
    <div class="sk-three-bounce">
      <div class="sk-child sk-bounce1"></div>
      <div class="sk-child sk-bounce2"></div>
      <div class="sk-child sk-bounce3"></div>
    </div>
  </div>



  
  <div id="main-wrapper">

    <div class="nav-header">
      <a href="{{route('dashboard')}}" class="brand-logo">
        <img class="brand-title" src="{{ asset('dashboard_assets/images/logos/logo-devpath.png') }}" alt="logo" >
      </a>
      <div class="nav-control">
        <div class="hamburger">
          <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
      </div>
    </div>
    @include('dashboard.partials.header');
    <div class="quixnav">
      <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
          <li class="nav-label first">Main Menu</li>
          <li><a href="{{route('dashboard')}}"><i class="ti-panel"></i><span class="nav-text">Dashboard</span></a></li>

          <li><a class="sidebar-sub-toggle" href="{{ route('customer.index')}}"><i class="ti-bar-chart-alt"></i> <span class="nav-text">Users</span> </a></li>
          <li><a href="{{route('teacher.index')}}"><i class="ti-book"></i> <span class="nav-text">Teachers</span> </a></li>
          <li><a href="{{route('courses.index')}}"><i class="ti-ruler-pencil"></i> <span class="nav-text">Courses</span> </a></li>
          <li><a href="{{route('categories.index')}}"><i class="ti-layout-grid2-alt"></i> <span class="nav-text">Categories</span> </a></li>
          <li><a href="{{route('transactions.index')}}"><i class="ti-money"></i> <span class="nav-text">Transactions</span> </a></li>
          <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="ti-close"></i><span class="nav-text">Logout</span></a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
              @csrf
            </form>
          </li>
          </li>
        </ul>
      </div>
    </div>
    <!-- /# sidebar -->

    @yield('content')



    <div class="footer">
      <p>{{ date('Y') }} © Devpath Admin Board</p>
    </div>


  </div>



  <!-- Include SweetAlert2 via CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="{{asset('dashboard_assets')}}/vendor/global/global.min.js"></script>
  <script src="{{asset('dashboard_assets')}}/js/quixnav-init.js"></script>
  <script src="{{asset('dashboard_assets')}}/js/custom.min.js"></script>

  <script src="{{asset('dashboard_assets')}}/vendor/chartist/js/chartist.min.js"></script>

  <script src="{{asset('dashboard_assets')}}/vendor/moment/moment.min.js"></script>
  <script src="{{asset('dashboard_assets')}}/vendor/pg-calendar/js/pignose.calendar.min.js"></script>


  <script src="{{asset('dashboard_assets')}}/js/dashboard/dashboard-2.js"></script>

  <script src="{{asset('dashboard_assets')}}/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
  <script src="{{asset('dashboard_assets')}}/js/plugins-init/sweetalert.init.js"></script>

  <!-- Datatable -->
  <script src="{{asset('dashboard_assets')}}/vendor/datatables/js/jquery.dataTables.min.js"></script>
  <script src="{{asset('dashboard_assets')}}/js/plugins-init/datatables.init.js"></script>
  <!-- scripit init-->
</body>

</html>