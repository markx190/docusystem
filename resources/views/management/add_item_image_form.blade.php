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
                    <li class="breadcrumb-item active">Dashboard v1</li>
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
        <i class="fa fa-edit"></i>
    Add New Item Image
</div> 
@if(session()->has('add_item_image_success'))
<div class="col-md-12" style="margin-top: 12px;">
    <div class="alert alert-success alert-dismissible"><i class="fa fa-check"></i>
        <a href="#" style="text-decoration: none; color: #FFFFFF;" class="close" 
            data-dismiss="alert" aria-label="close">&times;
        </a>
        {{ session()->get('add_item_image_success') }}
    </div>
</div>
@endif
<div class="card-body">
    <div class="col-md-12">
        <a href="{{ route('manage_items') }}"><button class="btn btn-primary btn-xs" style="margin-top: -18px; margin-left: -4px;">
            <i class="fa fa-arrow-left"></i> 
            Back
        </button></a>
    </div> 
<form id="avatar-edit-form" enctype="multipart/form-data" method="post">    
{{ csrf_field() }}
    <div class="row">
        <div class="col-md-3">
            <label><b>Item Name</b></label>
                <input id="fStyle" type="text" class="form-control item_name" value="" name="item_name" />
            <span class="text-danger">@error('item_name') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <label><b>Brand</b></label>
                <input style="height: 3em;" id="edit-input-avatar" type="file" name="avatar" class="form-control edit-file">
            <span class="text-danger">@error('brand') {{ $message }} @enderror</span>
        </div>
    </div>
</div>
<br>
<div class="modal-footer">
    <div class="row s-btn">
        </div>
            <button id="update-btn" type="submit" 
                class="btn btn-primary btn-sm">
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




