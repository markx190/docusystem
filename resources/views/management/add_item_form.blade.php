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
                    <li class="breadcrumb-item active"></li> Item
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
    Add New Item
</div> 
@if(session()->has('add_item_success'))
<div class="col-md-12" style="margin-top: 12px;">
    <div class="alert alert-success alert-dismissible"><i class="fa fa-check"></i>
        <a href="#" style="text-decoration: none; color: #FFFFFF;" class="close" 
            data-dismiss="alert" aria-label="close">&times;
        </a>
        {{ session()->get('add_item_success') }}
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
<form method="post" action="{{ route('add_item') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <label><b>Category</b></label>
                <select class="form-control" name="category">
                    <option value="{{ old('category') }}">{{ old('category') }}</option>
                    <option value="Food and Groceries">Food and Groceries</option>
                    <option value="Pre Loved Items">Pre Loved Items</option>
                    <option value="Pre Owned Items">Pre Onwed Items</option>
                    <option value="Electronic and Gadgets">Electronic and Gadgets</option>
                    <option value="Vintage Items">Vintage Items</option>
                    <option value="Music Instruments">Music Instruments</option>
                    <option value="Apparels">Apparels</option>
                </select>
            <span class="text-danger">@error('category') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <label><b>Item Name</b></label>
                <input id="fStyle" type="text" class="form-control item_name" value="{{ old('item_name') }}" name="item_name" />
            <span class="text-danger">@error('item_name') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <label><b>Generic</b></label>
                <input id="fStyle" type="text" class="form-control generic" value="{{ old('generic') }}" name="generic" />
            <span class="text-danger">@error('generic') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <label><b>Brand</b></label>
                <input id="mStyle" type="text" class="form-control brand" value="{{ old('brand') }}" name="brand">
            <span class="text-danger">@error('brand') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>Unit Price</b></label>
                    <input id="lStyle" type="text" class="form-control unitprice" value="0.00" name="unit_price" />
                <span class="text-danger">@error('unit_price') {{ $message }} @enderror</span>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label><b>Description</b></label>
                   <textarea rows="3" class="form-control description" name="description"></textarea>
                <span class="text-danger">@error('description') {{ $message }} @enderror</span>
            </div>
        </div>
        <div class="col-md-3">
            <label><b>Unit of Measure</b></label>
                <input id="mStyle" type="text" class="form-control uom" value="{{ old('uom') }}" name="uom">
            <span class="text-danger">@error('uom') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>Total Stock Count</b></label>
                    <input id="lStyle" type="text" class="form-control total_stock" value="{{ old('total_stock') }}" name="total_stock" />
                <span class="text-danger">@error('total_stock') {{ $message }} @enderror</span>
            </div>
        </div>
        
        <div class="col-md-9">
            <label><b>Item Image</b></label>
                <input style="height: 2.8em;" type="file" name="item_avatar" class="form-control a-item-avatar">
            <span class="text-danger">@error('item_avatar') {{ $message }} @enderror</span>
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
    </div>
</main>
<style>
    .subscription-h {
        background-color: #BFBFBF;
        margin-top: -16px;
    }
</style>




