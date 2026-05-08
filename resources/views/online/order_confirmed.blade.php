@include('layouts.view_store_header')
<!-- Page content-->
<div class="container mt-5">
    <div class="row" style="margin-top: -20px;">
        <div class="col-md-9" >
            <span>Placing your orders. Please complete the following. Review your entries before submitting.</span>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-shopping-cart" data-toggle="modal" data-target="#myModal" aria-hidden="true" style="font-size: 25px; cursor: pointer;"></i>
                {{ $cartCount }}
            </button>
        </div>
    </div>
</div>
<div class="container mt-5">    
    <div class="col-lg-12" style="margin-top: -35px;">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>
<!-- Search widget-->
<div class="card mb-4">
    <div class="card-header"><b>Buyer Details.</b></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12" >
                    <span>You need to enter your proper address to avoid delivery issues.</span>
                </div>
            </div>
            <form method="post" action="{{ route('confirm_order') }}">
                @csrf
                    <div class="row" style="margin-top: 12px;">
                        <div class="col-md-3">
                            <div class="form-group">
                            <label>First Name</label>
                        <input type="text" class="form-control" name="firstname" style=" margin-top: 5px;" />
                        <span class="text-danger">@error('firstname') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="lastname" style=" margin-top: 5px;" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" style=" margin-top: 5px;" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" class="form-control" name="mobile_number" value="+63" style=" margin-top: 5px;" />
                    </div>
                </div>
                <br>
                <div class="col-md-12">
                    <div class="form-group">
                        <label><b>Shipper's Delivery Address</b></label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Number</label>
                        <input type="text" class="form-control" name="lot_no" style=" margin-top: 5px;" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Street</label>
                        <input type="text" class="form-control" name="street" style=" margin-top: 5px;" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Barangay</label>
                        <input type="text" class="form-control" name="barangay" style=" margin-top: 5px;" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" name="city" style=" margin-top: 5px;" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Province</label>
                        <input type="text" class="form-control" name="province" style=" margin-top: 5px;" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr style="margin-top: 20px; "/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <b>Items Ordered</b>
                </div>
                @foreach($cartContents as $cItem)
                <center>
                    <table width="100%">
                        <tr>
                            <td style="width: 150px;">
                                <center>
                                <span style="font-size: 14px; color: #000000;" class="quantity">{{ $cItem->quantity }} - {{ $cItem['associatedModel']['uom'] }}</span>
                                </center>
                                </td>
                                <td style="width: 100px;">
                                @if(isset($cItem['associatedModel']['item_avatar']))
                                <a class="cart-img" href="#">
                                    <img src="../public/uploads/item_avatars/{{ $cItem['associatedModel']['item_avatar'] }}" alt="{{ $cItem->name }}" style="height: 60px; width: 60px;">
                                </a>
                                @endif
                                </td>
                                <td style="width: 320px;">
                                <span><a style="text-decoration: none; font-size: 13px;" href="/">{{ $cItem->name }}</a></span>
                                </td>
                            
                                <td style="width: 150px;">
                                <span style="font-size: 14px; color: #000000;"> x - ₱ {{ $cItem->price }}.00</span>
                            </td>
                        </tr>
                    </table>
                </center>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                <table width="100%">
                    <tr>
                        <td style="width: 720px;"><center>Total Amount:</center></td>
                        <td style="width: 180px;">
                            <span>₱ {{ $cartTotal }}.00</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="margin-top: 40px;">
        @if($cartTotal < '2000' || $cartTotal == '2000')
            <div class="col-md-3">
                <div class="form-group">
                    <button class="btn btn-primary" id="button-search" type="submit">Submit</button>
                        </div>
                            </div>
                            @else
                            <p>Sorry, you have reach the maximum total order amount.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Footer-->
@include('layouts.store_footer')
       
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                @if(count($cartContents) > 0)
                <h6 class="modal-title"><b>Cart</b></h6>
                @else
                <h6 class="modal-title"><b>Your Cart is empty</b></h6>
                @endif
                <b data-dismiss="modal" style="cursor: pointer;"><i class="fa fa-close"></i></b>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                @foreach($cartContents as $cItem)
                    <center>
                        <table width="100%">
                            <tr>
                                <td style="width: 55px;">
                                <center><a style="cursor: pointer; color: #DC3023; font-size: 22px;" type="button" class="remove" data-item-id="{{ $cItem->id }}" title="Remove this item" onclick="deleteItem(this)"><i class="fa fa-trash"></i></a></center>
                                </td>
                                <td style="width: 278px;">
                                <center>
                                <i class="fa fa-minus-circle" style="color: #1a53ff; cursor: pointer; font-size: 20px;" onclick="updateQuantity(this, -1)" data-item-id="{{ $cItem->id }}"></i>
                                <span style="font-size: 14px; color: #000000;" class="quantity">{{ $cItem->quantity }}</span>
                                <i class="fa fa-plus-circle" style="color: #1a53ff; cursor: pointer; font-size: 20px;" onclick="updateQuantity(this, 1)" data-item-id="{{ $cItem->id }}"></i>
                                </center>
                                </td>
                                <td style="width: 120px;">
                                @if(isset($cItem['associatedModel']['item_avatar']))
                                <a class="cart-img" href="#">
                                    <img src="/uploads/item_avatars/{{ $cItem['associatedModel']['item_avatar'] }}" alt="{{ $cItem->name }}" style="height: 60px; width: 60px;">
                                </a>
                                @endif
                                </td>
                                <td style="width: 400px;">
                                <span><a style="text-decoration: none; font-size: 13px;" href="/">{{ $cItem->name }}</a></span>
                                </td>
                            
                                <td style="width: 150px;">
                                <span style="font-size: 14px; color: #000000;"><center> x - ₱ {{ $cItem->price }}.00</center></span>
                            </td>
                        </tr>
                    </table>
                </center>
                @endforeach
                <div class="row">
                    <div class="form-group">
                        @if(count($cartContents) > 0)
                        <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <div class="col-md-3">
                            <button style="margin-top: 20px; margin-left: 12px;" type="submit" class="btn btn-warning">Checkout</button>
                        </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>