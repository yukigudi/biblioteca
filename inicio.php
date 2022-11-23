 <?php
    session_start();
    $id=$_SESSION['Id_usuario'];
    $usuario=$id;
    if ($id == null || $id='') {
        header("location:index.php");
    }
  ?>
 <!DOCTYPE html>
 <html>

 <head>
     <meta charset="utf-8">
     <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">

     <title>ISEJA Control de libros</title>

     <!-- Bootstrap CSS CDN -->
     <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
     <!-- Our Custom CSS -->
     <link rel="stylesheet" href="vendor/bootstrap/css/style.css">
     <link rel="stylesheet" type="text/css" href="icofont/icofont.min.css">
 </head>

 <body>
     <div class="wrapper">
         <!-- Sidebar  -->
         <nav id="sidebar">
             <div class="sidebar-header">
                 <img width="45" height="45" src="images/logo.png" alt="">
                 <small><b class="ml-2">ISEJA</b> Control de libros</small>
             </div>
             <ul class="list-unstyled components">
                 <li class="">
                     <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
                             class="icofont-library mr-3 h4 text-white"></span>Libros<i
                             class="icofont-rounded-down text-white"></i></a>
                     <ul class="collapse list-unstyled" id="homeSubmenu">
                         <li>
                             <a href="./libros/registrar_libros.php">Registrar</a>
                         </li>
                         <li>
                             <a href="./libros/libros.php">Consultar</a>
                         </li>
                         <li>
                             <a onClick='abrirReporte()' href="#">Reportes</a>
                         </li>
                     </ul>
                 </li>
                 <li class="">
                     <a href="#modulosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
                             class="icofont-listing-box mr-3 h4 text-white"></span>Modulos<i
                             class="icofont-rounded-down text-white"></i></a>
                     <ul class="collapse list-unstyled" id="modulosSubmenu">
                         <li>
                             <a href="./modulos_envio/registrar_envio.php">Envio</a>
                         </li>
                         <li>
                             <a href="./modulos_retorno/registrar_retorno.php">Retorno</a>
                         </li>
                         <li>
                             <a href="./modulos_recibido/registro.php">Recibo</a>
                         </li>
                       <!--  <li>
                             <a onClick='abrirReporte1()' href="#">Reportes</a>
                         </li>-->
                     </ul>
                 </li>
                 <li class="">
                     <a href="#incidenciasSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
                             class="icofont-bulb-alt mr-3 h4 text-white"></span>Incidencias<i
                             class="icofont-rounded-down text-white"></i></a>
                     <ul class="collapse list-unstyled" id="incidenciasSubmenu">
                         <li>
                             <a href="./incidencias/registrar_incidencias.php">Registrar</a>
                         </li>
                         <li>
                             <a onClick='abrirReporte2()' href="#">Reportes</a>
                         </li>
                     </ul>
                 </li>
                 <li class="">
                     <a href="#empleadosSubmenu" data-toggle="collapse" aria-expanded="false"
                         class="dropdown-toggle"><span
                             class="icofont-business-man mr-3 h4 text-white"></span>Empleados<i
                             class="icofont-rounded-down text-white"></i></a>
                     <ul class="collapse list-unstyled" id="empleadosSubmenu">
                         <li>
                             <a href="./empleados/registrar_empleados.php">Registrar</a>
                         </li>
                         <li>
                             <a href="./empleados/empleados.php">Consultar</a>
                         </li>
                         <li>
                             <a onClick='abrirReporte3()' href="#">Reportes</a>
                         </li>
                     </ul>
                 </li>
                 <li class="">
                     <a href="#puestoSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
                             class="icofont-ui-user mr-3 h4 text-white"></span>Puestos<i
                             class="icofont-rounded-down text-white"></i></a>
                     <ul class="collapse list-unstyled" id="puestoSubmenu">
                         <li>
                             <a href="./puestos/registrar_puesto.php">Registrar</a>
                         </li>
                         <li>
                             <a href="./puestos/puestos.php">Consultar</a>
                         </li>
                     </ul>
                 </li>
                 <?php if ($_SESSION['Id_usuario'] == 1) {?>
                 <li class="">
                     <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
                             class="icofont-users-alt-4 mr-3 h4 text-white"></span>Usuarios<i
                             class="icofont-rounded-down text-white"></i></a>
                     <ul class="collapse list-unstyled" id="userSubmenu">
                         <li>
                             <a href="./usuarios/registrar_usuarios.php">Registrar</a>
                         </li>
                         <li>
                             <a href="./usuarios/usuarios.php">Consultar</a>
                         </li>
                     </ul>
                 </li>
                 <?php   }?>

             </ul>
         </nav>
         <!-- Page Content  -->
         <div class="menu">
             <nav style="background-color:#952F57" class="p-2 navbar navbar-expand-lg navbar-light">
                 <div class="container-fluid">
                     <i class="fas fa-align-left"></i>
                     <a href="#"><span id="sidebarCollapse" class="text-white h3 icofont-navigation-menu"></span></a>
                     <div class="ml-3 text-center text-white">
                      
                     </div>
                     <button class="btn d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                         data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                         aria-expanded="false" aria-label="Toggle navigation">
                         <i class="fas fa-align-justify"></i>
                         <span class="text-white h3 icofont-circled-down"></span>
                     </button>
                     <div class="collapse navbar-collapse" id="navbarSupportedContent">
                         <ul class="nav navbar-nav ml-auto">
                                </span></i></a>
                            </li>
                             <!-- Example single danger button -->
                             <li class="nav-item">
                                 <div class="btn-group">
                                     <button type="button" id="perfil" class="btn dropdown-toggle"
                                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                         <img width="43" height="43" src="images/user.png" alt="">
                                     </button>
                                     <div class="dropdown-menu dropdown-menu-right">
                                         <a href="usuarios/perfil.php"><button class="dropdown-item"
                                                 type="button">Actualizar perfil</button></a>
                                         <a href="usuarios/modificar_contrasena.php"><button class="dropdown-item"
                                                 type="button">Cambiar contraseña</button></a>
                                         <div class="dropdown-divider"></div>
                                         <a href="conexion/cerrar_sesion.php"><button class="dropdown-item"
                                                 type="button">Cerrar sesión</button></a>
                                     </div>
                                 </div>
                             </li>
                         </ul>
                     </div>
                 </div>
             </nav>
         </div>
         <div class="container">
             <br><br>
             <br><br>
             <div class="container-fluid p-0">
                 <div class="row">
                     <div class="col-md-5 col-lg-3 p-0 p-1">
                         <div class="row no-gutters bg-white shadow-sm">
                             <div class="col-md-3 bg-danger p-3">
                                 <span class="icofont-library h1 text-white"></span>
                             </div>
                             <div class="col-md-9 pt-2">
                                 <small class="ml-3 h3 text-secondary border-danger"><b class="count">
                                         <?php 
                                    require_once("conexion/conexion.php");
                                    $query="SELECT COUNT(Id_libro) AS Total FROM libros";
                                    $resultado=$conexion->query($query);
                                    $fila=$resultado->fetch_assoc();
                                    echo $fila['Total'];
                                ?>
                                     </b></small>
                                 <br>
                                 <small class="ml-3 h6 text-secondary">Total de libros</small>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-5 col-lg-3 p-0 p-1">
                         <div class="row no-gutters bg-white shadow-sm">
                             <div class="col-md-3 bg-info p-3">
                                 <span class="icofont-business-man-alt-1 h1 text-white"></span>
                             </div>
                             <div class="col-md-9 pt-2">
                                 <small class="ml-3 h3 text-secondary border-info"><b class="count">
                                         <?php 
                                    require_once("conexion/conexion.php");
                                    $query="SELECT COUNT(Id_persona) AS Total FROM personas";
                                    $resultado=$conexion->query($query);
                                    $fila=$resultado->fetch_assoc();
                                    echo $fila['Total'];
                                ?>
                                     </b></small>
                                 <br>
                                 <small class="ml-3 h6 text-secondary">Total de Personas</small>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-5 col-lg-3 p-0 p-1">
                         <div class="row no-gutters bg-white shadow-sm">
                             <div class="col-md-3 bg-warning p-3">
                                 <span class="icofont-learn h1 text-white"></span>
                             </div>
                             <div class="col-md-9 pt-2">
                                 <small class="ml-3 h3 text-secondary border-warning"><b class="count">
                                         <?php 
                                    require_once("conexion/conexion.php");
                                    $query="SELECT COUNT(Id_consulta) AS Total FROM consulta";
                                    $resultado=$conexion->query($query);
                                    $fila=$resultado->fetch_assoc();
                                    echo $fila['Total'];
                                ?>
                                     </b></small>
                                 <br>
                                 <small class="ml-3 h6 text-secondary">Total de consultas</small>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-5 col-lg-3 p-0 p-1">
                         <div class="row no-gutters bg-white shadow-sm">
                             <div class="col-md-3 bg-success p-3">
                                 <span class="icofont-handshake-deal h1 text-white"></span>
                             </div>
                             <div class="col-md-9 pt-2">
                                 <small class="ml-3 h3 text-secondary border-success"><b class="count">
                                         <?php 
                                    require_once("conexion/conexion.php");
                                    $query="SELECT COUNT(Id_prestamo) AS Total FROM prestamos";
                                    $resultado=$conexion->query($query);
                                    $fila=$resultado->fetch_assoc();
                                    echo $fila['Total'];
                                ?>
                                     </b></small>
                                 <br>
                                 <small class="ml-3 h6 text-secondary">Total de prestamos</small>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-scrollable" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalScrollableTitle">Contáctanos</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body bg-light">
                     <div class="row">
                         <div class="col-sm-6">
                             <div class="card">
                                 <div class="card-body">
                                     <span class="text-info icofont-map h1"></span>
                                     <br>
                                     <small>Barrio: Bonampack</small>
                                     <br>
                                     <small>Calle: Yaxchilan</small>
                                     <br>
                                     <small>Número: 18</small>
                                 </div>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="card">
                                 <div class="card-body">
                                     <span class="text-info icofont-envelope h1"></span>
                                     <br>
                                     <small>Email: winalllpz@gmail.com</small>
                                     <br>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <br>
                     <div class="row">
                         <div class="col-sm-6">
                             <div class="card">
                                 <div class="card-body">
                                     <span class="text-info icofont-brand-whatsapp h1"></span>
                                     <br>
                                     <small>Tel: 9191936817</small>
                                     <br>
                                 </div>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="card">
                                 <div class="card-body">
                                     <span class="text-info icofont-facebook h1"></span>
                                     <br>
                                     <small>@GoldenLibrary</small>
                                     <br>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="modal fade" id="exampleModalScrollable1" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-scrollable" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalScrollableTitle">Quiénes somos</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body bg-light">
                     <div class="row">
                         <div class="col-sm-12">
                             <div class="card">
                                 <div class="card-body">
                                     <span class="text-info icofont-hat h1"></span>
                                     <p class="card-title">Misión</p>
                                     <small>Nuestra misión es poder dar a conocer toda la sabiduría a través de nuestros
                                         libros. Tener un repertorio digno para todas las personas; clases sociales,
                                         edades, grados y campos de estudio. Que nuestros libros sean del mayor agrado
                                         de nuestros visitadores, contando la mejor calidad de servicio en préstamos de
                                         títulos. Siempre con el cello de la casa.</small>
                                     <br>
                                 </div>
                             </div>
                         </div>
                         <br>
                         <div class="col-sm-12">
                             <div class="card">
                                 <div class="card-body">
                                     <span class="text-info icofont-eye h1"></span>
                                     <p class="card-title">Visión</p>
                                     <small>Nuestra visión es tener siempre tener una atención del público a pesar del
                                         tiempo en la que estamos, ser una de las instituciones de títulos literarios
                                         más conocidos del mundo. Tener instalaciones de calidad para preservar el buen
                                         espacio para leer, contar con el mejor trato de visitador-empleado, ya que
                                         nuestro público lo merece.</small>
                                     <br>
                                 </div>
                             </div>
                         </div>
                         <br>
                     </div>
                     <div class="row">
                         <div class="col-sm-12">
                             <div class="card">
                                 <div class="card-body">
                                     <span class="text-info icofont-chart-histogram-alt h1"></span>
                                     <p class="card-title">Objetivo General</p>
                                     <small>Tener un sistema para poder llevar a cabo la administración de los registros
                                         que se generan día con día y hacer más fácil la búsqueda de visitantes, las
                                         personas que tienen préstamos y los adeudos de libros. También llevar un
                                         registro de los libros que puedan estar dañados y así hacer una petición de
                                         cambios.</small>
                                     <br>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- Footer -->
     <footer class=" ">
         <div class="container-fluid text-center">
             <div class="row">
                 <div class="col-md-4">
                     <p class="text-white pt-3"><small><b>Copyright &copy; 2022 </b>ISEJA Control de libros todos los
                             derechos reservados</small></p>
                 </div>
                 <div class="col-md-4 text-white mt-3 mb-2">
                     <div class="contaiter">
                         <a href="conexion/desarolladores.php">Desarolladores</a>
                         <br>
                         <small>Version 3.0</small>
                     </div>
                 </div>
                 <div class="col-md-4 text-white mt-3 mb-2">
                     <div class="container">
                         <div class="d-inline">
                             <a href="" class="rounded-lg border border-info pt-2 p-2"><span
                                     class="icofont-facebook text-white h6"></span></a>
                         </div>
                         <div class="d-inline">
                             <a href="" class="rounded-lg border border-info pt-2 p-2"><span
                                     class="icofont-brand-whatsapp text-white h6"></span></a>
                         </div>
                         <div class="d-inline">
                             <a href="" class="rounded-lg border border-info pt-2 p-2"><span
                                     class="icofont-instagram text-white h6"></span></a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!-- /.container -->
     </footer>
     <!-- jQuery CDN - Slim version (=without AJAX) -->
     <script src="vendor/jquery/jquery.min.js" type="text/javascript"></script>
     <!-- Bootstrap JS -->
     <script src="vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
     <script src="vendor/bootstrap/js/counter.js" type="text/javascript"></script>
     <script type="text/javascript">
     $(document).ready(function() {
         $('#sidebarCollapse').on('click', function() {
             $('#sidebar').toggleClass('active');
         });
     });
     </script>
     <script>
     function abrirReporte() {
         window.open("reporte_libros/index.php", "Reporte de libros", "directories=no location=no");
     }

     function abrirReporte1() {
         window.open("reporte_personas/index.php", "Reporte de personas", "directories=no location=no");
     }

     function abrirReporte2() {
         window.open("reporte_autores/index.php", "Reporte de autores", "directories=no location=no");
     }

     function abrirReporte3() {
         window.open("reporte_empleados/index.php", "Reporte de empleados", "directories=no location=no");
     }

    /* function abrirReporte4() {
         window.open("reporte_consultas/index.php", "Reporte de consultas", "directories=no location=no");
     }

     function abrirReporte5() {
         window.open("reporte_prestamos/index.php", "Reporte de prestamos", "directories=no location=no");
     }*/
     </script>
 </body>

 </html>