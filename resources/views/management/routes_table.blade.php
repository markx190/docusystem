<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-top: 50px;">
    <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                <!-- <h1 class="m-0 text-dark">Dashboard</h1> -->
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard" style="color: #757D75;">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/manage_routes">Routes</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<main class="subs">
    <div class="container-fluid"> 
        <div class="row charts-docs">
            <div class="col-xl-12 ">
            <div class="card mb-4">  
            <div class="card-header subscription-h">
        <i class="fa fa-link"></i>
    Routes
</div> 
<div class="card-body docs-body">
@if(session()->has('delete_route_success'))
<div class="col-md-12" style="margin-top: 12px;">
    <div class="alert alert-success alert-dismissible"><i class="fa fa-check"></i>
        <a href="#" style="text-decoration: none; color: #FFFFFF;" class="close" 
            data-dismiss="alert" aria-label="close">&times;
        </a>
        {{ session()->get('delete_route_success') }}
    </div>
</div>
@endif
    <div class="row">
        <div class="col-md-6">
        <!-- <button class="btn btn-success btn-xs" onclick="addApplicant(event)"><i class="fa fa-plus-circle"></i> Add Applicant</button> -->
        <a href="{{ route('add_route_form') }}"><button class="btn btn-success btn-xs">
            <i class="fa fa-plus-circle"></i> Add New Route</button></a>
    </div>
</div>
<br>
<div class="table-responsive">
    <table id="routes" class="table-docs table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th class="t-th">Direction</th>
                <th class="t-th">Name</th>
                <th class="t-th">Terminal</th>
                <th class="t-th">Address</th>
                <th class="t-th">Status</th>  
                <th class="t-th">Action</th>                
            </tr>
        </thead>
    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .btn-group-xs > .btn, .btn-xs {
        padding: .25rem .4rem;
        font-size: .875rem;
        line-height: .5;
        border-radius: .2rem;
    }
    .t-th {
        font-size: 14px;
        font-family: "Montserrat", sans-serif;
        text-transform: uppercase;
        background-color: #BFBFBF;
        height: 2.3em;
        white-space: nowrap; 
    }
    .center {
        display: block;
        margin-left: auto;
        margin: auto;
        width: 100%;
    }  
    .subscription-h {
        background-color: #BFBFBF;
    }
    td { 
        white-space: nowrap; 
    }
</style>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->
<script src="/admin_lte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/admin_lte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/admin_lte/plugins/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
loadRoutesDataTable();
function loadRoutesDataTable(){
    $('.spinner').hide();
    $('.docs-body').show();
    $('#routes').DataTable().destroy();
        table = $('#routes').DataTable({
            "searching": true,
            "processing": false,
            "serverSide": false,
            "paginate": true,
            "responsive": true,
            "paging": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "lengthChange": true,
            "pageLength": 5,
            "ajax": {
                'url': '{{ url("/routes_datatables") }}',
                "data" : {
                    // "_token"	: "{{ csrf_token() }}"
	    		}
            },
            columnDefs: [
                { className: 'dt-body-center', targets: 5, "className": "text-center" },
                { targets: 5, orderable: false },
                { width: 50, targets: 0 },
                { width: 50, targets: 1 },
                { width: 50, targets: 2 },
                { width: 50, targets: 3 },
                { width: 50, targets: 4 },
                { width: 50, targets: 5 }
            ],
            columns:[
            {
                data: 'direction',
                name: 'direction'
            },
            {
                data: 'route_name',
                name: 'route_name'
            },
            {
                data: 'terminal',
                name: 'terminal'
            },
            {
                data: 'terminal_address',
                name: 'terminal_address'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action'
            }
        ]
    });   
}
});

</script>












