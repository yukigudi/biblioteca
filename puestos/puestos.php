<?php
    session_start();
    $id=$_SESSION['Id_usuario'];
    $usuario=$id;
    if ($id == null || $id == '') {
        header("location:../index.php");
    }
  ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ISEJA Control de módulos</title>

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
                <small><b class="ml-2">ISEJA</b> <br><p class="text-center">Control de módulos</p></small><hr style="border-color: white;">
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
                     <a href="#modulosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
                             class="icofont-listing-box mr-3 h4 text-white"></span>Modulos<i
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
                        <!--- <div class="spinner-grow text-light" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>--->
                    </div> 
                    <button class="btn d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                        <span class="text-white h3 icofont-circled-down"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                         <!--   <li class="nav-item">
                                <a data-toggle="modal" data-target="#exampleModalScrollable1" class="text-white h5 nav-link" href="#" title="Nuestra empresa"><i class="mr-2 icofont-building-alt"></i></a>
                            </li>

                            <li class="nav-item">
                                <a data-toggle="modal" data-target="#exampleModalScrollable" class="text-white h5 nav-link" href="#" title="Contactanos"><i class="mr-2 icofont-search-map"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="text-white h5 nav-link" href="../inicio.php"><i class="icofont-ui-home" title="Inicio"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="../prestamos/pendientes.php" class="text-white h5 nav-link" href="#"><i class="icofont-notification" title="Notificaciones"><span style="position: relative; top: -8px;" class="bg-warning badge count">
                                      <?php 
                                       /* require_once("../conexion/conexion.php");
                                        $buscar_pend="SELECT COUNT(Id_prestamo) AS numero FROM prestamos WHERE Fecha_devolucion<NOW() AND Estatus='Pendiente'";
                                        $confirmar=$conexion->query($buscar_pend);
                                        $rows=$confirmar->fetch_assoc();
                                        echo $rows['numero'];;*/
                                        ?>
                                </span></i></a>
                            </li>-->
                            <!-- Example single danger button -->
                            <li class="nav-item">
                                <div class="btn-group">
                                  <button type="button" id="perfil" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img width="43" height="43" src="../images/user.png" alt="">
                                  </button>
                                 <div class="dropdown-menu dropdown-menu-right">
                                    <a href="../usuarios/perfil.php"><button class="dropdown-item" type="button">Actualizar perfil</button></a>
                                    <a href="../usuarios/modificar_contrasena.php"><button class="dropdown-item" type="button">Cambiar contraseña</button></a>
                                    <div class="dropdown-divider"></div>
                                    <a href="../conexion/cerrar_sesion.php"><button class="dropdown-item" type="button">Cerrar sesión</button></a>
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
                        <div class="input-group">
                            <input type="search" name="dato" placeholder="Nombre del puesto" class="form-control shadow-sm border-0" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" maxlength="15">
                            <div class="input-group-prepend p-0" style="z-index: 0;">
                              <button name="buscar" type="submit" class="input-group-text btn btn-danger border-0 shadow-sm icofont-search-1"></button>
                            </div> 
                        </div>
                    </div>
                </div>
                <br>
                <div class="container-fluid" id="datos">
                    <table class='table table-sm table-hover bg-white shadow-sm'>
                        <thead>
                            <tr class='bg-warning text-white font-weight-bold'>
                                <th class='text-center'><small>ID</small></th>
                                <th class='text-center'><small>Descripción</small></th>
                                <th colspan='2' class='text-center'><small>Acciones</small></th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php 
                        if (isset($_POST['buscar'])) {
                            require_once("../conexion/conexion.php");
                            $dato=$_POST['dato'];
                            $query="SELECT * FROM puesto WHERE Descripcion LIKE '$dato%' AND Activo=1";
                            $resultado=$conexion->query($query);                                    
                                  while ($fila=$resultado->fetch_assoc()) { 
                                    $id=$fila['Id_puesto'];
                                  ?>                                       
                            <tr class='text-center'>
                                <td><small><?php echo $fila['Id_puesto']; ?></small></td>
                                <td><small><?php echo $fila['Descripcion']; ?></small></td>
                                <td><a class="bg-primary py-1 rounded-lg" href="modificar_puesto.php?id=<?php echo $fila['Id_puesto'] ?>"><span class='h6 text-white icofont-ui-edit px-1'></span></a></td>
                                <td><a class="bg-danger py-1 rounded-lg" href="#" onclick="confirmar(<?php echo $id; ?>)"><span class='h6 text-white icofont-ui-delete px-1'></span></a></td>   
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
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
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
    <div class="modal fade" id="exampleModalScrollable1" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
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
                    <small>Nuestra misión es poder dar a conocer toda la sabiduría a través de nuestros libros. Tener un repertorio digno para todas las personas; clases sociales, edades, grados y campos de estudio. Que nuestros libros sean del mayor agrado de nuestros visitadores, contando la mejor calidad de servicio en préstamos de títulos. Siempre con el cello de la casa.</small>
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
                        <small>Nuestra visión es tener siempre tener una atención del público a pesar del tiempo en la que estamos, ser una de las instituciones de títulos literarios más conocidos del mundo. Tener instalaciones de calidad para preservar el buen espacio para leer, contar con el mejor trato de visitador-empleado, ya que nuestro público lo merece.</small>
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
                    <small>Tener un sistema para poder llevar a cabo la administración de los registros que se generan día con día y hacer más fácil la búsqueda de visitantes, las personas que tienen préstamos y los adeudos de libros. También llevar un registro de los libros que puedan estar dañados y así hacer una petición de cambios.</small>
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
    <!-- Footer -->
    <footer class=" ">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-md-4">
                    <p class="text-white pt-3"><small><b>Copyright &copy; 2022 </b>ISEJA Control de módulos todos los derechos reservados</small></p>
                </div>  
                <div class="col-md-4 text-white mt-3 mb-2">
                    <div class="contaiter">
                        <a href="../conexion/desarolladores.php">Desarolladores</a>
                        <br>
                        <small>Version 3.0</small>
                    </div>
                </div>
                <div class="col-md-4 text-white mt-3 mb-2">
                    <div class="container">
                        <div class="d-inline">
                            <a href="" class="rounded-lg border border-info pt-2 p-2"><span class="icofont-facebook text-white h6"></span></a>
                        </div>
                        <div class="d-inline">
                            <a href="" class="rounded-lg border border-info pt-2 p-2"><span class="icofont-brand-whatsapp text-white h6"></span></a>
                        </div>
                        <div class="d-inline">
                            <a href="" class="rounded-lg border border-info pt-2 p-2"><span class="icofont-instagram text-white h6"></span></a>
                        </div>
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
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
         function launchFullScreen(element) {
      if(element.requestFullScreen) {
        element.requestFullScreen();
      } else if(element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
      } else if(element.webkitRequestFullScreen) {
        element.webkitRequestFullScreen();
      }
    }
    // Lanza en pantalla completa en navegadores que lo soporten
     function cancelFullScreen() {
         if(document.cancelFullScreen) {
             document.cancelFullScreen();
         } else if(document.mozCancelFullScreen) {
             document.mozCancelFullScreen();
         } else if(document.webkitCancelFullScreen) {
             document.webkitCancelFullScreen();
         }
     }
    </script>
    <script language="javascript"> 
    function confirmar(id){ 
        swal({
        title: "Advertecia!",
        text: "¿Esta seguro de eliminar el puesto?",
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
            window.location="eliminar.php?id="+id;
        }else{
            swal({
              title: "Operación cancelada!",
              text: "El puesto no fue eliminado",
              type: "error",
              confirmButtonClass: "btn-primary",
              confirmButtonText: "Volver",
              closeOnConfirm: false
            },);
        }
      });
    }
    </script>
    <script>
       function abrirReporte() {
       window.open("../reporte_libros/index.php","Reporte de libros","directories=no location=no");
       }
       function abrirReporte1() {   
       window.open("../reporte_personas/index.php","Reporte de personas","directories=no location=no");
       }
       function abrirReporte2() {
       window.open("../reporte_autores/index.php","Reporte de autores","directories=no location=no");
       }
       function abrirReporte3() {
       window.open("../reporte_empleados/index.php","Reporte de empleados","directories=no location=no");
       }
       function abrirReporte4() {
       window.open("../reporte_consultas/index.php","Reporte de consultas","directories=no location=no");
       }
       function abrirReporte5() {
       window.open("../reporte_prestamos/index.php","Reporte de prestamos","directories=no location=no");
       }
    </script>
</body>

</html>