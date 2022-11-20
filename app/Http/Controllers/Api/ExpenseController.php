<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\CreaetRequest;
use Illuminate\Support\Facades\Log;
use App\Models\Expense;
use App\Models\Expense_image;



class ExpenseController extends Controller
{
    //
    public function store_expense(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'time' => 'required',
            'expense_type' => 'required',
            'expense_bill' => 'required',
            'task_id' => 'required',
            'files' => 'required'
        ]);
        log::info($request);


        $request['date'] = ucfirst($request->date);
        $request['time'] = ucfirst($request->time);
        $request['expense_type'] = ucfirst($request->expense_type);
        $request['expense_bill'] = ucfirst($request->expense_bill);
        $request['task_id'] = ucfirst($request->task_id);
        $product = Expense::create($request->except('files'));
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $file_name = $file->store('public/product/images');

                Expense_image::create(['expense_id' => $product->id, 'image' => str_replace("public/", "", $file_name)]);
            }
        }
        if ($product) {
            return response()->json([
                'message' => 'Product Added successfully',
                'code' => 200

            ]);
        } else {
            return response()->json(['message' => 'Product Not Added', 'code' => 404], 404);
        }
    }

    public function get_expense()
    {
        $expense = Expense::with('images')->get();
        if (count($expense) > 0) {
            return $response['data'] = $expense;
            return response($response, 200)->header('Content-Type', 'application/json');
        } else {
            return response()->json(['message' => 'No expense found', 'code' => 404], 404);
        }
    }
}
