<?php
session_start();
include('menu.php');
$id = $_SESSION['Id_usuario'];
$usuario = $id;
if ($id == null || $id == '') {
    header("location:index.php");
}
require_once("conexion/conexion.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>ISEJA Control de módulos</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="vendor/bootstrap/css/style.css">
    <link rel="stylesheet" type="text/css" href="icofont/icofont.min.css">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img width="45" height="45" src="images/logo.png" alt="">
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
                                        <img width="43" height="43" src="images/user.png" alt="">
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="usuarios/perfil.php"><button class="dropdown-item" type="button">Actualizar perfil</button></a>
                                        <a href="usuarios/modificar_contrasena.php"><button class="dropdown-item" type="button">Cambiar contraseña</button></a>
                                        <div class="dropdown-divider"></div>
                                        <a href="conexion/cerrar_sesion.php"><button class="dropdown-item" type="button">Cerrar sesión</button></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container">
            <br><br>
            <br><br>
            <div class="container-fluid p-0">
                <div class="row">

                   
                    <div class="col-md-5 col-lg-3 p-0 p-1">
                        <div class="row no-gutters bg-white shadow-sm">
                            <div class="col-md-3 bg-success p-3">
                                <span class="icofont-listing-box h1 text-white"></span>
                            </div>

                            <div class="col-md-9 pt-2">
                                <small class="ml-3 h3 text-secondary border-success"><b class="count">
                                        <?php
                                        $query = "SELECT COUNT(Id_henvio) AS Total FROM header_envio_modulos";
                                        $resultado = $conexion->query($query);

                                        if (mysqli_num_rows($resultado) > 0) {
                                            $fila = $resultado->fetch_assoc();
                                            echo $fila['Total'];
                                        }
                                        ?>
                                    </b></small>
                                <br>
                                <small class="ml-3 h6 text-secondary">Total envios</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-3 p-0 p-1">
                        <div class="row no-gutters bg-white shadow-sm">
                            <div class="col-md-3 bg-success p-3">
                                <span class="icofont-listing-box h1 text-white"></span>
                            </div>

                            <div class="col-md-9 pt-2">
                                <small class="ml-3 h3 text-secondary border-success"><b class="count">
                                        <?php
                                        $query = "SELECT COUNT(Id_hretorno) AS Total FROM header_retorno_modulos";
                                        $resultado = $conexion->query($query);

                                        if (mysqli_num_rows($resultado) > 0) {
                                            $fila = $resultado->fetch_assoc();
                                            echo $fila['Total'];
                                        }
                                        ?>
                                    </b></small>
                                <br>
                                <small class="ml-3 h6 text-secondary">Total devoluciones</small>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
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
                    <p class="text-white pt-3"><small><b>Copyright &copy; 2022 </b>ISEJA Control de módulos todos los derechos reservados</small></p>
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
    <script src="vendor/jquery/jquery.min.js" type="text/javascript"></script>
    <!-- Bootstrap JS -->
    <script src="vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="vendor/bootstrap/js/counter.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>