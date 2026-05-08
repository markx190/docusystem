@include('layouts.header')
	<!-- Main Sidebar Container -->
		<aside class="main-sidebar elevation-4" style="background-color: #FFFFFF;">
    		<!-- Brand Logo -->
      	<a href="/manage_applicants" class="brand-link">
        <!-- <img src="/images/profilejang_logo.png" style="height: 34px; 50px;"> -->
		<center>DIRA</center>
    </a>
    <!-- Sidebar -->
    <div class="sidebar" style="margin-top: -15px;">
        <!-- Sidebar user panel (optional) -->
        	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
            	<div class="image">
            <img src="/admin_lte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ strtoupper(session()->get('GoogleName')) }}</a>
        </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          	<!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
          	<li class="nav-item has-treeview menu-open">
            	<a href="/manage_applicants" class="nav-link active">
              		<i class="nav-icon fas fa-tachometer-alt"></i>
              		<p>Preferences <i class="right fas fa-angle-left"></i></p>
            	</a>
        		<ul class="nav nav-treeview">
            		<li class="nav-item">
                		<a style="cursor: pointer;" href="/manage_applicants" class="nav-link">
                  			<i class="fa fa-list nav-icon"></i>
                  			<p>List of Applicants</p>
                		</a>
            		</li>
					<li class="nav-item">
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
					@endif
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
	</div>
</aside>
@include('auth.registration')
@include('layouts.footer')
