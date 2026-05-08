<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
                <meta name="description" content="" />
                <meta name="author" content="" />
                <title>whilers</title>
                <!-- Favicon-->
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="../public/online/css/styles.css" rel="stylesheet" />
                <link rel="icon" type="image/x-icon" href="public/images/favicon.ico" />
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- Core theme CSS (includes Bootstrap)-->
    </head>
<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark whilers-navbar">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand whilers-logo" href="/">
            <span><i class="fa fa-cubes" style="color: #ffeb3b;"></i> whilers market</span>
        </a>

        <!-- Mobile toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Nav links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">
                <li class="nav-item">
                    <a class="nav-link active" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contacts">Contact Us</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">Buyer Central</a>
                </li> --}}
                @if(session()->has('login_id'))
                {{-- LOGGED IN --}}
                    <li class="nav-item">
                        <a class="nav-link" href="/view_account">Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="{{ route('logout_account') }}">
                            Logout
                        </a>
                    </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="/login_account">Login</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-warning btn-sm px-3 rounded-pill ms-lg-2" href="/create_account">
                        Create Account
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<style>
  /* Navbar background */
.whilers-navbar {
    /*background: linear-gradient(135deg, #F47983, #5a2dbf);*/
    background-color: #D24D57;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}
/* Logo style */
.whilers-logo {
    font-size: 26px;
    font-weight: 800;
    letter-spacing: 0.3px;   /* subtle, not shouty */
    color: #ffeb3b !important;
    text-transform: none;   /* 👈 NOT all caps */
}

/* Nav links */
.navbar-dark .navbar-nav .nav-link {
    color: rgba(255,255,255,0.85);
    font-weight: 500;
    transition: color 0.2s ease;
}

.navbar-dark .navbar-nav .nav-link:hover,
.navbar-dark .navbar-nav .nav-link.active {
    color: #ffffff;
}

/* CTA button */
.navbar .btn-warning {
    font-weight: 600;
}
  
    
</style>

