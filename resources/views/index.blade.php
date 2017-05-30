@extends('layouts.main')

@section('contenido')
    <div class="row">
        <h1 class="page-header text-center text-primary">Bienvenido {{$user->name}}</h1>
    </div>
    
    @if($user->rol_id == 1)
        <p>Hola, Admin.</p>
    @elseif($user->rol_id == 2)
        <p>Hola, profesor en este módulo podrás ver tus cursos y asignar notas a tus alumnos.</p>
    @elseif($user->rol_id == 3)
        <p>Hola, estudiante en este módulo podrás ver tus cursos y notas.</p>    
    @endif
    
@endsection
