  <?php
    session_start();
    include('../menu.php');
    $id = $_SESSION['Id_usuario'];
    $usuario = $id;
    if ($id == null || $id == '') {
        header("location:index.php");
    }
    require_once("../conexion/conexion.php");

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
                  <small><b class="ml-2">ISEJA</b> <br>
                      <p class="text-center">Control de módulos</p>
                  </small>
                  <hr style="border-color: white;">
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
                      <h4>REPORTE DE INVENTARIOS</h4>
                  </label></center>
              <form action="#" class="form" method="POST">

                  <div class="form-row container">
                      <div class="col-md-6 col-lg-5">
                          <div class="input-group" style="z-index: 0;">
                              <input type="date" name="dato" id="dato" placeholder="" class="form-control shadow-sm border-0" autocomplete="off" value="<?php echo $_POST['dato'] ?>" onchange="this.form.submit()">

                          </div>
                      </div>
                      <div class="col-md-6 col-lg-5">
                          <div class="input-group" style="z-index: 0;">
                              <input type="search" name="codigo" id="codigo" placeholder="codigo" class="form-control shadow-sm border-0" autocomplete="off" value="<?php echo $_POST['codigo'] ?>">
                              <div class="input-group-prepend bg-white p-0">
                                  <button name="buscar" type="submit" class="input-group-text btn btn-danger border-0 shadow-sm icofont-search-1"></button>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="form-row container mt-3">
                      <div class="col-md-4 col-lg-3 mb-4">
                          <label for="ubicacion">Ubicación</label>
                          <select id="ubicacion" name="ubicacion" class="form-control" onchange="this.form.submit()">
                              <option value=""></option>
                              <?php

                                $query = "SELECT * FROM ubicaciones order by tipo asc, Id_ubicacion asc";
                                $resultado = $conexion->query($query);
                                $p_open = false;
                                $p_open1 = false;
                                echo '<optgroup label="Coordinación de Zona">';
                                if ($resultado->num_rows > 0) {
                                    while ($fila = $resultado->fetch_assoc()) {
                                        if ($fila['tipo'] == 'cz') {
                                            echo '<option value="' . $fila['Id_ubicacion'] . '"';
                                            if ($_POST['ubicacion'] == $fila['Id_ubicacion']) {
                                                echo ' selected';
                                            }
                                            echo '>' . $fila['nombre_lugar'] . '</option>';
                                        } else if ($fila['tipo'] == 'd') {
                                            if (!$p_open) {
                                                echo '</optgroup>';
                                                echo '<optgroup label="Delegación">';
                                                $p_open = true;
                                            }
                                            echo '<option value="' . $fila['Id_ubicacion'] . '"';
                                            if ($_POST['ubicacion'] == $fila['Id_ubicacion']) {
                                                echo ' selected';
                                            }
                                            echo '>' . $fila['nombre_lugar'] . '</option>';
                                        } else if ($fila['tipo'] == 'r') {
                                            if (!$p_open1) {
                                                echo '</optgroup>';
                                                echo '<optgroup label="Resguardo">';
                                                $p_open1 = true;
                                            }
                                            echo '<option value="' . $fila['Id_ubicacion'] . '"';
                                            if ($_POST['ubicacion'] == $fila['Id_ubicacion']) {
                                                echo ' selected';
                                            }
                                            echo '>' . $fila['nombre_lugar'] . '</option>';
                                        }
                                    }
                                }
                                if ($p_open) {
                                    echo '</optgroup>';
                                }
                                if ($p_open1) {
                                    echo '</optgroup>';
                                }

                                ?>
                          </select>

                      </div>

                      <div class="col-md-4 col-lg-3 mb-4">
                          <label for="nivel">Nivel</label>
                          <select id="nivel" name="nivel" class="form-control" onchange="this.form.submit()">
                              <option value=""></option>
                              <?php foreach ($niveles as $var => $nivel) : ?>
                                  <option value="<?php echo $var ?>" <?php if ($var == $_POST['nivel']) : ?> selected="selected" <?php endif; ?>><?php echo $nivel ?></option>
                              <?php endforeach; ?>
                          </select>

                      </div>
                      <div class="col-md-4 col-lg-3 mb-4">
                          <label for="estado">Estado</label>
                          <select id="estado" name="estado" class="form-control" onchange="this.form.submit()">
                              <option value=""></option>
                              <?php foreach ($estados as $var => $estado) : ?>
                                  <option value="<?php echo $var ?>" <?php if ($var == $_POST['estado']) : ?> selected="selected" <?php endif; ?>><?php echo $estado ?></option>
                              <?php endforeach; ?>
                          </select>
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

                  <br>
                  <div class="container-fluid" id="datos">
                      <table class='table table-sm table-hover gb-white shadow-sm'>
                          <thead>
                              <tr style="background-color:#952F57;" class='text-white font-weight-bold'>
                                  <th class='text-center'><small>Código</small></th>
                                  <th class='text-center'><small>Módulo</small></th>
                                  <th class='text-center'><small>Ubicación</small></th>
                                  <th class='text-center'><small>Cantidad</small></th>
                                  <th class='text-center'><small>Nivel</small></th>
                                  <th class='text-center'><small>Material</small></th>
                                  <th class='text-center'><small>Estado</small></th>
                                  <th class='text-center'><small>Fecha</small></th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                                $filtro = "";

                                if (isset($_POST['dato']) && ($_POST['dato']) != "") {
                                    $dato = $_POST['dato'];
                                    $filtro .= " AND fecha='$dato'";
                                }

                               // if (isset($_POST['buscar'])) {
                                    if (isset($_POST['codigo']) && ($_POST['codigo']) != "") {
                                        $codigo = $_POST['codigo'];
                                        $filtro .= " AND libros.codigo LIKE '$codigo%'";
                                    }
                                //}
                                if (isset($_POST['nivel']) && ($_POST['nivel']) != "") {
                                    $nivel = $_POST['nivel'];
                                    $filtro .= " AND libros.nivel='$nivel' ";
                                }
                                if (isset($_POST['ubicacion']) && ($_POST['ubicacion']) != "") {
                                    $ubicacion = $_POST['ubicacion'];
                                    $filtro .= " AND ubicaciones.Id_ubicacion='$ubicacion' ";
                                }
                                if (isset($_POST['estado']) && ($_POST['estado']) != "") {
                                    $estado = $_POST['estado'];
                                    $filtro .= " AND libros.estado='$estado' ";
                                }
                                if ($filtro) {
                                    $filtro = substr($filtro, 4);
                                    $filtro = "Where" . $filtro;
                                }


                                $query = "SELECT ubicaciones_modulos.Id_ubic_mod,ubicaciones_modulos.fecha,libros.Titulo,libros.estado,ubicaciones.nombre_lugar as ubicacion_actual,ubicaciones_modulos.cantidad as Copias,libros.nivel,libros.material,libros.codigo FROM ubicaciones_modulos left join ubicaciones on ubicaciones.Id_ubicacion=ubicaciones_modulos.ubicacion_Id left join libros on libros.Id_libro=ubicaciones_modulos.modulo_Id " . $filtro;
                               // echo $query;

                                $resultado = $conexion->query($query);
                                while ($fila = $resultado->fetch_assoc()) {
                                ?>
                                  <tr class='text-center'>
                                      <td><small><?php echo $fila['codigo']; ?></small></td>
                                      <td><small><?php echo $fila['Titulo']; ?></small></td>
                                      <td><small><?php echo $fila['ubicacion_actual']; ?></small></td>
                                      <td><small><?php echo $fila['Copias']; ?></small></td>
                                      <td><small><?php echo $fila['nivel']; ?></small></td>
                                      <td><small><?php echo $fila['material']; ?></small></td>
                                      <td><small><?php echo $fila['estado']; ?></small></td>
                                      <td><small><?php echo $fila['fecha']; ?></small></td>

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
                  $dato = $('#dato').val();
                  $ubicacion = $('#ubicacion').val();
                  $nivel = $('#nivel').val();
                  $estado = $('#estado').val();
                  $filtros = "";
                  if ($dato != "") {
                      $filtros += "?dato=" + $dato;
                  }

                  if ($ubicacion != "") {
                      if ($filtros == "") {
                          $filtros += "?ubicacion=" + $ubicacion;
                      } else {
                          $filtros += "&ubicacion=" + $ubicacion;
                      }
                  }

                  if ($nivel != "") {
                      if ($filtros == "") {
                          $filtros += "?nivel=" + $nivel;
                      } else {
                          $filtros += "&nivel=" + $nivel;
                      }
                  }

                  if ($estado != "") {
                      if ($filtros == "") {
                          $filtros += "?estado=" + $estado;
                      } else {
                          $filtros += "&estado=" + $estado;
                      }
                  }
                  // var filtros = "?dato=" + dato;
                  var url = "/biblioteca/phpxsls/ReportesXls/PhpOffice/reporte_inventarios.php" + $filtros;

                  // var url = "/biblioteca/phpxsls/ReportesXls/PhpOffice/reporte_ubicaciones_cordzona.php";
                  // Creamos un enlace con el atributo download y lo hacemos clic para iniciar la descarga

                  $('<a>').attr({
                      href: url,
                      download: 'reporte_inventarios.xlsx'
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

          function abrirReporteEnvios() {
              console.log('entra aqui');
              $dato = $('#dato').val();
              $ubicacion = $('#ubicacion').val();
              $nivel = $('#nivel').val();
              $estado = $('#estado').val();
              $codigo = $('#codigo').val();
              $filtros = "";
              //console.log($dato);
              if ($dato != "") {
                  $filtros += "?dato=" + $dato;
              }

              if ($ubicacion != "") {
                  if ($filtros == "") {
                      $filtros += "?ubicacion=" + $ubicacion;
                  } else {
                      $filtros += "&ubicacion=" + $ubicacion;
                  }
              }

              if ($nivel != "") {
                  if ($filtros == "") {
                      $filtros += "?nivel=" + $nivel;
                  } else {
                      $filtros += "&nivel=" + $nivel;
                  }
              }

              if ($estado != "") {
                  if ($filtros == "") {
                      $filtros += "?estado=" + $estado;
                  } else {
                      $filtros += "&estado=" + $estado;
                  }
              }

              //console.log($filtros);
              window.open("/biblioteca/reporte_inventarios/index.php" + $filtros, "Reporte de Inventarios", "directories=no location=no");

          }
      </script>
  </body>

  </html>