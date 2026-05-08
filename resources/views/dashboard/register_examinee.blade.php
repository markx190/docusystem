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
    REGISTER
</div> 
@if(session()->has('success'))
<div class="col-md-12" style="margin-top: 12px;">
    <div class="alert alert-success alert-dismissible"><i class="fa fa-check"></i>
        <a href="#" style="text-decoration: none; color: #FFFFFF;" class="close" 
            data-dismiss="alert" aria-label="close">&times;
        </a>
        {{ session()->get('success') }}
    </div>
</div>
@endif
<div class="card-body">
    <div class="col-md-12">
        <button class="btn btn-primary btn-xs" 
            onclick="manageSubscription(event)"
                style="margin-top: -18px; margin-left: -4px;">
            <i class="fa fa-arrow-left"></i> 
            Back
        </button>
    </div> 
    <form method="post" action="{{ url('/save_examinee') }}">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <label><b>Type of Exam</b></label>
                <select class="form-control" name="test_name">
                    <option></option>
                    <option value="Listening">Listening</option>
                    <option value="Grammar">Grammar</option>
                </select>
            <span id="test-name-text"></span>
        </div>
        <div class="col-md-3">
            <label><b>Firstname</b></label>
                <input id="fStyle" type="text" class="form-control firstname" name="firstname" />
            <span id="firstname-text"></span>
        </div>
        <div class="col-md-3">
            <label><b>Middlename</b></label>
                <input id="mStyle" type="text" class="form-control middlename" name="middlename">
            <span id="middlename-text"></span>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>Lastname</b></label>
                    <input id="lStyle" type="text" class="form-control lastname" name="lastname" />
                <span id="lastname-text"></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label><b>Position Category</b></label>
                    <select class="form-control" name="position_applied">
                        <option></option>
                        <option value="Administrative">Administrative</option>
                        <option value="Clinical">Clinical</option>
                        <option value="Nursing">Nursing</option>
                    </select>
                <span id="position-applied-text"></span>
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




