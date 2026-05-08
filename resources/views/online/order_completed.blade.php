@include('layouts.order_completed_header')
<!-- Page content-->
<div class="container mt-5">
    <div class="row" style="margin-top: -20px;">
    @if(session()->getId() == $buyer->session_id)
        <div class="col-md-9" >
            <span style="font-weight: normal;">Your order was completed.</span>
        </div>
    @else
    <div class="col-lg-12" style="margin-top: 20px;">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Page has expired.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="container mt-5">    
    <div class="col-lg-12" style="margin-top: -35px;">
    @if (session('order_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('order_success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>
<!-- Search widget-->
<div class="card mb-4">
    <div class="card-header"><b>Buyer's Information</b></div>
        @if(session()->getId() == $buyer->session_id)
            <div class="card-body">
                <div class="row" style="margin-top: 12px;">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><b>Order ID</b></label>
                        <p class="qrcode"></p>
                         <p>Order Reference No. <b>{{ $buyer->order_id }}</b></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><b>Name</b></label>
                        <p>{{ $buyer->firstname .' '. $buyer->lastname }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><b>Email</b></label>
                        <p>{{ $buyer->email }}<p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><b>Mobile Number</b></label>
                        <p>{{ $buyer->mobile_number }}<p>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 12px;">
                    <div class="form-group">
                        <label><b>Your Delivery Address</b></label>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 12px;">
                    <div class="col-md-12">
                        <div class="form-group">
                    <p>{{ $buyer->lot_no .' '. $buyer->street .' '. $buyer->barangay .' '. $buyer->city . ' '. $buyer->province }}<p>
                </div>
            </div>
            <div class="col-md-12" style="margin-top: 12px;">
                <div class="form-group">
                    <label><b>Notes</b></label>
                        @if (session('delivery_note'))
                            <p>    
                                {{ session('delivery_note') }}
                            </p>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 12px;">
                    <div class="col-md-12">
                        <div class="form-group">
                    <p><p>
                </div>
            </div>                
        </div>
    </div>
    <div class="col-md-12">
        </div>
            </div>
                <div class="row" style="margin-top: 40px;">
            </div>
        @else
        <div class="row">
            <div class="col-md-12">
                <p style="margin-left: 15px; margin-top: 5px;"><b>This page has expired.</b></p>
                <p style="margin-left: 1px;"><center><img style="width: 95%; height: 5%;" src="/images/gray_image.png" /></center></p>
            </div>  
        </div>
        @endif
    </div>
</div>
<!-- Footer-->
@include('layouts.store_footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
<script>
    $(document).ready(function () {
     var getQr = {{ $buyer->order_id }}
        $('.qrcode').qrcode({
        width: 115,
        height: 115,
        text: getQr
    });
});
</script>