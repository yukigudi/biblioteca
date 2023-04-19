<?php
session_start();
include('../menu.php');
$id = $_SESSION['Id_usuario'];
$usuario = $id;
if ($id == null || $id == '') {
    header("location:index.php");
}

$niveles = array(
    /*'administrador' => 'Administrador',
    'responsable_estatal' => 'Responsable Estatal',
    'coordinadorzona' => 'Coordinador de Zona',*/
    'tecnicodocente' => 'Técnico docente',
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
        <div class="container table-responsive">
            <br><br><br><br>
            <form action="#" class="form" method="POST">
                <div class="form-row container">
                    <div class="col-md-6 col-lg-5">
                        <div class="input-group" style="z-index: 0;">
                            <input type="search" name="dato" id="dato" placeholder="Nombre" class="form-control shadow-sm border-0" autocomplete="off" value="<?php echo $_POST['dato'] ?>">
                            <div class="input-group-prepend bg-white p-0">
                                <button name="buscar" type="submit" class="input-group-text btn btn-danger border-0 shadow-sm icofont-search-1"></button>
                            </div>
                        </div>
                    </div>
                   <!-- <div class="col-md-4 col-lg-3 mb-4">
                        <select id="nivel" name="nivel" class="form-control" onchange="this.form.submit()">
                            <option value="">Nivel de usuario</option>
                            <?php /*foreach ($niveles as $var => $nivel) : ?>
                                <option value="<?php echo $var ?>" <?php if ($var == $_POST['nivel']) : ?> selected="selected" <?php endif; ?>><?php echo $nivel ?></option>
                            <?php endforeach;*/ ?>
                        </select>
                    </div>-->
                </div>
                <div class="form-row container mt-3">
                <div class="col-md-4 col-lg-3 mb-4 text-right">
                        <button onclick="abrirReporteUsuarios()" style="background-color: #dc3545; color: white; border: none; padding: 8px 12px; border-radius: 5px;">
                            <i class="icofont-file-pdf"></i> Descargar en PDF
                        </button>
                    </div>
                    <div class="col-md-4 col-lg-3 mb-4">
                        <button id="btnDescargarxls" name="btnDescargarxls" style="background-color: #28a745; color: white; border: none; padding: 8px 12px; border-radius: 5px;">
                            <i class="icofont-file-excel"></i> Descargar en Excel
                        </button>
                    </div>
                </div>
                <br>
                <div class="container-fluid" id="datos">
                    <table class='table table-sm table-hover gb-white shadow-sm'>
                        <thead>
                            <tr style="background-color:#952F57;" class='text-white font-weight-bold'>
                                <th class='text-center'><small>ID</small></th>
                                <th class='text-center'><small>Usuario</small></th>
                                <th class='text-center'><small>Nombre</small></th>
                                <th class='text-center'><small>Fecha alta</small></th>
                               <!-- <th class='text-center'><small>Nivel de usuario</small></th>-->
                                <th class='text-center'><small>Correo</small></th>

                                <th colspan='2' class='text-center'><small>Acciones</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            require_once("../conexion/conexion.php");
                            $filtro = "";
                            if (isset($_POST['buscar'])) {
                                if (isset($_POST['dato'])) {
                                    $dato = $_POST['dato'];
                                    $filtro .= "AND Nombre_empleado LIKE '%$dato%'";
                                }
                            }
                        /*    if (isset($_POST['nivel']) && ($_POST['nivel']) != "") {
                                $nivel = $_POST['nivel'];
                                $filtro .= "AND nivel='$nivel' ";
                            }*/


                            $query = "SELECT * FROM usuarios WHERE Activo=1 and nivel='tecnicodocente' " . $filtro;
                            $resultado = $conexion->query($query);
                            while ($fila = $resultado->fetch_assoc()) {
                                $id = $fila['Id_usuario'];
                            ?>
                                <tr class='text-center'>
                                    <td><small><?php echo $fila['Id_usuario']; ?></small></td>
                                    <td><small><?php echo $fila['Nombre_usuario']; ?></small></td>
                                    <td><small><?php echo $fila['nombre_empleado']; ?></small></td>
                                    <td><small><?php echo $fila['fecha']; ?></small></td>
                                    <!--<td><small><?php //echo $fila['nivel']; ?></small></td>-->
                                    <td><small><?php echo $fila['correo']; ?></small></td>

                                    <td class="text-right"><a class="bg-primary py-1 rounded-lg" href="modificar_tecnicod.php?id=<?php echo $fila['Id_usuario'] ?>"><span class='h6 text-white icofont-ui-edit px-1'></small></a></td>

                                    <td class="text-left"> <?php if ($_SESSION['Id_usuario'] == 1) { ?><a class="bg-danger py-1 rounded-lg" href="#" onclick="confirmar(<?php echo $id; ?>)"><span class='h6 text-white icofont-ui-delete px-1'></span></a><?php   } ?></td>
                                </tr>
                            <?php
                            }
                            // echo $query;
                            ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>


    <!-- Footer -->
    <footer class=" ">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-md-4 text-white mt-3 mb-2">
                    <div class="container">

                    </div>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });

            $("#btnDescargarxls").click(function() {
                console.log('entra aqui');
                var dato = "<?php echo $_POST['dato']; ?>";
                var nivel = "tecnicodocente";
                var filtros = "?dato=" + dato+"&nivel=" + nivel;
                var url = "/biblioteca/phpxsls/ReportesXls/PhpOffice/reporte_usuariostd.php" + filtros;

                // var url = "/biblioteca/phpxsls/ReportesXls/PhpOffice/reporte_ubicaciones_cordzona.php";
                // Creamos un enlace con el atributo download y lo hacemos clic para iniciar la descarga

                $('<a>').attr({
                    href: url,
                    download: 'reporte_ubicaciones_cordzona.xlsx'
                })[0].click();

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
        function confirmar(id) {
            swal({
                    title: "Advertecia!",
                    text: "¿Esta seguro de eliminar al Técnico docente?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-primary ",
                    confirmButtonText: "Eliminar",
                    cancelButtonClass: "btn-danger",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        window.location = "eliminar.php?id=" + id;
                    } else {
                        swal({
                            title: "Operación cancelada!",
                            text: "El Técnico docente no fue eliminado",
                            type: "error",
                            confirmButtonClass: "btn-primary",
                            confirmButtonText: "Volver",
                            closeOnConfirm: false
                        }, );
                    }
                });
        }
    </script>

    <script>
        function abrirReporteUsuarios() {
            $dato = $('#dato').val();
            $nivel = "tecnicodocente";
            $material = $('#material').val();
            $estado = $('#estado').val();

            $filtros = "";
    
    if ($dato != "") {
        $filtros += "&dato=" + $dato;
    }
    if ($nivel != "") {
        $filtros += "&nivel=" + $nivel;
    }
    if ($filtros != "") {
        $filtros = "?" + $filtros.substring(1); // elimina el primer & y lo reemplaza por ?
    }
            //$filtros = "?dato=" + $dato + "&nivel=" + $nivel + "&material=" + $material + "&estado=" + $estado;
            console.log($filtros);
            window.open("../reporte_usuarios/index.php" + $filtros, "Reporte de Usuarios", "directories=no location=no");

        }
    </script>
</body>

</html>