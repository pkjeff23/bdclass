<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\grado;
use Session;
use DB;
class GradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grados = grado::all();
        $user = Session::get('user');
        
        return view('grados')->with(['grados'=>$grados,'user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $this->validate($request,[
        'grado'=> 'required|max:10',
        ]);
        
        $result = DB::select('call pa_insergrado(?)', array($request->grado));
        
        if($result == null){
            return redirect::back()->with('msj','Creado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo crear');
        }
    }

    
    public function update(Request $request, $id)
    {
               $this->validate($request,[
            'grado'=> 'required|max:10',
        ]);
        
        $grado = grado::find($id);
        if($grado == null){
            return redirect::back()->with('msjError','No existe el periodo');
        }
        
        $result = DB::select('call pa_updategrados(?,?)', array($id,$request->grado));
        
        if($result == null){
            return redirect::back()->with('msj','Editado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo editar');
        }
    }
    public function destroy($id)
    {
        $grado = grado::find($id);
        if($grado == null){
            return redirect::back()->with('msjError','No existe el periodo');
        }
        
        $result = DB::select('call pa_deletegrados(?)', array($id));
        
        if($result == null){
            return redirect::back()->with('msj','Eliminado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo eliminar');
        }
    }
    
    }
    