<?php
  session_start();
  include('menu.php');
  $id = $_SESSION['Id_usuario'];
  $usuario = $id;
  if ($id == null || $id == '') {
    header("location:index.php");
  }
  ?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/sweetalert.css">
    <script src="../vendor/bootstrap/js/sweetalert.min.js" type="text/javascript"></script>
  </head>

  <body>

    <?php
    require_once("../conexion/conexion.php");
    $id = $_REQUEST['id'];
 //$id = $_POST['id'];
        // $tipo = 'cz';
        $direccion = $_POST['direccion'];
        $localidad = $_POST['localidad'];
        $municipio = $_POST['municipio'];
        $cod_pos = $_POST['cod_pos'];
        $telefono = $_POST['telefono'];
        $nombre_lugar = $_POST['nombre_lugar'];
        $fecha = date("Y-m-d");


        //$query = "INSERT INTO ubicaciones (tipo,direccion,localidad,municipio,codigo_postal,telefono,nombre_lugar,fecha_registro) values('$tipo','$direccion','$localidad','$municipio','$cod_pos','$telefono','$nombre_lugar','$fecha')";
        $query = "UPDATE ubicaciones set direccion='$direccion',localidad='$localidad',municipio='$municipio',codigo_postal='$cod_pos',telefono='$telefono',nombre_lugar='$nombre_lugar' where Id_ubicacion=" . $id;
        //echo $query;
        $verificar = $conexion->query($query);
        if ($verificar) {
            echo '<script>
                    swal({
                    title: "Operación exitosa",
                    text: "El registro fue actualizado correctamente!",
                    type: "success",
                    showCancelButton: true,
                    cancelButtonClass: "btn-warning",
                    cancelButtonText: "Registrar",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Ver registro",
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
                    text: "Ocurrio un error al actualizar el registro!",
                    type: "error",
                    showCancelButton: true,
                    cancelButtonClass: "btn-warning",
                    cancelButtonText: "Intentar de nuevo",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Ver registro",
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
    ?>
    <script src="../vendor/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  </body>

  </html>