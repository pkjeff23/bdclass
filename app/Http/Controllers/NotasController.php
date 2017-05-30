<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\curso;
use App\nota;
use App\grado;
use App\User;
use App\estudiante;
use App\profesor;
use App\periodo;
use Session;
use DB;
class NotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::has('user')){
            $user = Session::get('user');
            $profesor = profesor::where('user_id',$user->id)->first();
            
            $cursos = curso::where("docente_id",$profesor->id)->get();
            return view('misestudiantes')->with(['cursos'=>$cursos,'user'=>$user]);
        }else{
            return view('auth.login');
        }
        
    }
    
    public function nueva($id){
        $curso = curso::find($id);
        
        if($curso == null){
            return redirect::back()->with('msjError','Curso no existe');
        }
        
        $estudiantes = estudiante::where('grados_id',$curso->grado_id)->get();
        $user = Session::get('user');
        $periodos = periodo::all();
        
        return view('ingresarnotas')->with(['user'=>$user, 'estudiantes'=>$estudiantes, 'curso'=>$curso,'periodos'=>$periodos]);
    }
    
    public function guardarNotas($id, Request $request){
        $curso = curso::find($id);
        
        if($curso == null){
            return redirect::back()->with('msjError','Curso no existe');
        }
        
        $notas = collect($request->notas);
        $estudiantes = collect($request->estudiantes);
        
        foreach($estudiantes as $e){
            $result = DB::select('call pa_insernotas(?,?,?,?)', array($id,$e,$request->periodo,$notas->shift()));
        }
        if($result == null){
            return redirect('/Lista')->with('msj','Notas creadas');
        }else{
            return redirect('/Lista')->with('msjError','No se pudo crear');
        }
    }
}
