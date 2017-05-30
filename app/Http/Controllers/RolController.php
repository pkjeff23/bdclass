<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Rol;
use Session;
use DB;
class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = rol::all();
        $user = Session::get('user');
        
        return view('roles')->with(['roles'=>$roles,'user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $this->validate($request,[
        'rol'=> 'required|max:10',
        ]);
        
        $result = DB::select('call pa_inserRols(?)', array($request->rol));
        
        if($result == null){
            return redirect::back()->with('msj','Creado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo crear');
        }
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'rol'=> 'required|max:10',
        ]);
        
        $rol = rol::find($id);
        if($rol == null){
            return redirect::back()->with('msjError','No existe el periodo');
        }
        
        $result = DB::select('call pa_updaterol(?,?)', array($id,$request->rol));
        
        if($result == null){
            return redirect::back()->with('msj','Editado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo editar');
        }
    }
    public function destroy($id)
    {
        $rol = rol::find($id);
        if($rol == null){
            return redirect::back()->with('msjError','No existe el periodo');
        }
        
        $result = DB::select('call pa_deleterol(?)', array($id));
        
        if($result == null){
            return redirect::back()->with('msj','Eliminado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo eliminar');
        }
    }
    
}
    