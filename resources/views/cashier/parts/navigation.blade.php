<nav role="navigation" class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-dark navbar-shadow navbar-border">
    <div  class="navbar-wrapper  ">
        <div class="navbar-container  content container-fluid">
          <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
            <ul class="nav  navbar-nav">
                <li class="nav-item hidden-sm-down">
                    <a href="/cashier/dashboard" class="nav-link nav-link-expand">
                    <i class="ficon icon-grid2">
                        Menü
                        </i>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav float-xs-right">
              <li class="dropdown dropdown-user nav-item">
                    <a href="/#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link" aria-expanded="false">
                        <span class="avatar avatar-online"><img src="/theme_asset/images/portrait/small/avatar-s-1.png" alt="avatar">
                            <i></i>
                        </span>
                        <span class="user-name">
                            {{Auth::user()->name}}
                        </span>
                    </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{route('cashier.profile')}}" class="dropdown-item"><i class="icon-head"></i> Edit Profile</a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="icon-power3"></i> {{ __('Log Out') }}</a>
                    </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
</nav>
<script>
    
</script>