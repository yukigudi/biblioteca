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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/sweetalert.css">
    <script src="../vendor/bootstrap/js/sweetalert.min.js" type="text/javascript"></script>
</head>
<body>
  
  <?php 
                require_once ("../conexion/conexion.php");
                $id=$_REQUEST['id'];
                $estatus=$_POST['estatus'];
                $query = "UPDATE prestamos SET Estatus='$estatus' WHERE Id_prestamo=$id ";
                $verificar=$conexion->query($query);
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
                    window.location="prestamos.php";
                  });
                    </script>';
                }else{
                    echo '<script>
                    swal({
                    title: "Operación Fallida",
                    text: "Ocurrio un error al actualizar los datos del prestamo!",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Regresar",
                  },
                  function(){
                    window.location="prestamos.php";
                  });
                    </script>';
                }
        ?>      
<script src="../vendor/jquery/jquery.min.js" type="text/javascript"></script> 
<script src="../vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
</body>
</html>