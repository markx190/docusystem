@forelse($items as $item)
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
    <a data-session-id="{{ session()->getId() }}"
       data-item-id-no="{{ $item->item_id_no }}"
       data-item-name="{{ $item->item_name }}"
       data-item-avatar="{{ $item->item_avatar }}"
       data-unit-price="{{ $item->unit_price }}" 
       class="btn btn-primary btn-sm" 
       onclick="addItemToCart(this)" 
       type="btn">
       Add To Cart
    </a>
    <a style="text-decoration: none; color: #000000;" href="/view_item_store/{{ $item->item_id_no }}">
        <span><b><i class="fa fa-eye"></i></b></span>
    </a>
</div>
@empty
<div class="col-12 text-center py-5 text-muted">
    <i class="fa fa-search fa-2x mb-2"></i>
    <h5>No items found.</h5>
    <p>Try another keyword or category.</p>
</div>
@endforelse
