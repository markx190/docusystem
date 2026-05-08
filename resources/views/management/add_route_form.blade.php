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
        <i class="fa fa-plus-circle"></i>
    Add New Route
</div> 
@if(session()->has('add_route_success'))
<div class="col-md-12" style="margin-top: 12px;">
    <div class="alert alert-success alert-dismissible"><i class="fa fa-check"></i>
        <a href="#" style="text-decoration: none; color: #FFFFFF;" class="close" 
            data-dismiss="alert" aria-label="close">&times;
        </a>
        {{ session()->get('add_route_success') }}
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
<form method="post" action="{{ route('add_route') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <label><b>Direction</b></label>
                <select class="form-control" name="direction">
                    <option value="{{ old('direction') }}">{{ old('direction') }}</option>
                    <option value="North Bound">North Bound</option>
                    <option value="South Bound">South Bound</option>
                </select>
            <span class="text-danger">@error('direction') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <label><b>Name</b></label>
                <input id="fStyle" type="text" class="form-control route_name" value="{{ old('route_name') }}" name="route_name" />
            <span class="text-danger">@error('route_name') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <label><b>Terminal</b></label>
                <input id="fStyle" type="text" class="form-control terminal" value="{{ old('terminal') }}" name="terminal" />
            <span class="text-danger">@error('terminal') {{ $terminal }} @enderror</span>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>Terminal Address</b></label>
                    <input id="mStyle" type="text" class="form-control brand" value="{{ old('terminal_address') }}" name="terminal_address">
                <span class="text-danger">@error('terminal_address') {{ $message }} @enderror</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>Province</b></label>
                    <select class="form-control" name="province">
                        <option value=""></option>
                        <option value="Aurora">Aurora</option>
                        <option value="Bataan">Bataan</option>
                        <option value="Batangas">Batangas</option>
                        <option value="Benguet">Benguet</option>
                    </select>
                <span class="text-danger">@error('province') {{ $message }} @enderror</span>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <div class="row s-btn">
        </div>
            <button id="update-btn" type="submit" 
                class="btn btn-success btn-sm">
                    <i class="fa fa-save"></i> SUBMIT</button>
                        </div>
                            </div>
                        </div>        
                    </div><!-- /.container-fluid -->
                </form>
            </section>
        </div>
    </div>
</main>
<style>
    .subscription-h {
        background-color: #BFBFBF;
        margin-top: -16px;
    }
</style>




