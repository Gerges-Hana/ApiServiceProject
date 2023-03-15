<?php

namespace App\Http\Controllers;

use App\Models\DeliveryGuy;
use Illuminate\Http\Request;

/**
 * Delivery staff web controller
 */
class DeliveryController extends Controller
{
    public function index()
    {
        $deliveryGuys = DeliveryGuy::all();
        // dd($deliveryGuys);
        $count = 0;
        return view('delivery-staff', ['delvieryGuys' => $deliveryGuys, 'count' => $count]);
    }

    public function deliveryGuysBusy()
    {
        $count = 0;
        $deliveryGuys = DeliveryGuy::where('status', 'busy')->get();

        return view('delivery-staff', ['delvieryGuys' => $deliveryGuys , 'count' => $count]);
    }

    public function deliveryGuysFree()
    {
        $deliveryGuys = DeliveryGuy::where('status', 'free')->get();
        $count = 0;
        return view('delivery-staff', ['delvieryGuys' => $deliveryGuys , 'count' => $count]);
    }

    public function getDelivery($id)
    {
        DeliveryGuy::all()->where('companyId', $id);

    }

    public function deliverySearch(Request $request)
    {

        $search = $request['query'] ?? "";

        if ($search != "") {
            $deliveryGuys = DeliveryGuy::where('name', 'LIKE', "%$search%")->orwhere('id', 'LIKE', "%$search%")->get();

        } else {
            $deliveryGuys = DeliveryGuy::all();
        }
        return view('delivery-staff', ['delvieryGuys' => $deliveryGuys]);
    }
    public function deliverySearchByCompanyName(Request $request)
    {
        $count=0;
        $delivery = new DeliveryGuy();
        return view('delivery-staff', ['delvieryGuys' => SearchController::searchWithCompanyName($request, $delivery),'count'=>$count]);
    }
}
