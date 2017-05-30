
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Usuario</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('Css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{asset('vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('dist/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{asset('vendor/morrisjs/morris.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!--Solo mostrar las opciones si es un usuario del sistema-->
    @if (isset($user))
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    
                </button>
                <a class="navbar-brand" href="index.html">Colegio</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                       <i class="fa fa-user fa-fw"></i> {{$user->name}} <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="/Cuenta"><i class="fa fa-user fa-fw"></i> Mi cuenta</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        @if($user->rol_id == 1)
                        <li>
                            <a href="#"><i class="fa fa-cloud-upload  "></i> Administrar<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/Usuario ">Usuarios</a>
                                </li>
                                <li>
                                    <a href="/Estudiante">Estudiantes</a>
                                </li>
                                <li>
                                    <a href="/Profesor "> Docentes</a>
                                </li>
                                <li>
                                    <a href="/Asignatura ">Asignaturas</a>
                                </li>
                                <li>
                                    <a href="/Grado ">Grados</a>
                                </li>
                                <li>
                                    <a href="/Curso ">Cursos</a>
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                @elseif($user->rol_id == 2)
                <li>
                            <a href="/Lista"><i class="fa fa-bar-chart-o "></i> Mis Cursos</a>
                        </li>
                        <li>
                @elseif($user->rol_id == 3)
                <li>
                            <a href="/Nota"><i class="fa fa-bar-chart-o "></i> Mis Asignaturas</a>
                        </li>
                        <li>
                        
                @endif
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            @include('layouts.msj')
            @yield('contenido')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    @else
    <div class="container">
		<div class="row">
			<div style="padding: 3%;">
	            <div class="alert alert-danger alert-dismissible text-center" role="alert">
	                  <h4 style="margin-top:1em; margin-bottom: 1em;"><strong>La página buscada no existe</strong></h4>
	            </div>
	        </div>
	        <div style="padding-bottom: 3%;">
	        	<a href="{{url('/')}}" class="btn btn-primary btn-lg btn-block"> Ir al inicio</a>
        	</div>
		</div>
	</div>
    @endif
    
    <!-- jQuery -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('vendor/metisMenu/metisMenu.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{asset('vendor/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('vendor/morrisjs/morris.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('dist/js/sb-admin-2.js')}}"></script>
    
    @yield('script')
</body>

</html>