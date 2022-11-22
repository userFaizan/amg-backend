<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Validator;

class TaskController extends Controller
{
  public function tasklist(Request $request)
  {
    $task = Task::all();
    return view('adminpanel.Task.tasklist',compact('task'));
  }  
}