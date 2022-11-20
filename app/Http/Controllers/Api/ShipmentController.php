<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipment;


class ShipmentController extends Controller
{
    //
    public function get_shipment()
    {
        $task=Shipment::all();
        if(count($task)>0)
        {
            return $response['data'] = $task;
            return response($response, 200)->header('Content-Type', 'application/json');
        }
        else{
        return response()->json(['message' => 'Shipment not Founded' , 'code'=>404], 404);
          

        }
    }

}
