@include('layouts.store_header')
<!-- Page content-->
<div class="container mt-5">
    <div class="row" style="margin-top: -20px;">
        @if($user)
            <div class="col-md-9">
                <p style="color: #1F4788;"><i class="fa fa-user"></i> Welcome, {{ $user->firstname }} {{ $user->lastname }}</p>
            </div>
        @endif
        <div class="col-md-9" >
            <b>Your Everyday Palenke, free delivery promo period.</b>
        </div>
        <div class="col-md-3">
            <button style=" margin-left: 15px;" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-shopping-cart" data-toggle="modal" data-target="#myModal" aria-hidden="true" style="font-size: 25px; cursor: pointer;"></i>
                {{ $cartCount }}
            </button>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="col-lg-12" style="margin-top: -35px;">
        <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header" style="background-color: #ECF0F1; color: #212529;"> Search</div>
        <div class="card-body">
        <form method="GET" action="{{ route('store.index') }}" id="searchForm">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Category</label>
                    <select class="form-control" name="category">
                        <option value="">All</option>
                @foreach([
                    'Food and Groceries','Electronics','Pre Loved Items',
                ] as $category)
                    <option value="{{ $category }}"
                        {{ request('category') == $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Item Name</label>
                <input
                    type="text"
                    class="form-control"
                    name="item_name"
                    value="{{ request('item_name') }}"
                    placeholder="Search item"
                >
            </div>
        <div class="col-md-1 d-flex align-items-end">
    <button
    class="btn btn-outline-secondary btn-sm w-90 search-btn"
    type="submit"
    title="Search"
>
    <i class="fa fa-search"></i>
</button>

</div>
    </div>

</form>
                </div>
            </div>
                </div>

        <!-- Side widgets-->
        <div class="col-lg-12">
            <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header" style="background-color: #D2D7D3; color: #212529;">Featured Items</div>
                        <div class="card-body">
            
    <div class="row" id="product-list">
        @include('partials.items', ['items' => $items])
    </div>

    <div class="text-center my-4 d-none" id="loading">
        <span class="spinner-border text-primary"></span>
    </div>

    <div class="text-center text-muted my-4 d-none" id="end-message">
        No more items to load
    </div>
</div>
        </div>
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
                                    <img src="/uploads/item_avatars/{{ $cItem['associatedModel']['item_avatar'] }}" alt="{{ $cItem->name }}" style="height: 60px; width: 60px; border-radius: 10px;">
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

let page = 1;
let loading = false;
let lastPage = {{ $items->lastPage() }};
let searchTimer;

function loadItems(reset = false) {
    if (loading) return;

    if (!reset && page >= lastPage) {
        $('#end-message').removeClass('d-none');
        return;
    }

    loading = true;
    $('#loading').removeClass('d-none');

    if (reset) {
        page = 1;
        $('#product-list').html('');
        $('#end-message').addClass('d-none');
    } else {
        page++;
    }

    $.ajax({
        url: "{{ route('store.index') }}",
        type: "GET",
        data: {
            page: page,
            category: $('[name=category]').val(),
            item_name: $('[name=item_name]').val()
        },
        success: function (html) {
            if (reset) {
                $('#product-list').html(html);
            } else {
                $('#product-list').append(html);
            }
            loading = false;
            $('#loading').addClass('d-none');
        }
    });
}

// Infinite scroll
$(window).on('scroll', function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 150) {
        loadItems();
    }
});



let timer;

$('#searchForm input, #searchForm select').on('input change', function () {
    clearTimeout(timer);

    timer = setTimeout(() => {
        $.ajax({
            url: "{{ route('store.index') }}",
            type: "GET",
            data: $('#searchForm').serialize(),
            beforeSend: function () {
                $('#loading').removeClass('d-none');
            },
            success: function (html) {
                $('#product-list').html(html);
                $('#loading').addClass('d-none');
            }
        });
    }, 400);
});



</script>