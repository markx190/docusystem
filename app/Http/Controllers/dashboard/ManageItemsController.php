<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\ManageItemsService;
use Illuminate\Http\Request;
use App\User;
use App\Models\Item;
use Auth;
use Validator;
use Image;
use Exception;

class ManageItemsController extends Controller
{
    protected $manageItem;

    public function __construct(ManageItemsService $manageItem)
    {
        $this->manageItem = $manageItem;
    }

    public function index()
    {
        try {
            $viewItems = $this->manageItem->indexView();
            return $viewItems;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function units()
    {
        try {
            $viewStudios = $this->manageItem->unitsView();
            return $viewStudios;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function itemsDataTable(Request $request)
    {
        try {
            return $this->manageItem->itemsDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function fileHistoryDataTable(Request $request)
    {
        try {
            return $this->manageItem->fileHistoryDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function unitsDataTable(Request $request)
    {
        try {
            return $this->manageItem->unitsDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addItemForm(Request $request)
    {
        try {
            return $this->manageItem->addItemForm($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function addUnitForm(Request $request)
    {
        try {
            return $this->manageItem->addUnitForm($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addItem(Request $request)
    {
       return $this->manageItem->addItem($request);
    }
    
    public function addUnit(Request $request)
    {
       return $this->manageItem->addUnit($request);
    }

    public function addImageForm(Request $request)
    {
        try {
            return $this->manageItem->addImageForm($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addItemImage(Request $request)
    {
       return $this->manageItem->addItemImage($request);
    }
    
    public function addFacilityForm(Request $request)
    {
        try {
            return $this->manageItem->addFacilityForm($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function addFacility(Request $request)
    {
       return $this->manageItem->addFacility($request);
    }
    
    public function addAmenityForm(Request $request)
    {
        try {
            return $this->manageItem->addAmenityForm($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function addAmenity(Request $request)
    {
       return $this->manageItem->addAmenity($request);
    }

    public function updateItemForm(Request $request)
    {
        try {
            return $this->manageItem->updateItemForm($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addFileHistoryForm(Request $request)
    {
        try {
            return $this->manageItem->addFileHistoryForm($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addFileHistory(Request $request)
    {
       return $this->manageItem->addFileHistory($request);
    }
    
    public function updateUnitForm(Request $request)
    {
        
        return $this->manageItem->updateUnitForm($request);
       
    }

    public function updateItem(Request $request)
    {
        try {
            return $this->manageItem->updateItem($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function updateUnit(Request $request)
    {
        return $this->manageItem->updateUnit($request);
    }
    
    public function deleteItemImage(Request $request)
    {
        return $this->manageItem->deleteItemImage($request);
    }
    
    public function deleteFacility(Request $request)
    {
        return $this->manageItem->deleteFacility($request);
    }
    
    public function deleteAmenity(Request $request)
    {
        return $this->manageItem->deleteAmenity($request);
    }
    
    public function checkOrders(Request $request)
    {
        try {
            return $this->manageItem->checkOrders($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function markOrderChecked(Request $request)
    {
        return $this->manageItem->markOrderChecked($request);
    }

}