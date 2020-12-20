<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $input['password'] = bcrypt($input['password']);
        User::create([
            "email" => $input["email"],
            "password" => $input["password"]]);
        return response()->json(['success' => 200]);

    }
}
