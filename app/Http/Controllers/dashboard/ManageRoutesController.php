<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Classes\Services\Dashboard\ManageRoutesService;
use Illuminate\Http\Request;
use App\User;
use App\Models\Routes;
use Auth;
use Validator;
use Image;
use Exception;

class ManageRoutesController extends Controller
{
    protected $manageRoute;

    public function __construct(ManageRoutesService $manageRoute)
    {
        $this->manageRoute = $manageRoute;
    }

    public function index()
    {
        try {
            $viewRoutes = $this->manageRoute->indexView();
            return $viewRoutes;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
    
    public function routesDataTable(Request $request)
    {
        try {
            return $this->manageRoute->routesDataTable($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addRouteForm(Request $request)
    {
        try {
            return $this->manageRoute->addRouteForm($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addRoute(Request $request)
    {
        \Log::info('add route');
       return $this->manageRoute->addRoute($request);
    }

    public function addRouteImageForm(Request $request)
    {
        try {
            return $this->manageRoute->addRouteImageForm($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function addRouteImage(Request $request)
    {
       return $this->manageRoute->addRouteImage($request);
    }

    public function updateRouteForm(Request $request)
    {
        try {
            return $this->manageRoute->updateRouteForm($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function updateRoute(Request $request)
    {
        try {
            return $this->manageRoute->updateRoute($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function deleteRouteForm(Request $request)
    {
        try {
            return $this->manageRoute->deleteRouteForm($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function deleteRoute(Request $request)
    {
        try {
            return $this->manageRoute->deleteRoute($request);
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}