<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
use DB;
use App\User;
use Session;



use App\Http\Requests;

class frontcontroller extends Controller
{
    public function index(){
        if(Session::has('user')){
            $user = Session::get('user');
            return view('index')->with('user',$user);
        }else{
            return view('auth.login');
        }
        
    }
    public function login(Request $request){
        $user = DB::select('call pa_login(?,?)', array($request->email, $request->password));
        if($user == null){
            return view('auth.login')->with('msjError'.'Usuario no válido');
        }
        Session::put('user',$user[0]);
        
        return view('index')->with('user',$user[0]);
     
    }
    
    public function registro(){
        $rol = Rol::all();
        return view('auth.register')->with('rol',$rol);
    }
    
    public function sesiones(){
        if(Session::has('user'))
        Session::forget('user');
            return view('auth.login');
        
    }    
}
