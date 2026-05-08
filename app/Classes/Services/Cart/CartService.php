<?php

namespace App\Classes\Services\Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Darryldecode\Cart\Facades\Cart as CartFacade;

class CartService
{
    public function addItemToCart(Request $request)
    {
        try {
            // Get session ID
            $sessionId = Session::getId();

            // Log request data
            \Log::info('item_id_no: ' . $request->itemIdNo);
            \Log::info('item_name: ' . $request->itemName);
            \Log::info('unit_price: ' . $request->unitPrice);

            // Add item to cart
            CartFacade::session($sessionId)->add([
                'id' => $request->itemIdNo,
                'name' => $request->itemName,
                'price' => $request->unitPrice,
                // Add other relevant details
            ]);

            // Log cart contents
            $cartContents = CartFacade::session($sessionId)->getContent();
            \Log::info('cart_contents: ' . json_encode($cartContents));

            // Check if the item is in the cart
            $itemInCart = CartFacade::session($sessionId)->get($request->itemIdNo);
            \Log::info('item_in_cart: ' . json_encode($itemInCart));

        } catch (\Exception $e) {
            \Log::error('Error: ' . $e->getMessage());
        }
    }
}
