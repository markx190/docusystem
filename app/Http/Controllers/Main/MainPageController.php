<?php

namespace App\Http\Controllers\Main;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use App\Models\Item;
use App\Models\ItemImages;
use Validator;
use Auth;
use Image;
use Session;
use Exception;
use Cart;
use DB;

class MainPageController extends Controller
{
	public function index()
	{
		session_start();
		try {
			$items = Item::all();
			$sessionId = session()->getId();
			$cartContents = Cart::session($sessionId)->getContent();
			$cartCount = Cart::session($sessionId)->getContent()->count();
			$cartTotal = Cart::session($sessionId)->getTotal();

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

    // Dump item and imagesArray for debugging
    // dd($items, $imagesArray);

    return view('riverfront.index', [
        'items' => $items,
        'cartContents' => $cartContents,
        'cartCount' => $cartCount,
        'cartTotal' => $cartTotal,
        'itemData' => $itemDataArray,
        'imagesArray' => $imagesArray
    ]);
			
		} catch (Exception $e) {
			return $e->getMessage();
		} 
	}

	public function viewCart()
	{
		try {
			$items = Item::all();
			$sessionId = session()->getId();
			$cartContents = Cart::session($sessionId)->getContent();
			$cartCount = Cart::session($sessionId)->getContent()->count();
			$cartTotal = Cart::session($sessionId)->getTotal();
			$itemImages = ItemImages::where('item_id_no', $request->itemIdNoVal)->get();

			return view('riverfront.view_cart',[
				'items' => $items,
				'cartContents' => $cartContents,
				'cartCount' => $cartCount,
				'cartTotal' => $cartTotal,
				'itemImages' => $itemImages
			]);
		} catch (Exception $e) {
			return $e->getMessage();
		} 
	}

	public function getImagesPerItem(Request $request)
	{
		try {
			\Log::info('item_id_no');
			$itemImages = ItemImages::where('item_id_no', $request->itemIdNoVal)->get();
			$sessionId = session()->getId();
			return view('riverfront.view_modal_slides',[
				'itemImages' => $itemImages
			]);
		} catch (Exception $e) {
			return $e->getMessage();
		} 
	}

    public function checkout()
	{
		try {
			$items = Item::all();
			$sessionId = session()->getId();
			$cartContents = Cart::session($sessionId)->getContent();
			$cartCount = Cart::session($sessionId)->getContent()->count();
			$cartTotal = Cart::session($sessionId)->getTotal();
			return view('riverfront.checkout',[
				'items' => $items,
				'cartContents' => $cartContents,
				'cartCount' => $cartCount,
				'cartTotal' => $cartTotal
			]);
		} catch (Exception $e) {
			return $e->getMessage();
		} 
	}
	
}