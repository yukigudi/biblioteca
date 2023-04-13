<!DOCTYPE html>
<html lang="en">
<head>
	<title>ISEJA Control de módulos</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="icofont/icofont.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/util.css">
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/main.css">
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/sweetalert.css">
	<script src="vendor/bootstrap/js/sweetalert.js" type="text/javascript"></script>
</head>
<body>
	<div class="row m-0 p-0">
		<!--	<div class="d-none d-sm-none d-md-block d-lg-block  col-md-7 col-lg-8 p-0">
				<img src="images/fondo.jpg" class="w-100 vh-100" alt="">
				<div class="carousel-caption d-none d-md-block">
			        <h5>ISEJA Control de módulos</h5>
			        <p class="text-white"></p>
			     </div>
			</div> -->
			<div class="bg-white col-sm-6 col-md-6 col-lg-6 p-0" style="margin-left: 25%;">
       
        
         <!-- Page Content  -->
        
        <div class="container">
            <br><br><br><br>     
            <div class="bg-white rounded-lg formulario">
                 <form class="p-4 needs-validation" action="recuperar_contrasenia.php" method="POST" novalidate>
                  <center><label class="mt-2" for=""><h4>ACTUALIZAR CONTRASEÑA</h4></label></center>
                <div class="form-row">
             
   
                <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                    <label for="validationCustom03">Correo electronico</label>
                    <input type="email" class="form-control" id="validationCustom03" required name="email" placeholder="e-mail" maxlength="50">
                   
                  </div>
               

                  <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                    <label for="validationCustom01">Contraseña</label>
                    <input type="password" class="form-control" id="validationCustom01" required name="pass" placeholder="Nueva contraseña" minlength="5" maxlength="16">
                    <div class="valid-feedback">
                      Correcto!
                    </div>
                    <div class="invalid-feedback">
                      Porfavor rellena el campo.
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-4 mb-4">
                    <label for="validationCustom02">Repetir contraseña</label>
                    <input type="password" class="form-control" id="validationCustom02" required name="pass1" placeholder="Repetir contraseña" minlength="5" maxlength="16">
                    <div class="valid-feedback">
                      Correcto!
                    </div>
                    <div class="invalid-feedback">
                      Porfavor rellena el campo.
                    </div>
                  </div>
                 </div>
                <button class="btn btn-warning text-white" type="submit" name="registrar">Actualizar</button>
              </form>
            </div>
          <br>
          </div>
        <script src="push/push.min.js" type="text/javascript"></script>
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
            require_once("conexion/conexion.php");
            $pass=$_POST['pass'];
            $pass1=$_POST['pass1'];
            $email=$_POST['email'];
            if ($pass==$pass1) {
                $query="SELECT empleados.Id_empleado FROM empleados LEFT JOIN personas on (empleados.Id_persona=personas.Id_persona) WHERE personas.correo='$email'";
                $resultado=$conexion->query($query);
                $row=$resultado->fetch_assoc();
                   
                $empleado=$row['Id_empleado'];
                echo$empleado."-".$query;
                $query="UPDATE usuarios SET Password='$pass1' WHERE Id_empleado=$empleado";
                $verificar=$conexion->query($query);
                if ($verificar) {
                    echo '<script>
                    swal({
                    title: "Operación exitosa",
                    text: "La actualización se realizo con exitó!",
                    type: "success",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Aceptar",
                  },
                  function(){
                    window.location="inicio.php";
                  });
                    </script>';
                }else{
                    echo '<script>
                    swal({
                    title: "Operación fallida",
                    text: "Ocurrio un error al actualizar los datos!",
                    type: "error",
                    showCancelButton: true,
                    cancelButtonClass: "btn-warning",
                    cancelButtonText: "Intentar de nuevo",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Volver al inicio",
                    closeOnConfirm: false
                  },
                  function(isConfirm) {
                      if (isConfirm) {
                        window.location="inicio.php";
                      } else {
                        window.location="recuperar_contrasenia.php";
                      }
                    });
                    </script>';
                }
            }else{
                echo '<script>
                    swal({
                    title: "Advertencia",
                    text: "Las contraseñas no son iguales!",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonClass: "btn-warning",
                    cancelButtonText: "Intentar de nuevo",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Volver al inicio",
                    closeOnConfirm: false
                  },
                  function(isConfirm) {
                      if (isConfirm) {
                        window.location="inicio.php";
                      } else {
                        window.location="recuperar_contrasenia.php";
                      }
                    });
                    </script>';
            }
        }
    ?>
    <script src="vendor/bootstrap/js/toastr.min.js" type="text/javascript"></script>
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Contáctanos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body bg-light">
            <div class="row">
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <span class="text-info icofont-map h1"></span>
                    <br>
                    <small>Barrio: Bonampack</small>
                    <br>
                    <small>Calle: Yaxchilan</small>
                    <br>
                    <small>Número: 18</small>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <span class="text-info icofont-envelope h1"></span>
                    <br>
                    <small>Email: winalllpz@gmail.com</small>
                    <br>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <span class="text-info icofont-brand-whatsapp h1"></span>
                    <br>
                    <small>Tel: 9191936817</small>
                    <br>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <span class="text-info icofont-facebook h1"></span>
                    <br>
                    <small>@GoldenLibrary</small>
                    <br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="exampleModalScrollable1" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Quiénes somos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body bg-light">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <span class="text-info icofont-hat h1"></span>
                    <p class="card-title">Misión</p>
                    <small>Nuestra misión es poder dar a conocer toda la sabiduría a través de nuestros libros. Tener un repertorio digno para todas las personas; clases sociales, edades, grados y campos de estudio. Que nuestros libros sean del mayor agrado de nuestros visitadores, contando la mejor calidad de servicio en préstamos de títulos. Siempre con el cello de la casa.</small>
                    <br>
                  </div>
                </div>
              </div>
              <br>
                <div class="col-sm-12">
                    <div class="card">
                      <div class="card-body">
                        <span class="text-info icofont-eye h1"></span>
                        <p class="card-title">Visión</p>
                        <small>Nuestra visión es tener siempre tener una atención del público a pesar del tiempo en la que estamos, ser una de las instituciones de títulos literarios más conocidos del mundo. Tener instalaciones de calidad para preservar el buen espacio para leer, contar con el mejor trato de visitador-empleado, ya que nuestro público lo merece.</small>
                        <br>
                      </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <span class="text-info icofont-chart-histogram-alt h1"></span>
                    <p class="card-title">Objetivo General</p>
                    <small>Tener un sistema para poder llevar a cabo la administración de los registros que se generan día con día y hacer más fácil la búsqueda de visitantes, las personas que tienen préstamos y los adeudos de libros. También llevar un registro de los libros que puedan estar dañados y así hacer una petición de cambios.</small>
                    <br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div style="max-width: 90%;" class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Buscar Libros</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Titulo del libro</label>
                    <input type="search" class="form-control" name="buscar" id="buscar" placeholder="Los 3 cerditos" autocomplete="off">
                </div>
            </div>
            <br>
            <div class="table-responsive datos" id="datos">
                
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="vendor/jquery/jquery.min.js" type="text/javascript"></script>
    <!-- Bootstrap JS -->
    <script src="vendor/bootstrap/js/popper.min.js" type="text/javascript"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
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