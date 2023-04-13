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
                                <h4>REGISTRAR RECIBO DE MODULOS</h4>
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
                            <!--          <div class="col-md-6 col-lg-3 mb-4">
                                <label for="validationCustom02">Regresar a</label>
                                <select id="regresara" name="regresara" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <?php

                                    /* $query = "SELECT * FROM ubicaciones_resguardo";

                                    $resultado = $conexion->query($query);
                                    if ($resultado->num_rows > 0) {
                                        while ($fila = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $fila['Id_resguardo']; ?>">
                                                <?php echo $fila['nombre_lugar']; ?></option>
                                    <?php }
                                    } */ ?>
                                </select>
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>-->
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
            // agregar evento change a los elementos de radio
            /*$(document).on('change', 'input[name^="recibio_completo"]', function() {
                console.log('entra aqui recibio completo');
                // obtener el valor seleccionado
                var valor = $(this).val();
                // si el valor es "no", mostrar el div de mensaje correspondiente
                if (valor === "no") {
                    console.log('NO entra aqui recibio completo');
                    $(this).closest(".envios").next(".incidencia").show();
                } else {
                    console.log('SI entra aqui recibio completo');
                    $(this).closest(".envios").next(".incidencia").hide();
                }
            });*/

            var contador = 0;
            $(document).on('change', 'input[name^="recibio_completo"]', function() {
                var valor = $(this).val();
                var mensaje = $(".incidencia");
                if (valor === "no") {
                    console.log('1');
                    contador++;
                    if (contador === 1) {
                        console.log('2');
                        console.log(mensaje);
                        mensaje.show();
                        mensaje.attr("data-visible", "true");
                    }
                } else {
                    contador--;
                    if (contador === 0) {
                        mensaje.hide();
                        mensaje.attr("data-visible", "false");
                    }
                }
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

                $("#ordenes").change(function() {

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

                            $(".envios").append('<div class="col-md-12 col-lg-12 mb-2 text-right incidencia" id="incidencia" name="incidencia" style="display:none">Si los modulos y sus cantidades no concuerdan con lo recibido fisicamente favor de<p onclick="registraIncidencia()"> <label style="font-weight:bold;" for="incidencias">Registrar una incidencia</label></p>.</div><div class="col-md-6 col-lg-6 mb-2"><label for="modulos">Módulo</label></div><div class="col-md-6 col-lg-3 mb-2"><label for="cantidad">Cantidad</label></div><div class="col-md-6 col-lg-3 mb-2"><label for="cantidad">¿Recibió completo?</label></div></div>');

                            for (var i = 0; i <= datos.length; i++) {
                                $(".envios").append('<div class="linea col-md-12 col-lg-12 mb-1"><div class="form-row"><div class="col-md-6 col-lg-6 mb-1">' + datos[i].titulo + '<input type="hidden" id="modulos[]" name="modulos[]" class="modulos" value="' + datos[i].id + '"></div><div class="col-md-6 col-lg-3 mb-1">' + datos[i].cantidad + '<input type="hidden" name="cantidad[]" id="cantidad[]" class="cantidad" value="' + datos[i].cantidad + '"></div><div class="col-md-6 col-lg-3 mb-1"><div class="form-row"><div class="col-md-6 col-lg-3 mb-1" style="margin-left:30px"><input type="radio" class="form-check-input" name="recibio_completo' + i + '" value="si" checked><label for="recibio_completo' + i + '">Si</label></div><div class="col-md-6 col-lg-3 mb-1"><input type="radio" class="form-check-input" name="recibio_completo' + i + '" value="no"><label for="recibio_completo' + i + '">No</label></div></div></div></div></div>');
                            }
                        }
                    });
                });
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
                            $(".envios").append('<div class="col-md-12 col-lg-12 mb-2 text-right incidencia" id="incidencia" name="incidencia" style="display:none">Si los módulos y sus cantidades no concuerdan con lo recibido físicamente favor de<p onclick="registraIncidencia()"> <label style="font-weight:bold;" for="incidencias">Registrar una incidencia</label></p>.</div><div class="col-md-6 col-lg-6 mb-2"><label for="modulos">Módulo</label></div><div class="col-md-6 col-lg-3 mb-2"><label for="cantidad">Cantidad</label></div><div class="col-md-6 col-lg-3 mb-2"><label for="cantidad">¿Recibió completo?</label></div></div>');

                            for (var i = 0; i <= datos.length; i++) {
                                $(".envios").append('<div class="col-md-12 col-lg-12 mb-1"><div class="form-row"><div class="col-md-6 col-lg-6 mb-1">' + datos[i].titulo + '<input type="hidden"  id="modulos[]" name="modulos[]" class="modulos" value="' + datos[i].id + '"></div><div class="col-md-6 col-lg-3 mb-1">' + datos[i].cantidad + '<input type="hidden"  id="cantidad[]" name="cantidad[]" class="cantidad" value="' + datos[i].cantidad + '"></div><div class="col-md-6 col-lg-3 mb-1"><div class="form-row"><div class="col-md-6 col-lg-3 mb-1" style="margin-left:30px"><input type="radio" class="form-check-input" name="recibio_completo' + i + '" value="si" checked><label for="recibio_completo' + i + '">Si</label></div><div class="col-md-6 col-lg-3 mb-1"><input type="radio" class="form-check-input" name="recibio_completo' + i + '" value="no"><label for="recibio_completo' + i + '">No</label></div></div></div></div></div>');
                            }
                            $("#envioa").val(datos[0].envioa);
                            console.log(datos[0].envioa);
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
        //require_once("../conexion/conexion.php");
        // $ubicacion = $_POST['ubicacion_actual'];
        if (isset($_POST['ubicacion_actual'])) {
            // hacer algo con $array['ubicacion_envio']
            $ubicacion = $_POST['ubicacion_actual'];
        } else {
            // asignar un valor predeterminado
            $ubicacion = '';
        }
        //$regresara = $_POST['regresara'];
        // $recibe = $_POST['recibe'];
        $testigo = $_POST['testigo'];
        $fecha_actual = $_POST['fecha'];
        $modulos = $_POST['modulos'];
        $cantidad = $_POST['cantidad'];
        $orden = $_POST['ordenes'];
        //$ubicacion_envio = $_POST['envioa'];
        //$recibecompleto = $_POST['recibio_completo'];
        $tipo = $_POST['tipo'];
        if (isset($_POST['ubicacion_envio'])) {
            // hacer algo con $array['ubicacion_envio']
            $ubicacion_envio = $_POST['ubicacion_envio'];
        } else {
            // asignar un valor predeterminado
            $ubicacion_envio = '';
        }

        echo 'envioa' . $ubicacion_envio . '<br>';


        $fecha = date("Y-m-d H:i:s");
        //$ubicacion_bodega = 7; //bodega grande

        if (isset($modulos) and is_array($modulos)) {
            //header de envio inserto el registro

            $query = "INSERT INTO header_recibido_modulos (fecha,usuario,ubicacion_actual,fechaenvio,orden,tipo,testigo) values('$fecha',$usuario,'$ubicacion','$fecha_actual','$orden','$tipo','$testigo')";
            //echo 'querydetalle3 ' . $query . '<br>';
            $verificar = $conexion->query($query);
            if (!$verificar) {
                echo "Error en la consulta 1: " . $conexion->$error;
            }
            $last_id = $conexion->insert_id;
            $Id_recibido = $last_id;
            foreach ($modulos as $key => $value) {

                $recibecompleto_valor = isset($_POST['recibio_completo' . $key]) ? ($_POST['recibio_completo' . $key] == 'si' ? 1 : 0) : 0;
                //inserta los modulos que se recibieron
                $querydetalle = "INSERT INTO recibido_modulos (Id_hrecibido,titulo,cantidad,recibecompleto) values($Id_recibido,$value,$cantidad[$key],$recibecompleto_valor)";
                //echo  $querydetalle . "<br/>";
                $verificar3 = $conexion->query($querydetalle);

                if ($recibecompleto_valor == 1) {
                    //checar si existe en la ubicacion
                    $query = "SELECT cantidad, ubicacion_Id FROM ubicaciones_modulos WHERE ubicacion_Id IN ($ubicacion, $ubicacion_envio) AND modulo_Id = $value AND cantidad > 0";
                    echo $query . "</br>";
                    $resultado = $conexion->query($query);

                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {

                            $cantidad_actualizada = $fila['cantidad'] - $cantidad[$key];
                            if ($fila['ubicacion_Id'] == $ubicacion_envio) {
                                //aqui checa si hay registro de la ubicacionactual
                                $querydetalle4 = "UPDATE ubicaciones_modulos SET cantidad = $cantidad_actualizada, fecha='$fecha_actual' WHERE ubicacion_Id = $ubicacion AND modulo_Id = $value ";
                                $verificar4 = $conexion->query($querydetalle4);
                                echo 'querydetalle4 ' . $querydetalle4 . '<br>';
                                if (!$verificar4) {
                                    echo "Error en la consulta: " . $conexion->error;
                                }
                            } else {
                                $querydetalle3 = "INSERT INTO ubicaciones_modulos (modulo_Id, ubicacion_Id, cantidad, fecha) VALUES ($value, $ubicacion_envio, $cantidad[$key], '$fecha_actual')";
                                $verificar3 = $conexion->query($querydetalle3);
                                echo 'querydetalle3 ' . $querydetalle3 . '<br>';
                            }

                            if ($fila['ubicacion_Id'] == $ubicacion) {
                                //aqui encuentra -  $regresara 
                                $cantidad_nueva = $fila['cantidad'] + $cantidad[$key];
                                $querydetalle3 = "UPDATE ubicaciones_modulos SET cantidad = $cantidad_nueva, fecha='$fecha_actual' WHERE ubicacion_Id = $ubicacion AND modulo_Id = $value";
                                $verificar3 = $conexion->query($querydetalle3);
                                echo 'querydetalle3 ' . $querydetalle3 . '<br>';
                                if (!$verificar3) {
                                    echo "Error en la consulta: " . $conexion->error;
                                }
                            } else {
                                $querydetalle3 = "INSERT INTO ubicaciones_modulos (modulo_Id, ubicacion_Id, cantidad, fecha) VALUES ($value, $ubicacion, $cantidad[$key], '$fecha_actual')";
                                $verificar3 = $conexion->query($querydetalle3);
                                echo 'querydetalle3 ' . $querydetalle3 . '<br>';
                            }
                        }
                    }
                }
            }

            /*  foreach ($modulos as $key => $value) {

                $recibecompleto_valor = isset($_POST['recibio_completo' . $key]) ? ($_POST['recibio_completo' . $key] == 'si' ? 1 : 0) : 0;
                //inserta los modulos que se recibieron
                $querydetalle = "INSERT INTO recibido_modulos (Id_hrecibido,titulo,cantidad,recibecompleto) values($Id_recibido,$value,$cantidad[$key],$recibecompleto_valor)";
                //echo  $querydetalle . "<br/>";
                $verificar3 = $conexion->query($querydetalle);

                //checar si existe en la ubicacion
                $query = "SELECT cantidad, ubicacion_Id FROM ubicaciones_modulos WHERE ubicacion_Id IN ($ubicacion, $ubicacion_envio) AND modulo_Id = $value AND cantidad > 0";
                echo $query . "</br>";
                $resultado = $conexion->query($query);

                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {

                        $cantidad_actualizada = $fila['cantidad'] - $cantidad[$key];
                        if ($fila['ubicacion_Id'] == $ubicacion_envio) {
                            //aqui checa si hay registro de la ubicacionactual
                            $querydetalle4 = "UPDATE ubicaciones_modulos SET cantidad = $cantidad_actualizada, fecha='$fecha_actual' WHERE ubicacion_Id = $ubicacion AND modulo_Id = $value ";
                            $verificar4 = $conexion->query($querydetalle4);
                            echo 'querydetalle4 ' . $querydetalle4 . '<br>';
                            if (!$verificar4) {
                                echo "Error en la consulta: " . $conexion->error;
                            }
                        } else {
                            $querydetalle3 = "INSERT INTO ubicaciones_modulos (modulo_Id, ubicacion_Id, cantidad, fecha) VALUES ($value, $ubicacion_envio, $cantidad[$key], '$fecha_actual')";
                            $verificar3 = $conexion->query($querydetalle3);
                            echo 'querydetalle3 ' . $querydetalle3 . '<br>';
                        }

                        if ($fila['ubicacion_Id'] == $ubicacion) {
                            //aqui encuentra -  $regresara 
                            $cantidad_nueva = $fila['cantidad'] + $cantidad[$key];
                            $querydetalle3 = "UPDATE ubicaciones_modulos SET cantidad = $cantidad_nueva, fecha='$fecha_actual' WHERE ubicacion_Id = $ubicacion AND modulo_Id = $value";
                            $verificar3 = $conexion->query($querydetalle3);
                            echo 'querydetalle3 ' . $querydetalle3 . '<br>';
                            if (!$verificar3) {
                                echo "Error en la consulta: " . $conexion->error;
                            }
                        } else {
                            $querydetalle3 = "INSERT INTO ubicaciones_modulos (modulo_Id, ubicacion_Id, cantidad, fecha) VALUES ($value, $ubicacion, $cantidad[$key], '$fecha_actual')";
                            $verificar3 = $conexion->query($querydetalle3);
                            echo 'querydetalle3 ' . $querydetalle3 . '<br>';
                        }
                    }
                }
            }*/

            //se debe actualizar la tabla de envio ya que fue recibido para que no se reciba 2 veces?
            $querydetalle4 = "UPDATE header_envio_modulos set activo=0 where Id_henvio=$orden";
            $verificar4 = $conexion->query($querydetalle4);
            echo  $querydetalle4 . "<br/>";
        } else {
            echo 'no es: ' . $_POST['modulos'];
        }
        if ($verificar && $verificar3 && $verificar4) {
            echo '<script>
                    swal({
                    title: "Operación exitosa",
                    text: "El envio de módulos fue registrado correctamente!",
                    type: "success",
                    showCancelButton: true,
                    cancelButtonClass: "btn-warning",
                    cancelButtonText: "Registrar",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Ver Recibos",
                    closeOnConfirm: false
                  },
                  function(isConfirm) {
                      if (isConfirm) {
                        window.location="/biblioteca/reportes/recibidos.php";
                      } else {
                        window.location="registro.php";
                      }
                    });
                    </script>';
        } else {

            echo '<script>
                    swal({
                    title: "Operación fallida",
                    text: "Ocurrio un error al registrar el envio de módulos!",
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
    <script language="javascript">
        function contarCampos() {
            var $c = $('.envios').length;
            console.log($c);
        }

        function registraIncidencia() {
            // href="../incidencias/registrar_incidencias.php" target="_blank"
            $testigo = $('#testigo').val();
            $orden = $('#ordenes').val();
            $tipo = $('#tipo').val();
            $ubicacion_actual = $('#envioa').val();
            $regresara = $('#regresara').val();
            $fecha = $('#fechaorden').val();
            $usuarioenvia = $('#usuarioenvia').val();
            $usuariorecibe = $('#usuariorecibe').val();
            /*$nivel=$('#nivel').val();
            $material=$('#material').val();
            $estado=$('#estado').val();*/

            $filtros = "?testigo=" + $testigo + "&orden=" + $orden + "&tipo=" + $tipo + "&ubicacion_actual=" + $ubicacion_actual + "&regresara=" + $regresara + "&fechaorden=" + $fecha + "&usuarioenvia=" + $usuarioenvia + "&usuariorecibe=" + $usuariorecibe;
            window.open("../incidencias/registrar_incidencias.php" + $filtros, "Registro de Incidencia", "directories=no location=no");
        }
    </script>

</body>

</html>