@extends('layouts.main')

@section('contenido')
    <div class="row">
        <h1 class="page-header text-center text-primary">Listado de Cursos</h1>
    </div>
    <div class="row col-md-offset-2" style="margin-bottom:1em;">
        <a href="" class="btn btn-default" data-toggle="modal" data-target="#crear">Crear</a>
    </div>
    
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Asignatura</th>
                        <th>Grado</th>
                        <th>Docente</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cursos as $r)
                    <tr>
                        <td class="col-md-3">{{$r->materia->nombre}}</td>
                        <td class="col-md-2">{{$r->grado->nombre}}</td>
                        <td class="col-md-5">{!!$r->profesor->usuario->name!!} {!!$r->profesor->usuario->lastname!!}</td>
                        <td class="col-md-2">
                            <button class="btn btn-link" title="Editar" data-target="#editar" data-toggle="modal" 
                            data-id="{{ $r->id }}" data-asignatura="{{ $r->asignatura_id }}" data-docente="{{$r->docente_id}}"
                            data-grado="{{$r->grado_id}}"><i class="fa fa-pencil" aria-hidden="true"> </i></button>
                            <button class="btn btn-link" title="Eliminar" data-target="#eliminar" data-toggle="modal" data-id="{{ $r->id }}"><i class="fa fa-trash" aria-hidden="true"> </i></button></td>
                        </tr>
                    @endforeach
                
                </tbody>
                
            </table>
        </div>
        
    </div>
    
    <div id="crear" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Crear Curso</h4>
          </div>
          <form role="form" method="POST" action="{{ url('Curso') }}">
              <div class="modal-body">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="curso"><span style="color:red;">* </span>Curso</label>
                    <select class="form-control" name="asignatura">
                      @foreach($asignaturas as $u)
                        <option value="{{$u->id}}">{{$u->nombre}}</option>
                      @endforeach
                    </select>
                    
                    <label for="Grado"><span style="color:red;">* </span>Grado</label>
                    <select class="form-control" name="Grado">
                      @foreach($grados as $u)
                        <option value="{{$u->id}}">{{$u->nombre}}</option>
                      @endforeach
                    </select>
                    
                    <label for="Docente"><span style="color:red;">* </span>Docente</label>
                    <select class="form-control" name="Docente">
                      @foreach($profesores as $c)
                        <option value="{{$c->id}}">{!!$c->usuario->name!!} {!!$c->usuario->lastname!!}</option>
                      @endforeach
                    </select>
                    
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
          </form>
        </div>
      </div>
    </div>
    
    <!-- Modal editar -->
    <div id="editar" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editar Curso</h4>
          </div>
          <form role="form" method="POST" id="formEdit">
              <div class="modal-body">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input hidden value="PUT" name="_method"/>
                    
                    <label for="curso"><span style="color:red;">* </span>Curso</label>
                    <select id="asignatura_id" class="form-control" name="asignatura">
                      @foreach($asignaturas as $u)
                        <option value="{{$u->id}}">{{$u->nombre}}</option>
                      @endforeach
                    </select>
                    
                    <label for="Grado"><span style="color:red;">* </span>Grado</label>
                    <select id="grado_id" class="form-control" name="Grado">
                      @foreach($grados as $u)
                        <option value="{{$u->id}}">{{$u->nombre}}</option>
                      @endforeach
                    </select>
                    
                    <label for="Docente"><span style="color:red;">* </span>Docente</label>
                    <select id="docente_id" class="form-control" name="Docente">
                      @foreach($profesores as $c)
                        <option value="{{$c->id}}">{!!$c->usuario->name!!} {!!$c->usuario->lastname!!}</option>
                      @endforeach
                    </select>
                    
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
          </form>
        </div>
      </div>
    </div>
    
    
    <!-- Modal eliminar -->
    <div id="eliminar" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Eliminar Curso</h4>
          </div>
          <form role="form" method="POST" id="formElim">
              <div class="modal-body">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input hidden value="DELETE" name="_method"/>
                    <p>¿Está seguro de eliminar este curso?</p>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger">Si</button>
              </div>
          </form>
        </div>
      </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">

  $(function() {
      $('#editar').on("show.bs.modal", function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var Id = button.data('id')
          var asignatura = button.data('asignatura')
          var Grado = button.data('grado')
          var Docente = button.data('docente')
          $("#asignatura_id").val(asignatura)
          $("#grado_id").val(Grado)
          $("#docente_id").val(Docente)

          var formAction ="/Curso/Editar/"+Id
          $('#formEdit').attr('action', formAction);
      });
  });

  $(function() {
      $('#eliminar').on("show.bs.modal", function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var Id = button.data('id')

          var formAction ="/Curso/Eliminar/"+Id
          $('#formElim').attr('action', formAction);
      });
  });
  
</script>

@endsection
