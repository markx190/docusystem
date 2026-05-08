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
                    <li class="breadcrumb-item active">Items</li>
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
        <i class="fa fa-credit-card"></i>
    Manage Orders
</div> 
<div class="card-body docs-body">
    <div class="row">
        
</div>
<br>
<div class="table-responsive">
    <table id="bzTrans" class="table-docs table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th class="t-th">Order Id</th>
                <th class="t-th">Name</th>
                <th class="t-th">Mobile No.</th>
                <th class="t-th">Total Amount</th>  
                <th class="t-th">Status</th>  
                <th class="t-th">Action</th>                
            </tr>
        </thead>
    </table>
                        </div>
                           Total Gross Sales:  {{ $totalOrdersAmount }}
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
loadBzTransDataTable();
function loadBzTransDataTable(){
    $('.spinner').hide();
    $('.docs-body').show();
    $('#bzTrans').DataTable().destroy();
        table = $('#bzTrans').DataTable({
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
                'url': "/bztrans_datatables",
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
                { width: 50, targets: 5 },
        
            ],
            columns:[
            {
                data: 'order_id',
                name: 'order_id'
            },
            {
                data: 'buyer_name',
                name: 'buyer_name'
            },
            {
                data: 'mobile_number',
                name: 'mobile_number'
            },
           
            {
                data: 'total_amount',
                name: 'total_amount'
            },
            {
                data: 'order_status',
                name: 'order_status'
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












