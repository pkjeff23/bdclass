@extends('layouts.main')

@section('contenido')
    <div class="row">
        <h1 class="page-header text-center text-primary">Mis materias</h1>
    </div>
    <div class="row col-md-offset-3">
        
    </div>
    
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <table class="table">
                <thead>
                    <tr>
                        <th class="col-md-4">materia</th>
                        <th class="col-md-4">periodo1</th>
                        <th class="col-md-4">periodo2</th>
                        <th class="col-md-4">periodo3</th>   
                    </tr>
                        
                </thead>
                <tbody>
                    @foreach($notas as $n)
                    <tr>
                        <td class="col-md-4">{{$n->curso->materia->nombre}}</td>
                        <td class="col-md-4">
                        @if($n->periodo_id == 1)
                        {{$n->valoracion}}
                        @endif
                        </td>
                        <td class="col-md-4">
                        @if($n->periodo_id == 2)
                        {{$n->valoracion}}
                        @endif
                        </td>
                        <td class="col-md-4">
                        @if($n->periodo_id == 3)
                        {{$n->valoracion}}
                        @endif
                        </td>   
                   </tr>
                    @endforeach
                    
                
                </tbody>
                
            </table>
        </div>
        
    </div>
  
@endsection