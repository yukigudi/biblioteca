<?php
include('../menu.php');
session_start();
$id = $_SESSION['Id_usuario'];
$usuario = $id;
if ($id == null || $id == '') {
    header("location:../index.php");
}
require_once("../conexion/conexion.php");
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
                            <!--  <li class="nav-item">
                                <a data-toggle="modal" data-target="#exampleModalScrollable1" class="text-white h5 nav-link" href="#" title="Nuestra empresa"><i class="mr-2 icofont-building-alt"></i></a>
                            </li>

                            <li class="nav-item">
                                <a data-toggle="modal" data-target="#exampleModalScrollable" class="text-white h5 nav-link" href="#" title="Contactanos"><i class="mr-2 icofont-search-map"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="text-white h5 nav-link" href="../inicio.php"><i class="icofont-ui-home" title="Inicio"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="../prestamos/pendientes.php" class="text-white h5 nav-link" href="#"><i class="icofont-notification" title="Notificaciones"><span style="position: relative; top: -8px;" class="bg-warning badge count">
                                      <?php
                                        /*   require_once("../conexion/conexion.php");
                                        $buscar_pend="SELECT COUNT(Id_prestamo) AS numero FROM prestamos WHERE Fecha_devolucion<NOW() AND Estatus='Pendiente'";
                                        $confirmar=$conexion->query($buscar_pend);
                                        $rows=$confirmar->fetch_assoc();
                                        echo $rows['numero'];;*/
                                        ?>
                                </span></i></a>
                            </li>-->
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
        <div class="container">
            <br><br><br><br>
            <br>
            <div class="bg-white rounded-lg formulario">
                <form class="p-4 needs-validation" action="registrar_retorno.php" method="POST" novalidate>
                    <div id="lineas">
                        <center><label for="">
                                <h4>REGISTRAR RETORNO DE MODULOS</h4>
                            </label></center>
                        <div class="form-row">
                            <div class="col-md-6 col-lg-3 mb-4">
                                <label for="validationCustom02">Ubicación Actual</label>
                                <select id="ubicacion_actual" name="ubicacion_actual" class="form-control" required>
                                    <?php

                                    $query = "SELECT * FROM ubicaciones order by tipo desc, Id_ubicacion desc";

                                    $resultado = $conexion->query($query);
                                    $p_open = false;
                                    echo '<optgroup label="Delegación">';
                                    if ($resultado->num_rows > 0) {
                                        while ($fila = $resultado->fetch_assoc()) {
                                            if ($fila['tipo'] == 'd') {
                                                echo '<option value="' . $fila['Id_ubicacion'] . '">' . $fila['nombre_lugar'] . '</option>';
                                            } else if ($fila['tipo'] == 'cz') {
                                                if (!$p_open) { // si no se ha abierto el optgroup de plazas
                                                    echo '</optgroup>';
                                                    echo '<optgroup label="Coordinación de Zona">';
                                                    $p_open = true; // se indica que se abrió el optgroup de plazas
                                                }
                                                echo '<option value="' . $fila['Id_ubicacion'] . '">' . $fila['nombre_lugar'] . '</option>';
                                            }
                                        }
                                    } ?>
                                    </optgroup>
                                </select>
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-4">
                                <label for="regresara">Regresar a</label>
                                <select id="regresara" name="regresara" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <?php
                                    $query = "SELECT * FROM ubicaciones where tipo='r'";
                                    $resultado = $conexion->query($query);
                                    if ($resultado->num_rows > 0) {
                                        while ($fila = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $fila['Id_ubicacion']; ?>">
                                                <?php echo $fila['nombre_lugar']; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label for="fecha_actual">Fecha actual</label>
                                <input type="date" class="form-control" id="fecha_actual" name="fecha" value="<?php echo date("Y-m-d") ?>" required>
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-3">
                                <label for="usuario_recibe">Destinatario</label>
                                <select id="usuario_recibe" name="recibe" class="form-control" required>
                                    <option value="">Selecciona</option>
                                    <?php

                                    $query = "SELECT * FROM usuarios";

                                    $resultado = $conexion->query($query);
                                    if ($resultado->num_rows > 0) {
                                        while ($fila = $resultado->fetch_assoc()) { ?>
                                            <option value="<?php echo $fila['Id_usuario']; ?>">
                                                <?php echo $fila['Nombre_usuario']; ?></option>
                                    <?php }
                                    } ?>

                                </select>
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-3">
                                <label for="testigo">Testigo</label>
                                <input type="text" class="form-control" id="testigo" name="testigo" required>
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
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
                        </div>

                        <!-- <div class="form-row envios">
                            <div class="col-md-8 col-lg-8 mb-4">
                                <label for="modulos">Módulo</label>
                                <select id="modulos[]" name="modulos[]" class="form-control modulos" required>
                                </select>
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-4">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" maxlength="4" pattern="^\d{1,3}$" class="form-control cantidad" id="cantidad[]" name="cantidad[]" required>
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>

                        </div>-->
                        <div class="form-row envios">
                        </div>
                    </div>
                    <!-- <div class="form-row">
                        <div class="col-md-6 col-lg-9 mb-4">
                            <hr>
                        </div>
                        <div onclick="agregarLinea()" class="col-md-6 col-lg-3 mb-4"><i class="icofont-plus-square"></i> Agregar Módulo
                        </div>
                    </div>-->
                    <button class="btn btn-warning text-white" type="submit" name="registrar" onClick='contarCampos()'>Registrar</button>
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
        $ubicacion = $_POST['ubicacion_actual'];
        $regresara = $_POST['regresara'];
        $recibe = $_POST['recibe'];
        $testigo = $_POST['testigo'];
        $fecha_actual = $_POST['fecha'];
        $modulos = $_POST['modulos'];
        $cantidad = $_POST['cantidad'];
        $fecha = date("Y-m-d H:i:s");
        $fechaactual = date("Y-m-d");

        if (isset($modulos) and is_array($modulos)) {
            //header de retorno

            $query = "INSERT INTO header_retorno_modulos (fecha,usuario,ubicacion,envioa,fechaenvio,recibe,testigo) values('$fecha',$usuario,'$ubicacion','$regresara','$fecha_actual',$recibe,'$testigo')";
            // echo  $query . "<br/>";

            $verificar = $conexion->query($query);
            $last_id = $conexion->insert_id;
            $id_envio = $last_id;
            foreach ($modulos as $key => $value) {
                $querydetalle = "INSERT INTO retorno_modulos (Id_hretorno, titulo, cantidad) VALUES ($id_envio, $value, $cantidad[$key])";
                $verificar2 = $conexion->query($querydetalle);

                $query = "SELECT cantidad, ubicacion_Id FROM ubicaciones_modulos WHERE ubicacion_Id IN ($ubicacion, $regresara) AND modulo_Id = $value AND cantidad > 0";
                $resultado = $conexion->query($query);
                // echo 'checa este query: ' . $query;
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        $cantidad_actualizada = $fila['cantidad'] - $cantidad[$key];
                        if ($fila['ubicacion_Id'] == $ubicacion) {
                            //aqui checa si hay registro de la ubicacionactual
                            $querydetalle4 = "UPDATE ubicaciones_modulos SET cantidad = $cantidad_actualizada, fecha='$fechaactual' WHERE ubicacion_Id = $ubicacion AND modulo_Id = $value";
                            $verificar4 = $conexion->query($querydetalle4);
                            echo '302querydetalle4 ' . $querydetalle4 . '<br>';
                            if (!$verificar4) {
                                echo "Error en la consulta: " . $conexion->error;
                            }
                        } /*else {
                            echo '307querydetalle3 inserta ' . $querydetalle3 . '<br>';
                            $querydetalle3 = "INSERT INTO ubicaciones_modulos (modulo_Id, ubicacion_Id, cantidad, fecha) VALUES ($value, $ubicacion, $cantidad[$key], '$fecha_actual')";
                            $verificar3 = $conexion->query($querydetalle3);
                        }*/

                        if ($fila['ubicacion_Id'] == $regresara) {
                            //aqui encuentra -  $regresara 
                            $cantidad_nueva = $fila['cantidad'] + $cantidad[$key];
                            $querydetalle3 = "UPDATE ubicaciones_modulos SET cantidad = $cantidad_nueva, fecha='$fechaactual' WHERE ubicacion_Id = $regresara AND modulo_Id = $value";
                            $verificar3 = $conexion->query($querydetalle3);
                            echo '317querydetalle3 ' . $querydetalle3 . '<br>';
                            if (!$verificar3) {
                                echo "Error en la consulta: " . $conexion->error;
                            }
                        } /*else {
                            echo '322querydetalle3 inserta ' . $querydetalle3 . '<br>';
                            $querydetalle3 = "INSERT INTO ubicaciones_modulos (modulo_Id, ubicacion_Id, cantidad, fecha) VALUES ($value, $regresara, $cantidad[$key], '$fecha_actual')";
                            $verificar3 = $conexion->query($querydetalle3);
                        }*/
                    }
                }
            }
        } else {
            echo 'no es';
        }
        if ($verificar && $verificar2 && $verificar3 && $verificar4) {
            echo '<script>
                        swal({
                        title: "Operación exitosa",
                        text: "El retorno de módulos fue registrado correctamente!",
                        type: "success",
                        showCancelButton: true,
                        cancelButtonClass: "btn-warning",
                        cancelButtonText: "Registrar",
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Ver retornos",
                        closeOnConfirm: false
                      },
                      function(isConfirm) {
                          if (isConfirm) {
                            window.location="/biblioteca/reportes/devoluciones.php";
                          } else {
                            window.location="registrar_retorno.php";
                          }
                        });
                        </script>';
        } else {
            echo '<script>
                        swal({
                        title: "Operación fallida",
                        text: "Ocurrio un error al registrar el retorno de módulos!",
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
                            window.location="registrar_retorno.php";
                          } else {
                            window.location="registrar_retorno.php";
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
                    <p class="text-white pt-3"><small><b><br />Copyright &copy; 2023 </b>ISEJA Control de módulos todos los
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
        //selecciona ubicacion actual
        $(document).ready(function() {
            $("#ubicacion_actual").change(function() {
                //console.log('jenjwnkrnewnr');
                var ubicacion_actual = $(this).val();
                //console.log(opcion);
                $.ajax({
                    type: "GET",
                    url: "datos_ubicacion.php",
                    data: {
                        ubicacion_actual: ubicacion_actual
                    },
                    success: function(data) {
                        //  console.log('wiiiiii');
                        var datos = JSON.parse(data);

                        $(".modulos").empty();
                        $(".modulos").append('<option value="">Seleccione</option>');
                        for (var i = 0; i < datos.length; i++) {
                            $(".modulos").append("<option value=" + datos[i].id + ">" + datos[i].titulo + "</option>");
                        }

                    }
                });
            });
        });
        //valida que un modulo no se seleccione 2 veces
        $(document).on('change', '.envios .modulos', function() {
            var moduloSeleccionado = $(this).val();
            var modulosEnUso = $('.envios .modulos').not(this).map(function() {
                return $(this).val();
            }).get();
            if (modulosEnUso.includes(moduloSeleccionado)) {
                alert("Este módulo ya ha sido seleccionado, por favor selecciona otro.");
                $(this).val("");
            }
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
        //selecciono la ubicacion
        $(document).ready(function() {
            $("#ordenes").empty();
            $("#ubicacion_actual").change(function() {
                console.log('ubicacion_actual');
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
                                $("#ordenes").append("<option value=" + datos[i].Id + ">" + "De " + datos[i].envioa + " a " + datos[i].ubicacion + " - " + datos[i].fecha + "</option>");
                            }

                        } catch (error) {
                            $("#ordenes").empty();
                            console.error("Error al parsear la cadena JSON: " + error.message);
                        }

                    }
                });
            });

            $("#ordenes").change(function() {
                console.log('entra aquidfgfgdgfdggd');
                var orden = $(this).val();

                $(".linea").empty();
                $.ajax({
                    type: "GET",
                    url: "datos.php",
                    data: {
                        orden: orden,
                        // tipo: $("#tipo").val()

                    },
                    success: function(data) {
                        var datos = JSON.parse(data);

                        $(".envios").empty();

                        $(".envios").append('<div class="col-md-12 col-lg-12 mb-2 text-right incidencia" id="incidencia" name="incidencia" style="display:none">Si los modulos y sus cantidades no concuerdan con lo recibido fisicamente favor de<p onclick="registraIncidencia()"> <label style="font-weight:bold;" for="incidencias">Registrar una incidencia</label></p>.</div><div class="col-md-6 col-lg-6 mb-2"><label for="modulos">Módulo</label></div><div class="col-md-6 col-lg-3 mb-2"><label for="cantidad">Cantidad</label></div><div class="col-md-6 col-lg-3 mb-2"></div></div>');

                        for (var i = 0; i <= datos.length; i++) {
                            $(".envios").append('<div class="linea col-md-12 col-lg-12 mb-1"><div class="form-row"><div class="col-md-6 col-lg-6 mb-1">' + datos[i].titulo + '<input type="hidden" id="modulos[]" name="modulos[]" class="modulos" value="' + datos[i].id + '"></div><div class="col-md-6 col-lg-3 mb-1">' + datos[i].cantidad + '<input type="hidden" name="cantidad[]" id="cantidad[]" class="cantidad" value="' + datos[i].cantidad + '"></div><div class="col-md-6 col-lg-3 mb-1"><div class="form-row"> </div> </div> </div> </div>');
                        }
                    }
                });
            });
        });

        //para cambiar el valor del campo ubicacion actual
        $("#ordenes").change(function() {

            console.log('ordenes2');
            var orden = $(this).val();
            //console.log(opcion);
            $.ajax({
                type: "GET",
                url: "datos_ubicacion.php",
                data: {
                    // ubic_actual: true,
                    orden: orden,
                    // tipo: $("#tipo").val()
                },
                success: function(data) {
                    var dato = JSON.parse(data);
                    console.log('aqui cambia selecciona la ubicacion actual');
                    $("#regresara").val(dato[0].envioa);
                    console.log(dato[0].envioa);
                    /*$("#ubicacion_actual").val(dato[0].envioa);
                    $("#fechaorden").val(dato[0].fecha);
                    $("#usuarioenvia").val(dato[0].usuarioenvia);
                    $("#usuariorecibe").val(dato[0].usuariorecibe);
                    $("#ubicacion_envio").val(dato[0].ubicacion);
                    $("#envioa").val(dato[0].envioa);*/
                }

            });

        });
        //--------------------
        function contarCampos() {
            var $c = $('.envios').length;
            console.log('son: ' + $c);
        }

        $(document).on('change', '.cantidad', function() {
            //hace una consulta a la base de datos para mostrar si la cantidad solicitada esta disponible
            var ubicacion_actual = $('#ubicacion_actual').val();
            var modulo = $(this).closest('.envios').find('.modulos').val();
            console.log('ubicacion actual:' + ubicacion_actual);
            var cantidad = $(this).val();
            var action = 'checar_disponibles';
            //console.log(opcion);
            $.ajax({
                type: "GET",
                url: "checar_disponibles.php",
                data: {
                    //action: action,
                    ubicacion_actual: ubicacion_actual,
                    modulo: modulo,
                    //cantidad: cantidad
                },
                success: function(data) {
                    //console.log('entraaqui');
                    var datos = JSON.parse(data);
                    console.log('datos: ' + datos[0].disponibles);
                    //console.dir(datos);
                    if (parseInt(datos[0].disponibles ?? 0) < parseInt(cantidad)) {
                        // console.log('disponibles: '+datos.disponibles);
                        $(this).closest('.envios').find('.message').html("La cantidad solicitada es mayor a la disponible");
                        //console.log('data: '+data);

                        $(this).val(""); // Limpiar el valor del campo dinámico

                        setTimeout(function() {
                            alert("La cantidad solicitada es mayor a la disponible");
                            // Mostrar la alerta después de 100 milisegundos
                        }, 100);


                    } else {
                        //console.log('Cantidad: '+cantidad);
                        //console.log('data: '+data);
                        $(this).closest('.envios').find('.message').html("hay disponibles");
                        //alert("hay " + datos[0].disponibles + " disponibles");
                    }
                }
            });

        });
    </script>

</body>

</html>