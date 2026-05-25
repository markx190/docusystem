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
                    <li class="breadcrumb-item active"></li> Files
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
        <i class="fa fa-plus-circle"></i>
    Add New File
</div> 
@if(session()->has('history_success'))
<div class="col-md-12" style="margin-top: 12px;">
    <div class="alert alert-success alert-dismissible"><i class="fa fa-check"></i>
        <a href="#" style="text-decoration: none; color: #FFFFFF;" class="close" 
            data-dismiss="alert" aria-label="close">&times;
        </a>
        {{ session()->get('history_success') }}
    </div>
</div>
@endif
<div class="card-body">
    <div class="col-md-12">
        <a href="{{ route('manage_items') }}"><button class="btn btn-secondary btn-xs" style="margin-top: -18px; margin-left: -4px;">
            <i class="fa fa-arrow-left"></i> 
            Back
        </button></a>
    </div> 
<form method="post" action="{{ route('add_file_history') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label><b>Description</b></label>
                   <textarea rows="3" class="form-control description" name="comments"></textarea>
                   <input type="hidden" name="file_id" value="{{ $items->item_id_no }}" />
                <span class="text-danger">@error('comments') {{ $message }} @enderror</span>
            </div>
        </div>
        <div class="col-md-3">
            <label><b>Status</b></label>
                <select class="form-control" name="file_status">
                    <option value="{{ old('file_status') }}">{{ old('file_status') }}</option>
                    <option value="New">New</option>
                    <option value="Received">Received</option>
                    <option value="For Release">For Release</option>
                    <option value="For Verification">For Verification</option>
                    <option value="Pending">Pending</option>
                    <option value="For Approval">For Approval</option>
                    <option value="Declined">Declined</option>
                    <option value="Approved">Approved</option>
                </select>
        </div>
    </div>
</div>

<div class="modal-footer">
    <div class="row s-btn">
        </div>
            <button id="update-btn" type="submit" 
                class="btn btn-primary btn-sm">
                    <i class="fa fa-save"></i> Save</button>
                        </div>
                            </div>
                        </div>        
                    </div><!-- /.container-fluid -->
                </form>
            </section>
        </div>
        <div class="container-fluid"> 
        <div class="row charts-docs">
            <div class="col-xl-12 ">
            <div class="card mb-4">  
            <div class="card-header subscription-h">
        <i class="fa fa-folder"></i>
    File Update History
</div> 
<div class="card-body docs-body">
    <div class="row">
        <div class="col-md-6">
        <!-- <button class="btn btn-success btn-xs" onclick="addApplicant(event)"><i class="fa fa-plus-circle"></i> Add Applicant</button> -->
    </div>
</div>
<br>
<div class="table-responsive">
    <table id="history" class="table-docs table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th class="t-th">Comments</th>
                <th class="t-th">Updated By</th>
                <th class="t-th">Department</th>
                <th class="t-th">Status</th>
                <th class="t-th">Date</th>               
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
    </div>

     </div>
    </div>

</main>
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
<script type="text/javascript">
$(document).ready(function () {
loadItemHistoryDataTable();
function loadItemHistoryDataTable(){
    $('.spinner').hide();
    $('.docs-body').show();
    $('#history').DataTable().destroy();
        table = $('#history').DataTable({
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
                'url': "/file_history_datatable",
                "data" : {
                    // "_token"	: "{{ csrf_token() }}"
	    		}
            },
            columnDefs: [
                { className: 'dt-body-center', targets: 3, "className": "text-center" },
                { targets: 3, orderable: false },
                { width: 50, targets: 0 },
                { width: 50, targets: 1 },
                { width: 50, targets: 2 },
                { width: 50, targets: 3 },
            ],
            columns:[
            {
                data: 'comments',
                name: 'comments'
            },
            {
                data: 'updated_by',
                name: 'updated_by'
            },
            {
                data: 'department',
                name: 'department'
            },
            {
                data: 'file_status',
                name: 'file_status'
            },
            {
                data: 'created_at',
                name: 'created_at'
            }
        ]
    });   
}
});
</script>





