  <?php
    session_start();
    include('../menu.php');
    $id = $_SESSION['Id_usuario'];
    $usuario = $id;
    if ($id == null || $id == '') {
        header("location:index.php");
    }


    $estados = array(
        'nuevo' => 'Nuevo',
        'usado' => 'Usado'
    );
    $niveles = array(
        'alfabetizacion' => 'Alfabetización',
        'primaria' => 'Primaria',
        'secundaria' => 'Secundaria',

    );
    $materiales = array(
        'basico' => 'Básico',
        'diversificado' => 'Diversificado'
    );

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
              <?php menu(); ?>
          </nav>
          <!-- Page Content  -->
          <div class="menu">
              <nav style="background-color:#952F57" class="p-2 navbar navbar-expand-lg navbar-light">
                  <div class="container-fluid">
                      <i class="fas fa-align-left"></i>
                      <a href="#"><span id="sidebarCollapse" class="text-white h3 icofont-navigation-menu"></span></a>
                      <div class="ml-3 text-center text-white">

                      </div>
                      <button class="btn d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                          <i class="fas fa-align-justify"></i>
                          <span class="text-white h3 icofont-circled-down"></span>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="nav navbar-nav ml-auto">

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
              <center><label for="">
                      <h4>REPORTE DE ENVIOS</h4>
                  </label></center>
              <form action="#" class="form" method="POST">


                  <div class="form-row container">
                      <div class="col-md-6 col-lg-5">
                          <div class="input-group" style="z-index: 0;">
                              <input type="date" class="form-control shadow-sm border-0" autocomplete="off" value="<?php echo $_POST['dato'] ?>" name="dato" id="dato" placeholder="busqueda por fecha" value="">
                              <div class="input-group-prepend bg-white p-0">
                                  <button name="buscar" type="submit" class="input-group-text btn btn-danger border-0 shadow-sm icofont-search-1"></button>
                              </div>
                          </div>
                      </div>
                      <div class="form-row container mt-3">
                          <div class="col-md-4 col-lg-3 mb-4 text-right">
                              <button onclick="abrirReporteEnvios()" style="background-color: #dc3545; color: white; border: none; padding: 8px 12px; border-radius: 5px;">
                                  <i class="icofont-file-pdf"></i> Descargar en PDF
                              </button>
                          </div>
                          <div class="col-md-4 col-lg-3 mb-4">
                              <button id="btnDescargarxls" name="btnDescargarxls" style="background-color: #28a745; color: white; border: none; padding: 8px 12px; border-radius: 5px;">
                                  <i class="icofont-file-excel"></i> Descargar en Excel
                              </button>
                          </div>
                      </div>
                  </div>
                  <br>
                  <div class="container-fluid" id="datos">
                      <table class='table table-sm table-hover gb-white shadow-sm'>
                          <thead>
                              <tr style="background-color:#952F57;" class='text-white font-weight-bold'>
                                  <th class='text-center'><small>ID</small></th>
                                  <th class='text-center'><small>Ubicación de envio</small></th>
                                  <th class='text-center'><small>Destino</small></th>
                                  <th class='text-center'><small>Fecha</small></th>
                                  <th class='text-center'><small>Remitente</small></th>
                                  <th class='text-center'><small>Destinatario</small></th>
                                  <th class='text-center'><small>Testigo</small></th>
                                  <th class='text-center'><small>Detalle</small></th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php

                                require_once("../conexion/conexion.php");
                                $filtro = "";
                               // if (isset($_POST['buscar'])) {
                                    if (isset($_POST['dato'])) {
                                        $dato = $_POST['dato'];
                                        $filtro .= " fechaenvio='$dato'";
                                    }
                                //}
                                if ($filtro) {
                                    // $filtro = substr($filtro, 4);
                                    $filtro = "Where" . $filtro;
                                }

                                //------ubicacion actual de envios
                                $query = "SELECT * FROM ubicaciones where tipo='r'";

                                $resultado = $conexion->query($query);
                                $ubicacion_actual = array();
                                if ($resultado->num_rows > 0) {
                                    while ($row = $resultado->fetch_assoc()) {
                                        $ubicacion_actual[$row['Id_ubicacion']] = $row['nombre_lugar'];
                                        // echo $fila['nombre_lugar'];
                                    }
                                }
                                //------------
                                //--------------envioa tipo m o tipo p
                                $query = "SELECT * FROM ubicaciones where tipo in ('cz','d') ";

                                $resultado = $conexion->query($query);

                                $envioa = array();
                                if ($resultado->num_rows > 0) {
                                    while ($row = $resultado->fetch_assoc()) {
                                        $envioa[$row['Id_ubicacion']] = $row['nombre_lugar'];
                                    }
                                }

                                //-----------
                                //-------destinatario--------
                                $query = "SELECT * FROM usuarios";

                                $resultado = $conexion->query($query);
                                $destinatario = array();
                                if ($resultado->num_rows > 0) {
                                    while ($row = $resultado->fetch_assoc()) {
                                        $destinatario[$row['Id_usuario']] = $row['nombre_empleado'];
                                        //echo $fila['Id_usuario']. $fila['Nombre_usuario']; 
                                    }
                                }
                                //-----------
                                //-------remitente--------
                                $query = "SELECT * FROM usuarios";

                                $resultado = $conexion->query($query);
                                $remitente = array();
                                if ($resultado->num_rows > 0) {
                                    while ($row = $resultado->fetch_assoc()) {
                                        $remitente[$row['Id_usuario']] = $row['nombre_empleado'];
                                        //echo $fila['Id_usuario']. $fila['Nombre_usuario']; 
                                    }
                                }
                                //-----------


                                $query = "SELECT * FROM header_envio_modulos " . $filtro . " order by fechaenvio desc,Id_henvio desc";
                                //$query = "SELECT ubicaciones_modulos.Id_ubic_mod,libros.Titulo,libros.estado,ubicaciones.nombre_lugar as ubicacion_actual,ubicaciones_modulos.cantidad as Copias,libros.nivel,libros.material FROM ubicaciones_modulos left join ubicaciones on ubicaciones.Id_ubicacion=ubicaciones_modulos.ubicacion_Id left join libros on libros.Id_libro=ubicaciones_modulos.modulo_Id " . $filtro;

                                //la ubicacion actual es municipios o plazas tipo "m" o "p"
                                //echo $query;
                                $resultado = $conexion->query($query);
                                while ($fila = $resultado->fetch_assoc()) {
                                    $id = $fila['Id_henvio'];

                                    $fila['ubicacion_actual'] = $ubicacion_actual[$fila['ubicacion']];
                                    $fila['envioa'] = $envioa[$fila['envioa']];
                                    $fila['usuario'] = $remitente[$fila['usuario']];
                                    $fila['recibe'] = $destinatario[$fila['recibe']];


                                ?>
                                  <tr class='text-center'>
                                      <td><small><?php echo $fila['Id_henvio']; ?></small></td>
                                      <td><small><?php echo $fila['ubicacion_actual']; ?></small></td>
                                      <td><small><?php echo $fila['envioa']; ?></small></td>
                                      <td><small><?php echo $fila['fechaenvio']; ?></small></td>
                                      <td><small><?php echo $fila['usuario']; ?></small></td>
                                      <td><small><?php echo $fila['recibe']; ?></small></td>
                                      <td><small><?php echo $fila['testigo']; ?></small></td>
                                      <td class="text-center"><a class="rounded-lg" href="#" onclick="detalleEnvios(<?php echo $id; ?>)"><span class='h6 icofont-look px-1'></span></a></td>
                                  </tr>
                              <?php
                                }
                                // echo $query;
                                ?>
                          </tbody>
                      </table>
                  </div>
              </form>
          </div>
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
                      <p class="text-white pt-3"><small><b>Copyright &copy; 2023 </b>ISEJA Control de módulos todos los
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

              $("#btnDescargarxls").click(function() {
                  console.log('entra aqui');
                  $dato = $('#dato').val();
                  $filtros = "";
                  if ($dato != "") {
                      $filtros = "?dato=" + $dato;
                  }

                  // var filtros = "?dato=" + dato;
                  var url = "/biblioteca/phpxsls/ReportesXls/PhpOffice/reporte_envios.php" + $filtros;

                  // var url = "/biblioteca/phpxsls/ReportesXls/PhpOffice/reporte_ubicaciones_cordzona.php";
                  // Creamos un enlace con el atributo download y lo hacemos clic para iniciar la descarga

                  $('<a>').attr({
                      href: url,
                      download: 'reporte_envios.xlsx'
                  })[0].click();

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
          function detalleEnvios(id) {
              $filtros = "?id=" + id;
              window.open("/biblioteca/reportes/detalle_envios.php" + $filtros, "Detalle de envios", "directories=no location=no");
          }
      </script>

      <script>
          function abrirReporteEnvios() {
              $dato = $('#dato').val();
              $filtros = "";
              if ($dato != "") {
                  $filtros = "?dato=" + $dato;
              }

              console.log($filtros);
              window.open("/biblioteca/reporte_envios/index.php" + $filtros, "Reporte de envios", "directories=no location=no");

          }
      </script>
  </body>

  </html>