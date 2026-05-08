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
use App\Models\RoutesTerminal;
// use App\Models\ItemImages;
use Image;
use Exception;
use Auth;
use Mail;

class ManageRoutesService
{
    public function indexView()
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            return view('management.manage_routes', [
                'dateTime' => $dTime,
                'user' => $logData
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function routesDataTable($request)
    {
        try {
            $routes = DB::table('routes_terminal')->get();
            $results = datatables()->of($routes);
                return $results
                    ->addColumn('action', function ($data) {
                        $action = '<a href="/update_route_form/'. $data->route_id_no .'" style="text-decoration:none;">
                        <button class="btn btn-warning btn-xs" type="button"
                            data-r-id="'. $data->id .'"
                                data-route-id-no="'. $data->route_id_no .'">
                            <i class="fa fa-eye"></i> View
                        </button>
                    </a>
                    <a href="/delete_route_form/'. $data->route_id_no .'" style="text-decoration:none;">
                            <button class="btn btn-danger btn-xs" type="button"
                                data-e-id="'. $data->id .'"
                                data-route-id-no="'. $data->route_id_no .'">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </a>';
                return $action;
            })
            ->make();
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    public function addRouteForm(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            return view('management.add_route_component', [
                'dateTime' => $dTime,
                'user' => $logData
            ]);
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function addRoute(Request $request)
    {
        $request->validate([
            'route_name' => 'required',
            'terminal' => 'required',
            'terminal_address' => 'required',
            'direction' => 'required',
            'province' => 'required'
        ]);

        $routes = new RoutesTerminal;

        $routes->route_id_no = mt_rand(100000, 999999);
        $routes->route_name = $request->route_name;
        $routes->terminal = $request->terminal;
        $routes->terminal_address = $request->terminal_address;
        $routes->direction = $request->direction;
        $routes->province = $request->province;
        $routes->status = 'Active';
        $saved = $routes->save();
        
        if ($saved) {               
            return back()->with('add_route_success', 'A new route was added successfully');
        } else {
            return back()->with('add_route_failed', 'Something went wrong adding new route');
        }
       
    }

    public function updateRouteForm(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            $routes = RoutesTerminal::where('route_id_no', '=', $request->rIdNo)->first();
    
            return view('management.update_route_component', [
                'dateTime' => $dTime,
                'user' => $logData,
                'routes' => $routes
            ]);
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function updateRoute($request)
    {  
        $request->validate([
            'route_name' => 'required',
            'terminal' => 'required',
            'terminal_address' => 'required',
            'direction' => 'required',
            'province' => 'required'
        ]);

        $updateRoutes = RoutesTerminal::where('id', $request->id)->first();
        if (!empty($updateRoutes)) {
        $updateRoutes->route_name = $request->route_name;
        $updateRoutes->terminal = $request->terminal;
        $updateRoutes->terminal_address = $request->terminal_address;
        $updateRoutes->direction = $request->direction;
        $updateRoutes->province = $request->province;
        $updateRoutes->status = $request->status;
        $updated = $updateRoutes->save();
        
            if ($updated) {               
                return back()->with('update_route_success', 'Route was updated successfully');
            } else {
                return back()->with('update_route_failed', 'Something went wrong updating the data');
            }

        }
    }

    public function deleteRouteForm(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Manila');
            $dTime = date('F j, Y');
            if (Session::has('login_id')){
                $logData = User::where('id', Session::get('login_id'))->first();
            }
            $dRoutes = RoutesTerminal::where('route_id_no', '=', $request->rIdNo)->first();
    
            return view('management.delete_route_component', [
                'dateTime' => $dTime,
                'user' => $logData,
                'dRoutes' => $dRoutes
            ]);
        } catch (Exception $e){
            return $e->getMessage(); 
        }
    }

    public function deleteRoute($request)
    {  
        $deletedRoutes = RoutesTerminal::find($request->id)->delete();
            return redirect()->route('manage_routes')->with('delete_route_success', 'Route was deleted');
    }
}
