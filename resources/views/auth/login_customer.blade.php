@include('layouts.store_header')
<div class="container d-flex justify-content-center align-items-center min-vh-100" style="margin-top: -65px;">
    <div class="col-md-5">
        <div class="card shadow-lg border-0 login-card">
            {{-- LOGO --}}
            <div class="text-center logo-wrapper">
                <span style="color: #FFA400; font-weight: 900; font-size: 32px;">Whilers</span>
            </div>
            {{-- CARD BODY --}}
            <div class="card-body px-4 pt-2 pb-4">
                <p class="text-center text-muted mb-4">
                    Sign in to your account
                </p>
                {{-- ERROR ALERT --}}
                @if(session()->has('fail'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i>
                    <div>{{ session('fail') }}</div>
                </div>
                @endif

                {{-- LOGIN FORM --}}
                <form method="POST" action="{{ route('login_user') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <div class="floating-input">
                        <input type="text"
                               name="username"
                               class="form-control shadow-sm"
                               placeholder="">
                                      <label class="form-label"><b>Email</b></label>
                        <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div class="floating-input">
                            <input type="password"
                               name="password"
                               class="form-control shadow-sm"
                               placeholder="">
                            <label class="form-label"><b>Password</b></label>
                            <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <button type="submit"
                            class="btn btn-primary btn-block btn-lg mt-3 shadow">
                        Login
                    </button>
                </form>

                {{-- REGISTER LINK --}}
                <div class="text-center mt-3">
                    <small class="text-muted">
                        Don’t have an account?
                        <a href="{{ route('create_account') }}" style="text-decoration: none;"><b>Register here</b></a>
                    </small>
                </div>
            </div>
            {{-- FOOTER --}}
            <div class="card-footer text-center text-muted small">
                Version 1.0
            </div>

        </div>
    </div>
</div>

<style>
/* CARD */
.login-card {
    border-radius: 14px;
}

/* LOGO */
.logo-wrapper {
    padding-top: 25px;
    margin-bottom: 10px;
}
.whilers-logo {
    font-weight: 900;
    font-size: 36px;
    letter-spacing: 1px;
}

/* FORM FIELDS */
.form-control {
    border-radius: 12px;
    height: 45px;
    transition: all 0.3s ease;
}
.form-control:focus {
    box-shadow: 0 0 10px rgba(0,0,0,0.15);
    border-color: #FFD700;
}

/* BUTTON */
.btn-warning {
    border-radius: 30px;
    background-color: #FFD700;
    color: #111;
    font-weight: bold;
    transition: all 0.3s ease;
}
.btn-warning:hover {
    background-color: #e6c200;
    color: #111;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

/* ALERT ICON */
.alert i {
    font-size: 18px;
}
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

/* ERROR */
.text-danger {
    font-size: 12px;
}

</style>
