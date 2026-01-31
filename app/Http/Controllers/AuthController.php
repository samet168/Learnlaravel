<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }
// login
    public function ProcessLogin(Request $request)        
    {
    //   dd($request->all());  
    $Validator =validator::make($request->all(),[
        'email'    => 'required|email',
        'password' => 'required'
    ]);

    // required មិនអាចមិនមានបានទេ
    if($Validator->passes()){
        $credentials=[
            'email'    => $request->email,
            'password' => $request->password
        ];
        // Auth =ប្រើបានតែជាមួយ user ទេ
        if(Auth::attempt($credentials)){
            return redirect()->route('product.index')->with('success', 'Login Successfully');
        }else{
            return redirect()->back()->with('error', 'Login Failed');
        }
    }else{
        return redirect()->back()->withInput()->withErrors($Validator);
    }
    }
// logout
    public function logout(){
        Auth::logout();
        //Auth::logout(); ប្រើសម្រាប់ logout
        return redirect()->route('auth.show.login')->with('success', 'Logout Successfully');
    }



    public function showRegister()
    {
        return view('register');
    }



    public function ProcessRegister(Request $request)
    {

        // dd($request->all());
        $Validator = Validator::make($request->all(), [
            'name'     => 'required|min:4|max:10',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:4|',
            'confirm_password' => 'required|same:password'
            // same ប្រៀបធៀបជាមួយ password
        ]);
        if ($Validator->passes()) {
            // passes()​ =true 
            // fails() = false

            $user = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            //hash password
            // $user->password = bcrypt($request->password);
           $user->password = Hash::make($request->password);

            $user->save();

            return redirect()->route('auth.show.login')->with('success', 'Register Successfully! Please Login');

        } else {
            

            return redirect()->back()->withInput()->withErrors($Validator);
            // dd($Validator->errors());
            

            
        }
    }

}   
