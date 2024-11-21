<!DOCTYPE html>
<html lang="en">

@include('dashboard.partials.head');

<body>
  @include('dashboard.partials.header');
  <div id="main-wrapper">

    <div class="nav-header">
      <a href="{{route('dashboard')}}" class="brand-logo">
        <img class="logo-text" src="{{ asset('dashboard_assets/images/logos/logo-devpath.png') }}" alt="logo" style="width: 200px; height: auto">
      </a>
      <div class="nav-control">
        <div class="hamburger">
          <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
      </div>
    </div>
    <div class="quixnav">
      <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
          <li class="nav-label first">Main Menu</li>
          <li><a href="{{route('dashboard')}}"><i class="ti-panel"></i><span class="nav-text">Dashboard</span></a></li>

          <li><a class="sidebar-sub-toggle" href="/"><i class="ti-bar-chart-alt"></i> Users </a></li>
          <li><a href="app-event-calender.html"><i class="ti-book"></i> Teachers </a></li>
          <li><a href="app-email.html"><i class="ti-ruler-pencil"></i> Courses </a></li>
          <li><a href="app-widget-card.html"><i class="ti-layout-grid2-alt"></i> Categories</a></li>
          <li><a href="app-widget-card.html"><i class="ti-money"></i>Transactions</a></li>
          <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="ti-close"></i> Logout</a>
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


    <div class="row">
      <div class="col-lg-12">
        <div class="footer">
          <p>{{ date('Y') }} © Devpath Admin Board</p>
        </div>
      </div>
    </div>



    <script src="{{asset('dashboard_assets')}}/vendor/global/global.min.js"></script>
    <script src="{{asset('dashboard_assets')}}/js/quixnav-init.js"></script>
    <script src="{{asset('dashboard_assets')}}/js/custom.min.js"></script>

    <script src="{{asset('dashboard_assets')}}/vendor/chartist/js/chartist.min.js"></script>

    <script src="{{asset('dashboard_assets')}}/vendor/moment/moment.min.js"></script>
    <script src="{{asset('dashboard_assets')}}/vendor/pg-calendar/js/pignose.calendar.min.js"></script>


    <script src="{{asset('dashboard_assets')}}/js/dashboard/dashboard-2.js"></script>


    <!-- scripit init-->
</body>

</html>