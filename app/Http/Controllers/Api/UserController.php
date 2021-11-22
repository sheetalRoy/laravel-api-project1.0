<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\UserAddress;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public function login(Request $request){
        $name = $request->name;
        $password = $request->password;
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'password' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        // $user = User::where(['name' => $name, 'password' =>$password])->first();
        $user = User::where(['name' => $name])->first();
        if($user){
            return [
              'data' => $user,  
              'message' => 'Register successfully',
              'success' => true,
              'status' => 200
            ];
        }else{
            return [
                'message' => 'User not found',
                'success' => false,
                'status' => 401
            ];
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'password' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
    //   $user = User::create([
    //     'name' => $request->name,
    //     'email' => $request->email,
    //     'password' => bcrypt($request->password),
    //   ]);
    //   $addressObj = UserAddress::create([
    //       'address' => $request->address,
    //       'pin' => $request->pin,
    //       'user_id' => $user
    //   ]);
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->save();
    //   $inp = json_decode($area, true);
      $addressObj = new UserAddress;
      $addressObj->address = json_encode($request->address);
      $addressObj->pin = $request->pin;
    //   $addressObj->user_id = $user;
      $addressObj->user_id = $user->id;
      $addressObj->save();
      if($user){
          return [
              'message' => 'Register successfully',
              'success' => true,
              'status' => 200
          ];
      }else{
        return [
            'success' => false,
            'status' => 402
        ];
      }
    }
    public function getUsers(){
        // $data = UserAddress::find(1);
        $data = User::select('users.name', 'user_addresses.address')
        ->join('user_addresses', 'users.id', '=', 'user_addresses.user_id')
        ->get();
        return [
            'data' => $data,
            'status' => 200,
            'statusText' => 'ok'
        ];
    }
}
