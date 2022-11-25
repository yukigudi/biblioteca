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
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ISEJA Control de libros</title>

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
                <small><b class="ml-2">ISEJA</b> Control de libros</small>
            </div>
            <ul class="list-unstyled components">
                <li class="">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
                            class="icofont-library mr-3 h4 text-white"></span>Libros<i
                            class="icofont-rounded-down text-white"></i></a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="../libros/registrar_libros.php">Registrar</a>
                        </li>
                        <li>
                            <a href="../libros/libros.php">Consultar</a>
                        </li>
                        <li>
                            <a onClick='abrirReporte()' href="#">Reportes</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="#modulosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
                            class="icofont-listing-box mr-3 h4 text-white"></span>Modulos<i
                            class="icofont-rounded-down text-white"></i></a>
                    <ul class="collapse list-unstyled" id="modulosSubmenu">
                        <li>
                            <a href="../modulos_envio/registrar_envio.php">Envio</a>
                        </li>
                        <li>
                            <a href="../modulos_retorno/registrar_retorno.php">Retorno</a>
                        </li>
                        <li>
                            <a href="../modulos_recibido/registro.php">Recibo</a>
                        </li>
                        <li>
                             <a onClick='abrirReporte1()' href="#">Reportes</a>
                         </li>
                    </ul>
                </li>
                <li class="">
                    <a href="#incidenciasSubmenu" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle"><span class="icofont-bulb-alt mr-3 h4 text-white"></span>Incidencias<i
                            class="icofont-rounded-down text-white"></i></a>
                    <ul class="collapse list-unstyled" id="incidenciasSubmenu">
                        <li>
                            <a href="../incidencias/registrar_incidencias.php">Registrar</a>
                        </li>
                        <li>
                            <a onClick='abrirReporte2()' href="#">Reportes</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="#empleadosSubmenu" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle"><span class="icofont-business-man mr-3 h4 text-white"></span>Empleados<i
                            class="icofont-rounded-down text-white"></i></a>
                    <ul class="collapse list-unstyled" id="empleadosSubmenu">
                        <li>
                            <a href="../empleados/registrar_empleados.php">Registrar</a>
                        </li>
                        <li>
                            <a href="../empleados/empleados.php">Consultar</a>
                        </li>
                        <li>
                            <a onClick='abrirReporte3()' href="#">Reportes</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="#puestoSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
                            class="icofont-ui-user mr-3 h4 text-white"></span>Puestos<i
                            class="icofont-rounded-down text-white"></i></a>
                    <ul class="collapse list-unstyled" id="puestoSubmenu">
                        <li>
                            <a href="../puestos/registrar_puesto.php">Registrar</a>
                        </li>
                        <li>
                            <a href="../puestos/puestos.php">Consultar</a>
                        </li>
                    </ul>
                </li>
                <?php if ($_SESSION['Id_usuario'] == 1) {?>
                <li class="">
                    <a href="#userSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
                            class="icofont-users-alt-4 mr-3 h4 text-white"></span>Usuarios<i
                            class="icofont-rounded-down text-white"></i></a>
                    <ul class="collapse list-unstyled" id="userSubmenu">
                        <li>
                            <a href="../usuarios/registrar_usuarios.php">Registrar</a>
                        </li>
                        <li>
                            <a href="../usuarios/usuarios.php">Consultar</a>
                        </li>
                    </ul>
                </li>
                <?php   }?>

            </ul>
        </nav>
        <!-- Page Content  -->
        <div class="menu">
            <nav style="background-color:#952F57" class="p-2 navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <i class="fas fa-align-left"></i>
                    <a href="#"><span id="sidebarCollapse" class="text-white h3 icofont-navigation-menu"></span></a>
                    <div class="ml-3 text-center text-white">

                    </div>
                    <button class="btn d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                        <span class="text-white h3 icofont-circled-down"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <!-- Example single danger button -->
                            <li class="nav-item">
                                <div class="btn-group">
                                    <button type="button" id="perfil" class="btn dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <img width="43" height="43" src="../images/user.png" alt="">
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="../usuarios/perfil.php"><button class="dropdown-item"
                                                type="button">Actualizar perfil</button></a>
                                        <a href="../usuarios/modificar_contrasena.php"><button class="dropdown-item"
                                                type="button">Cambiar contraseña</button></a>
                                        <div class="dropdown-divider"></div>
                                        <a href="../conexion/cerrar_sesion.php"><button class="dropdown-item"
                                                type="button">Cerrar sesión</button></a>
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
            <div class="container">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Nota:</strong> Dar clic en buscar personas para saber el ID de la persona. <a
                        class="text-dark" data-toggle="modal" data-target="#staticBackdrop" href=""><b> Ver
                            personas</b></a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="bg-white rounded-lg formulario">
                <form class="p-4 needs-validation" action="registrar_empleados.php" method="POST" novalidate>
                    <center><label class="mt-2" for="">
                            <h4>REGISTRAR EMPLEADOS</h4>
                        </label></center>
                    <div class="form-row">
                        <div class="col-md-6 col-lg-2 mb-4">
                            <label for="validationCustom01">Id de persona</label>
                            <input type="number" class="form-control" id="validationCustom01" required name="id"
                                placeholder="Id de persona" maxlength="11">
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Porfavor rellena el campo.
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-4" id="caja">
                        </div>
                        <div class="col-md-6 col-lg-3 mb-4">
                            <label for="validationCustom02">Puesto</label>
                            <select id="validationCustom02" name="puesto" class="form-control" required>
                                <option value="" disabled selected>Elige una opción</option>
                                <?php 
                        include('../conexion/conexion.php');
                        $query="SELECT * FROM puesto";
                        $resultado=$conexion->query($query);
                        while ($fila=mysqli_fetch_array($resultado)) {
                            echo '<option value="'.$fila["Id_puesto"].'">'.$fila["Descripcion"].'</option>';
                        }
                       ?>
                            </select>
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Porfavor rellena el campo.
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-4">
                            <label for="validationCustom03">Fecha de contratación</label>
                            <input type="date" class="form-control" id="validationCustom03" name="fecha" required>
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                            <div class="invalid-feedback">
                                Porfavor rellena el campo.
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-warning text-white" type="submit" name="registrar">Registrar</button>
                </form>
            </div>
            <br>
        </div>
        <script src="../push/push.min.js" type="text/javascript"></script>
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
            $id=$_POST['id'];
            $puesto=$_POST['puesto'];
            $fecha=$_POST['fecha'];
            $query="INSERT INTO empleados (Id_persona,Id_puesto,Fecha_contratacion) VALUES ($id,$puesto,'$fecha')";
            $verificar=$conexion->query($query);
            if ($verificar) {
                    echo '<script>
                    swal({
                    title: "Operación exitosa",
                    text: "El empleado fue registrado correctamente!",
                    type: "success",
                    showCancelButton: true,
                    cancelButtonClass: "btn-warning",
                    cancelButtonText: "Registrar",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Ver empleados",
                    closeOnConfirm: false
                  },
                  function(isConfirm) {
                      if (isConfirm) {
                        window.location="empleados.php";
                      } else {
                        window.location="registrar_empleados.php";
                      }
                    });
                    </script>';
                }else{
                    echo '<script>
                    swal({
                    title: "Operación fallida",
                    text: "Ocurrio un error al registrar el empleado!",
                    type: "error",
                    showCancelButton: true,
                    cancelButtonClass: "btn-warning",
                    cancelButtonText: "Intentar de nuevo",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Ver empleados",
                    closeOnConfirm: false
                  },
                  function(isConfirm) {
                      if (isConfirm) {
                        window.location="empleados.php";
                      } else {
                        window.location="registrar_empleados.php";
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
                    <p class="text-white pt-3"><small><b>Copyright &copy; 2022 </b>ISEJA Control de libros todos los
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
    <script src="../vendor/bootstrap/js/buscar_persona.js" type="text/javascript"></script>
    <script src="../vendor/bootstrap/js/buscar_persona1.js" type="text/javascript"></script>
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
    <script>
     function abrirReporte() {
       window.open("../reporte_libros/index.php","Reporte de libros","directories=no location=no");
       }
       function abrirReporte1() {   
       window.open("../reporte_modulos/index.php","Reporte de módulos","directories=no location=no");
       }
       function abrirReporte2() {   
       window.open("../reporte_incidencias/index.php","Reporte de incidencias","directories=no location=no");
       }
       function abrirReporte3() {
       window.open("../reporte_empleados/index.php","Reporte de empleados","directories=no location=no");
       }
    </script>
</body>

</html>