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
                  <small><b class="ml-2">ISEJA</b> Control de módulos</small>
              </div>
              <?php //menu(); ?>
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
                                <h4>DETALLE DE ASIGNACIONES NUMERO <?Php echo $_GET['id'] ?></h4>
                            </label></center>
              <form action="#" class="form" method="POST">


                  <div class="form-row container">
                      <div class="col-md-6 col-lg-5">
                          <div class="input-group" style="z-index: 0;">
                          <!---aqui iban filtros --->
                          </div>
                      </div>
                      <div class="col-md-4 col-lg-3 mb-4">
                          <button class="btn btn-warning text-white" onclick="abrirDetalleEnvios(<?Php echo $_GET['id'] ?>)" name="imprimir_reporte">Imprimir</button>
                      </div>
                  </div>
                  <br>
                  <div class="container-fluid" id="datos">
                      <table class='table table-sm table-hover gb-white shadow-sm'>
                          <thead>
                              <tr style="background-color:#952F57;" class='text-white font-weight-bold'>
                                  <th class='text-center'><small>ID</small></th>
                                  <th class='text-center'><small>Módulo</small></th>
                                  <th class='text-center'><small>Cantidad</small></th>
                                  <th class='text-center'><small>Nivel</small></th>
                                  <th class='text-center'><small>Estado</small></th>
                                  <th class='text-center'><small>Material</small></th>
                                  <th class='text-center'><small>Técnico Docente</small></th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php

                                require_once("../conexion/conexion.php");
                                $filtro = "";
                                if (isset($_GET['id'])) {
                                    if (isset($_GET['id'])) {
                                        $dato = $_GET['id'];
                                        $filtro .= " Id_hasignacion='$dato'";
                                    }
                                }
                                if ($filtro) {
                                   // $filtro = substr($filtro, 4);
                                    $filtro = "Where" . $filtro;
                                }

                                //------libros
                                $query = "SELECT * FROM libros";

                                $resultado = $conexion->query($query);
                                $libro = array();
                                if ($resultado->num_rows > 0) {
                                    while ($row = $resultado->fetch_assoc()) {
                                        $libro[$row['Id_libro']] = $row['Titulo'];
                                        // echo $fila['nombre_lugar'];
                                    }
                                }
                                //------------
                                $query = "SELECT * FROM usuarios";

                                $resultado = $conexion->query($query);
                                $tecnico = array();
                                if ($resultado->num_rows > 0) {
                                    while ($row = $resultado->fetch_assoc()) {
                                        $tecnico[$row['Id_usuario']] = $row['nombre_empleado'];
                                        //echo $fila['Id_usuario']. $fila['Nombre_usuario']; 
                                    }
                                }

                                $query = "SELECT * FROM `asignacion_modulos` INNER join libros on asignacion_modulos.titulo=libros.Id_libro " . $filtro;
                                //$query = "SELECT * FROM envio_modulos " . $filtro;
                                
                                $resultado = $conexion->query($query);
                                while ($fila = $resultado->fetch_assoc()) {
                                  
                                    //$fila['titulo'] = $libro[$fila['titulo']];


                                ?>
                                  <tr class='text-center'>
                                  <td><small><?php echo $fila['Id_asignacion']; ?></small></td>
                                      <td><small><?php echo $fila['Titulo']; ?></small></td>
                                      <td><small><?php echo $fila['cantidad']; ?></small></td>
                                      <td><small><?php echo $fila['nivel']; ?></small></td>
                                      <td><small><?php echo $fila['estado']; ?></small></td>
                                      <td><small><?php echo $fila['material']; ?></small></td>
                                      <td><small><?php echo $tecnico[$fila['tecnico']]; ?></small></td>
                                  </tr>
                              <?php
                                }
                        
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
            window.open("/biblioteca/reportes/detalle_devoluciones.php" + $filtros, "Detalle de Devolución", "directories=no location=no");
        }
      </script>

      <script>
          function abrirDetalleEnvios(id) {
             // $dato = $('#dato').val();
              $filtros = "?dato=" + id ;
              console.log($filtros);
              window.open("/biblioteca/reporte_detalleEnvios/index.php" + $filtros, "Reporte de envios", "directories=no location=no");

          }
      </script>
  </body>

  </html>