@forelse($items as $item)
<div class="col-md-3 col-sm-6 mb-4">
    <div class="card h-100 border-0 shadow-sm product-card">
        <!-- Image -->
<!-- Image -->
<!-- Image -->
<div class="product-image-wrapper position-relative" 
     style="width: 100%; aspect-ratio: 1 / 1; display: flex; align-items: center; justify-content: center; background: #fff; overflow: hidden;">
    <a href="/view_item_store/{{ $item->item_id_no }}">
        <img 
            src="/uploads/item_avatars/{{ $item->item_avatar }}" 
            alt="{{ $item->item_name }}"
            style="
                width: 253px;;      
                height: 239px;      
                border-radius: 13px;
                display: block;
            "
        >
        <span class="badge bg-success position-absolute top-0 start-0 m-2">
            <i class="fa fa-check-circle"></i>
            @if($item->category == 'Food and Groceries')
                Fresh
            @elseif($item->category == 'Pre Loved Items')
                Pre-Loved
            @elseif($item->category == 'Pre Owned Items')
                Second Hand
            @elseif(in_array($item->category, ['Electronics and Gadgets', 'Music Instruments']))
                Good
            @elseif($item->category == 'Apparel')
                New
            @else
                New
            @endif
        </span>
    </a>
</div>
<!-- Body -->
    <div class="card-body d-flex flex-column">
        <h6 class="mb-1 fw-semibold text-truncate">
            {{ $item->item_name }} {{ $item->size }}
        </h6>
        <div class="text-muted small mb-2">
            {{ $item->uom }}
        </div>
        <div class="fw-bold text-primary mb-3">
            ₱ {{ number_format($item->unit_price, 2) }}
        </div>
        <!-- Actions -->
        <div class="mt-auto d-flex gap-2">
            <button
                class="btn btn-primary btn-sm flex-grow-1"
                onclick="addItemToCart(this)"
                data-item-id-no="{{ $item->item_id_no }}"
                data-item-name="{{ $item->item_name }}"
                data-item-avatar="{{ $item->item_avatar }}"
                data-unit-price="{{ $item->unit_price }}"
                data-company-id="{{ $item->company_id }}"
            >
                <i class="fa fa-cart-plus me-1"></i> Add
            </button>

            <a
                href="/view_item_store/{{ $item->item_id_no }}"
                class="btn btn-outline-secondary btn-sm"
                title="View item"
            >
                <i class="fa fa-eye"></i>
            </a>
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-12 text-center py-5 text-muted">
    <i class="fa fa-search fa-2x mb-2"></i>
    <h5>No items found</h5>
    <p class="mb-0">Try another keyword or category</p>
</div>
@endforelse
