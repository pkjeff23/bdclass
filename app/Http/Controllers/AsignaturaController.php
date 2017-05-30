<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\asignatura;
use Session;
use DB;
class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asignaturas = asignatura::all();
        $user = Session::get('user');
        
        return view('asignaturas')->with(['asignaturas'=>$asignaturas,'user'=>$user]);
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
           'nombrecorto'=> 'required|max:10',
        ]);
        
        
        $result = DB::select('call pa_pa_inserasignatura(?,?)', array($request->nombre,$request->nombrecorto));
        
        if($result == null){
            return redirect::back()->with('msj','Creado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo crear');
        }
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nombre'=> 'required|max:10',
            'nombrecorto'=> 'required|max:10',
        ]);
        
        $asignatura = asignatura::find($id);
        if($asignatura == null){
            return redirect::back()->with('msjError','No existe la asignatura');
        }
        
        $result = DB::select('call pa_updateasignatura(?,?,?)', array($id,$request->nombre,$request->nombrecorto));
        
        if($result == null){
            return redirect::back()->with('msj','Editado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo editar');
        }
    }
    public function destroy($id)
    {
        $asignatura = asignatura::find($id);
        if($asignatura == null){
            return redirect::back()->with('msjError','No existe el periodo');
        }
        
        $result = DB::select('call pa_deleteasignaturas(?)', array($id));
        
        if($result == null){
            return redirect::back()->with('msj','Eliminado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo eliminar');
        }
    }
    
    }
    