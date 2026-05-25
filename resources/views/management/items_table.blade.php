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
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Files</li>
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
        <i class="fa fa-folder"></i>
    Files
</div> 
<div class="card-body docs-body">
    <div class="row">
        <div class="col-md-6">
        <!-- <button class="btn btn-success btn-xs" onclick="addApplicant(event)"><i class="fa fa-plus-circle"></i> Add Applicant</button> -->
        <a href="{{ route('add_item_form') }}"><button class="btn btn-success btn-xs"><i class="fa fa-plus-circle"></i> Add New File</button></a>
    </div>
</div>
<br>
<div class="table-responsive">
    <table id="items" class="table-docs table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th class="t-th">Tracking No.</th>
                <th class="t-th">Files Name</th>
                <th class="t-th">Category</th>
                <th class="t-th">Owner</th>
                <th class="t-th">Date Received</th>
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> 
<script src="public/admin_lte/plugins/datatables/jquery.dataTables.js"></script>
<script src="public/admin_lte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="public/admin_lte/plugins/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
loadItemsDataTable();
function loadItemsDataTable(){
    $('.spinner').hide();
    $('.docs-body').show();
    $('#items').DataTable().destroy();
        table = $('#items').DataTable({
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
                'url': "/items_datatables",
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
                data: 'uom',
                name: 'uom'
            },
            {
                data: 'item_name',
                name: 'item_name'
            },
            {
                data: 'category',
                name: 'category'
            },
            {
                data: 'generic',
                name: 'generic'
            },
            {
                data: 'created_at',
                name: 'created_at'
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












