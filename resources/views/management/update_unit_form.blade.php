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
                    <li class="breadcrumb-item active">Update Unit</li>
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
@if(session()->has('update_unit_success'))
<div class="col-md-12 mt-2">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check-circle"></i>
        {{ session('update_unit_success') }}
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
        <a href="{{ route('manage_units') }}"><button class="btn btn-secondary btn-xs" style="margin-top: -18px; margin-left: -4px;">
            <i class="fa fa-arrow-left"></i> 
            Back
        </button></a>
    </div> 
<form method="POST"
      action="{{ route('update_unit', $unit->item_id_no) }}"
      enctype="multipart/form-data">
    @csrf

<div class="row">

    <div class="col-md-3">
        <label><b>Unit Type</b></label>
        <select class="form-control" name="unit_type">
            <option value="">-- Select Unit Type --</option>
            <option value="Food and Groceries" {{ $unit->unit_type == 'Food and Groceries' ? 'selected' : '' }}>Food and Groceries</option>
            <option value="Music" {{ $unit->unit_type == 'Music' ? 'selected' : '' }}>Music</option>
            <option value="Podcast" {{ $unit->unit_type == 'Podcast' ? 'selected' : '' }}>Podcast</option>
            <option value="Vlog" {{ $unit->unit_type == 'Vlog' ? 'selected' : '' }}>Vlog</option>
            <option value="Tiktok" {{ $unit->unit_type == 'Tiktok' ? 'selected' : '' }}>Tiktok</option>
            <option value="Party Events" {{ $unit->unit_type == 'Party Events' ? 'selected' : '' }}>Party Events</option>
            <option value="KTV" {{ $unit->unit_type == 'KTV' ? 'selected' : '' }}>KTV</option>
            <option value="Resort" {{ $unit->unit_type == 'Resort' ? 'selected' : '' }}>Resort</option>
        </select>
        <span class="text-danger">@error('unit_type') {{ $message }} @enderror</span>
    </div>

    <div class="col-md-3">
        <label><b>Item Name</b></label>
            <input type="text" class="form-control" name="item_name"
               value="{{ $unit->item_name }}">
        <span class="text-danger">@error('item_name') {{ $message }} @enderror</span>
    </div>

    <div class="col-md-3">
        <label><b>Rates</b></label>
            <input type="text" class="form-control" name="rates" value="{{ $unit->rates }}">
            <span class="text-danger">@error('rates') {{ $message }} @enderror</span>
    </div>

    <div class="col-md-3">
        <label><b>Booking Basis</b></label>
            <select class="form-control" name="booking_basis">
            <option value="">-- Select Booking Basis --</option>
            <option value="Hour" {{ $unit->booking_basis == 'Hour' ? 'selected' : '' }}>Hour</option>
            <option value="Day" {{ $unit->booking_basis == 'Day' ? 'selected' : '' }}>Day</option>
        </select>
        <span class="text-danger">@error('booking_basis') {{ $message }} @enderror</span>
    </div>

    <div class="col-md-3">
        <label><b>Operating Hours</b></label>
            <input type="text" class="form-control" name="operating_hours"
               value="{{ $unit->operating_hours }}">
        <span class="text-danger">@error('operating_hours') {{ $message }} @enderror</span>
    </div>
    
    <div class="col-md-3">
        <label><b>Pax Capacity</b></label>
            <input type="text" class="form-control" name="pax_capacity" value="{{ $unit->pax_capacity }}">
    </div>
    
    <div class="col-md-12">
        <div class="form-group">
            <label><b>Description</b></label>
                <textarea rows="3" class="form-control"
                name="description">{{ $unit->description }}</textarea>
            </div>
            <span class="text-danger">@error('description') {{ $message }} @enderror</span>
        </div>
    </div>
    
    <div class="row">
        <div class="form-group">
            <label><b>Address / Location</b></label>
        </div>
    </div>
    
    <div class="row">
    <div class="col-md-3">
        <label><b>Bldg. No.</b></label>
            <input type="text" class="form-control" name="unit_no"
        value="{{ $unit->unit_no }}">
        <span class="text-danger">@error('unit_no') {{ $message }} @enderror</span>
    </div>
    <div class="col-md-3">
        <label><b>Street</b></label>
            <input type="text" class="form-control" name="street"
               value="{{ $unit->street }}">
               <span class="text-danger">@error('street') {{ $message }} @enderror</span>
    </div>
    
    <div class="col-md-3">
        <label><b>City</b></label>
            <input type="text" class="form-control" name="town_city"
               value="{{ $unit->town_city }}">
               <span class="text-danger">@error('town_city') {{ $message }} @enderror</span>
    </div>
    
    <div class="col-md-3">
        <label><b>Province</b></label>
            <input type="text" class="form-control" name="province"
        value="{{ $unit->province }}">
        <span class="text-danger">@error('province') {{ $message }} @enderror</span>
    </div>

    <div class="col-md-3">
        <label><b>Status</b></label>
            <select class="form-control" name="status">
            <option value="{{ $unit->status }}">{{ $unit->status }}</option>
            <option value="Available">Available</option>
            <option value="Unavailable">Unavailable</option>
            <option value="Under Renovation">Under Renovation</option>
            </select>
        </div>
        <span class="text-danger">@error('status') {{ $message }} @enderror</span>
    </div>
    
    <div class="row">
    <div class="col-md-6 mt-3">
        <label><b>Change Item Image (optional)</b></label>
        <input type="file" name="item_avatar" class="form-control" style="height: 2.7em;">
    </div>
    
    <div class="col-md-6 mt-3">
        <label><b>Current Image</b></label><br>
            <img src="{{ asset('public/uploads/item_avatars/'.$unit->item_avatar) }}"
             class="img-thumbnail"
        style="height: 80px; width: 90px;">
    </div>
</div>

<div class="modal-footer mt-4">
    <button type="submit" class="btn btn-primary btn-sm">
        <i class="fa fa-upload"></i> Update Item
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

