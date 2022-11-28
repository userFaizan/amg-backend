<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;


class TasController extends Controller
{
    //

    public function store(Request $request)
    {
        $request['driver_id'] = Auth()->id();
        $data = Task::create($request->all());
        if ($data) {
            return response()->json([
                'message' => 'Task saved successfully',
                'code' => 200
            ]);
        } else {
            return response()->json(['message' => 'Task did not added', 'code' => 404], 404);
        }
    }

    //Get All Tasks

    public function get_alltask()
    {
        $task = Task::with('shipment')->get();
        if ($task) {
            return $response['data'] = $task;
            return response($response, 200)->header('Content-Type', 'application/json');
        } else {
            return response()->json(['message' => 'No task found', 'code' => 404], 404);
        }
    }


    //get shipment status wise
    public function get_status(Request $request)
    {
        $task = Task::with('shipment')->where('shipment_status', $request->shipment_status)->where('driver_id', Auth()->id())->get();
        if (count($task) > 0) {
            return $response['data'] = $task;
            return response($response, 200)->header('Content-Type', 'application/json');
        } else {
            return response()->json(['message' => 'No task found', 'code' => 404], 404);
        }
    }


    public function get_authtask()
    {
        $task = Task::with('shipment')->where('driver_id', Auth()->id())->get();
        if (count($task) > 0) {
            return $response['data'] = $task;
            return response($response, 200)->header('Content-Type', 'application/json');
        } else {
            return response()->json(['message' => 'No task found', 'code' => 404], 404);
        }
    }

    public function allupdate(Request $request)
    {
        // $data = Task::where('id', $request->id)->first();
        $task = Task::where('id',$request->id)->first();
        if ($task) {
        $task->update($request->all());
     
            
                return response()->json([
                    'message' => 'Record updated successfully ',
                    'code' => 200,
                ]);
             
            } else {
                return response()->json(['message' => 'No Task found', 'code' => 404], 404);
            }
        } 

    //update status

    public function statusupdate(Request $request)
    {
        $data = Task::where('id', $request->id)->first();


        if ($data != "" || $data != NULL) {
            if ($request->shipment_status != "" || $request->shipment_status != NULL) {

                $data->update(['shipment_status' => $request->shipment_status]);
            }
            return response()->json([
                'message' => 'Record updated successfully ',
                'code' => 200,
            ]);
        } else {
            return response()->json(['message' => 'No record found to update against given id', 'code' => 404], 404);
        }
    }

    public function change_task_status(Request $request)
    {
        $data = Task::findOrFail($request->id);
        $data->change_task_status = $request->change_task_status;
        $data->save();
       
        if($request->change_task_status == 5)
        {
            Task::where('id',$request->id)->update(  ['shipment_status' => 3] );

        }
         if($data){
            return response()->json([
                'message' => 'Task Status updated successfully ',
                'code' => 200,
            ]);
        }else {
            return response()->json(['message' => 'No record found to update against given id', 'code' => 404], 404);
        }
    }
}
