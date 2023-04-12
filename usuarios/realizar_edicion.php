<?php
session_start();
include('../menu.php');
$id = $_SESSION['Id_usuario'];
$usuario = $id;
if ($id == null || $id = '') {
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
  //$activo = $_POST['activo'];


  $id = $_GET['id'];
  $nombre_empleado = $_POST['nombre'];
  $usuario = $_POST['usuario'];
  $pass = $_POST['pass'];
  $calle = $_POST['calle'];
  $numeroi = $_POST['numeroi'];
  $numeroe = $_POST['numeroe'];
  $ciudad = $_POST['ciudad'];
  $estado = $_POST['estado'];
  $genero = $_POST['sexo'];
  $fecha_nac = $_POST['fecha_nac'];
  $telefono = $_POST['telefono'];
  $correo = $_POST['correo'];
  $nivel = $_POST['nivel'];
  //$fecha = date("Y-m-d"); ----fecha de registro no se actualiza

  //$query = "INSERT INTO usuarios (nombre_empleado,Nombre_usuario,Password,calle,numeroi,numeroe,ciudad,estado,genero,fecha_nac,telefono,correo,nivel,fecha) values('$nombre_empleado','$usuario','$pass','$calle','$numeroi','$numeroe','$ciudad','$estado','$genero','$fecha_nac','$telefono','$correo','$nivel','$fecha')";

  $query = "UPDATE usuarios SET nombre_empleado='$nombre_empleado',Nombre_usuario='$usuario',calle='$calle',numeroi='$numeroi',numeroe='$numeroe',ciudad='$ciudad',estado='$estado',genero='$genero',fecha_nac='$fecha_nac',telefono='$telefono',correo='$correo',nivel='$nivel' WHERE Id_usuario=$id ";
  //echo $query;
  $verificar = $conexion->query($query);
  if ($verificar) {
    echo '<script>
                    swal({
                    title: "Operación exitosa",
                    text: "La actualización se realizo con exitó!",
                    type: "success",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Regresar",
                  },
                  function(){
                    window.location="usuarios.php";
                  });
                    </script>';
  } else {
    echo '<script>
                    swal({
                    title: "Operación Fallida",
                    text: "Ocurrio un error al actualizar los datos del usuario!",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Regresar",
                  },
                  function(){
                    window.location="usuarios.php";
                  });
                    </script>';
  }
  ?>
  <script src="../vendor/jquery/jquery.min.js" type="text/javascript"></script>
  <script src="../vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>