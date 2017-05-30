<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\estudiante;
use App\grado;
use App\User;
use Session;
use DB;
class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiantes = estudiante::all();
        $grados=grado::all(); 
        $users=User::where('rol_id',3)->get();
        $user = Session::get('user');
        
        return view('estudiantes')->with(['estudiantes'=>$estudiantes,'grados'=>$grados,'usuarios'=>$users,'user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $this->validate($request,[
        'codigo'=> 'required|max:10',
        'nombre'=> 'required|max:10',
        'grado'=> 'required|max:10',
        ]);
        
        $result = DB::select('call pa_inserEstudiante(?,?,?)', array($request->codigo,$request->nombre,$request->grado));
        
        if($result == null){
            return redirect::back()->with('msj','Creado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo crear');
        }
    }

    
    public function update(Request $request, $id)
    {
               $this->validate($request,[
            'codigo'=> 'required|max:10',
            'nombre'=> 'required|max:10',
            'grado'=> 'required|max:10',
        ]);
        
        $estudiante = estudiante::find($id);
        if($estudiante == null){
            return redirect::back()->with('msjError','No existe el periodo');
        }
        
        $result = DB::select('call pa_updatestudiantes(?,?,?,?)', array($id,$request->codigo,$request->nombre,$request->grado));
        
        if($result == null){
            return redirect::back()->with('msj','Editado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo editar');
        }
    }
    public function destroy($id)
    {
        $estudiante = estudiante::find($id);
        if($estudiante == null){
            return redirect::back()->with('msjError','No existe el periodo');
        }
        
        $result = DB::select('call pa_deletestudiante (?)', array($id));
        
        if($result == null){
            return redirect::back()->with('msj','Eliminado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo eliminar');
        }
    }
    
    }
    