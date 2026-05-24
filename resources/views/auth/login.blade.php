@include('layouts.reg_header')
<div class="container d-flex justify-content-center align-items-center min-vh-100" style="margin-top: -35px;">
    <div class="col-md-5">
        <div class="card shadow-lg border-0 login-card">
            {{-- CARD BODY --}}
            <div class="card-body px-4 pt-2 pb-4">
                <h5 class="text-center mb-2 font-weight-bold" style="margin-top: 10px; color: #FFA400; font-size: 25px;">
                   Docusystem
                </h5>
                <p class="text-center text-muted mb-4">
                    Sign in to your account
                </p>
                {{-- ERROR ALERT --}}
                @if(session()->has('fail'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa fa-exclamation-circle"></i>
                        {{ session('fail') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span></span>
                        </button>
                    </div>
                @endif

                {{-- LOGIN FORM --}}
                <form method="POST" action="{{ route('login_user') }}">
                    @csrf

                    <div class="form-group">
                        <div class="floating-input">
                        <input type="text" name="username" placeholder=" " value="{{ old('username') }}">
                            <label>Email</label>
                        <span class="text-danger">@error('username') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="form-group">
                       <div class="floating-input">
                        <input type="password" name="password" placeholder=" " value="{{ old('password') }}">
                            <label>Password</label>
                        <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                    </div>

                    <button type="submit"
                            class="btn btn-success btn-block mt-3">
                        Login
                    </button>
                </form>

                {{-- REGISTER LINK --}}
                <div class="text-center mt-3">
                    <medium>
                        Don’t have an account?
                        <a href="{{ route('register_user') }}">Register here</a>
                    </medium>
                </div>
            </div>

            {{-- FOOTER --}}
            <div class="card-footer text-center text-muted medium">
                Version 1.0
            </div>
        </div>
    </div>
</div>
<style>
.login-card {
    border-radius: 14px;
}

.logo-wrapper {
    padding-top: 20px;
    margin-bottom: -10px; /* pulls form closer */
}

.login-logo {
    max-width: 90px;   /* SMALLER logo */
    height: auto;
}

.form-control {
    border-radius: 8px;
}

.btn-success {
    border-radius: 30px;
}

/* FLOATING INPUT */
.floating-input {
    position: relative;
}

.floating-input input {
    width: 100%;
    padding: 14px 12px;
    font-size: 15px;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    outline: none;
    background: transparent;
    transition: all 0.2s ease;
}

/* LABEL */
.floating-input label {
    position: absolute;
    top: 50%;
    left: 12px;
    color: #6b7280;
    font-size: 14px;
    pointer-events: none;
    transform: translateY(-50%);
    transition: 0.2s ease;
    background: #fff;
    padding: 0 6px;
}

/* FLOAT EFFECT */
.floating-input input:focus + label,
.floating-input input:not(:placeholder-shown) + label {
    top: -6px;
    font-size: 12px;
    color: #2563eb;
}

/* FOCUS */
.floating-input input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

</style>

