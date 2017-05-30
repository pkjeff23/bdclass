<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect; //libreria que redirecciona a una pagina
use App\Http\Requests;
use App\periodo;
use Session;
use DB;

class PeriodoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodos = periodo::all();
        $user = Session::get('user');
        
        return view('periodo')->with(['periodos'=>$periodos,'user'=>$user]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'periodo'=> 'required|max:10',
        ]);
        
        $result = DB::select('call pa_insertarperiodo(?)', array($request->periodo));
        
        if($result == null){
            return redirect::back()->with('msj','Creado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo crear');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'periodo'=> 'required|max:10',
        ]);
        
        $periodo = periodo::find($id);
        if($periodo == null){
            return redirect::back()->with('msjError','No existe el periodo');
        }
        
        $result = DB::select('call pa_updateperiodos(?,?)', array($id,$request->periodo));
        
        if($result == null){
            return redirect::back()->with('msj','Editado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo editar');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periodo = periodo::find($id);
        if($periodo == null){
            return redirect::back()->with('msjError','No existe el periodo');
        }
        
        $result = DB::select('call pa_deleteperiodos(?)', array($id));
        
        if($result == null){
            return redirect::back()->with('msj','Eliminado éxitosamente');
        }else{
            return redirect::back()->with('msjError','No se pudo eliminar');
        }
    }
}
