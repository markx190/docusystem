@include('layouts.reg_header')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-8 col-lg-7">
        <div class="card shadow-lg border-0">
            {{-- HEADER --}}
            <div class="card-body px-4 pt-4">
                <div class="text-center logo-wrapper">
                <span style="color: #FFA400; font-weight: 900; font-size: 32px;">Whilers</span>
            </div>
                <h4 class="text-center font-weight-bold mb-1">
                    Create an Account
                </h4>
                <p class="text-center text-muted mb-4">
                    Fill in the details below to register
                </p>
                {{-- SUCCESS ALERT --}}
                @if(session()->has('reg_success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle"></i>
                        {{ session('reg_success') }}
                    </div>
                @endif
                {{-- ERROR ALERT --}}
                @if(session()->has('fail'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa fa-exclamation-circle"></i>
                        {{ session('fail') }}
                    </div>
                @endif
                {{-- FORM --}}
                <form method="POST" action="{{ route('submit_customer') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="floating-input">
                            <input type="text" name="firstname" placeholder=" " value="{{ old('firstname') }}">
                            <label>First Name</label>
                        <span class="text-danger">@error('firstname') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="floating-input">
                        <input type="text" name="lastname" placeholder=" " value="{{ old('lastname') }}">
                            <label>Last Name</label>
                        <span class="text-danger">@error('lastname') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="floating-input">
                        <input type="text" name="mobile_number" placeholder=" " value="{{ old('mobile_number') }}">
                            <label>Mobile Number</label>
                        <span class="text-danger">@error('mobile_number') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="floating-input">
                        <input type="email" name="email" placeholder=" " value="{{ old('email') }}">
                        <label>Email</label>
                        <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="floating-input">
                        <input type="password" placeholder=" " name="password">
                            <label>Password</label>
                        <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="floating-input">
                        <input type="password" placeholder=" " name="password_confirmation">
                        <label>Confirm Password</label>
                        <span class="text-danger">@error('password_confirmation') {{ $message }} @enderror</span>
                    </div>
                </div>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success px-5">
                        <i class="fa fa-user-plus"></i> Register
                    </button>
                </div>
            </form>

                {{-- LOGIN LINK --}}
                <div class="text-center mt-3">
                    <medium class="text-muted">
                        Already registered?
                        <a href="/login_account">Login here</a>
                    </medium>
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="card-footer text-center text-muted">
                Version 1.0
            </div>

        </div>

    </div>
</div>
<style>
    /* CARD */
.card {
    border-radius: 16px;
    background: #ffffff;
}
.whilers-logo {
    font-weight: 900;
    font-size: 36px;
    letter-spacing: 1px;
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

/* ERROR */
.text-danger {
    font-size: 12px;
}

/* BUTTON */
.btn-success {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    border: none;
    padding: 12px 32px;
    font-weight: 600;
    border-radius: 12px;
}

.btn-success:hover {
    background: linear-gradient(135deg, #16a34a, #15803d);
}

</style>
