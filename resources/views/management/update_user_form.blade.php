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
                    <li class="breadcrumb-item active">Update User</li>
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
    Update User
</div> 
@if(session()->has('update_user_success'))
<div class="col-md-12 mt-2">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check-circle"></i>
        {{ session('update_user_success') }}
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
        <a href="{{ route('manage_users') }}"><button class="btn btn-secondary btn-xs" style="margin-top: -18px; margin-left: -4px;">
            <i class="fa fa-arrow-left"></i> 
            Back
        </button></a>
    </div> 
<form method="POST"
      action="{{ route('update_users', $user->id) }}"
      enctype="multipart/form-data">
    @csrf

<div class="row">
    <div class="col-md-3">
        <label><b>Company</b></label>
             <input type="text" class="form-control" name="company"
               value="{{ $user->company }}">
        <span class="text-danger">@error('company') {{ $message }} @enderror</span>
    </div>
    <div class="col-md-3">
        <label><b>Status</b></label>
            <select class="form-control" name="status">
                <option value="{{ $user->status }}">{{ $user->status }}</option>
                <option value="New">New</option>
                <option value="Regular">Regular</option>
                <option value="Suspended">Suspended</option>
                <option value="Resigned">Resigned</option>
            </select>
        <span class="text-danger">@error('status') {{ $message }} @enderror</span>
    </div>
    
</div>
</div>

<div class="modal-footer mt-4">
    <button type="submit" class="btn btn-primary btn-sm">
        <i class="fa fa-save"></i> Update User
            </button>
        </div>
                        
                                </form>
                            </section>
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

