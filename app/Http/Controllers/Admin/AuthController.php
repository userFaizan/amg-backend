<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }  
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('adminpanel.drivers.registration');
    }
      
    public function customRegistration(Request $request)
    {  

        $request->validate(
            [
                'name'          => 'required',
                'password'      => 'required|min:5',
                'email'         => 'required|email|unique:users',
                'id_no'         => 'required',
                'phone_number'  => 'required',
                'lat'           => 'required',
                'lng'           => 'required',
                'l_expiry'      => 'required',
            ], 
            [
                'name.required'          => 'Name is required',
                'password.required'      => 'Password is required',
                'id_no.required'         => 'Id Number is required',
                'phone_number.required'  => 'Phone Number is required',
                'Latitude'               => 'Latitude is required',
                'Longitude'              => 'Longitude is required',
                'License Expiry'         => 'License Expiry is required', 
           ]
          );
    
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        return redirect('driverlist')->with('message', 'Driver Added Successfully!' );

    }

 
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
    public function index_driver()
    {
        $user = User::where('id', '!=', auth()->id())->get();
        return view('adminpanel.drivers.driverlist', compact('user'));
    }
    
    public function edit($id)
    {
        $user = User::find($id);
        return view('adminpanel.drivers.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $user = User:: find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->id_no = $request->id_no;
        $user->phone_number = $request->phone_number;
        $user->lat = $request->lat;
        $user->lng = $request->lng;
        $user->l_expiry = $request->l_expiry;
        $user->save(); 
        return redirect('driverlist')->with('message', 'Driver Updated Successfully!' );
      
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id)->delete();
        return redirect('/driverlist')->with('message', 'Driver Removed Successfully!.');
    }
}