<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\User;
use App\Rol;
use Session;
use DB;
class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = user::all();
        $rols=rol::all();       
        $user = Session::get('user');
        
        return view('usuarios')->with(['usuarios'=>$users,'roles'=>$rols,'user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $this->validate($request,[
        'nombre'=> 'required|max:10',
        'apellido'=> 'required|max:10',
        'email'=> 'required|max:30',
        'contraseña'=> 'required|max:10',
        'dni'=> 'required|max:10',
        'rol'=> 'required|max:10',
        ]);
        
        $result = DB::select('call pa_inserusers(?,?,?,?,?,?)', array($request->nombre,$request->apellido,$request->email,$request->contraseña,$request->dni,$request->rol));
        
        if($result == null){
            return redirect::back()->with('msj','Creado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo crear');
        }
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
    public function destroy($id)
    {
        $user = user::find($id);
        if($user == null){
            return redirect::back()->with('msjError','No existe el periodo');
        }
        
        $result = DB::select('call pa_deleteuser(?)', array($id));
        
        if($result == null){
            return redirect::back()->with('msj','Eliminado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo eliminar');
        }
    }
    
}
    