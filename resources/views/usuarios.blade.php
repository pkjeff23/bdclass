@extends('layouts.main')

@section('contenido')
    <div class="row">
        <h1 class="page-header text-center text-primary">Listado de Usuarios</h1>
    </div>
    <div class="row" style="margin-bottom:1em;">
        <a href="" class="btn btn-default" data-toggle="modal" data-target="#crear">Crear</a>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $r)
                    <tr>
                        <td>{!!$r->name!!}</td>
                        <td>{!!$r->lastname!!}</td>
                        <td>{{$r->dni}}</td>
                        <td>{{$r->email}}</td>
                        <td>{{$r->rol->name}}</td>
                        <td>
                            <button class="btn btn-link" title="Editar" data-target="#editar" data-toggle="modal" data-id="{{ $r->id }}"
                            data-nombre="{{ $r->name }}" data-apellido="{!!$r->lastname!!}" data-dni="{{$r->dni}}" data-email="{{$r->email}}"><i class="fa fa-pencil" aria-hidden="true"> </i>
                            </button>
                            <button class="btn btn-link" title="Eliminar" data-target="#eliminar" data-toggle="modal" data-id="{{ $r->id }}"><i class="fa fa-trash" aria-hidden="true"> </i></button>
                        </td>
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
            <h4 class="modal-title">Crear Usuario</h4>
          </div>
          <form role="form" method="POST" action="{{ url('Usuario') }}">
              <div class="modal-body">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="nombre"><span style="color:red;">* </span>Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre" required>
                    @if ($errors->has('nombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                    @endif
                    
                    <label for="apellido"><span style="color:red;">* </span>Apellido</label>
                    
                    <input type="text" class="form-control" name="apellido" placeholder="Ingrese el apellido" required>
                    @if ($errors->has('apellido'))
                    <span class="help-block">
                        <strong>{{ $errors->first('apellido') }}</strong>
                    </span>
                    @endif
                    
                    <label for="email"><span style="color:red;">* </span>Email</label>
                    
                    <input type="email" class="form-control" name="email" placeholder="Ingrese el email" required>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                    
                    
                    <label for="contraseña"><span style="color:red;">* </span>Contraseña</label>
                    
                    <input type="password" class="form-control" name="contraseña" placeholder="Ingrese la contraseña" required>
                    @if ($errors->has('contraseña'))
                    <span class="help-block">
                        <strong>{{ $errors->first('contraseña') }}</strong>
                    </span>
                    @endif
                    
                    
                    <label for="dni"><span style="color:red;">* </span>DNI</label>
                    
                    <input type="text" class="form-control" name="dni" placeholder="Ingrese el dni" required>
                    @if ($errors->has('dni'))
                    <span class="help-block">
                        <strong>{{ $errors->first('dni') }}</strong>
                    </span>
                    @endif
                    
                    <label for="rol"><span style="color:red;">* </span>Rol</label>
                    <select  class="form-control" name="rol">
                      @foreach($roles as $g)
                      <option value="{{$g->id}}">{{$g->name}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('rol'))
                    <span class="help-block">
                        <strong>{{ $errors->first('rol') }}</strong>
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
            <h4 class="modal-title">Editar Usuario</h4>
          </div>
          <form role="form" method="POST" id="formEdit">
              <div class="modal-body">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input hidden value="PUT" name="_method"/>
                    <label for="nombre"><span style="color:red;">* </span>Nombre</label>
                    <input id="nombre_edit" type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre" required>
                    @if ($errors->has('nombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                    @endif
                    
                    <label for="apellido"><span style="color:red;">* </span>Apellido</label>
                    
                    <input id="apellido_edit" type="text" class="form-control" name="apellido" placeholder="Ingrese el apellido" required>
                    @if ($errors->has('apellido'))
                    <span class="help-block">
                        <strong>{{ $errors->first('apellido') }}</strong>
                    </span>
                    @endif
                    
                    <label for="email"><span style="color:red;">* </span>Email</label>
                    
                    <input id="email_edit" type="email" class="form-control" name="email" placeholder="Ingrese el email" required>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                    
                    <label for="dni"><span style="color:red;">* </span>DNI</label>
                    
                    <input id="dni_edit" type="text" class="form-control" name="dni" placeholder="Ingrese el dni" required>
                    @if ($errors->has('dni'))
                    <span class="help-block">
                        <strong>{{ $errors->first('dni') }}</strong>
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
            <h4 class="modal-title">Eliminar usuario</h4>
          </div>
          <form role="form" method="POST" id="formElim">
              <div class="modal-body">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input hidden value="DELETE" name="_method"/>
                    <p>¿Está seguro de eliminar este usuario?</p>
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
          var apellido = button.data('apellido')
          var email = button.data('email')
          var dni = button.data('dni')
          $("#nombre_edit").val(nombre)
          $("#apellido_edit").val(apellido)
          $("#email_edit").val(email)
          $("#dni_edit").val(dni)

          var formAction ="/Usuario/Editar/"+Id
          $('#formEdit').attr('action', formAction);
      });
  });

  $(function() {
      $('#eliminar').on("show.bs.modal", function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var Id = button.data('id')

          var formAction ="/Usuario/Eliminar/"+Id
          $('#formElim').attr('action', formAction);
      });
  });
  
</script>

@endsection
