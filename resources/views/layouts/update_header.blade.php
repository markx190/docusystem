<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8">
		    <meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title>Whilers | Admin Backoffice</title>
		    <!-- Tell the browser to be responsive to screen width -->
		    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		    <link rel="icon" type="image/x-icon" href="../public/images/favicon.ico" />
		    <!-- Font Awesome -->
		    <link rel="stylesheet" href="{{ asset('public/admin_lte/plugins/fontawesome-free/css/all.min.css') }}">
		    <!-- Ionicons -->
		    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		    <!-- Tempusdominus Bbootstrap 4 -->
		    <link rel="stylesheet" href="/admin_lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
		    <!-- iCheck -->
		    <link rel="stylesheet" href="/admin_lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		    <!-- JQVMap -->
		    <link rel="stylesheet" href="/admin_lte/plugins/jqvmap/jqvmap.min.css">
		    <!-- Select2 -->
		    <link rel="stylesheet" href="/admin_lte/plugins/select2/css/select2.min.css">
		    <link rel="stylesheet" href="/admin_lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
		    <!-- Theme style -->
	
		    
	    <link rel="stylesheet" href="{{ asset('/admin_lte/dist/css/adminlte.min.css') }}">
		    <!-- overlayScrollbars -->
		
		    	    <link rel="stylesheet" href="{{ asset('/admin_lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
		    <!-- Daterange picker -->
		    <link rel="stylesheet" href="/admin_lte/plugins/daterangepicker/daterangepicker.css">
		    <!-- summernote -->
		    <link rel="stylesheet" href="/admin_lte/plugins/summernote/summernote-bs4.css">
		    <!-- Google Font: Source Sans Pro -->
		    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
		    <link rel="stylesheet" href="/admin_lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
		    <!-- <link rel='stylesheet' href='https://cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css'> -->
	    <link rel="stylesheet" href="{{ asset('/admin_lte/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin_lte/datatables_responsive.css') }}">
    
<script src="{{ asset('/admin_lte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


</head>
<body class="hold-transition sidebar-mini layout-fixed" style="font-size: 15px;">
<div class="wrapper">
<!-- Navbar -->
	<nav class="main-header navbar navbar-expand navbar-purple navbar-purple fixed-top">
    	<!-- Left navbar links -->
    		<ul class="navbar-nav">
        		<li class="nav-item">
          		<a class="nav-link" style="color: #EEEEEE;" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        		</li>
        		<!-- <li class="nav-item d-none d-sm-inline-block">
          		<a href="{{ route('dashboard') }}" class="nav-link" style="color: #EEEEEE;">Home</a>
        		</li>
        		<li class="nav-item d-none d-sm-inline-block">
          	<a href="#" class="nav-link" style="color: #EEEEEE;">Contact Us</a>
        </li> -->
    </ul>
    <!-- SEARCH FORM -->
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        
      		<!-- Notifications Dropdown Menu -->
      		<li class="nav-item dropdown">
    <a class="nav-link"
       href="#"
       id="orderBell"
       data-toggle="dropdown"
       aria-haspopup="true"
       aria-expanded="false"
       style="color:#EEEEEE;">

        <i class="far fa-bell"></i>
        <span class="badge badge-danger navbar-badge" id="orderCount">0</span>
    </a>

    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
         aria-labelledby="orderBell">

        <span class="dropdown-item dropdown-header text-left">
            Pending Orders
        </span>

        <div class="dropdown-divider"></div>

        <div id="orderList">
            <span class="dropdown-item text-muted text-center">
                No unpaid orders 🎉
            </span>
        </div>
    </div>
</li>

    	@if(session()->get('GoogleName') == 'Admin')
    		<li class="nav-item">
        		<a class="nav-link" style="color: #EEEEEE;" data-widget="control-sidebar" data-slide="true" href="#">
            		<i class="fas fa-th-large"></i>
            	</a>
       		</li>
   	 	@endif
    </ul>
</nav>
<!-- /.navbar -->
<audio id="orderSound">
    <source src="{{ asset('../audio/shop-notification.mp3') }}" type="audio/mpeg">
</audio>

<script src="{{ asset('../admin_lte/plugins/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('../admin_lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>



<script>
$(function () {
    function loadOrders() {
        $.get("{{ route('check_orders') }}", function (orders) {

            let html = '';
            let count = orders.length;

            $('#orderCount').text(count);
            $('#orderCount').toggle(count > 0);

            if (count === 0) {
                html = `
                    <span class="dropdown-item text-muted text-center">
                        No unpaid orders 🎉
                    </span>
                `;
            } else {
                orders.forEach(order => {
                    html += `
                        <a href="#"
                           class="dropdown-item order-item d-flex align-items-center"
                           data-id="${order.order_id}">

                            <img src="/images/default_avatar.jpg"
                                 class="img-circle elevation-2 mr-3"
                                 alt="User Image"
                                 style="width:40px;height:40px;">

                            <div class="flex-grow-1">
                                <strong>${order.firstname ?? 'Unknown'} ${order.lastname ?? ''}</strong><br>
                                <small class="text-muted">${order.mobile_number ?? ''}</small>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    `;
                });
            }

            $('#orderList').html(html);
        });
    }

    loadOrders();
    setInterval(loadOrders, 60000);

    // Click → mark checked → disappear
    $(document).on('click', '.order-item', function (e) {
        e.preventDefault();

        let orderId = $(this).data('id');

        $.post("{{ route('mark_order_checked') }}", {
            _token: "{{ csrf_token() }}",
            order_id: orderId
        }, function () {
            loadOrders();
        });
    });

});
</script>
