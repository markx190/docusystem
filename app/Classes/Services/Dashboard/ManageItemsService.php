<?php

namespace App\Classes\Services\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Classes\Constants\Constants;
use App\Models\User;
use Illuminate\Support\Arr;
use Carbon\Carbon;
// use Datatables;
use Session;
use Validator;
use DB;
use App\Models\Item;
use App\Models\WStudios;
use App\Models\ItemImages;
use App\Models\FileHistory;
use App\Models\Facilities;
use App\Models\Amenities;
use Image;
use Exception;
use Auth;
use Mail;

class ManageItemsService
{
    public function indexView()
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            return view('management.manage_items', [
                'dateTime' => $dTime,
                'user' => $logData
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function unitsView()
    {
    try {
        date_default_timezone_set('Asia/Manila');
        $dTime = date('F j, Y');

        if (!Session::has('login_id')) {
            return redirect('/login'); // session expired
        }

        $logData = User::where('id', Session::get('login_id'))->first();

        if (!$logData) {
            return redirect('/login'); // user not found
        }

        return view('management.manage_units', [
            'dateTime' => $dTime,
            'user' => $logData
        ]);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function unitsDataTable($request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            
            $units = DB::table('wstudios')->where('company_id', $logData->account_id)->get();
            
            $results = datatables()->of($units);
                return $results
                    ->addColumn('action', function ($data) {
                        $action = '<a target="_blank" href="add_facility_form/'. $data->item_id_no .'" style="text-decoration:none;">
                            <button class="btn btn-secondary btn-xs" type="button"
                                data-e-id="'. $data->id .'"
                                data-item-id-no="'. $data->item_id_no .'">
                            <i class="fa fa-image"></i> Add Facility
                        </button>
                    </a>
                    <a target="_blank" href="add_amenity_form/'. $data->item_id_no .'" style="text-decoration:none;">
                            <button class="btn btn-primary btn-xs" type="button"
                                data-e-id="'. $data->id .'"
                                data-item-id-no="'. $data->item_id_no .'">
                            <i class="fa fa-image"></i> Add Amenities
                        </button>
                    </a>
                    <a target="_blank" href="/update_unit_form/'. $data->item_id_no .'" style="text-decoration:none;">
                        <button class="btn btn-warning btn-xs" type="button"
                            data-e-id="'. $data->id .'"
                                data-item-id-no="'. $data->item_id_no .'">
                            <i class="fa fa-edit"></i> Update Unit
                        </button>
                    </a>
                    <a target="_blank" href="/delete_unit_form/'. $data->item_id_no .'" style="text-decoration:none;">
                        <button class="btn btn-danger btn-xs" type="button"
                            data-e-id="'. $data->id .'"
                                data-item-id-no="'. $data->item_id_no .'">
                            <i class="fa fa-edit"></i> Delete
                        </button>
                    </a>';
                return $action;
            })
            ->make();
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function itemsDataTable($request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            
            $items = DB::table('items')->get();
            
            $results = datatables()->of($items);
                return $results
                    ->addColumn('action', function ($data) {
                        $action = '<a href="add_file_history_form/'. $data->id .'" style="text-decoration:none;">
                            <button class="btn btn-primary btn-xs" type="button"
                                data-e-id="'. $data->id .'"
                                data-item-id-no="'. $data->id .'">
                            <i class="fa fa-file"></i> View History
                        </button>
                    </a>
                    <a href="/update_item_form/'. $data->item_id_no .'" style="text-decoration:none;">
                        <button class="btn btn-warning btn-xs" type="button"
                            data-e-id="'. $data->id .'"
                                data-item-id-no="'. $data->item_id_no .'">
                            <i class="fa fa-edit"></i> Update
                        </button>
                    </a>';
                return $action;
            })
            ->make();
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function fileHistoryDataTable($request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            
            $history = DB::table('file_history')
                       ->join('users', 'users.account_id', '=', 'file_history.updated_by')
                       ->get();
            
            $history = datatables()->of($history);
            return $history
            ->editColumn('updated_by', function ($data) {
                        return $data->firstname .' '.$data->lastname;
                 })
            ->make();
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }


    public function addItemForm(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            return view('management.add_item_component', [
                'dateTime' => $dTime,
                'user' => $logData
            ]);
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }
    
    public function addUnitForm(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            return view('management.add_unit_component', [
                'dateTime' => $dTime,
                'user' => $logData
            ]);
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function addItem(Request $request)
    {
        if (Session::has('login_id')){
            $logData = User::where('id', Session::get('login_id'))->first();
        }
        $request->validate([
            'item_name' => 'required',
            'category' => 'required',
            'generic' => 'required',
            'item_avatar' => 'required|image|mimes:jpeg,pdf,png,jpg|max:3048'
        ]);

        $items = new Item;

        if ($request->hasFile('item_avatar')) {
            $itemAvatar = $request->file('item_avatar');
            $filename = time() . '.' . $itemAvatar->getClientOriginalExtension();
            \Log::info($filename);
            $location = public_path('uploads/item_avatars/'. $filename); // Use $filename instead of $avatar
            Image::make($itemAvatar)->resize(510, 850)->save($location);
            $items->item_avatar = $filename;  
        }

        $items->item_id_no = mt_rand(100000, 999999);
        $items->company_id = $logData->account_id;
        $items->item_name = $request->item_name;
        $items->generic = $request->generic;
        $items->brand = $logData->company;
        $items->uom = $request->uom;
        $items->category = $request->category;
        $items->description = $request->description;
        $items->status = 'New';
        $saved = $items->save();
        
        if ($saved) {               
            return back()->with('add_item_success', 'A new item was added successfully');
        } else {
            return back()->with('add_item_failed', 'Something went wrong adding new item');
        }
       
    }
    
    public function addUnit(Request $request)
    {
        if (Session::has('login_id')){
            $logData = User::where('id', Session::get('login_id'))->first();
        }
        $request->validate(
            [
                'item_name'       => 'required|string|max:255',
                'unit_type'       => 'required|string|max:100',
                'host_name'       => 'required|string|max:255',
                'rates'       => 'required|string',
                'booking_basis'       => 'required|string',
                'description'     => 'required|string',
                'contact_numbers' => 'required|min:11|max:11',
                'operating_hours' => 'required|string|max:255',
                'unit_no'         => 'required|string|max:100',
                'street'          => 'required|string|max:255',
                'town_city'       => 'required|string|max:255',
                'province'        => 'required|string|max:255',
                'item_avatar'     => 'required|image|mimes:jpeg,png,jpg|max:5048'
            ],
            [
                // Custom Messages
                'item_name.required'       => 'Unit name is required.',
                'unit_type.required'       => 'Please select a unit type.',
                'rates.required'       => 'Rates is required.',
                'booking_basis.required'       => 'Booking basis is required.',
                'host_name.required'       => 'Host name is required.',
                'contact_numbers.required'       => 'Contact Numbers is required.',
                'description.required'     => 'Please enter a description.',
                'operating_hours.required' => 'Operating hours are required.',
                'unit_no.required'         => 'Building number is required.',
                'street.required'          => 'Street is required.',
                'town_city.required'       => 'City is required.',
                'province.required'        => 'Province is required.',
                'item_avatar.required'     => 'Please upload a unit image.',
                'item_avatar.image'        => 'Uploaded file must be an image.',
                'item_avatar.mimes'        => 'Image must be jpeg, png, or jpg format.',
                'item_avatar.max'          => 'Image size must not exceed 3MB.',
            ]
        );

        $items = new WStudios;

        if ($request->hasFile('item_avatar')) {
            $itemAvatar = $request->file('item_avatar');
            $filename = time() . '.' . $itemAvatar->getClientOriginalExtension();
            \Log::info($filename);
            $location = public_path('uploads/item_avatars/'. $filename); // Use $filename instead of $avatar
            Image::make($itemAvatar)->resize(510, 850)->save($location);
            $items->item_avatar = $filename;  
        }

        $items->item_id_no = mt_rand(100000, 999999);
        $items->company_id = $logData->account_id;
        $items->item_name = $request->item_name;
        $items->unit_type = $request->unit_type;
        $items->host_name = $request->host_name;
        $items->contact_numbers = $request->contact_numbers;
        $items->operating_hours = $request->operating_hours;
        
        $items->rates = $request->rates;
        $items->pax_capacity = $request->pax_capacity;
        $items->description = $request->description;
        $items->unit_no = $request->unit_no;
        $items->street = $request->street;
        $items->town_city = $request->town_city;
        $items->province = $request->province;
        $items->status = 'Available';
        $saved = $items->save();
        
        if ($saved) {               
            return back()->with('add_unit_success', 'New unit was added successfully');
        } else {
            return back()->with('add_unit_failed', 'Something went wrong adding new unit');
        }
       
    }

    public function addImageForm(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            $item = Item::where('item_id_no', '=', $request->itemIdNo)->first();
            $itemImages = ItemImages::where('item_id_no', '=', $request->itemIdNo)->get();
            return view('management.manage_item_images', [
                'dateTime' => $dTime,
                'items' => $item,
                'itemImages' => $itemImages,
                'user' => $logData
            ]);
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }
    
    public function addFacilityForm(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            $units = WStudios::where('item_id_no', $request->itemIdNo)->first();
         
            $facilities = Facilities::where('item_id_no', $units->item_id_no)->get();
            
         
            return view('management.manage_facilities', [
                'dateTime' => $dTime,
                'items' => $units,
                'facilities' => $facilities,
                'user' => $logData
            ]);
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function addFileHistoryForm(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            $items = Item::where('id', $request->itemId)->first();
         
            return view('management.add_file_history_component', [
                'dateTime' => $dTime,
                'items' => $items,
                'user' => $logData
            ]);
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function addFileHistory(Request $request)
    {
        if (Session::has('login_id')){
            $logData = User::where('id', Session::get('login_id'))->first();
        }

        $request->validate([
            'comments' => 'required',
            'file_status' => 'required'
            ],
            [
            'comments.required' => 'Comment is required.',
            'status.required' => 'Status is required'
            ]
        );
    
        $history = new FileHistory();
        $history->file_id = $request->file_id;
        $history->comments = $request->comments;
        $history->updated_by = $logData->account_id;    
        $history->department = $logData->company;   
        $history->file_status = $request->file_status;    
        $history->save();
    
        if ($history) {
            return back()->with('history_success', 'File Comments was added');
        }
    
        return back()->with('fail', 'Something went wrong with your comments');
    }
    
    public function addAmenityForm(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            $units = WStudios::where('item_id_no', $request->itemIdNo)->first();
         
            $amenities = Amenities::where('item_id_no', $units->item_id_no)->get();
            
         
            return view('management.manage_amenities', [
                'dateTime' => $dTime,
                'items' => $units,
                'amenities' => $amenities,
                'user' => $logData
            ]);
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function addItemImage(Request $request)
    {
    try {
        if (!Session::has('login_id')) {
            return back()->with('error', 'Please login first.');
        }

        $logData = User::find(Session::get('login_id'));
        if (!$logData) return back()->with('error', 'User not found.');

        $validation = Validator::make($request->all(), [
            'item_images.*' => 'required|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240', // 10MB max
        ]);

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }

        if ($request->hasFile('item_images')) {
            foreach ($request->file('item_images') as $file) {
                $itemImage = new ItemImages();
                $itemImage->item_id_no = $request->item_id_no;

                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                if (in_array($file->extension(), ['jpeg','jpg','png','gif'])) {
                    \Image::make($file)->save(public_path('uploads/item_images/' . $filename));
                } else {
                    $file->move(public_path('uploads/item_images/'), $filename);
                }

                $itemImage->item_image = $filename;
                $itemImage->save();
            }
        }

        return back()->with('add_item_image_success', 'Item(s) uploaded successfully.');
        } catch (\Exception $e) {
        \Log::error($e->getMessage());
        return back()->with('error', 'Something went wrong: '.$e->getMessage());
        }
    }
    
    public function addFacility(Request $request)
    {
    try {

        if (!Session::has('login_id')) {
            return back()->with('error', 'Please login first.');
        }

        $request->validate([
            'facility_name' => 'required|string|max:255',
            'item_id_no' => 'required',
            'item_images.*' => 'required|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240'
        ]);

        if ($request->hasFile('item_images')) {

            foreach ($request->file('item_images') as $file) {

                $facility = new Facilities();
                $facility->item_id_no = $request->item_id_no;
                $facility->facility_name = $request->facility_name;

                $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

                if (in_array($file->extension(), ['jpeg','jpg','png','gif'])) {
                    \Image::make($file)
                        ->save(public_path('uploads/item_images/'.$filename));
                } else {
                    $file->move(public_path('uploads/item_images/'), $filename);
                }

                $facility->item_image = $filename;
                $facility->save();
            }
        }

        return back()->with('add_item_image_success', 'Facility uploaded successfully.');

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong.');
        }
    }
    
    public function addAmenity(Request $request)
    {
    try {
        if (!Session::has('login_id')) {
            return back()->with('error', 'Please login first.');
        }

        $request->validate(
            [
                'amenity_name' => 'required|string|max:255',
                'item_id_no'   => 'required|string|max:100',
                'item_images.*'=> 'required|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240'
            ],
            [
                'amenity_name.required' => 'Amenity name is required.',
                'item_id_no.required'   => 'Item Id is required.',
                'item_images.*.mimes'   => 'Each file must be jpeg, png, jpg, gif, mp4, mov, or avi.',
                'item_images.*.max'     => 'Each file must not exceed 10MB.',
            ]
        );

        if ($request->hasFile('item_images')) {
            foreach ($request->file('item_images') as $file) {

                $amenity = new Amenities();
                $amenity->item_id_no = $request->item_id_no;
                $amenity->amenity_name = $request->amenity_name;

                $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

                if (in_array($file->extension(), ['jpeg','jpg','png','gif'])) {
                    \Image::make($file)->save(public_path('uploads/item_images/'.$filename));
                } else {
                    $file->move(public_path('uploads/item_images/'), $filename);
                }

                $amenity->item_image = $filename;
                $amenity->save();
            }
        }

        return back()->with('add_item_image_success', 'Amenity uploaded successfully.');

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong. You are missing required field');
        }
    }

    public function updateItemForm($request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
    
            if (Session::has('login_id')) {
                $logData = User::where('id', Session::get('login_id'))->first();
            }
    
            $item = Item::where('item_id_no', $request->itemIdNo)->firstOrFail();
    
            return view('management.update_item_component', [
                'dateTime' => $dTime,
                'user' => $logData,
                'item' => $item
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateItem(Request $request)
{
    if (Session::has('login_id')) {
        $logData = User::where('id', Session::get('login_id'))->first();
    }

    $validator = Validator::make($request->all(), [
        'item_name' => 'required',
        'brand' => 'required',
        'category' => 'required',
        'description' => 'required',
        'item_avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:3048'
    ], [
        'item_name.required' => 'Item Name is required.',
        'brand.required' => 'Department is required.',
        'category.required' => 'Category is required.',
        'description.required' => 'Description is required.',
        'status.required' => 'Status is required.',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    $item = Item::where('item_id_no', $request->itemIdNo)->firstOrFail();

    // Handle image update
    if ($request->hasFile('item_avatar')) {

        // Delete old image
        if ($item->item_avatar &&
            file_exists(public_path('uploads/item_avatars/' . $item->item_avatar))) {

            unlink(public_path('uploads/item_avatars/' . $item->item_avatar));
        }

        $itemAvatar = $request->file('item_avatar');

        $filename = time() . '.' .
                    $itemAvatar->getClientOriginalExtension();

        $location = public_path('uploads/item_avatars/' . $filename);

        Image::make($itemAvatar)
            ->resize(510, 850)
            ->save($location);

        $item->item_avatar = $filename;
    }

    // Update fields
    $item->item_name = $request->item_name;
    $item->generic = $request->generic;
    $item->unit_price = $request->unit_price;
    $item->brand = $logData->company;
    $item->uom = $request->uom;
    $item->category = $request->category;
    $item->description = $request->description;
    $item->total_stock = $request->total_stock;

    if ($item->save()) {
        return back()->with(
            'update_item_success',
            'Item updated successfully'
        );
    }

    return back()->with(
        'update_item_failed',
        'Something went wrong while updating'
    );
}
    
    // Update Unit
    public function updateUnitForm($request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
    
            if (Session::has('login_id')) {
                $logData = User::where('id', Session::get('login_id'))->first();
            }
    
            $unit = WStudios::where('item_id_no', $request->itemIdNo)->firstOrFail();
    
            return view('management.update_unit_component', [
                'dateTime' => $dTime,
                'user' => $logData,
                'unit' => $unit
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function updateUnit(Request $request)
    {
        $validated = $request->validate(
            [
                'item_name'       => 'required|string|max:255',
                'unit_type'       => 'required|string|max:100',
                'rates'           => 'required|string',
                'booking_basis'   => 'required|string',
                'description'     => 'required|string',
                'operating_hours' => 'required|string|max:255',
                'unit_no'         => 'required|string|max:100',
                'street'          => 'required|string|max:255',
                'town_city'       => 'required|string|max:255',
                'province'        => 'required|string|max:255',
                'status'          => 'required|string|max:255',
                'item_avatar'     => 'nullable|image|mimes:jpeg,png,jpg|max:5048'
            ],
            [
                'item_name.required'     => 'Unit name is required.',
                'unit_type.required'     => 'Please select a unit type.',
                'rates.required'         => 'Rates is required.',
                'booking_basis.required' => 'Booking basis is required.',
                'status.required'        => 'Status is required.',
                'description.required'   => 'Please enter a description.',
                'operating_hours.required'=> 'Operating hours are required.',
                'unit_no.required'       => 'Building number is required.',
                'street.required'        => 'Street is required.',
                'town_city.required'     => 'City is required.',
                'province.required'      => 'Province is required.',
            ]
        );
    
        $item = WStudios::where('item_id_no', $request->itemIdNo)->firstOrFail();
    
        if ($request->hasFile('item_avatar')) {
    
            if ($item->item_avatar && file_exists(public_path('uploads/item_avatars/' . $item->item_avatar))) {
                unlink(public_path('uploads/item_avatars/' . $item->item_avatar));
            }
    
            $itemAvatar = $request->file('item_avatar');
            $filename = time() . '.' . $itemAvatar->getClientOriginalExtension();
            $location = public_path('uploads/item_avatars/' . $filename);
    
            Image::make($itemAvatar)
                ->resize(510, 850, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save($location);
    
            $validated['item_avatar'] = $filename;
        }
    
        $item->update($validated);
    
        return back()->with('update_unit_success', 'Unit updated successfully');
    }


    public function deleteItemImage(Request $request)
    {
        $image = ItemImages::find($request->id);
    
        if (!$image) {
            return response()->json(['success' => false, 'message' => 'Image not found'], 404);
        }
    
        // Delete file from storage
        $filePath = public_path('uploads/item_images/' . $image->item_image);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    
        $image->delete();
    
        return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
    }
    
    public function deleteFacility(Request $request)
    {
    try {

        $facility = Facilities::find($request->id);

        if (!$facility) {
            return response()->json([
                'success' => false,
                'message' => 'Facility not found.'
            ], 404);
        }

        $filePath = public_path('uploads/item_images/' . $facility->item_image);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $facility->delete();

        return response()->json([
            'success' => true,
            'message' => 'Facility deleted successfully.'
        ]);

        } catch (\Exception $e) {
    
            \Log::error($e->getMessage());

            return response()->json([
            'success' => false,
            'message' => 'Something went wrong.'
            ], 500);
        }
    }

    public function deleteAmenity(Request $request)
    {
    try {

        $amenity = Amenities::find($request->id);

        if (!$amenity) {
            return response()->json([
                'success' => false,
                'message' => 'Amenity not found.'
            ], 404);
        }

        $filePath = public_path('uploads/item_images/' . $amenity->item_image);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $amenity->delete();

        return response()->json([
            'success' => true,
            'message' => 'Amenity deleted successfully.'
        ]);

        } catch (\Exception $e) {
    
            \Log::error($e->getMessage());

            return response()->json([
            'success' => false,
            'message' => 'Something went wrong.'
            ], 500);
        }
    }
    
    public function checkOrders()
    {
        $orders = DB::table('items')
                      ->join('users', 'items.company_id', '=', 'users.account_id')
            ->where('items.status', 'New')   // ✅ SIMPLE & CORRECT
            ->orderBy('items.id', 'desc')
            ->get([
                'items.id',
                'users.firstname',
                'users.lastname',
                'users.company',
                'items.generic'
            ]);
    
        return response()->json($orders);
    }

    public function markOrderChecked(Request $request)
    {
        DB::table('items')
            ->where('id', $request->order_id)
            ->update(['status' => 'Checked'. $logData->company ]);
    
        return response()->json(['success' => true]);
    }


}
