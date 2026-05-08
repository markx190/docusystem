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
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
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
        <i class="fa fa-trash"></i>
    Delete Route
</div> 
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
<div class="card-body">
    <div class="col-md-12">
        <a href="{{ route('manage_routes') }}">
            <button class="btn btn-secondary btn-xs" style="margin-top: -18px; margin-left: -4px;">
            <i class="fa fa-arrow-left"></i> 
            Back
        </button></a>
    </div> 
<form method="post" action="{{ route('delete_route') }}" enctype="multipart/form-data">
@csrf
@if($user->account_type == 'Administrator')
    <div class="row">
         <div class="col-md-10">
            <div class="form-group">
                You're about to delete one record. 
            </div>
        </div>
        <div class="col-md-3">
            <label><b>Direction:</b></label>
                {{ $dRoutes->direction }}
            <span class="text-danger">@error('direction') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <label><b>Route ID No:</b></label>
                {{ $dRoutes->route_id_no }}
                <input id="fStyle" type="hidden" class="form-control route_id" name="id" value="{{ $dRoutes->id }}" />
            <span class="text-danger">@error('route_name') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <label><b>Name:</b></label>
                {{ $dRoutes->route_name }}
        </div>
        <div class="col-md-3">
            <label><b>Terminal:</b></label>
                {{ $dRoutes->terminal }}
        </div>
        <div class="col-md-6">
            <label><b>Terminal Address:</b></label>
                {{ $dRoutes->terminal_address }}
        </div>
        <div class="col-md-3">
            <label><b>Status:</b></label>
                {{ $dRoutes->status }}
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="row s-btn">
        </div>
            <button id="update-btn" type="submit" 
                class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i> YES DELETE</button>
                        </div>
                            </div>
                        </div>        
                    </div><!-- /.container-fluid -->
                </form>
            </section>
        @else 
        <div class="row">
            <div class="col-md-10">
                <div class="form-group">
                You are not a allowed to delete this record. 
            </div>      
        @endif
        </div>
    </div>
</main>
<style>
    .subscription-h {
        background-color: #BFBFBF;
        margin-top: -16px;
    }
</style>




