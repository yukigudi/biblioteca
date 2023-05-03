<?php
session_start();
include('../menu.php');
$id = $_SESSION['Id_usuario'];
$usuario = $id;
if ($id == null || $id == '') {
  header("location:index.php");
}
//Direccion, localidad, municipio, codigo postal, telefono, nombre del lugar
//Administrador, Responsable Estatal, Coordinador de Zona

$niveles = array(
  'administrador' => 'Administrador',
  'responsable_estatal' => 'Responsable Estatal',
  'coordinadorzona' => 'Coordinador de Zona',
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
                    <a href="perfil.php"><button class="dropdown-item" type="button">Actualizar perfil</button></a>
                    <a href="modificar_contrasena.php"><button class="dropdown-item" type="button">Cambiar contraseña</button></a>
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
    <div class="container">
      <br><br><br><br>
      <div class="bg-white rounded-lg formulario">
        <form class="p-4 needs-validation" action="registrar_cordzona.php" method="POST" novalidate>
          <center><label for="">
              <h4>REGISTRAR COORDINACION DE ZONA</h4>
            </label></center>
          <div class="form-row">

            <div class="col-sm-12 col-md-4 col-lg-6 mb-4">
              <label for="nombre_lugar">Nombre del lugar</label>
              <input type="text" class="form-control" id="nombre_lugar" required name="nombre_lugar" placeholder="Nombre del lugar" pattern="^[a-zA-Z0-9À-ÿ\s]*$" maxlength="40">
              <div class="valid-feedback">
                Correcto!
              </div>
              <div class="invalid-feedback">
                Porfavor rellena el campo.
              </div>
            </div>

            <div class="col-sm-12 col-md-4 col-lg-6 mb-4">
              <label for="calle">Dirección</label>
              <input type="text" class="form-control" id="direccion" required name="direccion" placeholder="Dirección" pattern="^[a-zA-Z0-9À-ÿ\s]*$" maxlength="30">
              <div class="valid-feedback">
                Correcto!
              </div>
              <div class="invalid-feedback">
                Porfavor rellena el campo.
              </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-3 mb-3">
              <label for="localidad">Localidad</label>
              <input type="text" class="form-control" id="localidad" required name="localidad" placeholder="Localidad" pattern="^[a-zA-Z0-9À-ÿ\s]*$" maxlength="30">
              <div class="valid-feedback">
                Correcto!
              </div>
              <div class="invalid-feedback">
                Porfavor rellena el campo.
              </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 mb-3">
              <label for="municipio">Municipio</label>
              <input type="text" class="form-control" id="municipio" required name="municipio" placeholder="Municipio" pattern="^[a-zA-Z0-9À-ÿ\s]*$" maxlength="30">
              <div class="valid-feedback">
                Correcto!
              </div>
              <div class="invalid-feedback">
                Porfavor rellena el campo.
              </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 mb-3">
              <label for="cod_pos">Código postal</label>
              <input type="text" class="form-control" id="cod_pos" required name="cod_pos" placeholder="Código postal" pattern="[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" maxlength="10">
              <div class="valid-feedback">
                Correcto!
              </div>
              <div class="invalid-feedback">
                Porfavor rellena el campo.
              </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
              <label for="telefono">Teléfono</label>
              <input type="tel" class="form-control" id="telefono" required name="telefono" placeholder="Teléfono" pattern="[0-9]{8,10}">
              <div class="valid-feedback">
                Correcto!
              </div>
              <div class="invalid-feedback">
                Profavor rellena el campo.
              </div>
            </div>
          </div>
          <br>
          <button class="btn btn-warning text-white" type="submit" name="registrar">Registrar</button>
        </form>
      </div>
      <br>
    </div>

    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </div>
  <?php
  if (isset($_POST['registrar'])) {
    require_once("../conexion/conexion.php");
    //$id = $_POST['id'];
    $tipo = 'cz';
    $direccion = $_POST['direccion'];
    $localidad = $_POST['localidad'];
    $municipio = $_POST['municipio'];
    $cod_pos = $_POST['cod_pos'];
    $telefono = $_POST['telefono'];
    $nombre_lugar = $_POST['nombre_lugar'];
    $fecha = date("Y-m-d");


    $query = "INSERT INTO ubicaciones (tipo,direccion,localidad,municipio,codigo_postal,telefono,nombre_lugar,fecha_registro) values('$tipo','$direccion','$localidad','$municipio','$cod_pos','$telefono','$nombre_lugar','$fecha')";

    echo $query;
    $verificar = $conexion->query($query);
    if ($verificar) {
      echo '<script>
                    swal({
                    title: "Operación exitosa",
                    text: "La Coordinación de zona fue registrado correctamente!",
                    type: "success",
                    showCancelButton: true,
                    cancelButtonClass: "btn-warning",
                    cancelButtonText: "Registrar",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Ver Coordinaciones de zona",
                    closeOnConfirm: false
                  },
                  function(isConfirm) {
                      if (isConfirm) {
                        window.location="cordzona.php";
                      } else {
                        window.location="registrar_cordzona.php";
                      }
                    });
                    </script>';
    } else {
      echo '<script>
                    swal({
                    title: "Operación fallida",
                    text: "Ocurrio un error al registrar la Coordinación de zona!",
                    type: "error",
                    showCancelButton: true,
                    cancelButtonClass: "btn-warning",
                    cancelButtonText: "Intentar de nuevo",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Ver Coordinaciones de zonas",
                    closeOnConfirm: false
                  },
                  function(isConfirm) {
                      if (isConfirm) {
                        window.location="cordzona.php";
                      } else {
                        window.location="registrar_cordzona.php";
                      }
                    });
                    </script>';
    }
  }
  ?>
 
  <!-- Footer -->
  <footer class=" ">
    <div class="container-fluid text-center">
      <div class="row">
        <div class="col-md-4 text-white mt-3 mb-2">
          <div class="container">

          </div>
        </div>
        <div class="col-md-4">
          <p class="text-white pt-3"><small><b>Copyright &copy; 2023 </b>ISEJA Control de módulos todos los derechos reservados</small></p>
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
  
  <script>
    $(document).ready(function() {
      $('.toast').toast('show');
    });
  </script>
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
</body>

</html>