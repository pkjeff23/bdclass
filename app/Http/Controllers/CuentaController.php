<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\curso;
use App\User;
use Session;
use DB;
class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users =User::all();
        $user = Session::get('user');
        
        return view('cuenta')->with(['usuarios'=>$users,'user'=>$user]);
    }

public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nombre'=> 'required|max:255',
            'apellido'=> 'required|max:255',
            'email'=> 'required|max:30',
            'dni'=> 'required|max:10',
        ]);
        
        $user = user::find($id);
        if($user == null){
            return redirect::back()->with('msjError','No existe el periodo');
        }
        
        $result = DB::select('call pa_updateusers(?,?,?,?,?)', array($id,$request->nombre,$request->apellido,$request->email,$request->dni));
        
        if($result == null){
            return redirect::back()->with('msj','Editado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo editar');
        }
    }
}