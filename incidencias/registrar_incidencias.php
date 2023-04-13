<?php
include('../menu.php');
session_start();
$id = $_SESSION['Id_usuario'];
$usuario = $id;
if ($id == null || $id == '') {
    header("location:../index.php");
}
require_once("../conexion/conexion.php");

if (isset($_GET['testigo']) && ($_GET['testigo']) != "") {
    $testigo = $_GET['testigo'];
}

if (isset($_GET['tipo']) && ($_GET['tipo']) != "") {
    $tipo = $_GET['tipo'];
    if ($_GET['tipo'] == 'envio') {
        $opcion = 'envio_modulos';
        $campo = 'envio';
    } elseif ($_GET['tipo'] == 'devolucion') {
        $opcion = 'retorno_modulos';
        $campo = 'retorno';
    }
}
$tipos = array(
    'envio' => 'Envio',
    'devolucion' => 'Devolución'
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
    <input type="hidden" name="testigo" value="<?php echo $_GET['testigo']; ?>">
    <input type="hidden" name="orden" value="<?php echo $_GET['orden']; ?>">
    <input type="hidden" name="tipo" value="<?php echo $_GET['tipo']; ?>">
    <input type="hidden" name="ubicacion_actual" value="<?php echo $_GET['ubicacion_actual']; ?>">
    <input type="hidden" name="regresara" value="<?php echo $_GET['regresara']; ?>">
    <input type="hidden" name="fechaorden" value="<?php echo $_GET['fechaorden']; ?>">
    <input type="hidden" name="usuarioenvia" value="<?php echo $_GET['usuarioenvia']; ?>">
    <input type="hidden" name="usuariorecibe" value="<?php echo $_GET['usuariorecibe']; ?>">
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img width="45" height="45" src="../images/logo.png" alt="">
                <small><b class="ml-2">ISEJA</b> Control de módulos</small>
            </div>
            <?php   //menu();
            ?>
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
        <div class="container">
            <br><br><br><br>
            <br>
            <div class="bg-white rounded-lg formulario">
                <form class="p-4 needs-validation" action="registrar_incidencias.php" method="POST" novalidate>
                    <div id="lineas">
                        <center><label for="">
                                <h4>REGISTRAR INCIDENCIA</h4>
                            </label></center>
                        <div class="form-row">
                            <div class="col-md-2 col-lg-2 mb-3">
                                <label for="incidenciaen">Incidencia en</label>
                                <select id="incidenciaen" name="incidenciaen" class="form-control" required>
                                    <option value=""></option>
                                    <?php foreach ($tipos as $var => $tipo) : ?>
                                        <option value="<?php echo $var ?>" <?php if ($var == $_GET['tipo']) : ?> selected="selected" <?php endif; ?>><?php echo $tipo ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 mb-6">
                                <label for="ordenes">Ordenes de envío/recibo</label>
                                <select name="ordenes" id="ordenes" class="form-control" required>
                                    <option value=""></option>
                                </select>
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 mb-3">
                                <label for="fecha_envio">Fecha Envío/Devolución</label>
                                <input type="date" class="form-control" name="fecha_envio" value="<?php echo $_GET['fechaorden'] ?>">
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-3">
                                <label for="testigo">Usuario que envió/devolvió</label>
                                <select name="usuario_envio" class="form-control" required>
                                    <option value="">Selecciona</option>
                                    <?php

                                    $query = "SELECT * FROM usuarios";

                                    $resultado = $conexion->query($query);
                                    if ($resultado->num_rows > 0) {
                                        while ($fila = $resultado->fetch_assoc()) {

                                            $selected = '';
                                            if (isset($_GET['usuarioenvia']) && $_GET['usuarioenvia'] == $fila['Id_usuario']) {
                                                $selected = 'selected';
                                            } ?>
                                            <option value="<?php echo $fila['Id_usuario']; ?>" <?php echo $selected; ?>>
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
                            <div class="col-md-3 col-lg-3 mb-3">
                                <label for="fecha_recibido">Fecha Recibido</label>
                                <input type="date" class="form-control" name="fecha_recibido" value="<?php echo date("Y-m-d") ?>">
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-3">
                                <label for="usuario_recibio">Usuario que recibió</label>
                                <select name="usuario_recibio" class="form-control" required>
                                    <option value="">Selecciona</option>
                                    <?php

                                    $query = "SELECT * FROM usuarios";

                                    $resultado = $conexion->query($query);
                                    if ($resultado->num_rows > 0) {
                                        while ($fila = $resultado->fetch_assoc()) {
                                    ?>
                                            <option value="<?php echo $fila['Id_usuario']; ?>" <?php if ($fila['Id_usuario'] == $_GET['usuariorecibe']) : ?> selected="selected" <?php endif; ?>>
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


                        </div>

                        <div class="form-row">
                            <div class="col-md-12 col-lg-12 mb-4">
                                <label for="incidencia">Incidencia</label>
                                <textarea class="form-control" rows="5" name="incidencia"></textarea>

                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>
                        </div>
                    </div>
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
        echo 'si registra';
        require_once("../conexion/conexion.php");
        $fechaenvio = $_POST['fecha_envio'];
        $fecharecibido = $_POST['fecha_recibido'];
        $usuarioenvio = $_POST['usuario_envio'];
        $usuariorecibio = $_POST['usuario_recibio'];
        $testigo = "";
        $incidencia = $_POST['incidenciaen'];
        $orden = $_POST['ordenes'];
        $detalle = $_POST['incidencia'];
        $fecha = date("Y-m-d H:i:s");
        /* $modulos = $_POST['modulos'];
                $cantidad = $_POST['cantidad'];*/

        $query = "INSERT INTO incidencias (fecha,usuario,fechaenvio,fecharecibido,usuarioenvio,usuariorecibio,testigo,incidencia,orden,detalle) values('$fecha',$usuario,'$fechaenvio','$fecharecibido',$usuarioenvio,$usuariorecibio,'$testigo','$incidencia','$orden','$detalle')";

        //echo  $query . "<br/>";
        $verificar = $conexion->query($query);


        if ($verificar) {
            echo '<script>
                    swal({
                    title: "Operación exitosa",
                    text: "Incidencia registrada correctamente!",
                    type: "success",
                    showCancelButton: true,
                    cancelButtonClass: "btn-warning",
                    cancelButtonText: "Registrar otra incidencia",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                  },
                  function(isConfirm) {
                      if (isConfirm) {
                        window.close(); // Cerrar la ventana actual
                      } else {
                        window.location="registrar_incidencias.php";
                      }
                    });
                    </script>';
        } else {
            echo '<script>
                    swal({
                    title: "Operación fallida",
                    text: "Ocurrio un error al registrar la incidencia!",
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
                        window.location="registrar_incidencias.php";
                      } else {
                        window.location="registrar_incidencias.php";
                      }
                    });
                    </script>';
        }
    } else {
        // echo'no registra';
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
            $("#ordenes").empty();
            $("#incidenciaen").change(function() {
                console.log('incidenciaen');
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
                            // console.log('wiiiiii');
                            var datos = JSON.parse(data);
                            //var datosenvio = JSON.parse(datosenvio);
                            // $("#ubicacion_actual").val(datos[i].ubicacion);

                            $("#ordenes").empty();
                            $("#ordenes").append('<option value="">Seleccione</option>');
                            for (var i = 0; i < datos.length; i++) {
                                $("#ordenes").append("<option value=" + datos[i].Id + ">" + "De " + datos[i].ubicacion + " a " + datos[i].envioa + " - " + datos[i].fecha + "</option>");
                            }

                            //var ubicacion=datos[$(this).val()].ubicacion;
                            // console.log(datos[i].envioa);
                        } catch (error) {
                            $("#ordenes").empty();
                            console.error("Error al parsear la cadena JSON: " + error.message);
                        }



                    }
                });
            });
        });
        //---------------------------------

        $(document).ready(function() {
            // Paso 3: Asignar una función al evento onchange del primer select para cargar los valores en el segundo select
            $("#incidenciaen").on("change", function() {
                var valor_select1 = $(this).val();
                var texto_select1 = $(this).find(":selected").text();

                $.ajax({
                    url: "datos.php",
                    data: {
                        opcion: valor_select1
                    },
                    type: "GET",
                    // dataType: "json",
                    success: function(data) {
                        try{
 // Paso 4: Construir las opciones del segundo select
                        // console.log('wiiiiii');
                        var datos = JSON.parse(data);
                        //var datosenvio = JSON.parse(datosenvio);
                        // $("#ubicacion_actual").val(datos[i].ubicacion);

                        $("#ordenes").empty();
                        $("#ordenes").append('<option value="">Seleccione</option>');
                        for (var i = 0; i < datos.length; i++) {
                            $("#ordenes").append("<option value=" + datos[i].Id + ">" + "De " + datos[i].ubicacion + " a " + datos[i].envioa + " - " + datos[i].fecha + "</option>");
                        }
                        // Paso 5: Seleccionar la opción correspondiente en el segundo select
                        var valor_select2 = '<?php echo $_GET['orden']; ?>';
                        if (valor_select2) {
                            $("#ordenes").val(valor_select2);
                        }
                        } catch (error) {
                                $("#ordenes").empty();
                                console.error("Error al parsear la cadena JSON: " + error.message);
                            }
                       
                    }
                });
            });

            // Llamar a la función onchange del primer select para cargar los valores en el segundo select y seleccionar la opción correspondiente
            $("#incidenciaen").trigger("change");
        });

        //---------------------------------






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