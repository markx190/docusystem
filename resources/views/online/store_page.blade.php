@include('layouts.reg_header')
<div class="container">
    <main class="reg-form">
        <div class="container-fluid"> 
            <div class="row charts-docs">
            <div class="col-xl-12 ">
            <div class="card mb-4">  
            <div class="card-header subscription-h">
        <i class="fa fa-arrow-right" style="color: #FFFFFF;"></i>
    Login
</div> 
@if(session()->has('fail'))
<div class="col-md-12" style="margin-top: 12px;">
    <div class="alert alert-danger alert-dismissible"><i class="fa fa-check"></i>
        <a href="#" style="text-decoration: none; color: #FFFFFF;" class="close" 
            data-dismiss="alert" aria-label="close">&times;
        </a>
        {{ session()->get('fail') }}
    </div>
</div>
@endif
<div class="card-body">
    <div class="col-md-12">
        <a href="{{ route('register_user') }}">
            <button class="btn btn-primary btn-xs" style="margin-top: -18px; margin-left: -4px;">
            <i class="fa fa-edit"></i> 
            Register
            </button></a>
        <p>Please register, if you don't have an account yet.</p>
    </div> 
    <form method="post" action="{{ route('login_user') }}">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <label><b>Email</b></label>
                <input type="text" class="form-control" name="email" placeholder="Email" />
            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label><b>Password</b></label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            <span class="text-danger">@error('password') {{ $message }} @enderror</span>
        </div>
    </div>
    <br>
    <button id="update-btn" type="submit" 
                class="btn btn-success btn-sm">
                    <i class="fa fa-paper-plane"></i> LOGIN</button>
</div>
<div class="modal-footer">
    <div class="row s-btn">
        </div>
            <!-- <button id="update-btn" type="submit" 
                class="btn btn-success btn-sm">
                    <i class="fa fa-paper-plane"></i> LOGIN</button> -->
                    <b>Version</b> 1.0
                        <!-- </div> -->
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
    .reg-form {
        margin-top: 35px;
    }
</style>
@include('layouts.reg_footer')




