  <?php
    session_start();
    include('../menu.php');
    $id=$_SESSION['Id_usuario'];
    $usuario=$id;
    if ($id == null || $id='') {
        header("location:index.php");
    }

    //Administrador, Responsable Estatal, Coordinador de Zona

    $niveles = array(
      'administrador' => 'Administrador',
      'responsable_estatal' => 'Responsable Estatal',
      'coordinadorzona' => 'Coordinador de Zona',
  );
  ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
            <?php   menu();?>
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
                                    <a href="perfil.php"><button class="dropdown-item" type="button">Actualizar perfil</button></a>
                                    <a href="modificar_contrasena.php"><button class="dropdown-item" type="button">Cambiar contraseña</button></a>
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
            <div class="bg-white rounded-lg formulario">
                <form class="p-4 needs-validation" action="registrar_usuarios.php" method="POST" novalidate>
                  <center><label for=""><h4>REGISTRAR USUARIOS</h4></label></center>
                <div class="form-row">
              
                  <div class="col-sm-12 col-md-4 col-lg-6 mb-4">
                    <label for="nombre">Nombre de empleado</label>
                    <input type="text" class="form-control" id="nombre"required name="nombre" placeholder="Nombre completo" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" maxlength="40">
                    <div class="valid-feedback">
                      Correcto!
                    </div>
                    <div class="invalid-feedback">
                      Porfavor rellena el campo.
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-3 mb-4">
                    <label for="usuario">Nombre de usuario</label>
                    <input type="text" class="form-control" id="usuario" required name="usuario" placeholder="Usuario" autocomplete="off" pattern="[a-zA-Z0-9]+" maxlength="16">
                    <div class="valid-feedback">
                      Correcto!
                    </div>
                    <div class="invalid-feedback">
                      Porfavor rellena el campo.
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-3 mb-4">
                    <label for="pass">Contraseña</label>
                    <input type="password" class="form-control" id="pass" required name="pass" placeholder="Contraseña" minlength="5" maxlength="16">
                    <div class="valid-feedback">
                      Correcto!
                    </div>
                    <div class="invalid-feedback">
                      Porfavor rellena el campo.
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-4 col-lg-3 mb-4">
                    <label for="calle">Calle</label>
                    <input type="text" class="form-control" id="calle" required name="calle" placeholder="Calle" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" maxlength="30">
                    <div class="valid-feedback">
                      Correcto!
                    </div>
                    <div class="invalid-feedback">
                      Porfavor rellena el campo.
                    </div>
                  </div>
                  <div class="col-sm-6 col-md64 col-lg-3 mb-3">
                    <label for="numeroi">Número interior</label>
                    <input type="text" class="form-control" id="numeroi" required name="numeroi" placeholder="Número de casa" pattern="[0-9]+" maxlength="4">
                    <div class="valid-feedback">
                      Correcto!
                    </div>
                    <div class="invalid-feedback">
                      Porfavor rellena el campo.
                    </div>
                  </div>
                  <div class="col-sm-6 col-md64 col-lg-3 mb-3">
                    <label for="numeroe">Número exterior</label>
                    <input type="text" class="form-control" id="numeroe" required name="numeroe" placeholder="Número de casa" pattern="[0-9]+" maxlength="4">
                    <div class="valid-feedback">
                      Correcto!
                    </div>
                    <div class="invalid-feedback">
                      Porfavor rellena el campo.
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-3 mb-3">
                    <label for="ciudad">Ciudad</label>
                    <input type="text" class="form-control" id="ciudad" required name="ciudad" placeholder="Ciudad" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" maxlength="18">
                    <div class="valid-feedback">
                      Correcto!
                    </div>
                    <div class="invalid-feedback">
                      Porfavor rellena el campo.
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-3 mb-3">
                    <label for="estado">Estado</label>
                    <input type="text" class="form-control" id="estado" required name="estado" placeholder="Estado" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" maxlength="18">
                    <div class="valid-feedback">
                      Correcto!
                    </div>
                    <div class="invalid-feedback">
                      Porfavor rellena el campo.
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-3 mb-3">
                    <label for="sexo">Genero</label>
                    <select class="form-control" id="sexo" required name="sexo">
                      <option value="" disabled selected>Elige una opción</option>
                      <option value="Masculino">Masculino</option>
                      <option value="Femenino">Femenino</option>
                    </select>
                      <div class="valid-feedback">
                        Correcto!
                    </div>
                    <div class="invalid-feedback">
                        Porfavor rellena el campo.
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                    <label for="fecha_nac">Fecha de nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nac" required name="fecha_nac">
                    <div class="valid-feedback">
                      Correcto!
                    </div>
                    <div class="invalid-feedback">
                      Porfavor Coloca una fecha.
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                    <label for="telefono">Teléfono</label>
                    <input type="tel" class="form-control" id="telefono" required name="telefono" placeholder="Teléfono" pattern="[0-9]{8,10}">
                    <div class="valid-feedback">
                      Correcto!
                    </div>
                    <div class="invalid-feedback">
                      Profavor rellena el campo.
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-4 col-lg-6 mb-3">
                    <label for="correo">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" maxlength="50" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$">
                    <div class="valid-feedback">
                      Correcto!
                    </div>
                    <div class="invalid-feedback">
                      Profavor coloca un correo valido.
                    </div>
                  </div>
                  <div class="col-md-4 col-lg-3 mb-4">
                          <label for="nivel">Nivel de usuario</label>
                          <select id="nivel" name="nivel" class="form-control">
                          <option value=""></option>
                              <?php foreach ($niveles as $var => $nivel) : ?>
                                  <option value="<?php echo $var ?>" <?php if( $var == $_POST['nivel'] ): ?>
                                     selected="selected" <?php endif; ?>><?php echo $nivel ?></option>
                              <?php endforeach; ?>
                          </select>

                      </div>


                </div>
                <br>
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
                require_once ("../conexion/conexion.php");
                $id = $_POST['id'];
                $nombre_empleado= $_POST['nombre'];
                $usuario = $_POST['usuario'];
                $pass = $_POST['pass'];
                $calle=$_POST['calle'];
                $numeroi=$_POST['numeroi'];
                $numeroe=$_POST['numeroe'];
                $ciudad=$_POST['ciudad'];
                $estado=$_POST['estado'];
                $genero=$_POST['sexo'];
                $fecha_nac=$_POST['fecha_nac'];
                $telefono=$_POST['telefono'];
                $correo=$_POST['correo'];
                $nivel=$_POST['nivel'];
                $fecha = date("Y-m-d");


                $query = "INSERT INTO usuarios (nombre_empleado,Nombre_usuario,Password,calle,numeroi,numeroe,ciudad,estado,genero,fecha_nac,telefono,correo,nivel,fecha) values('$nombre_empleado','$usuario','$pass','$calle','$numeroi','$numeroe','$ciudad','$estado','$genero','$fecha_nac','$telefono','$correo','$nivel','$fecha')";

                echo $query;
                $verificar=$conexion->query($query);
                if ($verificar) {
                    echo '<script>
                    swal({
                    title: "Operación exitosa",
                    text: "El usuario fue registrado correctamente!",
                    type: "success",
                    showCancelButton: true,
                    cancelButtonClass: "btn-warning",
                    cancelButtonText: "Registrar",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Ver usuarios",
                    closeOnConfirm: false
                  },
                  function(isConfirm) {
                      if (isConfirm) {
                        window.location="usuarios.php";
                      } else {
                        window.location="registrar_usuarios.php";
                      }
                    });
                    </script>';
                }else{
                    echo '<script>
                    swal({
                    title: "Operación fallida",
                    text: "Ocurrio un error al registrar el usuario!",
                    type: "error",
                    showCancelButton: true,
                    cancelButtonClass: "btn-warning",
                    cancelButtonText: "Intentar de nuevo",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Ver usuarios",
                    closeOnConfirm: false
                  },
                  function(isConfirm) {
                      if (isConfirm) {
                        window.location="usuarios.php";
                      } else {
                        window.location="registrar_usuarios.php";
                      }
                    });
                    </script>';
                }
            }
        ?> 
   <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div style="max-width: 90%;" class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Buscar Empleados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Nombre del empleado</label>
                    <input type="search" class="form-control" name="buscar" id="buscar" placeholder="Jesús López" autocomplete="off">
                </div>
            </div>
            <br>
            <div class="table-responsive datos" id="datos">
                
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
                    <p class="text-white pt-3"><small><b>Copyright &copy; 2023 </b>ISEJA Control de libros todos los derechos reservados</small></p>
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
    <script src="../vendor/bootstrap/js/buscar_empleado.js" type="text/javascript"></script>
    <script src="../vendor/bootstrap/js/buscar_empleado1.js" type="text/javascript"></script>
    <script>
         $(document).ready(function(){
            $('.toast').toast('show');
         });
     </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
         function launchFullScreen(element) {
      if(element.requestFullScreen) {
        element.requestFullScreen();
      } else if(element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
      } else if(element.webkitRequestFullScreen) {
        element.webkitRequestFullScreen();
      }
    }
    // Lanza en pantalla completa en navegadores que lo soporten
     function cancelFullScreen() {
         if(document.cancelFullScreen) {
             document.cancelFullScreen();
         } else if(document.mozCancelFullScreen) {
             document.mozCancelFullScreen();
         } else if(document.webkitCancelFullScreen) {
             document.webkitCancelFullScreen();
         }
     }
    </script>
</body>

</html>