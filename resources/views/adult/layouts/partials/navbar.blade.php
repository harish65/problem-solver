<header class="header">
    <div class="container">
      <nav class="navbar navbar-expand-md navbar-dark">
        <a class="navbar-brand dashboard" href="{{ route('adult.dashboard')}}"><img src="{{ URL::to('/') }}/assets/img/logos/new-logo-01.svg" width="200" height="100" alt="logo"/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link dashboard  {{ Route::is('adult.dashboard') ? 'active' : '' }}" href="{{ route('adult.dashboard')}}">Project</a>
            </li>
            <li class="nav-item" >
              <a class="nav-link nav-problem {{ Route::is('adult.problem') ? 'active' : '' }}"  id="nav-problem" href="">Problem</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-solution {{ Route::is('adult.solution') ? 'active' : '' }}" id="nav-solution" href="">Solution</a>
            </li>    
            <li class="nav-item">
              <a class="nav-link nav-solution-func {{ Route::is('adult.solution-func') ? 'active' : '' }}" id="nav-solution-func" href="">Solution Function</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link nav-varification {{ Route::is('adult.varification') ? 'active' : '' }}" id="nav-varification" href="">Verification</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link nav-relationship {{ Route::is('adult.rel') ? 'active' : '' }}" id="nav-relationship"  href="">Relationship</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link nav-report" id="nav-report" href="">Report</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="#">Result</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="#">Settings</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="#">Quiz</a>
            </li> 
          </ul>
        </div>  
        <div class="dropdown">
          <button type="button" class="btn btn-primary dropdown-toggle profileBtn" data-toggle="dropdown">
            <img src="{{ url('/') }}/assets-new/images/profileImg.png" alt="profile Image"/>
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#"><i class="fa fa-user"></i>Profile</a>
            <a class="dropdown-item" href="{{ route('adult.vfrindex')}}"><i class="fa fa-gear"></i>Verification Type</a>
            <a class="dropdown-item" href="{{route('adult.vrftindex')}}"><i class="fa fa-gear"></i>Verification Type Text</a> 
            <a class="dropdown-item" href="{{route('adult.sftindex')}}"><i class="fa fa-gear"></i>Solution Fuction Type</a> 
            <a class="dropdown-item" href="{{ route('adult.stindex') }}"><i class="fa fa-gear"></i>Solution Type</a> 
            <!-- <a class="dropdown-item" href="{{ route('adult.users') }}"><i class="fa fa-gear"></i>Users</a>  -->
            <a class="dropdown-item logout"  onClick="logout();" href="{{route('user.getlogout')}}"><i class="fa fa-lock"></i>Logout</a>
          </div>
        </div>
        <ul>
          <li>
            <a href="#" class="nav-link dashboard">{{ Auth::user()->name }} {{   Auth::user()->id }} </a>
          </li>
        </ul>
      </nav>
    </div>
  </header>