<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
include('../menu.php');
//session_start();
$id = $_SESSION['Id_usuario'];
$usuario = $id;
if ($id == null || $id == '') {
    header("location:../index.php");
}
require_once("../conexion/conexion.php");
//echo'Ubic: '.$_POST['ubicacion_actual'];
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <div class="container">
            <br><br><br><br>
            <br>
            <div class="bg-white rounded-lg formulario">
                <form class="p-4 needs-validation" action="registro.php" method="POST" novalidate>
                    <div id="lineas">
                        <center><label for="">
                                <h4>REGISTRAR ASIGNACIONES</h4>
                            </label></center>
                        <div class="form-row">
                            <div class="col-md-3 col-lg-3 mb-3">
                                <label for="fecha_actual">Fecha</label>
                                <input type="date" class="form-control" id="fecha_actual" name="fecha" value="<?php echo date("Y-m-d") ?>" required>
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>


                            <div class="col-md-3 col-lg-3 mb-4">
                                <label for="tipo">Tipo</label>
                                <select id="tipo" name="tipo" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <option value="envio">Envío</option>
                                    <option value="devolucion">Devolución</option>
                                </select>
                            </div>

                            <div class="col-md-5 col-lg-5 mb-5">
                                <label for="ordenes">Ordenes</label>

                                <select id="ordenes" name="ordenes" class="form-control" required>
                                </select>
                                <input type="hidden" id="fechaorden" name="fechaorden">
                                <input type="hidden" id="usuarioenvia" name="usuarioenvia">
                                <input type="hidden" id="usuariorecibe" name="usuariorecibe">
                                <input type="hidden" id="ubicacion_envio" name="ubicacion_envio">
                                <input type="hidden" id="envioa" name="envioa">
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 mb-4">
                                <label for="ubicacion_actual">Ubicación Actual</label>
                                <select id="ubicacion_actual" name="ubicacion_actual" class="form-control" required>
                                    <option value="">Seleccione</option>

                                    <?php

                                    $query = "SELECT * FROM ubicaciones order by tipo, Id_ubicacion";

                                    $resultado = $conexion->query($query);

                                    if ($resultado->num_rows > 0) {
                                        while ($fila = $resultado->fetch_assoc()) {

                                            echo '<option value="' . $fila['Id_ubicacion'] . '">' . $fila['nombre_lugar'] . '</option>';
                                        }
                                    } ?>
                                  
                                </select>
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 mb-3">
                                <label for="testigo">Testigo</label>
                                <input type="text" class="form-control" id="testigo" name="testigo" required>
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>


                        </div>

                        <div class="form-row envios">
                        </div>

                    </div>
                    <button class="btn btn-warning text-white" type="submit" name="registrar">Registrar</button>
                </form>
            </div>
            <br>
        </div>

        <script>
            $(document).on('change', '.cantidad', function() {
                //hace una consulta a la base de datos para mostrar si la cantidad solicitada esta disponible
                var ubicacion_actual = $('#ubicacion_actual').val();
                var modulo = $(this).closest('.envios').find('.modulos').val();
                console.log(modulo);
                var cantidad = $(this).val();
                //  var action = 'checar_disponibles';
                //console.log(opcion);
                $.ajax({
                    type: "GET",
                    url: "checar_disponibles.php",
                    data: {

                        modulo: modulo,
                        ubicacion_actual: ubicacion_actual
                        //cantidad: cantidad
                    },
                    success: function(data) {
                        //console.log('entraaqui');
                        var datos = JSON.parse(data);


                        if (parseInt(datos[0].disponibles ?? 0) < parseInt(cantidad)) {

                            console.log('disponibles: ' + datos[0].disponibles);
                            $(this).closest('.envios').find('.message').html("La cantidad solicitada es mayor a la disponible");

                            alert("La cantidad solicitada es mayor a la disponible");
                            $(this).val("");

                        } else {

                            //console.log('Cantidad: '+cantidad);
                            $(this).closest('.envios').find('.message').html("hay disponibles");
                            //alert("hay " + datos[0].disponibles + " disponibles");
                        }
                    }
                });

            });
            //selecciono el tipo
            $(document).ready(function() {
                $("#ordenes").empty();
                $("#tipo").change(function() {
                    console.log('tipo');
                    var opcion = $(this).val();
                    //console.log(opcion);
                    $.ajax({
                        type: "GET",
                        url: "datos.php",
                        data: {
                            opcion: opcion
                        },
                        success: function(data) {
                            try {
                                var datos = JSON.parse(data);

                                $("#ordenes").empty();
                                $("#ordenes").append('<option value="">Seleccione</option>');
                                for (var i = 0; i < datos.length; i++) {
                                    $("#ordenes").append("<option value=" + datos[i].Id + ">" + "De " + datos[i].ubicacion + " a " + datos[i].envioa + " - " + datos[i].fecha + "</option>");
                                }

                            } catch (error) {
                                $("#ordenes").empty();
                                console.error("Error al parsear la cadena JSON: " + error.message);
                            }

                        }
                    });
                });

                /*      $("#ordenes").change(function() {

                          var orden = $(this).val();

                          $(".linea").empty();
                          $.ajax({
                              type: "GET",
                              url: "datos.php",
                              data: {
                                  orden: orden,
                                  tipo: $("#tipo").val()

                              },
                              success: function(data) {
                                  var datos = JSON.parse(data);

                                  $(".envios").empty();

                                  for (var i = 0; i <= datos.length; i++) {
                                      $(".envios").append('<div class="linea col-md-12 col-lg-12 mb-1"><div class="form-row"><div class="col-md-6 col-lg-6 mb-1">' + datos[i].titulo + '<input type="hidden" id="modulos[]" name="modulos[]" class="modulos" value="' + datos[i].id + '"></div><div class="col-md-6 col-lg-3 mb-1">' + datos[i].cantidad + '<input type="hidden" name="cantidad[]" id="cantidad[]" class="cantidad" value="' + datos[i].cantidad + '"></div><div class="col-md-6 col-lg-3 mb-1"><div class="form-row"><div class="col-md-6 col-lg-3 mb-1" style="margin-left:30px"><input type="radio" class="form-check-input" name="recibio_completo' + i + '" value="si" checked><label for="recibio_completo' + i + '">Si</label></div><div class="col-md-6 col-lg-3 mb-1"><input type="radio" class="form-check-input" name="recibio_completo' + i + '" value="no"><label for="recibio_completo' + i + '">No</label></div></div></div></div></div>');
                                  }
                              }
                          });
                      });*/
                //para cambiar el valor del campo ubicacion actual
                $("#ordenes").change(function() {
                    //console.log('ordenes2');
                    var orden = $(this).val();
                    //console.log(opcion);
                    $.ajax({
                        type: "GET",
                        url: "datos_ubicacion.php",
                        data: {
                            // ubic_actual: true,
                            orden: orden,
                            tipo: $("#tipo").val()
                        },
                        success: function(data) {
                            var dato = JSON.parse(data);
                            console.log('aqui cambia selecciona la ubicacion actual');
                            $("#ubicacion_actual").val(dato[0].envioa);
                            $("#fechaorden").val(dato[0].fecha);
                            $("#usuarioenvia").val(dato[0].usuarioenvia);
                            $("#usuariorecibe").val(dato[0].usuariorecibe);
                            $("#ubicacion_envio").val(dato[0].ubicacion);
                            $("#envioa").val(dato[0].envioa);
                        }

                    });

                });
                //--------------------

                $("#ordenes").change(function() {
                    var orden = $(this).val();
                    // console.log('ubicacion: '+$("#ubicacion_actual").val());
                    $.ajax({
                        type: "GET",
                        url: "datos.php",
                        data: {
                            orden: orden,
                            tipo: $("#tipo").val()
                        },
                        success: function(data) {
                            var datos = JSON.parse(data);
                            $(".envios").empty();
                            $(".envios").append('<div class="col-md-6 col-lg-6 mb-2"><label for="modulos">Módulo</label></div><div class="col-md-6 col-lg-3 mb-2"><label for="cantidad">Cantidad</label></div><div class="col-md-6 col-lg-3 mb-2"><label for="cantidad">Técnico docente</label></div></div>');

                            for (var i = 0; i <= datos.length; i++) {
                                $(".envios").append('<div class="col-md-12 col-lg-12 mb-1"><div class="form-row"><div class="col-md-6 col-lg-5 mb-1">' + datos[i].titulo + '<input type="hidden"  id="modulos[]" name="modulos[]" class="modulos" value="' + datos[i].id + '"></div><div class="col-md-6 col-lg-2 mb-1"><input type="number"  id="cantidad[]" name="cantidad[]" class="cantidad form-control" value="' + datos[i].cantidad + '"></div><div class="col-md-6 col-lg-5 mb-1"><div class="form-row"><div class="col-md-6 col-lg-10 mb-1" style="margin-left:30px"><select id="tecnico_docente[]" name="tecnico_docente[]" class="form-control"><option>seleccione</option></select></div></div></div></div></div>');

                                $.ajax({
                                    type: "GET",
                                    url: "datos_tecnico_docente.php",
                                    data: {
                                        ubicacion: $("#ubicacion_actual").val()
                                    },
                                    success: function(dataTecnico) {
                                        var datosTecnico = JSON.parse(dataTecnico);
                                        $('.envios select[name="tecnico_docente[]"]').each(function() {
                                            var selectTecnico = $(this);
                                            selectTecnico.empty();
                                            selectTecnico.append('<option>seleccione</option>');
                                            for (var j = 0; j < datosTecnico.length; j++) {
                                                selectTecnico.append('<option value="' + datosTecnico[j].id + '">' + datosTecnico[j].nombre + '</option>');
                                            }
                                        });

                                    }
                                });
                            }
                        }
                    });
                });

                //--------------------

            });
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

        if (isset($_POST['ubicacion_actual'])) {
            // hacer algo con $array['ubicacion_envio']
            $ubicacion = $_POST['ubicacion_actual'];
        } else {
            // asignar un valor predeterminado
            $ubicacion = '';
        }
        if (isset($_POST['ubicacion_envio'])) {
            // hacer algo con $array['ubicacion_envio']
            $ubicacion_envio = $_POST['ubicacion_envio'];
        } else {
            // asignar un valor predeterminado
            $ubicacion_envio = '';
        }
        $fecha_actual = $_POST['fecha'];
        $tipo = $_POST['tipo'];
        $orden = $_POST['ordenes'];
        $ubicacion = $_POST['ubicacion_actual'];
        $testigo = $_POST['testigo'];

        $modulos = $_POST['modulos'];
        $cantidad = $_POST['cantidad'];
        $tecnico = $_POST['tecnico_docente'];



        // echo 'envioa' . $ubicacion_envio . '<br>';


        $fecha = date("Y-m-d H:i:s");
        //$ubicacion_bodega = 7; //bodega grande

        /* var_dump($modulos);
        var_dump($tecnico);
        var_dump($cantidad);*/

        if (isset($modulos) && is_array($modulos) && isset($tecnico) && is_array($tecnico) && isset($cantidad) && is_array($cantidad)) {

            //if (isset($modulos) and is_array($modulos)) {
            //header de envio inserto el registro
            $query = "INSERT INTO header_asignacion_modulos (fecha,usuario,ubicacion,fechaasignacion,orden,tipo,testigo) values('$fecha',$usuario,'$ubicacion','$fecha_actual','$orden','$tipo','$testigo')";
            //echo 'query insert ' . $query . '<br>';
            $verificar = $conexion->query($query);
            if (!$verificar) {
                echo "Error en la consulta 1: " . $conexion->$error;
            }
            $last_id = $conexion->insert_id;
            $Id_asig = $last_id;

            foreach ($modulos as $key => $value) {
                //asignar los modulos que se recibieron
                $tec = $tecnico[$key];
                $cant = $cantidad[$key];
                // if ($tecnico > 0) {
                $querydetalle = "INSERT INTO asignacion_modulos (Id_hasignacion,titulo,cantidad,tecnico) values($Id_asig,$value,$cantidad[$key],$tecnico[$key])";
                echo  $querydetalle . "<br/>";
                $verificar3 = $conexion->query($querydetalle);
                //}
            }
        } else {
            echo '<script>alert("Por favor ingrese un valor válido en todos los campos");</script>';
        }
        if ($verificar && $verificar3) {
            echo '<script>
                    swal({
                    title: "Operación exitosa",
                    text: "La asignación de módulos fue registrada correctamente!",
                    type: "success",
                    showCancelButton: true,
                    cancelButtonClass: "btn-warning",
                    cancelButtonText: "Registrar",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Ver asignaciones",
                    closeOnConfirm: false
                  },
                  function(isConfirm) {
                      if (isConfirm) {
                        window.location="/biblioteca/reportes/asignaciones.php";
                      } else {
                        window.location="registro.php";
                      }
                    });
                    </script>';
        } else {

            echo '<script>
                    swal({
                    title: "Operación fallida",
                    text: "Ocurrio un error al registrar la asignación de módulos!",
                    type: "error",
                    showCancelButton: true,
                    cancelButtonClass: "btn-warning",
                    cancelButtonText: "Intentar de nuevo",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "ok",
                    closeOnConfirm: false
                  },
                  function(isConfirm) {
                      if (isConfirm) {
                        window.location="registro.php";
                      } else {
                        window.location="registro.php";
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