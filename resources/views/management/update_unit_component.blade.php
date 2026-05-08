@include('layouts.update_header')
<!-- Main Sidebar Container -->
	<aside class="main-sidebar elevation-4" style="background-color: #FFFFFF;">
    	<!-- Brand Logo -->
      	<a href="https://whilers.com" style="text-decoration: none; color: red;" class="brand-link">
        <center style="font-weight: 700; font-size: 24.3px;">whilers</center>
    </a>
    <!-- Sidebar -->
	<hr style="margin-top: -8px;">
    <div class="sidebar" style="margin-top: -20px;">
        <!-- Sidebar user panel (optional) -->
        	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
            	<div class="image">
				@if(isset($user->avatar) && !empty($user->avatar))
				<img src="../public/uploads/avatars/{{ $user->avatar }}" class="img-circle elevation-2" 
				style="width: 32px; height: 34px;" alt="User Image">
				@else
				<img src="../public/images/default_avatar.jpg" class="img-circle elevation-2" 
				style="width: 36px; height: 34px;" alt="User Image">
				@endif
			<h6 style="margin-top: 10px;">Hi, {{ $user->firstname }}</h6>
		</div>
    </div>
	<hr style="margin-top: -25px;">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          	<!-- Add icons to the links using the .nav-icon class
            	with font-awesome or any other icon font library -->
          		<li class="nav-item has-treeview menu-open">
            		<a href="/manage_items" class="nav-link active">
              			<i class="nav-icon fas fa-tachometer-alt"></i>
              		<p>Preferences <i class="right fas fa-angle-left"></i></p>
            	</a>
        		<ul class="nav nav-treeview">
        		    <li class="nav-item">
                		<a href="/dashboard" class="nav-link">
                  			<i class="fa fa-desktop nav-icon"></i>
                  			<p>Dashboard</p>
                		</a>
            		</li>
            		@if($user->account_type == 'Host')
					<li class="nav-item">
                		<a href="/manage_units" class="nav-link">
                  			<i class="fa fa-building nav-icon"></i>
                  			<p>Units</p>
                		</a>
            		</li>
            		<li class="nav-item">
                		<a style="cursor: pointer;" href="/manage_guests" class="nav-link">
                  			<i class="fa fa-users nav-icon"></i>
                  			<p>Guests</p>
                		</a>
            		</li>
					<li class="nav-item">
                		<a style="cursor: pointer;" href="/manage_bookings" class="nav-link">
                  			<i class="fa fa-tags nav-icon"></i>
                  			<p>Bookings</p>
                		</a>
            		</li>
            		@endif
					<!-- <li class="nav-item">
                		<a style="cursor: pointer;" onclick="manageSubscription(event)" class="nav-link">
                  			<i class="fa fa-link nav-icon"></i>
                  			<p>Connections</p>
                		</a>
            		</li>
					
					@if(session()->get('GoogleName') == 'Admin')
					<li class="nav-item">
                	<a style="cursor: pointer;" onclick="importExportData(event)" class="nav-link">
                  		<i class="fa fa-upload nav-icon"></i>
                  			<p>Upload Data</p>
                		</a>
            		</li>
					@endif -->
        		</ul>
        	</li>
          	<li class="nav-item">
			  	<a class="dropdown-item" href="{{ route('logout') }}"
                	onclick="event.preventDefault();
                	document.getElementById('logout-form').submit();">
					<i class="fa fa-arrow-left nav-icon"></i>
                	{{ __('Logout') }}
                </a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
					@csrf
					</form>
          		</li>
        	</ul>
    	</nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
@include('management.update_unit_form')
@include('layouts.footer')


