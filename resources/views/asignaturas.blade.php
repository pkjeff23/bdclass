@extends('layouts.main')

@section('contenido')
    <div class="row">
        <h1 class="page-header text-center text-primary">Listado de Asignaturas</h1>
    </div>
    <div class="row col-md-offset-2">
        <a href="" class="btn btn-default" data-toggle="modal" data-target="#crear">Crear</a>
    </div>
    
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Asignatura</th>
                        <th>Nombre Corto</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($asignaturas as $a)
                    <tr>
                        <td class="col-md-6">{{$a->nombre}}</td>
                        <td class="col-md-4">{{$a->nombre_corto}}</td>
                        <td class="col-md-2">
                            <button class="btn btn-link" title="Editar" data-target="#editar" data-toggle="modal" data-id="{{ $a->id }}" data-nombre="{{ $a->nombre }}" data-nombrecorto="{{ $a->nombre_corto }}"><i class="fa fa-pencil" aria-hidden="true"> </i></button>
                            <button class="btn btn-link" title="Eliminar" data-target="#eliminar" data-toggle="modal" data-id="{{ $a->id }}"><i class="fa fa-trash" aria-hidden="true"> </i></button></td>
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
            <h4 class="modal-title">Crear Asignatura</h4>
          </div>
          <form role="form" method="POST" action="{{ url('Asignatura') }}">
              <div class="modal-body">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="asignatura"><span style="color:red;">* </span>Asignaturas</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Ingrese la asignatura"  required>
                    <label for="nombrecorto"><span style="color:red;">* </span>Nombre corto</label>
                    <input type="text" class="form-control" name="nombrecorto" placeholder="Ingrese el nombre corto"  required>
                    @if ($errors->has('asignatura'))
                    <span class="help-block">
                        <strong>{{ $errors->first('asignatura') }}</strong>
                    </span>
                    @endif
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
            <h4 class="modal-title">Editar Asignatura</h4>
          </div>
          <form role="form" method="POST" id="formEdit">
              <div class="modal-body">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input hidden value="PUT" name="_method"/>
                    <label for="asignatura"><span style="color:red;">* </span>Asignatura</label>
                    <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre" required>
                    
                    <label for="nombrecorto"><span style="color:red;">* </span>Nombre corto</label>
                    <input id="nombrecorto" type="text" class="form-control" name="nombrecorto" placeholder="Ingrese el nombrecorto" required>
                    @if ($errors->has('asignatura'))
                    <span class="help-block">
                        <strong>{{ $errors->first('asignatura') }}</strong>
                    </span>
                    @endif
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
            <h4 class="modal-title">Eliminar asignatura</h4>
          </div>
          <form role="form" method="POST" id="formElim">
              <div class="modal-body">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input hidden value="DELETE" name="_method"/>
                    <p>¿Está seguro de eliminar esta asignatura?</p>
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
          var nombre = button.data('nombre')
          var nombrecorto = button.data('nombrecorto')
          $("#nombre").val(nombre)
          $("#nombrecorto").val(nombrecorto)
          var formAction ="/Asignatura/Editar/"+Id
          $('#formEdit').attr('action', formAction);
      });
  });

  $(function() {
      $('#eliminar').on("show.bs.modal", function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var Id = button.data('id')

          var formAction ="/Asignatura/Eliminar/"+Id
          $('#formElim').attr('action', formAction);
      });
  });
  
</script>

@endsection
