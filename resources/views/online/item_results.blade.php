@include('layouts.store_header')
<!-- Page content-->
<div class="container mt-5">
    <div class="row" style="margin-top: -20px;">
        <div class="col-md-9" >
            <b>Your Wet and Dry Market goes Online.</b>
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
        <!-- Search widget-->
<div class="card mb-4">
    <div class="card-header" style="background-color: #757D75; color: #FFFFFF;"><b>Explore Quality Products</b></div>
        <div class="card-body">
            <form method="post" action="{{ route('search_item') }}">
                @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label>Category</label>
                            <select class="form-control" name="category" style="border-radius: 35px; margin-top: 5px;">
                                <option></option>
                                <option value="Beef">Beef</option>
                                <option value="Chicken">Chicken</option>
                                <option value="Fish">Fish</option>
                                <option value="Frozen Delights">Frozen Delights</option>
                                <option value="Fruits">Fruits</option>
                                <option value="Pork">Pork</option>
                                <option value="Root Crops">Root Crops</option>
                                <option value="Spice">Spice</option>
                                <option value="Vegetables">Vegetables</option>
                                <option value="Regimen Packed">Regimen Packed</option>
                            </select>
                        <!-- @if(strlen($sCategory) < 1)
                        <span class="text-danger">Category is required</span>
                        @endif -->
                        </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                <label>Enter an Item</label>
                                <input type="text" class="form-control" name="item_name" style="border-radius: 35px; margin-top: 5px;" />
                            </div>
                        </div>   
                    </div>   
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-3">
                            <div class="form-group">
                        <button class="btn btn-primary" id="button-search" type="submit">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="card mb-4">
    <div class="card-header" style="background-color: #757D75; color: #FFFFFF;"><b>Searched Items</b></div>
        @if(count($items) < 1)
            <div class="row">
                <div class="col-md-3">
                <p style="margin-left: 15px; color: red;">Sorry, no items was found.</p>
            <p style="margin-left: 15px; margin-top: -15px; color: red;">You may try to search another item.</p>
        </div>
    </div>
@else
<div class="card-body">
    <div class="row" style="margin-top: -15px;">
        @foreach($items as $item)
            <div class="col-md-3">       
                <img style="height: 225px; width: 260px; margin-top: 10px;" src="/uploads/item_avatars/{{ $item->item_avatar }}" />
                    <br>
                        <i class="fa fa-check-circle" aria-hidden="true" style="color: #16A085; margin-top: 15px;"></i> {{ $item->item_name .' '. $item->size }}<br>
                        <i class="fa fa-star" aria-hidden="true" style="color: #F7CA18;"></i>
                        <i class="fa fa-star" aria-hidden="true" style="color: #F7CA18;"></i>
                        <i class="fa fa-star" aria-hidden="true" style="color: #F7CA18;"></i>
                        <i class="fa fa-star" aria-hidden="true" style="color: #F7CA18;"></i>
                    <br>
                    <span><b>Php {{ $item->unit_price }} / {{ $item->uom }}</b></span>
                    <br>
                        <a style="margin-bottom: 12px;" data-session-id="{{ session()->getId() }}"
                        data-item-id-no="{{ $item->item_id_no }}"
                        data-item-name="{{ $item->item_name }}"
                        data-item-avatar="{{ $item->item_avatar }}"
                        data-unit-price="{{ $item->unit_price }}" 
                        class="btn btn-primary btn-sm" 
                        onclick="addItemToCart(this)" 
                        type="btn">
                        Add To Cart
                        </a>
                        </div>    
                    @endforeach
                </div>
            </div>
        @endif
    </div>   
</div>
    <!-- Side widgets-->
        <div class="col-lg-12">
            <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header" style="background-color: #757D75; color: #FFFFFF;"><b>Ready to Ship Goods</b></div>
                <div class="card-body">
            <div class="row">
                @foreach($toShips as $ready)
                    <div class="col-md-3">       
                        <img style="height: 225px; width: 260px; margin-top: 10px; margin-bottom: 20px;" src="/uploads/item_avatars/{{ $ready->item_avatar }}" />
                            <br>
                        <i class="fa fa-check-circle" aria-hidden="true" style="color: #16A085; margin-top: 15px;"></i> {{ $ready->item_name .' '. $ready->size }}<br>
                        <i class="fa fa-star" aria-hidden="true" style="color: #F7CA18;"></i>
                        <i class="fa fa-star" aria-hidden="true" style="color: #F7CA18;"></i>
                        <i class="fa fa-star" aria-hidden="true" style="color: #F7CA18;"></i>
                        <i class="fa fa-star" aria-hidden="true" style="color: #F7CA18;"></i>
                    <br>
                    <span><b>Php {{ $ready->unit_price }} / {{ $ready->uom }}</b></span>
                    <br>
                        <a data-session-id="{{ session()->getId() }}"
                        data-item-id-no="{{ $ready->item_id_no }}"
                        data-item-name="{{ $ready->item_name }}"
                        data-item-avatar="{{ $ready->item_avatar }}"
                        data-unit-price="{{ $ready->unit_price }}" 
                        class="btn btn-primary btn-sm" 
                        onclick="addItemToCart(this)" 
                        type="btn">
                        Add To Cart
                    </a>
                </div>      
            @endforeach
        </div>
    </div>
</div>   
<div class="col-lg-12">
    <!-- Search widget-->
        <div class="card mb-4">
            <div class="card-header" style="background-color: #757D75; color: #FFFFFF;"><b>Frozen Delights</b></div>
                <div class="card-body">
                    <div class="row">
                    @foreach($frozens as $frozen)
                         <div class="col-md-3">
                            <img style="height: 225px; width: 260px; margin-top: 10px;" src="/uploads/item_avatars/{{ $frozen->item_avatar }}" />
                            <br>
                            <i class="fa fa-check-circle" aria-hidden="true" style="color: #16A085; margin-top: 15px;"></i> {{ $frozen->item_name .' '. $frozen->size }}<br>
                            <i class="fa fa-star" aria-hidden="true" style="color: #F7CA18;"></i>
                            <i class="fa fa-star" aria-hidden="true" style="color: #F7CA18;"></i>
                            <i class="fa fa-star" aria-hidden="true" style="color: #F7CA18;"></i>
                            <i class="fa fa-star" aria-hidden="true" style="color: #F7CA18;"></i>
                        <br>
                        <span><b>Php {{ $frozen->unit_price }} / {{ $frozen->uom }}</b></span>
                            <br>
                                <a data-session-id="{{ session()->getId() }}"
                                    data-item-id-no="{{ $frozen->item_id_no }}"
                                    data-item-name="{{ $frozen->item_name }}"
                                    data-item-avatar="{{ $frozen->item_avatar }}"
                                    data-unit-price="{{ $frozen->unit_price }}" 
                                    class="btn btn-primary btn-sm" 
                                    onclick="addItemToCart(this)" 
                                    type="btn">
                                    Add To Cart
                                </a>
                            </div>      
                        @endforeach
                    </div>
                </div>
            </div>
        </div>                
    </div>
</div>
<!-- Footer-->
@include('layouts.store_footer')
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