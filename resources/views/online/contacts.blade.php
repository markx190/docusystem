@include('layouts.view_store_header')
<!-- Page content-->
<div class="container mt-5">
    <div class="row" style="margin-top: -50px;">
        <div class="col-md-9" >
        </div>
    </div>
</div>
<div class="container mt-5">    
        @if($user)
            <div class="col-md-9" style="margin-top: -20px;">
                <p style="color: #1F4788;"><i class="fa fa-user"></i> Welcome, {{ $user->firstname }} {{ $user->lastname }}</p>
            </div>
        @endif
<!-- Search widget-->
<div class="card mb-4">
    <div class="card-header"><b>Contact Us</b></div>
        <div class="card-body">
            <div class="row" style="margin-top: 12px;">
                
                <div class="col-md-12">
                    <div class="form-group">
                        
                <!-- <p style="margin-left: 2px; margin-top: 5px;">Thank you for dropping by here at Buzytown Online. We will be glad if you make an order.<p> -->
                <p>For inquiries and customer support.</p>
                <p>Contact Number: 09615950391</p>
                <p>Email: buzytown101@gmail.com</p>
                </div>
            </div>                
        </div>
    </div>
    <div class="col-md-12">
        </div>
            </div>
                <div class="row" style="margin-top: 40px;">
        </div>
    </div>
</div>
<!-- Footer-->
@include('layouts.store_footer')