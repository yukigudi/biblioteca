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
              <form action="#" class="form" method="POST">


                  <div class="form-row container">
                      <div class="col-md-6 col-lg-5">
                          <div class="input-group" style="z-index: 0;">
                              <input type="search" name="dato" id="dato" placeholder="Titulo" class="form-control shadow-sm border-0" autocomplete="off" value="<?php echo $_POST['dato'] ?>">
                              <div class="input-group-prepend bg-white p-0">
                                  <button name="buscar" type="submit" class="input-group-text btn btn-danger border-0 shadow-sm icofont-search-1"></button>
                              </div>
                          </div>
                      </div>
                     
                  
                      <div class="col-md-4 col-lg-3 mb-4">
                          <button class="btn btn-warning text-white" onclick="abrirReportelibros()" name="imprimir_reporte">Imprimir</button>
                      </div>
                  </div>
                  <br>
                  <div class="container-fluid" id="datos">
                      <table class='table table-sm table-hover gb-white shadow-sm'>
                          <thead>
                              <tr style="background-color:#952F57;" class='text-white font-weight-bold'>
                                  <th class='text-center'><small>Nombre lugar</small></th>
                                  <th class='text-center'><small>Dirección</small></th>
                                  <th class='text-center'><small>Localidad</small></th>
                                  <th class='text-center'><small>Municipio</small></th>
                                  <th class='text-center'><small>Telefono</small></th>
                                  <th class='text-center'><small>Codigo Postal</small></th>

                                  <th colspan='2' class='text-center'><small>Acciones</small></th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php

                                require_once("../conexion/conexion.php");
                               // $filtro = " AND Activo=1 ";
                                if (isset($_POST['buscar'])) {
                                    if (isset($_POST['dato'])) {
                                        $dato = $_POST['dato'];
                                        $filtro .= " AND Titulo LIKE '$dato%'";
                                    }
                                }
                               /* if ($filtro) {
                                    $filtro = substr($filtro, 4);
                                    $filtro = "Where" . $filtro;
                                }*/


                                $query = "SELECT * FROM ubicaciones WHERE tipo='r' " . $filtro;
                                //echo $query;
                                $resultado = $conexion->query($query);
                                while ($fila = $resultado->fetch_assoc()) {
                                    $id = $fila['Id_ubicacion'];
                                ?>
                                  <tr class='text-center'>
                                      <td><small><?php echo $fila['nombre_lugar']; ?></small></td>
                                      <td><small><?php echo $fila['direccion']; ?></small></td>
                                      <td><small><?php echo $fila['localidad']; ?></small></td>
                                      <td><small><?php echo $fila['municipio']; ?></small></td>
                                      <td><small><?php echo $fila['telefono']; ?></small></td>
                                      <td><small><?php echo $fila['codigo_postal']; ?></small></td>
                                      <td class="text-right"><a class="bg-primary py-1 rounded-lg" href="modificar.php?id=<?php echo $fila['Id_ubicacion'] ?>"><span class='h6 text-white icofont-ui-edit px-1'></small></a></td>
                                      <td class="text-left"><a class="bg-danger py-1 rounded-lg" href="#" onclick="confirmar(<?php echo $id; ?>)"><span class='h6 text-white icofont-ui-delete px-1'></span></a></td>
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
                      text: "¿Esta seguro de eliminar la ubicación de resguardo?",
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
                              text: "La ubicación de resguardo no fue eliminada",
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
          function abrirReportelibros() {
              $dato = $('#dato').val();
              $tipo = "r";
              $filtros = "?dato=" + $dato + "&tipo=" + $tipo ;
              console.log($filtros);
              window.open("../reporte_ubicacionesresguardo/index.php" + $filtros, "Reporte de ubicaciones", "directories=no location=no");

          }
      </script>
  </body>

  </html>