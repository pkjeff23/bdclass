<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\curso;
use App\nota;
use App\estudiante;
use Session;
use DB;
class MisAsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = curso::all();
        $user = Session::get('user');
        $estudiante = estudiante::where('user_id',$user->id)->first();
        $notas =nota::where('estudiante_id',$estudiante->id)->get();
        
        return view('misasignaturas')->with(['cursos'=>$cursos,'notas'=>$notas,'user'=>$user]);
    }
}
