@include('layouts.header')
<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4" style="background-color: #FFFFFF;">
    <!-- Brand Logo -->
		<a href="http://ducosystem.com" style="text-decoration: none; color: red;" class="brand-link">
        	<center>Docusystem</center>
		</a>
    <!-- Sidebar -->
<hr style="margin-top: -8px;">
    <div class="sidebar" style="margin-top: -20px;">
        <!-- Sidebar user panel (optional) -->
        	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
            	<div class="image">
				@if(isset($user->avatar) && !empty($user->avatar))
				<img src="/uploads/avatars/{{ $user->avatar }}" class="img-circle elevation-2" 
				style="width: 52px; height: 50px;" alt="User Image">
				@else
				<img src="/images/default_avatar.jpg" class="img-circle elevation-2" 
				style="width: 52px; height: 50px;" alt="User Image">
				@endif
			<h5 style="margin-top: 10px; font-size: 12px;">Hi, {{ $user->firstname }}</h5>
		</div>
    </div>
	<hr style="margin-top: -25px;">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          	<!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
          		<li class="nav-item has-treeview menu-open">
            		<a href="/manage_routes" class="nav-link active">
              			<i class="nav-icon fas fa-tachometer-alt"></i>
              		<p>Preferences<i class="right fas fa-angle-left"></i></p>
            	</a>
        		<ul class="nav nav-treeview">
            		<li class="nav-item">
                		<a href="/manage_routes" class="nav-link">
                  			<i class="fa fa-link nav-icon"></i>
                  			<p>List of Routes</p>
                		</a>
            		</li>
					@if($user->account_type == 'Administrator')
					<li class="nav-item">
                		<a href="/manage_companies" class="nav-link">
                  			<i class="fa fa-building nav-icon"></i>
                  			<p>List of Companies</p>
                		</a>
            		</li>
					@endif
					
					<!-- @if(session()->get('GoogleName') == 'Admin')
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
@include('management.update_route_form')
@include('layouts.footer')


