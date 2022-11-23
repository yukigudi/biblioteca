<?php
$menu=" 
<ul class='list-unstyled components'>
<li class=''>
    <a href='#homeSubmenu' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><span
            class='icofont-library mr-3 h4 text-white'></span>Libros<i
            class='icofont-rounded-down text-white'></i></a>
    <ul class='collapse list-unstyled' id='homeSubmenu'>
        <li>
            <a href='./libros/registrar_libros.php'>Registrar</a>
        </li>
        <li>
            <a href='./libros/libros.php'>Consultar</a>
        </li>
        <li>
            <a onClick='abrirReporte()' href='#'>Reportes</a>
        </li>
    </ul>
</li>
<li class=''>
    <a href='#modulosSubmenu' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><span
            class='icofont-listing-box mr-3 h4 text-white'></span>Modulos<i
            class='icofont-rounded-down text-white'></i></a>
    <ul class='collapse list-unstyled' id='modulosSubmenu'>
        <!-- <li>
           <a href='./modulos/registrar_personas.php'>Registrar</a>
       </li>-->
        <li>
            <a href='./modulos_envio/registrar_envio.php'>Envio</a>
        </li>
        <li>
            <a href='./modulos_retorno/registro.php'>Retorno</a>
        </li>
        <li>
            <a href='./modulos_recibido/registro.php'>Recibo</a>
        </li>
        <li>
            <a onClick='abrirReporte1()' href='#'>Reportes</a>
        </li>
    </ul>
</li>
<li class=''>
    <a href='#incidenciasSubmenu' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><span
            class='icofont-bulb-alt mr-3 h4 text-white'></span>Incidencias<i
            class='icofont-rounded-down text-white'></i></a>
    <ul class='collapse list-unstyled' id='incidenciasSubmenu'>
        <li>
            <a href='./incidencias/registrar_personas.php'>Registrar</a>
        </li>
        <li>
            <a href='./personas/personas.php'>Envio</a>
        </li>
        <li>
            <a href='./personas/personas.php'>Retorno</a>
        </li>
        <li>
            <a href='./personas/personas.php'>Recibo</a>
        </li>
        <li>
            <a onClick='abrirReporte1()' href='#'>Reportes</a>
        </li>
    </ul>
</li>
<!-- <li class=''>
    <a href='#pageSubmenu' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><span
            class='icofont-people mr-3 h4 text-white'></span>Personas<i
            class='icofont-rounded-down text-white'></i></a>
    <ul class='collapse list-unstyled' id='pageSubmenu'>
        <li>
            <a href='./personas/registrar_personas.php'>Registrar</a>
        </li>
        <li>
            <a href='./personas/personas.php'>Consultar</a>
        </li>
        <li>
            <a onClick='abrirReporte1()' href='#'>Reportes</a>
        </li>
    </ul>
</li>-->
<!-- <li class=''>
   <a href='#autoresSubmenu' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><span class='icofont-read-book-alt mr-3 h4 text-white'></span>Autores<i class='icofont-rounded-down text-white'></i></a>
   <ul class='collapse list-unstyled' id='autoresSubmenu'>
       <li>
           <a href='./autores/registrar_autores.php'>Registrar</a>
       </li>
       <li>
           <a href='./autores/autores.php'>Consultar</a>
       </li>
       <li>
           <a onClick='abrirReporte2()' href='#'>Reportes</a>
       </li>
   </ul>
</li>-->
<li class=''>
    <a href='#empleadosSubmenu' data-toggle='collapse' aria-expanded='false'
        class='dropdown-toggle'><span
            class='icofont-business-man mr-3 h4 text-white'></span>Empleados<i
            class='icofont-rounded-down text-white'></i></a>
    <ul class='collapse list-unstyled' id='empleadosSubmenu'>
        <li>
            <a href='./empleados/registrar_empleados.php'>Registrar</a>
        </li>
        <li>
            <a href='./empleados/empleados.php'>Consultar</a>
        </li>
        <li>
            <a onClick='abrirReporte3()' href='#'>Reportes</a>
        </li>
    </ul>
</li>
<li class=''>
    <a href='#puestoSubmenu' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><span
            class='icofont-ui-user mr-3 h4 text-white'></span>Puestos<i
            class='icofont-rounded-down text-white'></i></a>
    <ul class='collapse list-unstyled' id='puestoSubmenu'>
        <li>
            <a href='./puestos/registrar_puesto.php'>Registrar</a>
        </li>
        <li>
            <a href='./puestos/puestos.php'>Consultar</a>
        </li>
    </ul>
</li>
<!--<li class=''>
   <a href='#consultaSubmenu' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><span class='icofont-learn mr-3 h4 text-white'></span>Consultas<i class='icofont-rounded-down text-white'></i></a>
   <ul class='collapse list-unstyled' id='consultaSubmenu'>
       <li>
           <a href='./consultas/registrar_consultas.php'>Registrar</a>
       </li>
       <li>
           <a href='./consultas/consultas.php'>Consultar</a>
       </li>
       <li>
           <a onClick='abrirReporte4()' href='#'>Reportes</a>
       </li>
   </ul>
</li>-->
<!--  <li class=''>
   <a href='#prestamoSubmenu' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><span class='icofont-paper mr-3 h4 text-white'></span>Prestamos<i class='icofont-rounded-down text-white'></i></a>
   <ul class='collapse list-unstyled' id='prestamoSubmenu'>
       <li>
           <a href='./prestamos/registrar_prestamos.php'>Registrar</a>
       </li>
       <li>
           <a href='./prestamos/prestamos.php'>Consultar</a>
       </li>
       <li>
           <a onClick='abrirReporte5()' href='#'>Reportes</a>
       </li>
   </ul>
</li>-->";
 
 if ($_SESSION['Id_usuario'] == 1) {
$menu .="<li class=''>
    <a href='#userSubmenu' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'><span
            class='icofont-users-alt-4 mr-3 h4 text-white'></span>Usuarios<i
            class='icofont-rounded-down text-white'></i></a>
    <ul class='collapse list-unstyled' id='userSubmenu'>
        <li>
            <a href='./usuarios/registrar_usuarios.php'>Registrar</a>
        </li>
        <li>
            <a href='./usuarios/usuarios.php'>Consultar</a>
        </li>
    </ul>
</li>";
  }

  $menu .="</ul>";

?>