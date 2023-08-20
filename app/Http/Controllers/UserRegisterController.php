<?php

namespace App\Http\Controllers;
use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserRegisterController extends Controller
{
    public function index(){
        return view('register');
    }
    public function userStore(Request $request){
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'age'=>'required|numeric',
                'password' => 'required|confirmed|string|min:6',
                'password_confirmation'=>'required'
            ]);
            if ($validator->fails()) {
                return response(['error' => $validator->errors(),'success' =>false],422);
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            if($user){
                $credentials = $request->only('email', 'password');
         
                if (Auth::attempt($credentials)) {
                    $user = Auth::user();
                    return response()->json([
                        'message' => 'User created successfully',
                        'success' =>true
                    ]);
                }
            }
            }
            catch (Throwable $e) {
                Log::error($e->getMessage());
                return response()->json([
                    'message' => $e->getMessage(),
                    'success' =>false
                ], 500);
            }
    }
    
    public function userLogOut(Request $request){ 

        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
        return response()->json([
            'message' => 'User logout successfully',
            'success' =>true
        ]);
    }
}
