<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\curso;
use App\asignatura;
use App\grado;
use App\profesor;
use App\User;
use Session;
use DB;
class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = curso::all();
        $asignaturas = asignatura::all();
        $grados = grado::all();
        $profesores = profesor::all();
        $user = Session::get('user');
        
        return view('cursos')->with(['cursos'=>$cursos,'asignaturas'=>$asignaturas,'grados'=>$grados,'profesores'=>$profesores,'user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $this->validate($request,[
        'asignatura'=> 'required|max:10',
        'Grado'=> 'required|max:10',
        'Docente'=> 'required|max:10',
        ]);
        
        $result = DB::select('call Pa_insercursos (?,?,?)', array($request->asignatura,$request->Grado,$request->Docente));
        
        if($result == null){
            return redirect::back()->with('msj','Creado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo crear');
        }
    }

    
    public function update(Request $request, $id)
    {
       $this->validate($request,[
            'asignatura'=> 'required|max:10',
            'Grado'=> 'required|max:10',
            'Docente'=> 'required|max:10',
        ]);
        
        $curso = curso::find($id);
        if($curso == null){
            return redirect::back()->with('msjError','No existe el periodo');
        }
        
        $result = DB::select('call pa_updatecursos(?,?,?,?)', array($id,$request->asignatura,$request->Grado,$request->Docente));
        
        if($result == null){
            return redirect::back()->with('msj','Editado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo editar');
        }
    }
    public function destroy($id)
    {
        $curso = curso::find($id);
        if($curso == null){
            return redirect::back()->with('msjError','No existe el periodo');
        }
        
        $result = DB::select('call pa_deletecursos (?)', array($id));
        
        if($result == null){
            return redirect::back()->with('msj','Eliminado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo eliminar');
        }
    }
    
    }
    