<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\profesor;
use App\User;
use Session;
use DB;
class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesores = profesor::all();
        $users=user::where('rol_id',2)->get();;       
        $user = Session::get('user');
        
        return view('profesores')->with(['profesores'=>$profesores,'usuarios'=>$users,'user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $this->validate($request,[
        'titulo'=> 'required|max:10',
        'nombre'=> 'required|max:10',
        ]);
        
        $result = DB::select('call pa_inserprofesor(?,?)', array($request->titulo,$request->nombre));
        
        if($result == null){
            return redirect::back()->with('msj','Creado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo crear');
        }
    }

    
    public function update(Request $request, $id)
    {
       $this->validate($request,[
            'titulo'=> 'required|max:10',
            'nombre'=> 'required|max:10',
        ]);
        
        $profesor = profesor::find($id);
        if($profesor == null){
            return redirect::back()->with('msjError','No existe el periodo');
        }
        
        $result = DB::select('call pa_updateprofesores(?,?,?)', array($id,$request->titulo,$request->nombre));
        
        if($result == null){
            return redirect::back()->with('msj','Editado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo editar');
        }
    }
    public function destroy($id)
    {
        $profesor = profesor::find($id);
        if($profesor == null){
            return redirect::back()->with('msjError','No existe el periodo');
        }
        
        $result = DB::select('call pa_deleteprofesores(?)', array($id));
        
        if($result == null){
            return redirect::back()->with('msj','Eliminado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo eliminar');
        }
    }
    
    }
    