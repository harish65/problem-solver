<header class="header">
    <div class="container">
      <nav class="navbar navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="{{ route("dashboard.index") }}"><img src="{{ url('/') }}/assets-new/images/sitelogo.png" alt='Site Logo'/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item {{ Route::is("dashboard.index") ? 'active' : '' }}">
              <a class="nav-link " href="{{ route("dashboard.index") }}">Home</a>
            </li>
            <li class="nav-item {{ Route::is("problem.index") ? 'active' : '' }}">
              <a class="nav-link" href="{{ route("problem.index") }}">Manage Problem</a>
            </li>
            
            <li class="nav-item {{ Route::is("solution.index") ? 'active' : '' }}">
              <a class="nav-link" href="{{ route("solution.index") }}">Manage Soluton</a>
            </li> 
            <li class="nav-item {{ Route::is("user.index") ? 'active' : '' }}">
              <a class="nav-link " href="{{ route("user.index") }}">Manage User</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="#">Settings</a>
              <!-- <div class="dropdown">
                <a type="button" class="nav-link dropdown-toggle " data-toggle="dropdown">
                  Settings
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('verificationtype.index')}}"><i class="fa fa-user"></i>Verification types</a>
                    <a class="dropdown-item" href="{{ route('verificationtypetext.index')}}"><i class="fa fa-gear"></i>Verification types text</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-gear"></i>Solution function manage</a>
                    <a class="dropdown-item" href="{{route('user.getlogout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
                  </div>
              </div> -->
            </li> 
          </ul>
        </div>  
        
        <div class="dropdown">
          <button type="button" class="btn btn-primary dropdown-toggle profileBtn" data-toggle="dropdown">
            <img src="{{ url('/') }}/assets-new/images/profileImg.png" alt="profile Image"/>
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('verificationtype.index')}}"><i class="fa fa-user"></i>Verification types</a>
            <a class="dropdown-item" href="{{ route('verificationtypetext.index')}}"><i class="fa fa-gear"></i>Verification types text</a>
            <a class="dropdown-item" href="#"><i class="fa fa-gear"></i>Manage Solution Function</a>
            <a class="dropdown-item" href="{{ route('category.index')}}"><i class="fa fa-gear"></i>Manage Problem Category</a>
            <a class="dropdown-item" href="{{route('user.getlogout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
          </div>
        </div>
      </nav>
    </div>
  </header>