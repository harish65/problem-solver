<div class="left-side-bar">
		<div class="brand-logo">
			<a href="{{ url("home") }}">
				<img src="{{ url("/") }}/assets/vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
				<img src="{{ url("/") }}/assets/vendors/images/deskapp-logo-white.svg" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li>
						<a href="{{ route("dashboard.index") }}" class="dropdown-toggle no-arrow {{ Route::is("dashboard.index") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-home"></span><span class="mtext">Home</span>
						</a>
					</li>
					<li>
						<a href="{{ url("project") }}" class="dropdown-toggle no-arrow {{ Route::is("project") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-list"></span><span class="mtext">Projects</span>
						</a>
					</li>
					<li>
						<a href="{{ url("adminUser") }}" class="dropdown-toggle no-arrow {{ Route::is("adminUser") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-user"></span><span class="mtext">User Manage</span>
						</a>
					</li>
					<li>
						<a href="{{ url("adminProblem") }}" class="dropdown-toggle no-arrow {{ Route::is("adminProblem") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-analytics-6"></span><span class="mtext">Problem Manage</span>
						</a>
					</li>
					{{-- <li>
						<a href="{{ url("adminSolutionType") }}" class="dropdown-toggle no-arrow {{ Route::is("adminSolutionType") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-analytics-14"></span><span class="mtext">Solution Type Manage</span>
						</a>
					</li> --}}
					<li>
						<a href="{{ url("adminSolution") }}" class="dropdown-toggle no-arrow {{ Route::is("adminSolution") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-shopping-bag"></span><span class="mtext">Solution Manage</span>
						</a>
					</li>
					<li>
						<a href="{{ url("adminSolFunction") }}" class="dropdown-toggle no-arrow {{ Route::is("adminSolFunction") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-key3"></span><span class="mtext">Sol Function Manage</span>
						</a>
					</li>
					<li>
						<a href="{{ url("adminVerificationType") }}" class="dropdown-toggle no-arrow {{ Route::is("adminVerificationType") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-key3"></span><span class="mtext">Verification Type</span>
						</a>
					</li>
					<li>
						<a href="{{ url("adminVerificationTypeText") }}" class="dropdown-toggle no-arrow {{ Route::is("adminVerificationTypeText") ? 'active' : '' }}">
							<span class="micon icon-copy dw dw-key3"></span><span class="mtext">Verification Type Text</span>
						</a>
					</li>				
					<li>
						<a href="#submenu2" data-bs-toggle="collapse" class="dropdown-toggle">
							<span class="micon icon-copy dw dw-key3"></span><span class="mtext">Permissions</span>
						</a>
						<ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu" style="padding-left:30%">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="fa fa-circle"> &nbsp; Roles</span></a>
                            </li>
                            <li>
                                <a href="{{ route("admin.permission.index") }}" > <span class="fa fa-circle"> &nbsp; Permissions</span></a>
                            </li>
                        </ul>
					</li>
					
					
				</ul>
			</div>
		</div>
	</div>