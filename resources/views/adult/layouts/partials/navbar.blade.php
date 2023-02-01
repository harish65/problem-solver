<header class="header">
    <div class="container">
      <nav class="navbar navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="#"><img src="{{ url('/') }}/assets-new/images/sitelogo.png" alt='Site Logo'/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Problem</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Soluton</a>
            </li>    
            <li class="nav-item">
              <a class="nav-link" href="#">Solution function</a>
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
            <a class="dropdown-item" href="#"><i class="fa fa-gear"></i>Seetings</a>
            <a class="dropdown-item" href="{{route('user.getlogout')}}"><i class="fa fa-lock"></i>Logout</a>
          </div>
        </div>
      </nav>
    </div>
  </header>