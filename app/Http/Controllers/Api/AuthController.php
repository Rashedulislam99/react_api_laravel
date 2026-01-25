<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('api-token')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }








    public function login(Request $request)
    {

        // return response()->json([
        //     'message' =>$request->all()
        // ], 200);



        // $request->validate([
        //     'name' => 'required|string',
        //     'password' => 'required',
        // ]);

        if (!Auth::attempt($request->only('name', 'password'))) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        // $token = $user->createToken('mobile-app', ['read', 'create']);
        // $token = $user->createToken('admin-panel', ['read', 'create', 'update', 'delete', 'admin']);

        return response()->json([
            'token' => $token,
            'user' => $user,
            "success" =>1,
            "response" => "Login successful"
        ]);
    }

    public function logout(Request $request)
    {
        // $request->user()->tokens()->delete();
        // //   $request->user()->currentAccessToken()->delete();
        // return response()->json(['message' => "successfully logout"], 200);

        return response()->json([
        'auth_header' => $request->header('Authorization'),
        'user' => $request->user(),
    ]);
    }
}
