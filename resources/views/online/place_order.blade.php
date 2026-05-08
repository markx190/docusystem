@include('layouts.view_store_header')
<!-- Page content-->
<div class="container mt-5">
    <div class="row" style="margin-top: -20px;">
        @if($user)
            <div class="col-md-9">
                <p style="color: #1F4788;"><i class="fa fa-user"></i> Welcome, {{ $user->firstname }} {{ $user->lastname }}</p>
            </div>
        @endif
        <div class="col-md-9" >
            <span style="font-weight: bold;">Please complete the following and review your entries before submitting.</span>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-shopping-cart" data-toggle="modal" data-target="#myModal" aria-hidden="true" style="font-size: 25px; cursor: pointer;"></i>
                {{ $cartCount }}
            </button>
        </div>
    </div>
</div>
<div class="container mt-5">    
    {{-- <div class="col-lg-12" style="margin-top: -35px;">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div> --}}
<!-- Search widget-->
<div class="card mb-4">
    <div class="card-header" style="background-color: #ECF0F1; color: #212529; margin-top: -32px;"><b>Buyer's Information</b></div>
        <div class="card-body">
            <form method="post" action="{{ route('confirm_order') }}">
                @csrf
    <div class="row" style="margin-top: 12px;">
        <div class="col-md-3">
            <div class="form-group">
                <label>First Name</label>
                    <input type="text" 
                    class="form-control" 
                    name="firstname" 
                    style="margin-top: 5px;" 
                    value="{{ old('firstname', $user->firstname ?? '') }}" />
                    @if($user)
                        <input type="hidden" name="account_id" value="{{ $user->account_id }}" />
                    @else
                    <input type="hidden" name="account_id" />
                    @endif
                <span class="text-danger">@error('firstname') {{ $message }} @enderror</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" 
                   class="form-control" 
                   name="lastname" 
                   style="margin-top: 5px;" 
                   value="{{ old('lastname', $user->lastname ?? '') }}" />
                <span class="text-danger">@error('lastname') {{ $message }} @enderror</span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Email</label>
                <input type="text" 
                   class="form-control" 
                   name="email" 
                   style="margin-top: 5px;" 
                   value="{{ old('email', $user->email ?? '') }}" />
                <span class="text-danger">@error('email') {{ $message }} @enderror</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Mobile Number</label>
                    <input type="text" 
                   class="form-control" 
                   name="mobile_number" 
                   style="margin-top: 5px;" 
                   value="{{ old('mobile_number', $user->mobile_number ?? '') }}" />
                <span class="text-danger">@error('mobile_number') {{ $message }} @enderror</span>
            </div>
        </div>
        <div class="col-md-12" style="margin-top: 12px;">
            <div class="form-group">
                <label><b>Shipper's Delivery Address (You need to enter your proper address to avoid delivery issues.)</b></label>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 12px;">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Postal Code (Optional)</label>
                            <input type="text" class="form-control" name="postal_code" style=" margin-top: 5px;" />
                        <span class="text-danger">@error('postal_code') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Number</label>
                            <input type="text" class="form-control" name="lot_no" style=" margin-top: 5px;" />
                        <span class="text-danger">@error('lot_no') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Street</label>
                            <input type="text" class="form-control" name="street" style=" margin-top: 5px;" />
                        <span class="text-danger">@error('street') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Barangay</label>
                            <input type="text" class="form-control" name="barangay" style=" margin-top: 5px;" />
                            <span class="text-danger">@error('barangay') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 12px;">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>City</label>
                            <!-- <input type="text" class="form-control" name="city" style=" margin-top: 5px;" /> -->
                            <select class="form-control" name="city">
                                <option value=""></option>
                                <option value="Marikina">Marikina</option>
                                <option value="Quezon City">Quezon City</option>
                            </select>
                        <span class="text-danger">@error('city') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Province</label>
                            <input type="text" class="form-control" name="province" value="Metro Manila" style=" margin-top: 5px;" readonly />
                        <span class="text-danger">@error('province') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><a style="cursor: pointer; color: #1F4788;" data-toggle="modal" data-target="#tocModal"><b>Accept Terms</b></a></label>
                            <input type="checkbox" name="toc" value="1" style="margin-top: 20px; width: 25px; height: 25px;" />
                        @if(session()->has('fail'))
                            <span class="text-danger">You must accept the Terms and Condition</span>
                        @endif
                    </div>
                </div>
                <div class="row" style="margin-top: 25px; ">
                    <div class="col-md-12">
                        <hr />
                    </div>
                </div>
                @if(count($cartContents) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <b>Items Ordered</b>
                </div>
                @foreach($cartContents as $cItem)
                <center>
                    <table width="100%" style=" border-collapse: collapse;">
                        <tr>
                            <td style="width: 150px;">
                                <center>
                                <span style="font-size: 14px; color: #000000;" class="quantity">{{ $cItem->quantity }} - {{ $cItem['associatedModel']['uom'] }}</span>
                                </center>
                                </td>
                                <td style="width: 100px;">
                                @if(isset($cItem['associatedModel']['item_avatar']))
                                <a class="cart-img" href="#">
                                    <img src="public/uploads/item_avatars/{{ $cItem['associatedModel']['item_avatar'] }}" alt="{{ $cItem->name }}" style="height: 60px; width: 60px; border-radius: 10px;">
                                </a>
                                @endif
                                </td>
                                <td style="width: 320px;">
                                <span><a style="text-decoration: none; font-size: 13px;">{{ $cItem->name }}</a></span>
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
                <hr style="margin-top: 20px; "/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table width="100%">
                    <tr>
                    <td style="width: 750px;">Flat shipping rate</td>
                        <td style="width: 180px;">
                            <span style="color: red; margin-left: 8px;">+ 0.00</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 750px;">Total Amount:</td>
                        <td style="width: 180px;">
                            <span style="margin-left: 8px; font-weight: bold;">₱ {{ $cartTotal }}.00</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @else
            <div class="row">
                <div class="col-md-12">
                    <span>You cart is empty. You cannot proceed right now. You may order an item.</span>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <hr style="margin-top: 20px; "/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <label><b>Default Payment Method</b></label><br>
                <span><i class="fa fa-check-circle" style="color: #26A65B;"></i> Cash on Delivery</span>
            </div>
        </div>
        <div class="row" style="margin-top: 40px;">
            <div class="col-md-3">
                <div class="form-group">
                    @if($cartTotal < 5000 && $cartTotal > 100)
                    <button class="btn btn-primary" id="button-search" type="submit"> Complete your Order</button>
                        </div>
                            </div>
                            @else
                            <p style="color: red;">Sorry, your total amount is not allowed for cash on delivery.</p>
                            @endif
                            </div>
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
                                @if($cItem['associatedModel']['category'] == 'Pre Loved Items')
                                @elseif($cItem['associatedModel']['category'] == 'Pre Owned Items')
                                @else
                                <i class="fa fa-minus-circle" style="color: #1a53ff; cursor: pointer; font-size: 20px;" onclick="updateQuantity(this, -1)" data-item-id="{{ $cItem->id }}"></i>
                                <span style="font-size: 14px; color: #000000;" class="quantity">{{ $cItem->quantity }}</span>
                                <i class="fa fa-plus-circle" style="color: #1a53ff; cursor: pointer; font-size: 20px;" onclick="updateQuantity(this, 1)" data-item-id="{{ $cItem->id }}"></i>
                                @endif
                                </center>
                                </td>
                                <td style="width: 120px;">
                                @if(isset($cItem['associatedModel']['item_avatar']))
                                <a class="cart-img" href="#">
                                    <img src="public/uploads/item_avatars/{{ $cItem['associatedModel']['item_avatar'] }}" alt="{{ $cItem->name }}" style="height: 60px; width: 60px; border-radius: 10px;">
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
                            <button style="margin-top: 20px; margin-left: 12px;" type="submit" class="btn btn-warning">Update Cart</button>
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
<div class="modal fade" id="tocModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <b>Terms and Condition</b>
                <b data-dismiss="modal" style="cursor: pointer;"><i class="fa fa-close"></i></b>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <center>
                    <div class="row">
                        <div class="col-md-12">
    <p style="text-align: justify;">
        Welcome to <b>Whilers</b>. By accessing or using our website and services,
        you agree to comply with and be bound by the following Terms and Conditions.
        Please read them carefully before using our platform.
    </p>

    <p style="text-align: justify;"><b>1. Acceptance of Terms</b></p>
    <p style="text-align: justify;">
        By using this website, you acknowledge that you have read, understood,
        and agree to be bound by these Terms and Conditions, as well as our Privacy Policy.
        If you do not agree, please discontinue use of our website.
    </p>

    <p style="text-align: justify;"><b>2. Changes to Terms</b></p>
    <p style="text-align: justify;">
        We reserve the right to update, modify, or replace these Terms at any time.
        Changes will be effective immediately upon posting on this page.
        Continued use of the website constitutes acceptance of the revised Terms.
    </p>

    <p style="text-align: justify;"><b>3. Eligibility and Account Use</b></p>
    <p style="text-align: justify;">
        You may use our website as a registered user or as a guest.
        You agree to provide accurate and complete information when placing orders.
        You are responsible for maintaining the confidentiality of your account
        and for all activities conducted under your account.
    </p>

    <p style="text-align: justify;"><b>4. Products and Availability</b></p>
    <p style="text-align: justify;">
        All products displayed on our website are subject to availability.
        We reserve the right to limit quantities, discontinue products,
        or modify product descriptions and prices at any time without prior notice.
    </p>

    <p style="text-align: justify;"><b>5. Orders and Payments</b></p>
    <p style="text-align: justify;">
        All orders placed through our website are subject to confirmation and acceptance.
        We reserve the right to cancel or refuse any order due to errors in pricing,
        product availability, or suspected fraudulent activity.
        Payment must be completed using the available payment methods on our platform.
    </p>

    <p style="text-align: justify;"><b>6. Shipping and Delivery</b></p>
    <p style="text-align: justify;">
        Delivery times provided are estimates only and may vary based on location,
        availability, and external factors such as weather or courier delays.
        We are not liable for delays beyond our reasonable control.
    </p>

    <p style="text-align: justify;"><b>7. Returns and Refunds</b></p>
    <p style="text-align: justify;">
        Returns and refunds are subject to our Return Policy.
        Items must be returned in their original condition and packaging.
        Certain items may be non-refundable or non-returnable.
        Please review our Return Policy for full details.
    </p>

    <p style="text-align: justify;"><b>8. User Conduct</b></p>
    <p style="text-align: justify;">
        You agree not to misuse our website, engage in fraudulent activities,
        or violate any applicable laws or regulations while using our services.
    </p>

    <p style="text-align: justify;"><b>9. Limitation of Liability</b></p>
    <p style="text-align: justify;">
        To the fullest extent permitted by law, Whilers shall not be liable for any
        indirect, incidental, special, or consequential damages arising from
        the use of our website or products.
    </p>

    <p style="text-align: justify;"><b>10. Governing Law</b></p>
    <p style="text-align: justify;">
        These Terms and Conditions shall be governed by and interpreted
        in accordance with the laws of the applicable jurisdiction.
    </p>

    <p style="text-align: justify;"><b>11. Contact Information</b></p>
    <p style="text-align: justify;">
        If you have any questions regarding these Terms and Conditions,
        please contact us through the details provided on our website.
    </p>
</div>

                    </div>
                </center>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

function addItemToCart(button){
	var itemIdNo = button.getAttribute('data-item-id-no');
	var itemName = button.getAttribute('data-item-name');
	var itemAvatar = button.getAttribute('data-item-avatar');
	var unitPrice = button.getAttribute('data-unit-price');
	
    $.ajax({
    url: "{{ url('/add_item_to_cart') }}",
    method: 'POST',
    data: { 
        _token: function() {
            return "{{csrf_token()}}"
        },
		itemIdNo,
		itemName,
		itemAvatar,
		unitPrice
    },
    cache: false,
	success: function (html){
		window.location.href = '/'
        }
    });
}

function deleteItem(button){
	// alert('delete');
	var itemIdNo = button.getAttribute('data-item-id');
	
    $.ajax({
    url: "{{ url('/delete_item') }}",
    method: 'POST',
    data: { 
        _token: function() {
            return "{{csrf_token()}}"
        },
		itemIdNo,
    },
    cache: false,
	success: function (html){
		window.location.href = '/'
        }
    });
}

function updateQuantity(element, change) {
    let itemId = element.getAttribute('data-item-id');
    let quantityElement = element.parentElement.querySelector('.quantity');
    let currentQuantity = parseInt(quantityElement.innerText);
    
    // Update quantity
    let newQuantity = currentQuantity + change;

    // Check to prevent quantity from going below 1
    if (newQuantity < 1) {
        return;
    }

    // Update the quantity displayed on the page
    quantityElement.innerText = newQuantity;

    // Send an AJAX request to update the session/cart
    $.ajax({
        url: '/update_cart', // URL to update the cart
        method: 'POST',
        data: {
            itemId: itemId,
            quantity: newQuantity,
            _token: '{{ csrf_token() }}' // CSRF token for security
        },
        success: function(response) {
            // Optionally, you can update other parts of the cart here, e.g., total price
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error(error);
        }
    });
}
</script>