<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
       $validatedData= $request->validate([
       'name'=>'required|max:10',
       'email'=>'required|email|unique:users',
       'password'=>'required'
       ]);
       $validetedDta['password']=bcrypt($validatedData['password']);
       $user=User::create($validatedData);
       return response()->json(['user'=>$user]);
    }
    public function login(Request $request){
     $user=User::where('email',$request->email)->first();
     if(!$user){
      return response(['message'=>'user not found']);
     }
     if(!Hash::check($request->password,$user->password)){
        return response(['message'=>'password is not correct']);
     }
     $user->tokens()->delete();
     return response([
     'status'=>'success' ,
     'message'=>'user logged in successfully',
     'name'=>$user->name,
     'token'=>$user->createtoken('auth_token')->plainTextToken
    ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
      'status'=>'success',
      'message'=>'user logged out successfull',
    ]);
    }
}
