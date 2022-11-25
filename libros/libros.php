 <?php
    session_start();
    $id=$_SESSION['Id_usuario'];
    $usuario=$id;
    if ($id == null || $id='') {
        header("location:../index.php");
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
     <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
     <!-- Our Custom CSS -->
     <link rel="stylesheet" href="../vendor/bootstrap/css/style.css">
     <link rel="stylesheet" type="text/css" href="../icofont/icofont.min.css">
     <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/sweetalert.css">
     <script src="../vendor/bootstrap/js/sweetalert.min.js" type="text/javascript"></script>
 </head>

 <body>
     <div class="wrapper">
         <!-- Sidebar  -->
         <nav id="sidebar">
             <div class="sidebar-header">
                 <img width="45" height="45" src="../images/logo.png" alt="">
                 <small><b class="ml-2">ISEJA</b> Control de libros</small>
             </div>
             <ul class="list-unstyled components">
                 <li class="">
                     <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
                             class="icofont-library mr-3 h4 text-white"></span>Libros<i
                             class="icofont-rounded-down text-white"></i></a>
                     <ul class="collapse list-unstyled" id="homeSubmenu">
                         <li>
                             <a href="../libros/registrar_libros.php">Registrar</a>
                         </li>
                         <li>
                             <a href="../libros/libros.php">Consultar</a>
                         </li>
                         <li>
                             <a onClick='abrirReporte()' href="#">Reportes</a>
                         </li>
                     </ul>
                 </li>
                 <li class="">
                     <a href="#modulosSubmenu" data-toggle="collapse" aria-expanded="false"
                         class="dropdown-toggle"><span class="icofont-listing-box mr-3 h4 text-white"></span>Modulos<i
                             class="icofont-rounded-down text-white"></i></a>
                     <ul class="collapse list-unstyled" id="modulosSubmenu">
                         <li>
                             <a href="../modulos_envio/registrar_envio.php">Envio</a>
                         </li>
                         <li>
                             <a href="../modulos_retorno/registrar_retorno.php">Retorno</a>
                         </li>
                         <li>
                             <a href="../modulos_recibido/registro.php">Recibo</a>
                         </li>
                         <li>
                             <a onClick='abrirReporte1()' href="#">Reportes</a>
                         </li>
                     </ul>
                 </li>
                 <li class="">
                     <a href="#incidenciasSubmenu" data-toggle="collapse" aria-expanded="false"
                         class="dropdown-toggle"><span class="icofont-bulb-alt mr-3 h4 text-white"></span>Incidencias<i
                             class="icofont-rounded-down text-white"></i></a>
                     <ul class="collapse list-unstyled" id="incidenciasSubmenu">
                         <li>
                             <a href="../incidencias/registrar_incidencias.php">Registrar</a>
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
                             <a href="../empleados/registrar_empleados.php">Registrar</a>
                         </li>
                         <li>
                             <a href="../empleados/empleados.php">Consultar</a>
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
                             <a href="../puestos/registrar_puesto.php">Registrar</a>
                         </li>
                         <li>
                             <a href="../puestos/puestos.php">Consultar</a>
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
                             <a href="../usuarios/registrar_usuarios.php">Registrar</a>
                         </li>
                         <li>
                             <a href="../usuarios/usuarios.php">Consultar</a>
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

                             <!-- Example single danger button -->
                             <li class="nav-item">
                                 <div class="btn-group">
                                     <button type="button" id="perfil" class="btn dropdown-toggle"
                                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                         <img width="43" height="43" src="../images/user.png" alt="">
                                     </button>
                                     <div class="dropdown-menu dropdown-menu-right">
                                         <a href="../usuarios/perfil.php"><button class="dropdown-item"
                                                 type="button">Actualizar perfil</button></a>
                                         <a href="../usuarios/modificar_contrasena.php"><button class="dropdown-item"
                                                 type="button">Cambiar contraseña</button></a>
                                         <div class="dropdown-divider"></div>
                                         <a href="../conexion/cerrar_sesion.php"><button class="dropdown-item"
                                                 type="button">Cerrar sesión</button></a>
                                     </div>
                                 </div>
                             </li>
                         </ul>
                     </div>
                 </div>
             </nav>
         </div>
         <div class="container table-responsive">
             <br><br><br><br>
             <form action="#" class="form" method="POST">
                 <div class="form-row container">
                     <div class="col-md-6 col-lg-5">
                         <div class="input-group" style="z-index: 0;">
                             <input type="search" name="dato" placeholder="Titulo del libro"
                                 class="form-control shadow-sm border-0" autocomplete="off">
                             <div class="input-group-prepend bg-white p-0">
                                 <button name="buscar" type="submit"
                                     class="input-group-text btn btn-danger border-0 shadow-sm icofont-search-1"></button>
                             </div>
                         </div>
                     </div>
                 </div>
                 <br>
                 <div class="container-fluid" id="datos">
                     <table class='table table-sm table-hover gb-white shadow-sm'>
                         <thead>
                             <tr class='bg-warning text-white font-weight-bold'>
                                 <th class='text-center'><small>ID</small></th>
                                 <th class='text-center'><small>Titulo</small></th>
                                 <th class='text-center'><small>Copias</small></th>
                                 <!--<th class='text-center'><small>Editorial</small></th>
                                <th class='text-center'><small>Fecha de edicion</small></th>
                                <th class='text-center'><small>Categoría</small></th>
                                <th class='text-center'><small>Estante</small></th>-->
                                 <th colspan='2' class='text-center'><small>Acciones</small></th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php 
                                if (isset($_POST['buscar'])) {
                                    require_once("../conexion/conexion.php");
                                    $dato=$_POST['dato'];
                                    $query="SELECT * FROM libros WHERE Titulo LIKE '$dato%' AND activo=1";
                                    $resultado=$conexion->query($query);
                                    while ($fila=$resultado->fetch_assoc()) {
                                        $id=$fila['Id_libro']; 
                                     ?>
                             <tr class='text-center'>
                                 <td><small><?php echo $fila['Id_libro']; ?></small></td>
                                 <td><small><?php echo $fila['Titulo']; ?></small></td>
                                 <td><small><?php echo $fila['Copias']; ?></small></td>
                                 <!--<td><small><?php //echo $fila['Editorial']; ?></small></td>
                                            <td><small><?php //echo $fila['Fecha_edicion']; ?></small></td>
                                            <td><small><?php //echo $fila['Categoria']; ?></small></td>
                                            <td><small><?php //echo $fila['Estante']; ?></small></td>-->
                                 <td><a class="bg-primary py-1 rounded-lg"
                                         href="modificar_libros.php?id=<?php echo $fila['Id_libro'] ?>"><span
                                             class='h6 text-white icofont-ui-edit px-1'></small></a></td>
                                 <td><a class="bg-danger py-1 rounded-lg" href="#"
                                         onclick="confirmar(<?php echo $id; ?>)"><span
                                             class='h6 text-white icofont-ui-delete px-1'></span></a></td>
                             </tr>
                             <?php
                                }           
                                }
                             ?>
                         </tbody>
                     </table>
                 </div>
             </form>
         </div>
     </div>


     <!-- Footer -->
     <footer class=" ">
         <div class="container-fluid text-center">
             <div class="row">
                 <div class="col-md-4 text-white mt-3 mb-2">
                     <div class="container">

                     </div>
                 </div>
                 <div class="col-md-4">
                     <p class="text-white pt-3"><small><b>Copyright &copy; 2022 </b>ISEJA Control de libros todos los
                             derechos reservados</small></p>
                 </div>
                 <div class="col-md-4 text-white mt-3 mb-2">
                     <div class="contaiter">

                         <small>Version 1.0</small>
                     </div>
                 </div>
             </div>
         </div>
         <!-- /.container -->
     </footer>
     <!-- jQuery CDN - Slim version (=without AJAX) -->
     <script src="../vendor/jquery/jquery.min.js" type="text/javascript"></script>
     <!-- Bootstrap JS -->
     <script src="../vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
     <script type="text/javascript">
     $(document).ready(function() {
         $('#sidebarCollapse').on('click', function() {
             $('#sidebar').toggleClass('active');
         });
     });

     function launchFullScreen(element) {
         if (element.requestFullScreen) {
             element.requestFullScreen();
         } else if (element.mozRequestFullScreen) {
             element.mozRequestFullScreen();
         } else if (element.webkitRequestFullScreen) {
             element.webkitRequestFullScreen();
         }
     }
     // Lanza en pantalla completa en navegadores que lo soporten
     function cancelFullScreen() {
         if (document.cancelFullScreen) {
             document.cancelFullScreen();
         } else if (document.mozCancelFullScreen) {
             document.mozCancelFullScreen();
         } else if (document.webkitCancelFullScreen) {
             document.webkitCancelFullScreen();
         }
     }
     </script>
     <script language="javascript">
     function confirmar(id) {
         swal({
                 title: "Advertecia!",
                 text: "¿Esta seguro de eliminar el libro incluyendo las relaciones que tenga?",
                 type: "warning",
                 showCancelButton: true,
                 confirmButtonClass: "btn-primary ",
                 confirmButtonText: "Eliminar",
                 cancelButtonClass: "btn-danger",
                 cancelButtonText: "Cancelar",
                 closeOnConfirm: false,
                 closeOnCancel: false
             },
             function(isConfirm) {
                 if (isConfirm) {
                     window.location = "eliminar.php?id=" + id;
                 } else {
                     swal({
                         title: "Operación cancelada!",
                         text: "El libro no fue eliminado",
                         type: "error",
                         confirmButtonClass: "btn-primary",
                         confirmButtonText: "Volver",
                         closeOnConfirm: false
                     }, );
                 }
             });
     }
     </script>
     <script>
     function abrirReporte() {
         window.open("../reporte_libros/index.php", "Reporte de libros", "directories=no location=no");
     }

     function abrirReporte1() {
         window.open("../reporte_modulos/index.php", "Reporte de módulos", "directories=no location=no");
     }

     function abrirReporte2() {
         window.open("../reporte_incidencias/index.php", "Reporte de incidencias", "directories=no location=no");
     }

     function abrirReporte3() {
         window.open("../reporte_empleados/index.php", "Reporte de empleados", "directories=no location=no");
     }
     </script>
 </body>

 </html>