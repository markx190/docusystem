@include('layouts.order_completed_header')
<!-- Page content -->
<div class="container mt-5">
    <div class="row" style="margin-top: -20px;">
        <div class="col-md-9" >
            <b>Your everyday Marketplace, free delivery promo period.</b>
        </div>
        <div class="col-md-3">
            <button style=" margin-left: 15px;" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-shopping-cart" data-toggle="modal" data-target="#myModal" aria-hidden="true" style="font-size: 25px; cursor: pointer;"></i>
                {{ $cartCount }}
            </button>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="card mb-4" style="margin-top:-32px;">
        <div class="card-header" style="background-color: #D2D7D3;">
            <b>{{ $viewItem->item_name }}</b>
        </div>

        <div class="card-body">
            <!-- Description -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <p style="margin-top:-10px;">
                        {{ $viewItem->description }}
                    </p>
                </div>
            </div>

            @php
                $imageFiles = $imagesArray->filter(function ($img) {
                    return in_array(
                        strtolower(pathinfo($img->item_image, PATHINFO_EXTENSION)),
                        ['jpg','jpeg','png','gif']
                    );
                });

                $videoFiles = $imagesArray->filter(function ($img) {
                    return in_array(
                        strtolower(pathinfo($img->item_image, PATHINFO_EXTENSION)),
                        ['mp4','mov','avi']
                    );
                });
            @endphp

            <!-- IMAGE CAROUSEL -->
            @if($imageFiles->count())
            <div id="itemImageCarousel" class="carousel slide mb-4" data-bs-ride="carousel" style="margin-top: -22px;">

                <!-- Indicators -->
                <div class="carousel-indicators">
                    @foreach($imageFiles as $key => $img)
                        <button type="button"
                                data-bs-target="#itemImageCarousel"
                                data-bs-slide-to="{{ $key }}"
                                class="{{ $key === 0 ? 'active' : '' }}"
                                aria-current="{{ $key === 0 ? 'true' : 'false' }}">
                        </button>
                    @endforeach
                </div>

                <!-- Slides -->
                <div class="carousel-inner text-center">
                    @foreach($imageFiles as $key => $img)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ asset('public/uploads/item_images/'.$img->item_image) }}"
                                 class="d-block mx-auto carousel-img"
                                 alt="Item image">
                        </div>
                    @endforeach
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button"
                        data-bs-target="#itemImageCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>

                <button class="carousel-control-next" type="button"
                        data-bs-target="#itemImageCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>

            </div>
            @endif
            
            <!-- VIDEOS (SEPARATE FROM CAROUSEL) -->
            @if($videoFiles->count())
                <hr>
                <h6 class="mb-3">
                    <i class="fa fa-video"></i> Product Videos
                </h6>

                <div class="row">
                    @foreach($videoFiles as $video)
                        <div class="col-md-4 mb-3">
                            <video src="{{ asset('public/uploads/item_images/'.$video->item_image) }}"
                                   controls
                                   class="w-100 rounded"
                                   style="max-height:220px;"></video>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="mt-auto d-flex gap-5">
                <button
                    class="btn btn-primary btn-sm flex-grow-1"
                    onclick="addItemToCart(this)"
                    data-item-id-no="{{ $viewItem->item_id_no }}"
                    data-item-name="{{ $viewItem->item_name }}"
                    data-item-avatar="{{ $viewItem->item_avatar }}"
                    data-unit-price="{{ $viewItem->unit_price }}"
                    data-company-id="{{ $viewItem->company_id }}"
                >
                    <i class="fa fa-cart-plus me-1"></i> Add
                </button>
            </div>
            <!-- Info Text -->
            <div class="row mt-3">
                <div class="col-md-12">
                    <p>
                        <i class="fa fa-check-circle" style="color:green;"></i>
                        Everything you need, one checkout away.
                    </p>
                </div>
            </div>

        </div>
    </div>

</div>

<!-- Footer -->
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
                                    <img src="../public/uploads/item_avatars/{{ $cItem['associatedModel']['item_avatar'] }}" alt="{{ $cItem->name }}" style="height: 60px; width: 60px; border-radius: 10px;">
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
                        <div class="col-md-4">
                            <button style="margin-top: 20px; margin-left: 12px;" type="submit" class="btn btn-warning">Proceed to Checkout</button>
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

<script type="text/javascript">

function addItemToCart(button){

	var itemIdNo = button.getAttribute('data-item-id-no');
	var itemName = button.getAttribute('data-item-name');
	var itemAvatar = button.getAttribute('data-item-avatar');
	var unitPrice = button.getAttribute('data-unit-price');
	var companyId = button.getAttribute('data-company-id');
	
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
		unitPrice,
		companyId
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
