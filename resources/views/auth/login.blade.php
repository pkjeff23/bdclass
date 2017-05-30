<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="Css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
        <script type="text/javascript" src="Js/jquery-1.12.3.min.js"></script>
        <script type="text/javascript" src="Js/main.js"></script>
        <title>Colegio</title>
    </head>
    <body>
        <div class="row" style="margin-bottom: 1em;">
            <h1 class="page-header text-center text-primary">Colegio</h1>
        </div>
        <div class="row">
            <div class=" col-md-offset-2 col-md-6">
                <h3 class="text-center text-primary">Login</h3>
                <br>
                <form id="log" class="form-horizontal" role="form"  method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    @include('layouts.msj')
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-lg-5 control-label">Email</label>
                        <div class="col-lg-7">
                            <input name="email" type="email" class="form-control" id="email"
                                   placeholder="Email" autofocus="" required>
                            @if ($errors->has('email'))-->
                                <span class="text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-lg-5 control-label">Contraseña</label>
                        <div class="col-lg-7">
                            <input name="password" type="password" class="form-control" id="pass" 
                                   placeholder="Contraseña" required>
                           @if ($errors->has('password'))-->
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-7 col-lg-offset-5">
                            <input type="submit" id="entrar" class="btn bg-primary" value="Ingresar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>