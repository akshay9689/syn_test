<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Session;
use Hash;

class AdminController extends Controller
{
    public function register(Request $request)
    {
    
        $validator = Validator::make( $request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'password' => 'required|min:5',
                'email' => 'required|email|unique:users',
                'user_type' => 'required',
            ],
            [
                'first_name.required' => 'First Name field is required.',
                'last_name.required' => 'Last Name field is required.',
                'password.required' => 'Password field is required. with Minimum 5 characters',
                'email.required' => 'Email field is required.',
                'email.email' => 'Email field must be email address.',
                'user_type.required' => 'User Type field is required.',
            ] );
            
            if ( $validator->fails() ) {
            return response()->json( [ 'errors' => $validator->errors() ] );
            }
            
            $user = new User( [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'password' => $request->input('password'),
            'email' => $request->input('email'),
            'user_type' => $request->input('user_type'),
            
            ] );
            $user->save();
            return response()->json( [ 'success' => 'registered successfully!' ] );
    }


    public function login(Request $request)
    {
    
        $validator = Validator::make( $request->all(), [
                
                'password' => 'required|min:5',
                'email' => 'required|email',
                
            ],
            [
                
                'password.required' => 'Password field is required. with Minimum 5 characters',
                'email.required' => 'Email field is required.',
                'email.email' => 'Email field must be email address.',
                
            ] );
            
            if ( $validator->fails() ) {
            return response()->json( [ 'errors' => $validator->errors() ] );
            }
            
            $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return response()->json( [ 'suc' => 'Login success' ] );
        }
            return response()->json( [ 'err' => 'Invalid Details' ] );
    }


    public function dashboard()
    {
        if(Auth::check()){
            $sdata = '';
            $data = User::where('user_type','dealer')->orderBy('id', 'desc')->paginate(2);
            return view('dashboard', compact('data', 'sdata'));
        }
        
        return redirect("/")->withSuccess('Opps! You do not have access');
    }

    public function search(Request $req){

       
        $text = $req->q;

      
       $sdata = $text;
       $data = DB::table('users')->where('zip', 'LIKE', "%$text%")->orderBy('id', 'desc')->paginate(2);
        $data->appends(['text'=> $text]);
       //dd($data);
           
       return view('dashboard', compact('data', 'sdata'));

      
    
    }


    public function edit(Request $req,  $id){

        $usertype = Auth::user()->user_type;

        if($usertype == 'employee'){
       
        $data = User::find($id);
        return view('edit', compact('data'));

        }

        else {
            return redirect()->back();
        }


    }




    public function logout()
    {
        Session::flush();
        Auth::logout();
  
        return Redirect('/');
    }


    public function address(Request $request)
    {
    
        $validator = Validator::make( $request->all(), [
                'state' => 'required|min:5',
                'city' => 'required|min:3',
                'zip' => 'required|numeric|min:5',
                
            ],
            [
                'state.required' => 'State field is required.',
                'city.required' => 'City field is required.',
                'password.required' => 'Password field is required. with Minimum 5 characters',
                'zip.required' => 'Zip field is required.',
                'zip.numeric' => 'Zip must be numberic',
                
            ] );
            
            if ( $validator->fails() ) {
            return response()->json( [ 'errors' => $validator->errors() ] );
            }
            
            $user = User::find($request->input('id'));
            $user->state = $request->input('state');
            $user->city = $request->input('city');
            $user->zip = $request->input('zip');
            
            $user->save();
            return response()->json( [ 'success' => 'successfully Updated!' ] );
    }

}
