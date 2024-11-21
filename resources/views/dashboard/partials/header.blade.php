<div class="header">
  <div class="header-content">
    <nav class="navbar navbar-expand">
      <div class="collapse navbar-collapse justify-content-between">
        <div class="header-left">
          <div class="search_bar dropdown">
            <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
              <i class="mdi mdi-magnify"></i>
            </span>
            <div class="dropdown-menu p-0 m-0">
              <form>
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
              </form>
            </div>
          </div>
        </div>

        <ul class="navbar-nav header-right">
          <li class="nav-item dropdown notification_dropdown">
            <a class="nav-link" href="#" role="button" data-toggle="dropdown">
              <i class="mdi mdi-bell"></i>
              <div class="pulse-css"></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <ul class="list-unstyled">

                <li class="media dropdown-item">
                  <span class="primary"><i class="ti-heart"></i></span>
                  <div class="media-body">
                    <a href="#">
                      <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                    </a>
                  </div>
                  <span class="notify-time">3:20 am</span>
                </li>

              </ul>
              <a class="all-notification" href="#">See all notifications <i
                  class="ti-arrow-right"></i></a>
            </div>
          </li>
          <li class="nav-item dropdown header-profile">
            <a class="nav-link" href="#" role="button" data-toggle="dropdown">
              <i class="mdi mdi-account"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="{{route('profile.view')}}" class="dropdown-item">
                <i class="icon-user"></i>
                <span class="ml-2">Profile </span>
              </a>
              <a href="/" class="dropdown-item">
                <i class="icon-envelope-open"></i>
                <span class="ml-2">Inbox </span>
              </a>

              <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="ti-power-off"></i> <span class="ml-2">Logout</span>
              </a>
              <form id=" logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
              </form>

            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</div>