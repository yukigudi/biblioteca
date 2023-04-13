<?php
session_start();
include('../menu.php');
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
                <form class="p-4 needs-validation" action="registrar_envio.php" method="POST" novalidate>
                    <div id="lineas">
                        <center><label for="">
                                <h4>REGISTRAR ENVIO</h4>
                            </label></center>
                        <div class="form-row">
                            <div class="col-md-6 col-lg-3 mb-4">
                                <label for="validationCustom02">Ubicación actual</label>
                                <select id="ubicacion_actual" name="ubicacion_actual" class="form-control" required>
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
                            <div class="col-md-6 col-lg-3 mb-4">
                                <label for="validationCustom02">Envío a</label>
                                <select id="envioa" name="envioa" class="form-control" required>
                                    <option value="">Selecciona</option>

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
                        </div>

                        <div class="form-row envios">
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
                                <input type="number" class="form-control cantidad" maxlength="4" pattern="^\d{1,3}$" id="cantidad[]" name="cantidad[]" required>
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>
                            <div class="message"></div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-6 col-lg-9 mb-4">
                            <hr>
                        </div>
                        <div onclick="agregarLinea()" class="col-md-6 col-lg-3 mb-4"><i class="icofont-plus-square"></i>
                            Agregar Módulo
                        </div>
                    </div>
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
        $envioa = $_POST['envioa'];
        $recibe = $_POST['recibe'];
        $testigo = $_POST['testigo'];
        $fecha_actual = $_POST['fecha'];
        $modulos = $_POST['modulos'];
        $cantidad = $_POST['cantidad'];
        $fecha = date("Y-m-d H:i:s");
        $fechaactual = date("Y-m-d");

        if (isset($modulos) and is_array($modulos)) {

            $query = "INSERT INTO header_envio_modulos (fecha,usuario,ubicacion,envioa,fechaenvio,recibe,testigo) values('$fecha',$usuario,'$ubicacion','$envioa','$fecha_actual',$recibe,'$testigo')";
            //echo  $query . "<br/>";

            $verificar5 = $conexion->query($query);
            if (!$verificar5) {
                echo "Error en la consulta 1: " . $conexion->$error;
            }
            $last_id = $conexion->insert_id;
            $Id_envio = $last_id;

            foreach ($modulos as $key => $value) {

                // Obtener la cantidad de módulos disponibles en la ubicación actual
                $query2 = "SELECT cantidad as disponibles FROM ubicaciones_modulos WHERE ubicacion_id = $ubicacion AND modulo_id = $value";
                 //echo $query . "<br/>";
                $resultado2 = $conexion->query($query2);
                $fila = $resultado2->fetch_assoc();
                $cantidad_disponible = $fila['disponibles'];

                // Actualizar la cantidad disponible en la ubicación actual
                $cantidad_actualizada = $cantidad_disponible - $cantidad[$key];
                $querydetalle = "UPDATE ubicaciones_modulos SET cantidad = $cantidad_actualizada,fecha='$fechaactual' WHERE ubicacion_id = $ubicacion AND modulo_id = $value";
                echo $querydetalle . "<br/>";
                $verificar2 = $conexion->query($querydetalle);
                if (!$verificar2) {
                    echo "Error en la consulta 2: " . $conexion->$error;
                }

                // Insertar el detalle del envío en la tabla envio_modulos
                $querydetalle4 = "INSERT INTO envio_modulos (Id_henvio, titulo, cantidad) VALUES ($Id_envio, $value, $cantidad[$key])";
                echo  $querydetalle4 . "<br/>";
                $verificar4 = $conexion->query($querydetalle4);
                if (!$verificar4) {
                    echo "Error en la consulta 4: " . $conexion->$error;
                }
            }
        } else {
            echo 'no es';
        }

        if ($verificar5 && $verificar2 && $verificar4) {
  
            echo '<script>
                    swal({
                    title: "Operación exitosa",
                    text: "El envio de módulos fue registrado correctamente!",
                    type: "success",
                    showCancelButton: true,
                    cancelButtonClass: "btn-warning",
                    cancelButtonText: "Registrar otro envío",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Ver envios",
                    closeOnConfirm: false
                  },
                  function(isConfirm) {
                      if (isConfirm) {
                        window.location="/biblioteca/reportes/envios.php";
                      } else {
                        window.location="registrar_envio.php";
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
                        window.location="registrar_envio.php";
                      } else {
                        window.location="registrar_envio.php";
                      }
                    });
                    </script>';
        }
    }

    // if (isset($_POST['action']) && $_POST['action'] == "disponibilidad_modulos") {
    //   echo 'si entra esta fregadera<br>' . $_POST['action'];
    //  echo $_POST['cantidad'] . 'nkdnasjndjk';
    //} else{
    //echo'no entra al action'.$_POST['action'];
    //}
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
        function agregarLinea() {
            //evento que hace que se llenen los selects con los libros
            var ubicacionActual = $("#ubicacion_actual").val();
            var $c = $('.envios').length;

            $('#lineas').append(
                '<div class="form-row envios"><div class="col-md-8 col-lg-8 mb-4"><select id="modulos[]" name="modulos[]" class="form-control modulos" required></select> <div class="valid-feedback"> Correcto! </div> <div class="invalid-feedback"> Porfavor rellena el campo.</div> </div><div class="col-md-6 col-lg-3 mb-4"><input type="number" maxlength="4" pattern="^\d{1,3}$" class="form-control cantidad" id="cantidad[]" name="cantidad[]" required><div class="valid-feedback">Correcto!</div><div class="invalid-feedback">Porfavor rellena el campo.</div></div><div class="message"></div></div>'
            );

            $.ajax({
                type: "GET",
                url: "datos_ubicacion.php",
                data: {
                    ubicacion_actual: ubicacionActual
                },
                success: function(data) {
                    //  console.log('wiiiiii');
                    var datos = JSON.parse(data);

                    // $(".modulos").empty();
                    $(".envios:last .modulos").append('<option value="">Seleccione</option>');
                    for (var i = 0; i < datos.length; i++) {
                        $('.envios:last .modulos').append("<option value=" + datos[i].id + ">" + datos[i].titulo + "</option>");
                    }

                }
            });

            console.log($c);
            // console.log('yeiiiiii');
        }

        function contarCampos() {
            var $c = $('.envios').length;
            console.log('son: ' + $c);
        }
        //Aun no funciona - checar
        // function checadisponibles() {
        $(document).on('change', '.cantidad', function() {
            //hace una consulta a la base de datos para mostrar si la cantidad solicitada esta disponible
            var ubicacion_actual = $('#ubicacion_actual').val();
            var modulo = $(this).closest('.envios').find('.modulos').val();
            console.log(modulo);
            var cantidad = $(this).val();
            var action = 'checar_disponibles';
            //console.log(opcion);
            $.ajax({
                type: "GET",
                url: "checar_disponibles.php",
                data: {
                    //action: action,
                    //ubicacion_actual: ubicacion_actual,
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
    </script>
</body>

</html>