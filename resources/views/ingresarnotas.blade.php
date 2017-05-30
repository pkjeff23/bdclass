@extends('layouts.main')

@section('contenido')
    <div class="row">
        <h1 class="page-header text-center text-primary">Ingresar notas de {{$curso->materia->nombre}} del grado {{$curso->grado->nombre}}</h1>
    </div>
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            @if ($estudiantes->count()>0)
            <form role="form" method="POST" action="{{url('/GuardarNotas/'.$curso->id)}}">
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-md-8 form-inline">
                        <label for="periodo">Seleccione el periodo:</label>
                        <select name="periodo" id="periodo" class="form-control">
                            @foreach ($periodos as $p)
                                <option value="{{$p->id}}">{{$p->periodo}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                
                <table class="table">
                    <thead>
                        <th>Estudiante</th>
                        <th>Nota</th>
                    </thead>
                    <tbody>
                        @foreach($estudiantes as $n)
                        <tr>
                            <td>{{$n->usuario->name}} {{$n->usuario->lastname}}</td>
                            <td>
                                <input type="hidden" name="estudiantes[]" value="{{$n->id}}"/>
                                <input type="number" class="form-control" name="notas[]" placeholder="Nota del 1 al 5" max="5" min="1" required/>
                            </td>
                       </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <a href="/Lista" class="btn btn-default">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
            @else
                <h3>No hay estudiantes en este curso</h3>
                <a href="/Lista" class="btn btn-default">Regresar</a>
            @endif
        </div>
    </div>
@endsection