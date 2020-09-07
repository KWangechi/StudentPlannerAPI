<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

use Tymon\JWTAuth\Facades\JWTAuth;
class AuthController extends Controller
{

    
    //function for registering student with a JWT Token
    public function register(Request $request){

        try{
        $user = User::create([
            
            
            'email' => $request->email,
            'password' => bcrypt($request->password),
            
        ]);

        return $this->login($request);
        $user->save();
        }

        catch(Exception $e)
        {
        return response()->json([
        'success' => false,
        'message' => ''.$e,
    
]);

        }
    }

    //function for authenticating the user using the same token
    public function login(Request $request){
        $info = $request->only('email', 'password');

        if(!$token =auth()->attempt($info)){
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            
            ]);
            
        }

        return response()->json([
            'success' => true,
            'message' => 'You have successfully logged in',
            'token' => $token,
            'user' => Auth::user()
            
        ]);

    }


    //function for logging out the authenticated user
    public function logout(Request $request){
        try{
                JWTAuth::invalidate(JWTAuth::parseToken($request->token));
                return response()->json([
                    'success' => true,
                    'message' => 'You have successfully logged out!'
                ]);
        }

        catch(Exception $exception){
return response()->json([
    'success' => false,
    'message' => ''.$e

]);

        }

    }
//THIS FUNCTION IS FOR SAVING NAME,CAMPUS,PHOTO,COURSE,YEAR OF STUDY AND INTERESTS
public function saveUserInfo(Request $request){

    $user = User::find(Auth::user()->id);
    $user->name= $request->name;
    $user->campus= $request->campus;
    $user->course= $request->course;
    $user->YOS= $request->YOS;
    $user->interests= $request->interests;
    $photo= '';
    //CHECK IF USER PROVIDED A PHOTO
    if($request->photo!=''){
        //USER TIME FOR PHOTO TO PREVENT NAME DUPLICATION
        $photo =time().'.jpg';
        //DECODE PHOTO STRING AND SAVE TO STORAGE/PROFILES
        file_put_contents('storage/profiles/'.$photo,base64_decode($request->photo));
        $user->photo=$photo;

    }
$user->update();
return response()->json([
    'success'=>true,
    'photo'=>$photo

]);
}

}
