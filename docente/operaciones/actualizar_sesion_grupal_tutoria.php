<?php
include "../../include/conexion.php";
include "../../include/busquedas.php";
include "../../include/funciones.php";
include("../include/verificar_sesion_docente_coordinador.php");
if (!verificar_sesion($conexion)) {
    echo "<script>
				  alert('Error Usted no cuenta con permiso para acceder a esta página');
				  window.location.replace('../login/');
			  </script>";
} else {
    $id_docente_sesion = buscar_docente_sesion($conexion, $_SESSION['id_sesion'], $_SESSION['token']);
    $b_docente = buscarDocenteById($conexion, $id_docente_sesion);
    $r_b_docente = mysqli_fetch_array($b_docente);

    $per_select = $_SESSION['periodo'];
    $b_per = buscarPeriodoAcadById($conexion, $per_select);
    $r_b_per = mysqli_fetch_array($b_per);

    $b_docentes_pe = buscarDocentesByIdPe($conexion, $r_b_docente['id_programa_estudio']);

    $id_sesion_grupal = $_POST['id_sesion_grupal'];

    $b_sesion_grupal = buscarTutoriaSesGrupalById($conexion, $id_sesion_grupal);
    $r_b_sesion_grupal = mysqli_fetch_array($b_sesion_grupal);
    $b_tutoria = buscarTutoriaById($conexion, $r_b_sesion_grupal['id_tutoria']);
    $r_b_tutoria = mysqli_fetch_array($b_tutoria);
    if ($id_docente_sesion == $r_b_tutoria['id_docente']) {

        $titulo = $_POST['titulo'];
        $fecha_hora = date("Y-m-d H:i:s", strtotime($_POST['fecha_hora']));
        $tema = $_POST['tema'];
        $link = $_POST['link'];
        $resultados = $_POST['resultados'];
        $array_asistentes = $_POST['array_asistentes'];


        $consulta = "UPDATE tutoria_sesion_grupal SET titulo='$titulo',fecha_hora='$fecha_hora',tema='$tema',link_reunion='$link',resultados='$resultados',asistentes='$array_asistentes' WHERE id='$id_sesion_grupal'";
        $ejec_consulta = mysqli_query($conexion, $consulta);

        if ($ejec_consulta) {
            echo "<script>
            alert('Datos Modificados Correctamente');
			window.location= '../editar_sesion_grupal_tutoria.php?data=".$id_sesion_grupal."';
		</script>
	";
        } else {
            echo "<script>
			alert('Error al Actualizar Registro, por favor contacte con el administrador');
			window.history.back();
		</script>
	";
        }

        mysqli_close($conexion);
    } else {
        echo "<script>
        window.history.back();
            </script>
        ";
    }
}
