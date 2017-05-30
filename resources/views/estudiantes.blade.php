@extends('layouts.main')

@section('contenido')
    <div class="row">
        <h1 class="page-header text-center text-primary">Listado de Estudiantes</h1>
    </div>
    <div class="row col-md-offset-3">
        <a href="" class="btn btn-default" data-toggle="modal" data-target="#crear">Crear</a>
    </div>
    
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <table class="table">
                <thead>
                    <tr>
                        <th>codigo</th>
                        <th>nombre</th>
                        <th>grado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($estudiantes as $r)
                    <tr>
                        <td>{{$r->codigo}}</td>
                        <td>{!!$r->usuario->name!!} {!!$r->usuario->lastname!!}</td>
                        <td>{{$r->grado->nombre}}</td>
                        <td>
                            <button class="btn btn-link" title="Editar" data-target="#editar" data-toggle="modal" data-id="{{ $r->id }}" data-codigo="{{ $r->codigo }}" data-nombre="{{ $r->user_id }}"  data-grado="{{$r->grados_id}}"><i class="fa fa-pencil" aria-hidden="true"> </i></button>
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
            <h4 class="modal-title">Crear Estudiante</h4>
          </div>
          <form role="form" method="POST" action="{{ url('Estudiante') }}">
              <div class="modal-body">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="estudiante"><span style="color:red;">* </span>Código</label>
                    <input type="text" class="form-control" name="codigo" placeholder="Ingrese el codigo" required>
                    @if ($errors->has('codigo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('codigo') }}</strong>
                    </span>
                    @endif
                    <label for="nombre"><span style="color:red;">* </span>Nombre</label>
                    <select class="form-control" name="nombre">
                    @foreach($usuarios as $u)
                    <option value="{{$u->id}}">{!!$u->name!!} {!!$u->lastname!!}</option>
                    @endforeach
                    </select>
                    @if ($errors->has('nombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                    @endif
                    <label for="grado"><span style="color:red;">* </span>Grado</label>
                    <select class="form-control" name="grado">
                    @foreach($grados as $g)
                    <option value="{{$g->id}}">{{$g->nombre}}</option>
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
            <h4 class="modal-title">Editar Estudiante</h4>
          </div>
          <form role="form" method="POST" id="formEdit">
              <div class="modal-body">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input hidden value="PUT" name="_method"/>
                    <label for="codigo"><span style="color:red;">* </span>Código</label>
                    <input id="codigo_edit" type="text" class="form-control" name="codigo" placeholder="Ingrese el codigo" required>
                    @if ($errors->has('codigo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('codigo') }}</strong>
                    </span>
                    @endif
                    <label for="nombre_edit"><span style="color:red;">* </span>Nombre</label>
                    <select id=nombre_edit class="form-control" name="nombre">
                    @foreach($usuarios as $u)
                    <option value="{{$u->id}}">{!!$u->name !!} {!!$u->lastname!!}</option>
                    @endforeach
                      @if ($errors->has('nombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                    @endif
                    </select>
                    
                    <label for="grado"><span style="color:red;">* </span>Grado</label>
                    <select id=grado_edit class="form-control" name="grado">
                    @foreach($grados as $g)
                    <option value="{{$g->id}}">{{$g->nombre}}</option>
                    @endforeach
                      @if ($errors->has('grado'))
                    <span class="help-block">
                        <strong>{{ $errors->first('grado') }}</strong>
                    </span>
                    @endif
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
            <h4 class="modal-title">Eliminar Estudiante</h4>
          </div>
          <form role="form" method="POST" id="formElim">
              <div class="modal-body">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input hidden value="DELETE" name="_method"/>
                    <p>¿Está seguro de eliminar este estudiante?</p>
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
          var codigo = button.data('codigo')
          var nombre = button.data('nombre')
          var grado = button.data('grado')
          $("#codigo_edit").val(codigo)
          $("#nombre_edit").val(nombre)
          $("#grado_edit").val(grado)

          var formAction ="/Estudiante/Editar/"+Id
          $('#formEdit').attr('action', formAction);
      });
  });

  $(function() {
      $('#eliminar').on("show.bs.modal", function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var Id = button.data('id')

          var formAction ="/Estudiante/Eliminar/"+Id
          $('#formElim').attr('action', formAction);
      });
  });
  
</script>

@endsection
