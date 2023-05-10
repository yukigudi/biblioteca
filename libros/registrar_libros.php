 <?php
  session_start();
  include('../menu.php');
  $id = $_SESSION['Id_usuario'];
  $usuario = $id;
  if ($id == null || $id == '') {
    header("location:index.php");
  }
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
     <div class="container">
       <br><br><br><br>
       <br>
       <div class="bg-white rounded-lg formulario">
         <form class="p-4 needs-validation" action="registrar_libros.php" method="POST" novalidate>
           <center><label for="">
               <h4>REGISTRAR MODULOS</h4>
             </label></center>
           <div class="form-row">
             <div class="col-md-4 col-lg-3 mb-4">
               <label for="validationCustom02">Estado</label>
               <?php
                $estados = array(
                  'nuevo' => 'Nuevo',
                  'usado' => 'Usado'
                );
                $niveles = array(
                  'alfabetizacion' => 'Alfabetización',
                  'primaria' => 'Primaria',
                  'secundaria' => 'Secundaria',

                );
                $materiales = array(
                  'basico' => 'Básico',
                  'diversificado' => 'Diversificado'
                );
                ?>
               <select id="estado" name="estado" class="form-control" required>
                <option value="">Seleccione</option>
                 <?php foreach ($estados as $var => $estado) : ?>
                   <option value="<?php echo $var ?>" <?php if ($var == $fila['estado']) : ?> selected="selected" <?php endif; ?>><?php echo $estado ?></option>
                 <?php endforeach; ?>
               </select>

               <div class="valid-feedback">
                 Correcto!
               </div>
               <div class="invalid-feedback">
                 Porfavor rellena el campo.
               </div>
             </div>
             <!--pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" maxlength="250"-->
             <div class="col-md-4 col-lg-6 mb-4">
               <label for="validationCustom010">Titulo</label>
               <input type="text" class="form-control" autocomplete="off" id="validationCustom010" required name="titulo" placeholder="Titulo del módulo">
               <div class="valid-feedback">
                 Correcto!
               </div>
               <div class="invalid-feedback">
                 Porfavor rellena el campo.
               </div>
             </div>
             <div class="col-md-4 col-lg-3 mb-4">
               <label for="validationCustom010">Código</label>
               <input type="text" class="form-control" autocomplete="off" id="validationCustom011" required name="codigo" placeholder="Código del módulo">
               <div class="valid-feedback">
                 Correcto!
               </div>
               <div class="invalid-feedback">
                 Porfavor rellena el campo.
               </div>
             </div>
             <div class="col-md-4 col-lg-3 mb-4">
               <!---pattern="[0-999]{1}--->
               <label for="validationCustom040">Cantidad</label>
               <input type="number" class="form-control" id="validationCustom040" required name="copias" pattern="^\d{1,3}$" placeholder="Cantidad">
               <div class="valid-feedback">
                 Correcto!
               </div>
               <div class="invalid-feedback">
                 Porfavor rellena el campo.
               </div>
             </div>
             <div class="col-md-4 col-lg-3 mb-4">
               <label for="nivel">Nivel</label>
               <select id="nivel" name="nivel" class="form-control" required>
               <option value="">Seleccione</option>
                 <?php foreach ($niveles as $var => $nivel) : ?>
                   <option value="<?php echo $var ?>" <?php if ($var == $fila['nivel']) : ?> selected="selected" <?php endif; ?>><?php echo $nivel ?></option>
                 <?php endforeach; ?>
               </select>
               <div class="valid-feedback">
                 Correcto!
               </div>
               <div class="invalid-feedback">
                 Porfavor rellena el campo.
               </div>
             </div>
             <div class="col-md-4 col-lg-3 mb-4">
               <label for="material">Material</label>
               <select id="material" name="material" class="form-control" required>
               <option value="">Seleccione</option>
                 <?php foreach ($materiales as $var => $material) : ?>
                   <option value="<?php echo $var ?>" <?php if ($var == $fila['material']) : ?> selected="selected" <?php endif; ?>><?php echo $material ?></option>
                 <?php endforeach; ?>
               </select>
               <div class="valid-feedback">
                 Correcto!
               </div>
               <div class="invalid-feedback">
                 Porfavor rellena el campo.
               </div>
             </div>
              <div class="col-md-4 col-lg-3 mb-4">
                    <label for="validationCustom03">Edición</label>
                    <input type="text" class="form-control" id="validationCustom03" required name="edicion" placeholder="Edición" maxlength="30">
                    <div class="valid-feedback">
                      Correcto!
                    </div>
                    <div class="invalid-feedback">
                      Porfavor rellena el campo.
                    </div>
                  </div>
                <!--</div>
                 <div class="form-row">
                  <div class="col-md-6 col-lg-4 mb-3">
                    <label for="validationCustom04">Fecha de ultima edición</label>
                    <input type="date" class="form-control" id="validationCustom04" name="fecha">
                    <div class="valid-feedback">
                      Correcto!
                    </div>
                    <div class="invalid-feedback">
                      Porfavor rellena el campo.
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 mb-3">
                    <label for="validationCustom05">Categoría</label>
                    <input type="text" class="form-control" id="validationCustom05" required name="cate" placeholder="Categoría" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+" maxlength="30">
                    <div class="valid-feedback">
                      Correcto!
                    </div>
                    <div class="invalid-feedback">
                      Porfavor rellena el campo.
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 mb-3">
                    <label for="validationCustom06">Número de Estante</label>
                    <input type="text" class="form-control" id="validationCustom06" required name="estante" placeholder="Número de estante" pattern="[0-9]{1}">
                    <div class="valid-feedback">
                      Correcto!
                    </div>
                    <div class="invalid-feedback">
                      Porfavor rellena el campo.
                    </div>
                  </div>-->
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
      require_once("../conexion/conexion.php");
      $titulo = $_POST['titulo'];
      $codigo = $_POST['codigo'];
      $copias = $_POST['copias'];
      $estado = $_POST['estado'];
      $nivel = $_POST['nivel'];
      $material = $_POST['material'];
      $editorial = $_POST['editorial'];
      $fecha = date("Y-m-d");
      $cate = $_POST['cate'];
      $estante = $_POST['estante'];
      $edicion = $_POST['edicion'];
      $ubicacion = 7; //bodega grande en tabla ubicaciones

      $query = "INSERT INTO libros (Titulo,codigo,Copias,estado,nivel,material,edicion,Activo) values('$titulo','$codigo',$copias,'$estado','$nivel','$material','$edicion',1)";
      $verificar = $conexion->query($query);
      $last_id = $conexion->insert_id;
      // $Id_envio = $last_id;
      //guardar en tabla general de ubicaciones de los modulos

      $querydetalle2 = "INSERT INTO ubicaciones_modulos (modulo_Id,ubicacion_Id,cantidad,fecha) values($last_id,$ubicacion,$copias,'$fecha')";
      $verificar2 = $conexion->query($querydetalle2);

      if ($verificar && $verificar2) {
        echo '<script>
                    swal({
                    title: "Operación exitosa",
                    text: "El módulo fue registrado correctamente!",
                    type: "success",
                    showCancelButton: true,
                    cancelButtonClass: "btn-warning",
                    cancelButtonText: "Registrar",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Ver módulos",
                    closeOnConfirm: false
                  },
                  function(isConfirm) {
                      if (isConfirm) {
                        window.location="libros.php";
                      } else {
                        window.location="registrar_libros.php";
                      }
                    });
                    </script>';
      } else {
        echo '<script>
                    swal({
                    title: "Operación fallida",
                    text: "Ocurrio un error al registrar el módulo!",
                    type: "error",
                    showCancelButton: true,
                    cancelButtonClass: "btn-warning",
                    cancelButtonText: "Intentar de nuevo",
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Ver módulos",
                    closeOnConfirm: false
                  },
                  function(isConfirm) {
                      if (isConfirm) {
                        window.location="libros.php";
                      } else {
                        window.location="registrar_libros.php";
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
           <p class="text-white pt-3"><small><b>Copyright &copy; 2023 </b>ISEJA Control de módulos todos los derechos reservados</small></p>
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
 </body>

 </html>