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
    <div class="card-header"><b>Account</b></div>
        <div class="card-body">
            <div class="row" style="margin-top: 12px;">
                <div class="col-md-12">
    <div class="form-group">
        <p class="fw-bold mb-3">Your Orders</p>

        @foreach($orders as $order)
            <div class="d-flex align-items-center mb-3 p-2 border rounded">
                
                <img 
                    src="{{ asset('public/uploads/item_avatars/' . $order->item_avatar) }}"
                    style="width: 130px; height: 120px; border-radius: 10px;"
                    class="me-3"
                />

                <div class="flex-grow-1">
                    <p class="mb-1"><strong>Order ID:</strong> {{ $order->order_id }}</p>
                    <p class="mb-1"><strong>Item:</strong> {{ $order->item_name }}</p>
                    <p class="mb-1"><strong>Qty:</strong> {{ $order->quantity }}</p>
                    <p class="mb-0">
                        <strong>Status:</strong> 
                        <span class="badge {{ $order->order_status == 'Processed' ? 'bg-success' : 'bg-warning' }}">
                            {{ $order->order_status }}
                        </span>
                    </p>
                </div>

                {{-- Cancel button only if NOT processed --}}
                @if($order->order_status !== 'Processed')
    <button 
        class="btn btn-sm btn-danger cancel-btn ms-3"
        data-id="{{ $order->id }}"
    >
        Cancel
    </button>
@endif


            </div>
        @endforeach
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
<div class="modal fade" id="cancelModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancel Order</h5>
                
    <span type="button" class="close" data-dismiss="modal">X</span>


            </div>
            <div class="modal-body">
                Are you sure you want to cancel this order?
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">No</button>

                <button class="btn btn-danger" id="confirmCancel">
                    Yes, Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    
document.addEventListener('DOMContentLoaded', function () {

    let orderId = null;
    const cancelModalEl = document.getElementById('cancelModal');
    const cancelModal = new bootstrap.Modal(cancelModalEl);

    // Use event delegation (important)
    $(document).on('click', '.cancel-btn', function () {
        id = $(this).data('id');
        cancelModal.show();
    });

    $('#confirmCancel').on('click', function () {
        $.ajax({
            url: `/orders/${id}/cancel`,
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                cancelModal.hide();
                // alert(response.message);
                location.reload();
            },
            error: function (xhr) {
                cancelModal.hide();
                // alert(xhr.responseJSON?.message || 'Something went wrong');
            }
        });
    });

});
</script>


<!-- Footer-->
@include('layouts.store_footer')