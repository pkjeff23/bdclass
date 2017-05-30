@extends('layouts.main')

@section('contenido')
    <div class="row">
        <h1 class="page-header text-center text-primary">Mis Datos</h1>
    </div>
    
    
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        
                    </tr>
                </thead>
                <tbody>
                    <div>
                      
                        <label class="text-center" for="nombre"><span style="color:red;">* </span>Nombre</label>
                         <div "text-center"> </span>{{$user->name}}</div>
                    @if ($errors->has('nombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                    @endif
                    
                    <label "text-center" for="apellido"><span style="color:red;">* </span>Apellido</label>
                    <div for="lastname">{{$user->lastname}}</div>
                    
                    @if ($errors->has('apellido'))
                    <span class="help-block">
                        <strong>{{ $errors->first('apellido') }}</strong>
                    </span>
                    @endif
                    
                    <label "text-center" for="email"><span style="color:red;">* </span>Email</label>
                    <div for="email">{{$user->email}}</div>
            
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                    
            
                    <label "text-center" for="dni"><span style="color:red;">* </span>DNI</label>
                     <div for="dni">{{$user->dni}}</div>
          
                    @if ($errors->has('dni'))
                    <span class="help-block">
                        <strong>{{ $errors->first('dni') }}</strong>
                    </span>
                    @endif
                        
                        <td>
                          
                            <button class="btn btn-link" title="Editar" data-target="#editar" data-toggle="modal" data-id="{{ $user->id }}"
                            data-nombre="{{ $user ->name }}" data-apellido="{!!$user ->lastname!!}" data-dni="{{$user->dni}}" data-email="{{$user->email}}"><i class="fa fa-pencil" aria-hidden="true"> </i>
                            </button>
                            
                        </td>
                    </div>
              
                
                </tbody>
                
            </table>
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

          var formAction ="/Cuenta/Editar/"+Id
          $('#formEdit').attr('action', formAction);
      });
  });

</script>

@endsection
