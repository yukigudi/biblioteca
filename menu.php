<?php
    session_start();
    $id=$_SESSION['Id_usuario'];
    $usuario=$id;
    if ($id == null || $id == '') {
        header("location:index.php");
    }

    function menu(){
  ?>
<ul class="list-unstyled components">

    <li class="">
        <a href="#modulosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
                class="icofont-library mr-3 h4 text-white"></span>Módulos<i
                class="icofont-rounded-down text-white"></i></a>
        <ul class="collapse list-unstyled" id="modulosSubmenu">
            <li>
                <a href="/biblioteca/libros/registrar_libros.php">Registrar</a>
            </li>
            <li>
                <a href="/biblioteca/libros/libros.php">Consultar</a>
            </li>
            <li>
                <a href="/biblioteca/modulos_envio/registrar_envio.php">Enviar</a>
            </li>
            <li>
                <a href="/biblioteca/modulos_recibido/registro.php">Recibir</a>
            </li>
            <li>
                <a href="/biblioteca/modulos_retorno/registrar_retorno.php">Devolver</a>
            </li>
            <li>
                <a href="/biblioteca/incidencias/registrar_incidencias.php" target="_blank">Incidencias</a>
            </li>
            <li>
                <a href="/biblioteca/modulos_asignaciones/registro.php">Asignaciones</a>
            </li>
            <!-- <li>
                             <a onClick='abrirReporte()' href="#">Reportes</a>
                         </li>-->
        </ul>
    </li>

    <li class="">
        <a href="#plazaSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
                class="icofont-location-pin mr-3 h4 text-white"></span>Ubicaciones<i
                class="icofont-rounded-down text-white"></i></a>
        <ul class="collapse list-unstyled" id="plazaSubmenu">
            <li>
                <a href="/biblioteca/ubicaciones/registrar_cordzona.php">Registrar Coordinación de Zona</a>
            </li>
            <li>
                <a href="/biblioteca/ubicaciones/registrar_delegacion.php">Registrar Delegación</a>
            </li>
            <li>
                <a href="/biblioteca/ubicaciones/registrar_ubicacionresguardo.php">Registrar ubicación de resguardo</a>
            </li>
            <li>
                <a href="/biblioteca/ubicaciones/cordzona.php">Consultar Coordinación de Zona</a>
            </li>
            <li>
                <a href="/biblioteca/ubicaciones/delegacion.php">Consultar Delegaciones</a>
            </li>
            <li>
                <a href="/biblioteca/ubicaciones/ubicaciones_resguardo.php">Consultar ubicación de resguardo</a>
            </li>

        </ul>
    </li>

    <li class="">
        <a href="#reportesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
                class="icofont-list mr-3 h4 text-white"></span>Reportes<i
                class="icofont-rounded-down text-white"></i></a>
        <ul class="collapse list-unstyled" id="reportesSubmenu">
        <li>
                <a href="/biblioteca/reportes/inventarios.php">Inventarios</a>
            </li>
            <li>
                <a href="/biblioteca/reportes/envios.php">Envíos</a>
            </li>
            <li>
            <a href="/biblioteca/reportes/recibidos.php">Recibos</a>
            </li>
            <li>
            <a href="/biblioteca/reportes/devoluciones.php">Devoluciones</a>
            </li>
            <li>
            <a href="/biblioteca/reportes/incidencias.php">Incidencias</a>
            </li>
            <li>
            <a href="/biblioteca/reportes/asignaciones.php">Asignaciones</a>
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
                <a href="/biblioteca/usuarios/registrar_usuarios.php">Registrar</a>
            </li>
            <li>
                <a href="/biblioteca/usuarios/usuarios.php">Consultar</a>
            </li>
        </ul>
    </li>
    <?php   }?>
    <li class="">
        <a href="#tecnicoSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span
                class="icofont-teacher mr-3 h4 text-white"></span>Técnico Docente<i
                class="icofont-rounded-down text-white"></i></a>
        <ul class="collapse list-unstyled" id="tecnicoSubmenu">
            <li>
                <a href="/biblioteca/usuarios/registrar_tecnicod.php">Registrar</a>
            </li>
            <li>
                <a href="/biblioteca/usuarios/tecnicod.php">Consultar</a>
            </li>
        </ul>
    </li>
</ul>

<?php   }?>


<script>
function abrirReporte() {
    window.open("../reporte_envios/index.php", "Reporte de libros", "directories=no location=no");
}

function abrirReporte1() {
    window.open("../reporte_recibidos/index.php", "Reporte de módulos", "directories=no location=no");
}
function abrirReporte2() {
    window.open("../reporte_devoluciones/index.php", "Reporte de empleados", "directories=no location=no");
}
function abrirReporte3() {
    window.open("../reporte_incidencias/index.php", "Reporte de incidencias", "directories=no location=no");
}


</script>