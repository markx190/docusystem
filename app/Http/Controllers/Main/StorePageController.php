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

class StorePageController extends Controller
{
	public function index(Request $request)
    {
        $user = null;

        if (session()->has('login_id')) {
            $user = User::find(session('login_id'));
        
            if (!$user) {
                session()->forget('login_id');
            }
        }
        
        $query = Item::query();
    
            if ($request->filled('category')) {
                $query->where('category', $request->category);
            }
        
            if ($request->filled('item_name')) {
                $query->where('item_name', 'LIKE', '%' . $request->item_name . '%');
            }
        
            $items = $query->paginate(12)->withQueryString();
        
            if ($request->ajax()) {
                return view('partials.items', compact('items'))->render();
            }
    
        $sessionId = session()->getId();
        $cartContents = Cart::session($sessionId)->getContent();
        $cartCount = $cartContents->count();
    
        return view('online.index', compact('items', 'user', 'cartContents', 'cartCount'));
    }


	public function searchItem(Request $request)
	{
		// dd($request->all());
		session_start();
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

        $data = $request->all();
        date_default_timezone_set('Asia/Manila');
        $dTime = date('F j, Y');
        
        $category = $data['category'];
        $item_name = $data['item_name'];

		$s_category = $category;
		$s_item_name = $item_name;

		$toShips = Item::where('category', '!=', 'Frozen Delights')->get();
		\Log::info($toShips);

		$frozenItems = Item::where('category', '=', 'Frozen Delights')->get();

        $results = Item::where('category', 'LIKE', '%' . $category . '%')
            ->where('item_name', 'LIKE', '%' . $item_name . '%')
            ->get();

        return view('online.item_results', [
            'dateTime' => $dTime,
            'items' => $results,
			'sCategory' => $s_category,
			'sItemName' => $s_item_name,
			'cartContents' => $cartContents,
			'cartCount' => $cartCount,
			'cartTotal' => $cartTotal,
			'frozens' => $frozenItems,
			'itemData' => $itemDataArray,
			'imagesArray' => $imagesArray,
			'toShips' => $toShips
        ]);
	}

	public function viewItemStore(Request $request)
	{
		session_start();
			$items = Item::all();
			$viewItem = Item::where('item_id_no', $request->itemIdNo)->first();
			$sessionId = session()->getId();
			$cartContents = Cart::session($sessionId)->getContent();
			$cartCount = Cart::session($sessionId)->getContent()->count();
			$cartTotal = Cart::session($sessionId)->getTotal();

			\DB::enableQueryLog();
			$itemImages = Item::with('images')->where('item_id_no', $request->itemIdNo)->first();
			\Log::info(\DB::getQueryLog());
			$iImages = ItemImages::where('item_id_no', $request->itemIdNo)->get();

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

        $data = $request->all();
        date_default_timezone_set('Asia/Manila');
        $dTime = date('F j, Y');

        return view('online.view_item_store', [
			'items' => $items,
            'dateTime' => $dTime,
			'viewItem' => $viewItem,
			'cartContents' => $cartContents,
			'cartCount' => $cartCount,
			'cartTotal' => $cartTotal,
			'imagesArray' => $iImages
        ]);
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
				'cartTotal' => $cartTotal,
			]);
		} catch (Exception $e) {
			return $e->getMessage();
		} 
	}

	public function about(Request $request)
	{
		return view('online.about');
	}

	public function buyerCentral(Request $request)
	{
		return view('online.buyer_central');
	}
	
	public function contacts(Request $request)
	{
		return view('online.contacts');
	}
	
	public function events(Request $request)
    {
        $user = null;

        if (session()->has('login_id')) {
            $user = User::find(session('login_id'));
        
            if (!$user) {
                session()->forget('login_id');
            }
        }
        
        $query = WStudios::query();
    
            if ($request->filled('category')) {
                $query->where('category', $request->category);
            }
        
            if ($request->filled('item_name')) {
                $query->where('item_name', 'LIKE', '%' . $request->item_name . '%');
            }
        
            $items = $query->paginate(12)->withQueryString();
        
            if ($request->ajax()) {
                return view('partials.items', compact('items'))->render();
            }
    
        $sessionId = session()->getId();
        $cartContents = Cart::session($sessionId)->getContent();
        $cartCount = $cartContents->count();
    
        return view('online.events', compact('items', 'user', 'cartContents', 'cartCount'));
    }
	
}
