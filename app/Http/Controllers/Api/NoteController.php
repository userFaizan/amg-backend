<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\NotesRequest;
use Illuminate\Support\Facades\Log;
use App\Models\Note;
use App\Models\Note_Image;

class NoteController extends Controller
{
    public function store_notes(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'time' => 'required',
            'notes_title' => 'required',
            'files' => 'required'
        ]);
        log::info($request);

        $request['date'] = ucfirst($request->date);
        $request['time'] = ucfirst($request->time);
        $request['notes_title'] = ucfirst($request->notes_title);
        $request['task_id'] = ucfirst($request->task_id);
        $product = Note::create($request->except('files'));
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $file_name = $file->store('public/note/image');

                Note_Image::create(['notes_id' => $product->id, 'image' => str_replace("public/", "", $file_name)]);
            }
        }
        if ($product) {
            return response()->json([
                'message' => 'Notes Added successfully',
                'code' => 200

            ]);
        } else {
            return response()->json(['message' => 'Notes Not Added', 'code' => 404], 404);
        }
    }

    public function get_notes()
    {
        $expense = Note::with('images')->get();
        if (count($expense) > 0) {
            return $response['data'] = $expense;
            return response($response, 200)->header('Content-Type', 'application/json');
        } else {
            return response()->json(['message' => 'No Notes found', 'code' => 404], 404);
        }
    }
}
