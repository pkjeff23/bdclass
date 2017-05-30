@extends('layouts.main')

@section('contenido')
    <div class="row">
        <h1 class="page-header text-center text-primary">Mis materias</h1>
    </div>
    <div class="row col-md-offset-3">
        
    </div>
    
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            @if ($cursos->count()>0)
            <table class="table">
                <thead>
                    <th>Materia</th>
                    <th>Grado</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($cursos as $n)
                    <tr>
                        <td>{{$n->materia->nombre}}</td>
                        <td>{{$n->grado->nombre}}</td>
                        <td>
                            <a href="{{url ('/NuevaNota/'.$n->id)}}" >Ingresar nota</a>
                        </td>
                   </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <h3>No tiene cursos inscriptos</h3>
            @endif
        </div>
        
    </div>
    

@endsection