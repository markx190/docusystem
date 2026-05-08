<?php

namespace App\Http\Controllers\Cart;
use App\Http\Controllers\Controller;
use App\Classes\Services\Cart\CartService;
// use Darryldecode\Cart\Facades\Cart as CartFacade;
use Illuminate\Http\Request;
use App\User;
use App\Models\Item;
use App\Models\Orders;
use App\Models\itemsOrdered;
use App\Models\BzTransactions;
use App\Models\CartItems;
use App\Mail\OrderConfirmationEmail;
use Mail;
use Auth;
use Validator;
use Image;
use Exception;
use Session;
use Cart;
use DB;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        try {
            $viewItems = $this->cart->indexView();
            return $viewItems;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function itemsOrderedDataTable(Request $request)
    {
        try {
            return $this->cart->itemsOrderedDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addItemToCart(Request $request)
    {
        
        try {
            $sessionId = session()->getId();
            $items = Item::where('item_id_no', $request->itemIdNo)->first();

            $request->validate([
                'itemName' => 'required',
                'unitPrice' => 'numeric|min:0',
                'quantity' => 'numeric|min:0',
            ]);
           
            Cart::session($sessionId)->add([
                'id' => $request->itemIdNo,
                'name' => $request->itemName,
                'price' => $request->unitPrice,
                'company_id' => $request->companyId,
                'quantity' => 1,
                'attributes' => array(),
                'associatedModel' => $items
            ]);

            // Log cart contents
            if (isset($array['quantity'])) {
                $quantity = $array['quantity'];
            } else {
                $quantity = null; 
            }

            $cartContents = Cart::session($sessionId)->getContent();
            \Log::info('cart_contents: ' . json_encode($cartContents));
        } catch (Exception $e){
            \Log::error('Error: ' . $e->getMessage());
        }
    }

    public function updateCart(Request $request)
    {
    try {
        $request->validate([
            'itemId' => 'required',
            'quantity' => 'numeric|min:1', 
        ]);

        // Retrieve session ID and item data
        $sessionId = session()->getId();
        $itemId = $request->input('itemId');
        $newQuantity = $request->input('quantity');

        $cartItem = Cart::session($sessionId)->get($itemId);

        if ($cartItem) {
            // Update the item quantity
            Cart::session($sessionId)->update($itemId, [
                'quantity' => array(
                    'relative' => false, // Set to false to use absolute quantity value
                    'value' => $newQuantity
                ),
            ]);

            // Optionally, log the updated cart contents
            $updatedCartContents = Cart::session($sessionId)->getContent();
            \Log::info('Updated cart_contents: ' . json_encode($updatedCartContents));

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully',
                'total' => Cart::session($sessionId)->getTotal(),
                'item' => $updatedCartContents[$itemId]
            ]);
        } else {
            // Item not found in the cart
            return response()->json([
                'success' => false,
                'message' => 'Item not found in the cart'
                ], 404);
            }
        } catch (Exception $e) {
            \Log::error('Error updating cart: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating cart'
            ], 500);
        }
    }

    public function checkout()
    {
        return redirect()->route('place_order')->with('success', 'You have checked out. Your orders has been placed.');
    }

    public function confirmOrder(Request $request)
    {

        $sessionId = Session::getId();
        // dd($sessionId);
        $cartContents = Cart::session($sessionId)->getContent();
        \Log::info('cart_contents: ' . json_encode($cartContents));
    
        if (!$cartContents || count($cartContents) == 0) {
            return redirect()->back()->with('error', 'Your cart is empty');
    }
    
    $sId = $sessionId;

    $request->validate([
        'firstname' => 'required',
        'lastname' => 'required',
        'mobile_number' => 'required|min:11|max:11',
        'postal_code' => 'required',
        'lot_no' => 'required',
        'street' => 'required',
        'barangay' => 'required',
        'city' => 'required',
        'province' => 'required'
    ]);

        $oId = mt_rand(100000, 999999);
        $buyer = new BzTransactions;
        $buyer->order_id = $oId;
        $buyer->session_id = $sessionId;
        $buyer->account_id = $request->account_id;
        $buyer->buyer_type = 'Guest';
        $buyer->firstname = $request->firstname;
        $buyer->lastname = $request->lastname;
        $buyer->email = $request->email;
        // $buyer->mobile_number = substr($request->mobile_number,3);
        $buyer->mobile_number = $request->mobile_number;
        $buyer->postal_code = $request->postal_code;
        $buyer->lot_no = $request->lot_no;
        $buyer->street = $request->street;
        $buyer->barangay = $request->barangay;
        $buyer->city = $request->city;
        $buyer->province = $request->province;
        $buyer->toc = $request->toc;
        $buyer->payment_method = 'COD';
        $buyer->status = 'Unpaid';

        $transaction = $buyer->save();
        $tAmount = '';
        if($transaction){
            $shipFee = 0;
            $tAmount = collect($cartContents)->sum(function($item) {
                return $item['price'] * $item['quantity'];
            });
            
            
            $totalAmount = $tAmount + 0;

            $order = new Orders;
            $order->order_id = $oId;
            $order->account_id = $request->account_id;
            $order->buyer_name = $request->firstname .' '. $request->lastname;
            $order->mobile_number = substr($request->mobile_number,3);
            $order->session_id = $sessionId;
            $order->order_status = 'Unpaid';

            $order->total_amount = $totalAmount;
         
            $saveOrder = $order->save();
        
        if($saveOrder){
            foreach ($cartContents as $item) {
            \Log::info('item price: '. $cartContents);

            $myOrder = new CartItems;
            $myOrder->session_id = $sId;
            $myOrder->order_id = $oId;
            $myOrder->item_id_no = $item['id'];
            $myOrder->item_name = $item['name'];
            $myOrder->quantity = $item['quantity'];
            $myOrder->unit_price = $item['price'];
            $myOrder->save();

        }
            $firstName = $request->firstname;
            $lastName = $request->lastname;
            $oItems = CartItems::where('order_id', $oId)->get();
            \Log::info($oItems);
            // Mail::to($request->email)->cc(['markescarioofficial@gmail.com'])->send(new OrderConfirmationEmail($oId, $firstName, $lastName, $oItems, $totalAmount));

            $this->flushCart();
            return redirect('order_completed/'. base64_encode($oId))->with('order_success', 'Your order was completed. Thank you.')
                          ->with(
                                'delivery_note',
                                'Your order will be prepared and delivered within 1 to 3 hours 
                                after placement. You will receive updates via email to keep you informed 
                                about your order, and our Customer Support team may contact you if needed. 
                                To cancel your order, please call us immediately at 0961-595-0391 or 
                                visit your account to request cancellation. Failure to do so may result in your order being processed as scheduled.
                                Delivery starts at 7am to 6pm.'
                                );
        } else {
            return back()->with('fail', 'Something went wrong in placing your order');
        }

        } else {
            return 'There is some error in saving your transaction';
        }

        // return redirect()->route('place_order')->with('success', 'You have place your order successfully. Thank you.');

        // Clear the cart
        // session()->forget('cart');
    }

    public function orderCompleted(Request $request)
    {
        session_start();
		try {
			$items = Item::where('category', '!=', 'Frozen Delights')->get();
			$sessionId = session()->getId();
			$cartContents = Cart::session($sessionId)->getContent();
			$cartCount = Cart::session($sessionId)->getContent()->count();
			$cartTotal = Cart::session($sessionId)->getTotal();
        
            $buyer = BzTransactions::where('order_id', base64_decode($request->oId))->first();
			\DB::enableQueryLog();
			$itemImages = Item::with('images')->get();
			\Log::info(\DB::getQueryLog());
        
            if (empty($buyer)){
                return redirect('page_expired')->with('page_error', 'Sorry. This page has expired. You need to make an order.');
            } else {
                return view('online.order_completed', [
                    'items' => $items,
                    'sessionId' => $sessionId,
                    'cartContents' => $cartContents,
                    'buyer' => $buyer,
                    'cartCount' => $cartCount,
                    'cartTotal' => $cartTotal,
                   
                ]);
            }
		} catch (Exception $e) {
			return $e->getMessage();
		} 
    }

    private function submitBuyer($oId, $sId)
    {
        // dd($sId);
    }

    public function placeOrder(Request $request)
    {
        session_start();
		try {
			$items = Item::where('category', '!=', 'Frozen Delights')->get();
			$sessionId = session()->getId();
			$cartContents = Cart::session($sessionId)->getContent();
			$cartCount = Cart::session($sessionId)->getContent()->count();
			// $cartTotal = Cart::session($sessionId)->getTotal();
            $shipping_fee = 0;
            $subTotal = collect($cartContents)->sum(function($item) {
                return ($item['price'] * $item['quantity']);
            });

            $cartTotal = $subTotal + $shipping_fee;

			\DB::enableQueryLog();
			$itemImages = Item::with('images')->get();
			\Log::info(\DB::getQueryLog());

			$itemDataArray = [];
			$imagesArray = [];

		foreach ($items as $item) {
			// Access item data
			$itemData = $item->toArray();
			// Access associated images for each item
			$images = $item->images->toArray();

			$itemDataArray[] = $itemData;
			$imagesArray[] = $images;
    	}
	
		$frozenItems = Item::where('category', '=', 'Frozen Delights')->get();

		return view('online.place_order', [
			'items' => $items,
			'cartContents' => $cartContents,
			'cartCount' => $cartCount,
			'cartTotal' => $cartTotal,
			'itemData' => $itemDataArray,
			'imagesArray' => $imagesArray,
			'frozens' => $frozenItems
		]);
			
		} catch (Exception $e) {
			return $e->getMessage();
		} 
    }

    public function deleteItem(Request $request)
    {
        $sessionId = session()->getId();
        Cart::session($sessionId)->remove($request->itemIdNo);

    }

    private function flushCart()
    {
    // Clear all items from the cart
    Cart::clear();

    // You can optionally provide a session ID to clear a specific cart
    // Cart::session($sessionId)->clear();

    // Redirect back or to a specific page after clearing the cart
    return redirect()->back()->with('flush_success', 'Cart has been cleared.');
    }

    public function pageExpired(Request $request)
    {
        return view('online.page_expired');
    }
    
    public function cancelOrder($id)
    {
        $order = BzTransactions::findOrFail($id);
    
        if ($order->status === 'Processed') {
            return response()->json([
                'message' => 'Processed orders cannot be canceled.'
            ], 403);
        }
    
        $order->status = 'Cancelled';
        $order->save();
    
        return response()->json([
            'message' => 'Order cancelled successfully.'
        ]);
    }

}