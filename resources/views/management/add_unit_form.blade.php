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
                    <li class="breadcrumb-item active"></li> Units
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
    Add New Unit
</div> 
@if(session()->has('add_unit_success'))
<div class="col-md-12" style="margin-top: 12px;">
    <div class="alert alert-success alert-dismissible"><i class="fa fa-check"></i>
        <a href="#" style="text-decoration: none; color: #FFFFFF;" class="close" 
            data-dismiss="alert" aria-label="close">&times;
        </a>
        {{ session()->get('add_unit_success') }}
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
    <form method="post" action="{{ route('add_unit') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <label><b>Unit Type</b></label>
                <select class="form-control" name="unit_type">
                    <option value="{{ old('item_type') }}">{{ old('unit_type') }}</option>
                    <option value="Music">Music</option>
                    <option value="Podcast">Podcast</option>
                    <option value="Vlog">Vlog</option>
                    <option value="Tiktok">Tiktok</option>
                    <option value="Party Events">Party Events</option>
                    <option value="KTV">KTV</option>
                    <option value="Resort">Resort</option>
                </select>
            <span class="text-danger">@error('unit_type') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <label><b>Unit Name</b></label>
                <input id="fStyle" type="text" class="form-control item_name" value="{{ old('item_name') }}" name="item_name" />
            <span class="text-danger">@error('item_name') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <label><b>Host Name</b></label>
                <input id="fStyle" type="text" class="form-control host_name" value="{{ $user->firstname.' '. $user->lastname }}" name="host_name" readonly />
                <input id="fStyle" type="hidden" class="form-control company_id" value="{{ $user->account_id }}" name="company_id" readonly />
            <span class="text-danger">@error('host_name') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <label><b>Rates</b></label>
                <input id="mStyle" type="text" class="form-control" value="{{ old('rates') }}" name="rates">
            <span class="text-danger">@error('rates') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <label><b>Booking Basis</b></label>
                <select class="form-control" name="booking_basis">
                    <option value="{{ old('booking_basis') }}">{{ old('booking_basis') }}</option>
                    <option value="Hour">Hour</option>
                    <option value="Day">Day</option>
                </select>
            <span class="text-danger">@error('booking_basis') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <label><b>Operating Hours</b></label>
                <input id="mStyle" type="text" class="form-control operating_hours" value="{{ old('operating_hours') }}" name="operating_hours">
            <span class="text-danger">@error('operating_hours') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <label><b>Pax Capacity</b></label>
                <input id="mStyle" type="text" class="form-control brand" value="{{ old('pax_capacity') }}" name="pax_capacity">
            <span class="text-danger">@error('pax_capacity') {{ $message }} @enderror</span>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>Contact Number</b></label>
                    <input id="lStyle" type="text" class="form-control contact_numbers" value="{{ $user->mobile_number }}" name="contact_numbers" readonly />
                <span class="text-danger">@error('contact_numbers') {{ $message }} @enderror</span>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Description</label> (Additional Information)
                   <textarea rows="3" class="form-control description" name="description"></textarea>
                    <span class="text-danger">@error('description') {{ $message }} @enderror</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label><b>Address / Location</b></label>
            </div>
        </div>
        <div class="row">
        <div class="col-md-3">
            <label><b>Building No.</b></label>
                <input id="mStyle" type="text" class="form-control uom" value="{{ old('unit_no') }}" name="unit_no">
            <span class="text-danger">@error('unit_no') {{ $message }} @enderror</span>
        </div>
 
        <div class="col-md-3">
            <div class="form-group">
                <label><b>Street</b></label>
                    <input id="lStyle" type="text" class="form-control street" value="{{ old('street') }}" name="street" />
                <span class="text-danger">@error('street') {{ $message }} @enderror</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>City</b></label>
                    <input id="lStyle" type="text" class="form-control town_city" value="{{ old('town_city') }}" name="town_city" />
                <span class="text-danger">@error('town_city') {{ $message }} @enderror</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>Province</b></label>
                    <input id="lStyle" type="text" class="form-control province" value="{{ old('province') }}" name="province" />
                <span class="text-danger">@error('province') {{ $message }} @enderror</span>
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
                    <i class="fa fa-upload"></i> Save</button>
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




