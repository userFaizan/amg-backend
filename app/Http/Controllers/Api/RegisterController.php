<?php
   
namespace App\Http\Controllers\Api;
   
use Illuminate\Http\Request;
use Laravel\Passport\Passport;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use App\Mail\otpmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

use Validator;
   
class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    { 
        $this->validate($request, [
        'name' => 'required|min:4',
        'email' => 'required|unique:users,email,$id',
        'password' => 'required|min:8',
        // 'password_confirmation'=>'required_with:password|same:password|min:8',
    ]);

    $user = User::where('email',$request->email)->first();
    if(!$user){
        if($request->password ){
            $request['password'] = Hash::make($request->password);
            $user =User::create($request->except([]));
            $user->save();
            if($user){
                $token = $user->createToken('Laravel Password Grant User')->accessToken;
                return response()->json([
                    'user' => $user,
                    'token' => $token,
                   
                ]);
            }
        }else{
            return response()->json(['message' => 'invalid Email Address' , 'code'=>404], 404);
           
        }
    }else{
        return response()->json(['message' => 'invalid Email Address' , 'code'=>404], 404);
       
    }
   
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
       
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $user = User::where('email',$request->email)->first();
        if($user){
            if (Hash::check($request->password, $user->password)){
                $token = $user->createToken('laravel grant user')->accessToken;
                
                return response()->json([
                    'user' => $user,
                    'token' => $token,
                ]);
            }else{
                return response()->json([
                    'message'=> 'password missmatch'
                 ],403);
            }
        }else{
                return response()->json(['message' => 'user doesnt exist' , 'code'=>404], 404);
           
        }
    }

    public function reset_password(Request $request)
    {   
        $request->validate([
            'password'=>'required|min:8',
            'password_confirmation'=>'required',
         ]);
         if ($request->password == $request->password_confirmation){
            Auth::user()->update(['password'=>Hash::make($request->password)]);
            return response()->json([
               'message' => 'password reset successfully',
                'code'=>200
            ]);
        }else{

            return response()->json(['message' => 'your confirm password does not match with your password' , 'code'=>404], 404);

        }
         
         }
        

         public function forgot_password(Request $request)
         {
             $request->validate([
                 'email' => 'required|email',
             ]);
             if(User::where('email',$request->email)->doesntExist()){
                return response()->json(['message' => 'invalid Email Address' , 'code'=>404], 404);
             }else{
                 $otp = rand(1111,9999);
                 $user=User::where('email', $request->email)->first();
                 $user->update(['otp' => $otp]);
                 
                 Mail::to($request->email)->send(new otpmail($otp));
                     return response()->json([
                     "message"=>"OTP send Successfully",
                     "code"=>200
                 ]);
             }
         }
    
        public function logout()
        {
            auth()->user()->token()->revoke();
            return response()->json([
                'message'=>'successfully logout',
                'code'=>200,

            ]);
        }

        public function match_otp(Request $request)
        {
            $user=User::where('email', $request->email)->first();
            //dd($user);
            
            if($user)
            {
                if(date('Y-m-d H:i:s',strtotime('+2 minutes',strtotime($user->updated_at))) >= date("Y-m-d H:i:s") ){
                    
                    if($user->otp == $request->otp)
                    {
                        $token=$user->createToken('LaravelAuthApp')->accessToken;
                      

                        return response()->json([
                            "user"=>$user,
                            "token"=>$token,
                            "message"=>"Match Otp Successfully!",
                            'code' => 200

                            
    
                        ]);
                    } else{
                return response()->json(['message' => 'otp miss match' , 'code'=>404], 404);
                       
    
                    }
                } else{
                return response()->json(['message' => 'otp expire' , 'code'=>404], 404);
                }
            }else{
                return response()->json(['message' => 'invalid user' , 'code'=>404], 404);
            
              
    
            }
        }

        public function update_password(Request $request){

            $request->validate([
               'new_password'=>'required|min:8',
            ]);
            if(Hash::check($request->old_password , auth()->user()->password)){
                //dd($request->old_password);
                if ($request->new_password == $request->confirm_password){
                    Auth::user()->update(['password'=>Hash::make($request->new_password)]);
                    return response()->json([
                       'message' => 'password has been updated',
                        'code'=>200
                    ]);
                }else{
            return response()->json(['message' => 'your confirm password does not match with your new password' , 'code'=>404], 404);

                }
            }else{
           
            return response()->json(['message' => 'your old password does not match' , 'code'=>404], 404);

            }
        }

}