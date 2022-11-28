<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Delivery;
use App\Models\Delivery_Image;
use Illuminate\Support\Facades\Storage;


class DeliveryController extends Controller
{
    //

    public function store_delivery(Request $request)
    {
        $this->validate($request, [
               'description' => 'required',
               'signature_img'=> 'required',
               'files' => 'required'
        ]);
        log::info($request);
        $image= Storage::disk('public')->put('public/product/tasksign', $request->signature_img);
        $product = Delivery::create([
            $request->except('files'),
            'description' => $request->description,
            'signature_img' =>$image
        ]);
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $file_name = $file->store('public/product/image');

                Delivery_Image::create(['delivery_id' => $product->id, 'image' => str_replace("public/", "", $file_name)]);
            }
        }
   

        if ($product) {
            return response()->json([
                'message' => 'Delivery Added successfully',
                'code' => 200

            ]);
        } else {
            return response()->json(['message' => 'Product Not Added', 'code' => 404], 404);
        }
    }

    public function get_delivery()
    {
        $expense = Delivery::with('images')->get();
        if (count($expense) > 0) {
            return $response['data'] = $expense;
            return response($response, 200)->header('Content-Type', 'application/json');
        } else {
            return response()->json(['message' => 'No expense found', 'code' => 404], 404);
        }
    }
}
