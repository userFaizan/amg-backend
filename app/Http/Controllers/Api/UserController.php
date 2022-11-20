<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function get_user()
    {
        $user = User::where('id', auth()->id())->first();

        if ($user) {
            return response()->json([
                'data' => $user,
                'message' => 'User Found',
                'code' => 200
            ]);
        } else {
            return response()->json(['message' => 'No User found', 'code' => 404], 404);
        }
    }
}
