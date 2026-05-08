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
    Add New Item
</div> 
@if(session()->has('update_item_success'))
<div class="col-md-12 mt-2">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check-circle"></i>
        {{ session('update_item_success') }}

        <button type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
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
<form method="POST"
      action="{{ route('update_item', $item->item_id_no) }}"
      enctype="multipart/form-data">
    @csrf

<div class="row">

    <div class="col-md-3">
        <label><b>Category</b></label>
        <select class="form-control" name="category">
            <option value="{{ $item->category }}">{{ $item->category }}</option>
            <option value="Food and Groceries">Food and Groceries</option>
                    <option value="Pre Loved Items">Pre Loved Items</option>
                    <option value="Pre Owned Items">Pre Onwed Items</option>
                    <option value="Electronic and Gadgets">Electronic and Gadgets</option>
                    <option value="Vintage Items">Vintage Items</option>
                    <option value="Music Instruments">Music Instruments</option>
                    <option value="Apparels">Apparels</option>
        </select>
    </div>

    <div class="col-md-3">
        <label><b>Item Name</b></label>
        <input type="text" class="form-control" name="item_name"
               value="{{ $item->item_name }}">
    </div>

    <div class="col-md-3">
        <label><b>Generic</b></label>
        <input type="text" class="form-control" name="generic"
               value="{{ $item->generic }}">
    </div>

    <div class="col-md-3">
        <label><b>Brand</b></label>
        <input type="text" class="form-control" name="brand"
               value="{{ $item->brand }}">
    </div>

    <div class="col-md-3">
        <label><b>Unit Price</b></label>
        <input type="text" class="form-control" name="unit_price"
               value="{{ $item->unit_price }}">
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label><b>Description</b></label>
            <textarea rows="3" class="form-control"
            name="description">{{ $item->description }}</textarea>
        </div>
    </div>

    <div class="col-md-3">
        <label><b>Unit of Measure</b></label>
        <input type="text" class="form-control" name="uom"
               value="{{ $item->uom }}">
    </div>

    <div class="col-md-3">
        <label><b>Total Stock</b></label>
        <input type="text" class="form-control" name="total_stock"
               value="{{ $item->total_stock }}">
    </div>

    <div class="col-md-3">
        <label><b>Status</b></label>
        <select class="form-control" name="status">
            <option value="{{ $item->status }}">{{ $item->status }}</option>
            <option value="New Stock">New Stock</option>
            <option value="Low Stock">Low Stock</option>
            <option value="Deactivated">Deactivated</option>
        </select>
    </div>

    <div class="col-md-6 mt-3">
        <label><b>Change Item Image (optional)</b></label>
        <input type="file" name="item_avatar" class="form-control" style="height: 2.7em;">
    </div>

    <div class="col-md-6 mt-3 text-center">
        <label><b>Current Image</b></label><br>
        <img src="{{ asset('/uploads/item_avatars/'.$item->item_avatar) }}"
             class="img-thumbnail"
             style="height: 80px; width: 90px;">
    </div>

</div>

<div class="modal-footer mt-4">
    <button type="submit" class="btn btn-primary btn-sm">
        <i class="fa fa-save"></i> UPDATE ITEM
            </button>
        </div>
    </form>
</div>        
                                        </div><!-- /.container-fluid -->
                                    </form>
                                </section>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
<style>
    .subscription-h {
        background-color: #BFBFBF;
        margin-top: -16px;
    }
</style>

<script>
setTimeout(function () {
    $('.alert').alert('close');
}, 3000);
</script>

