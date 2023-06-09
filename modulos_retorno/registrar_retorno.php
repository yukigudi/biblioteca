<?php

    session_start();
    $id=$_SESSION['Id_usuario'];
    $usuario=$id;
    if ($id == null || $id='') {
        header("location:../index.php");
    }
    require_once ("../conexion/conexion.php");
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
                        <!--- <div class="spinner-grow text-light" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>--->
                    </div>
                    <button class="btn d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
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
                                <select id="validationCustom02" name="envioa" class="form-control" required>
                                    <option value="plazas">Plazas</option>
                                    <option value="municipio">Municipio</option>
                                </select>
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-4">
                                <label for="validationCustom02">Regresar a</label>
                                <select id="validationCustom02" name="ubicacion_actual" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <option value="bodega_chica">Bodega chica</option>
                                    <option value="bodega_grande">Bodega grande</option>
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
                                <input type="date" class="form-control" id="fecha_actual" name="fecha"
                                    value="<?php echo date("Y-m-d")?>">
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-3">
                                <label for="usuario_recibe">Recibe</label>
                                <select id="usuario_recibe" name="recibe" class="form-control" required>
                                    <option value="">Selecciona</option>
                                    <?php 
                            
                            $query="SELECT * FROM usuarios";
                        
                        $resultado=$conexion->query($query);
                        if ($resultado->num_rows > 0) {
                            while ($fila=$resultado->fetch_assoc()) { ?>
                                    <option value="<?php echo$fila['Id_usuario']; ?>">
                                        <?php echo$fila['Nombre_usuario']; ?></option>
                                    <?php }}?>
                                    <!-- <option value="plazas">Plazas</option>
                                <option value="municipio">Municipio</option> -->
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
                                <input type="text" class="form-control" id="testigo" name="testigo">
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 col-lg-9 mb-4">
                                <hr>
                            </div>
                            <div onclick="agregarLinea()" class="col-md-6 col-lg-3 mb-4"><i
                                    class="icofont-plus-square"></i> Agregar linea de captura
                            </div>
                        </div>



                        <div class="form-row envios">
                            <div class="col-md-8 col-lg-8 mb-4">
                                <label for="modulos">Módulo</label>
                                <select id="modulos[]" name="modulos[]" class="form-control" required>
                                    <option value="">Selecciona</option>
                                    <?php 
                            $query="SELECT * FROM libros";
                        
                        $resultado=$conexion->query($query);
                        if ($resultado->num_rows > 0) {
                            while ($fila=$resultado->fetch_assoc()) { ?>
                                    <option value="<?php echo$fila['Id_libro']; ?>"><?php echo$fila['Titulo']; ?>
                                    </option>
                                    <?php }}?>
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
                                <input type="text" class="form-control" id="cantidad[]" name="cantidad[]">
                                <div class="valid-feedback">
                                    Correcto!
                                </div>
                                <div class="invalid-feedback">
                                    Porfavor rellena el campo.
                                </div>
                            </div>

                        </div>

                    </div>
                    <button class="btn btn-warning text-white" type="submit" name="registrar"
                        onClick='contarCampos()'>Registrar</button>
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
                require_once ("../conexion/conexion.php");
                $ubicacion = $_POST['ubicacion_actual'];
                $envioa=$_POST['envioa'];
                $recibe=$_POST['recibe'];
                $testigo=$_POST['testigo'];
                $fecha_actual=$_POST['fecha'];
                $modulos = $_POST['modulos'];
                $cantidad = $_POST['cantidad'];
                $fecha=date("Y-m-d H:i:s");

                    if (isset($modulos) AND is_array($modulos)) {

                        foreach($modulos as $key => $value) {

                            $query = "INSERT INTO retorno_modulos (fecha,usuario,ubicacion,envioa,fecharetorno,recibe,testigo,titulo,cantidad) values('$fecha',$usuario,'$ubicacion','$envioa','$fecha_actual',$recibe,'$testigo',$value,$cantidad[$key])";

                            echo  $query."<br/>";
                            $verificar=$conexion->query($query);
                            
                           // echo 'cantidad: '.$cantidad[$key].', libro: '.$value.'</br>';
                            //consulta sql
                          }

                  }else{
                    echo 'no es'; 
                  }
                 /* if (isset($_POST['cantidad']) AND is_array($_POST['cantidad'])) { 
                    echo 'OK';
                    // acceder a la primera posicion de val
                    echo $_POST['cantidad'][0]."</br>";
                  
                    // tambien puedes utilizar un foreach para recorrer todos los campos de val
                    foreach($_POST['cantidad'] as $key => $value) {
                      echo 'Clave de val: '.$key.', valor: '.$value.'</br>'; 
                    }
                  }else{
                    echo 'no es';
                  }*/


               //$query = "INSERT INTO libros (Titulo,Copias,Editorial,Fecha_edicion,Categoria,Estante) values('$titulo',$copias,'$editorial','$fecha','$cate',$estante)";
               // $verificar=$conexion->query($query);
                if ($verificar) {
                    echo '<script>
                    swal({
                    title: "Operación exitosa",
                    text: "El envio de módulos fue registrado correctamente!",
                    type: "success",
                    showCancelButton: true,
                    cancelButtonClass: "btn-warning",
                    cancelButtonText: "Registrar",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Ver libros",
                    closeOnConfirm: false
                  },
                  function(isConfirm) {
                      if (isConfirm) {
                        window.location="registrar_retorno.php";
                      } else {
                        window.location="registrar_eretorno.php";
                      }
                    });
                    </script>';
                }else{
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
                   
                </div><div class="col-md-4">
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
    function agregarLinea() {
        var $c = $('.envios').length;
        $('#lineas').append(
            '<div class="form-row envios"><div class="col-md-8 col-lg-8 mb-4"><select id="modulos[]" name="modulos[]" class="form-control" required><option value="">Selecciona</option> <?php  $query="SELECT * FROM libros"; $resultado=$conexion->query($query); if ($resultado->num_rows > 0) {while ($fila=$resultado->fetch_assoc()) { ?><option value="<?php echo$fila['Id_libro']; ?>"><?php echo$fila['Titulo']; ?></option><?php }} ?> </select> <div class="valid-feedback"> Correcto! </div> <div class="invalid-feedback"> Porfavor rellena el campo.</div> </div><div class="col-md-6 col-lg-3 mb-4"><input type="text" class="form-control" id="cantidad[]" name="cantidad[]"><div class="valid-feedback">Correcto!</div><div class="invalid-feedback">Porfavor rellena el campo.</div></div></div>'
        );


        console.log($c);
        // console.log('yeiiiiii');
    }

    function contarCampos() {
        var $c = $('.envios').length;
        console.log($c);
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