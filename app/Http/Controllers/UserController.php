<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function store(Request $request): object
    {
        $user = User::where('email', $request['email'])->first();

        if ($user) {
            return response()->json([
                'status' => 1,
                'message' => 'Email Already Exists',
                'code' => 409
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'status' => 1,
            'message' => 'User Registered Successfully',
            'code' => 200
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (!JWTAuth::attempt($credentials)) {
                $response['status'] = 0;
                $response['data'] = null;
                $response['code'] = 401;
                $response['message'] = 'Email or password incorrect';

            }
        } catch (JWTException $e) {
            $response['data'] = null;
            $response['code'] = 500;
            $response['message'] = 'Could not create Token';
        }
        $user = auth()->user();
        $data['token']=auth()->claims([
            'user_id'=>$user->id,
            'email'=>$user->email
        ])->attempt($credentials);

        $response['data'] = $data;
        $response['status'] = 1;
        $response['code'] = 200;
        $response['message'] = 'Login Successfully';
        return $response()->json($response);
    }
}
