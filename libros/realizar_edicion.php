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
    $id_libro = $_POST['id_libro'];
    $titulo = $_POST['titulo'];
    $copias = $_POST['copias'];
    $estado = $_POST['estado'];
    $nivel = $_POST['nivel'];
    $material = $_POST['material'];
    $codigo = $_POST['codigo'];

    $query = "UPDATE libros SET Titulo='$titulo', Copias=$copias, estado='$estado', nivel='$nivel', material='$material', codigo='$codigo' WHERE Id_libro=$id_libro ";
    $verificar = $conexion->query($query);
    echo $query . "<br>";

    $querydetalle2 = "UPDATE ubicaciones_modulos SET cantidad=$copias WHERE Id_libro=$id_libro and ubicacion_Id=7";
    $verificar2 = $conexion->query($querydetalle2);
    echo $querydetalle2 . "<br>";

    if ($verificar && $verificar2) {
      echo '<script>
                    swal({
                    title: "Operación exitosa",
                    text: "La actualización se realizo con exitó!",
                    type: "success",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Regresar",
                  },
                  function(){
                    window.location="libros.php";
                  });
                    </script>';
    } else {
      echo '<script>
                    swal({
                    title: "Operación Fallida",
                    text: "Ocurrio un error al actualizar los datos del libro!",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Regresar",
                  },
                  function(){
                    window.location="libros.php";
                  });
                    </script>';
    }
    ?>
    <script src="../vendor/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  </body>

  </html>