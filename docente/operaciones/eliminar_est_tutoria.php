<?php

include "../../include/conexion.php";
include "../../include/busquedas.php";
include "../../include/funciones.php";
include("../include/verificar_sesion_coordinador.php");
if (!verificar_sesion($conexion)) {
    echo "<script>
				  alert('Error Usted no cuenta con permiso para acceder a esta página');
				  window.location.replace('../login/');
			  </script>";
} else {
    $id_tutoria = $_GET['data'];
    $id_estudiante = $_GET['data2'];

    $per_select = $_SESSION['periodo'];
    $b_per = buscarPeriodoAcadById($conexion, $per_select);
    $r_b_per = mysqli_fetch_array($b_per);

    $id_docente_sesion = buscar_docente_sesion($conexion, $_SESSION['id_sesion'], $_SESSION['token']);
    $b_docente = buscarDocenteById($conexion, $id_docente_sesion);
    $r_b_docente = mysqli_fetch_array($b_docente);

    $b_tutoria = buscarTutoriaById($conexion, $id_tutoria);
    $r_b_tutoria = mysqli_fetch_array($b_tutoria);
    $b_docente_tutoria = buscarDocenteById($conexion, $r_b_tutoria['id_docente']);
    $r_b_docente_tutoria = mysqli_fetch_array($b_docente_tutoria);
    if ($r_b_docente_tutoria['id_programa_estudio'] == $r_b_docente['id_programa_estudio']) {

        $b_tutoria_est = buscarTutoriaEstudiantesByIdTutoriaAndIdEst($conexion, $id_tutoria, $id_estudiante);
        $r_b_tutoria_est = mysqli_fetch_array($b_tutoria_est);
        $id_tutoria_estudiante = $r_b_tutoria_est['id'];

        $b_tut_rec_info = buscarTutoriaRecojoInfoByIdTutEst($conexion, $id_tutoria_estudiante);
        while ($r_b_tut_rec_info = mysqli_fetch_array($b_tut_rec_info)) {
            $id_rec_info = $r_b_tut_rec_info['id'];
            $eliminar_rec_info = "DELETE FROM tutoria_recojo_informacion WHERE id='$id_rec_info'";
            $ejec_delete =mysqli_query($conexion, $eliminar_rec_info);
        }
        $b_tutoria_ses_indiv = buscarTutoriaSesIndivByIdTutEst($conexion, $id_tutoria_estudiante);
        while ($r_b_tutoria_ses_indiv = mysqli_fetch_array($b_tutoria_ses_indiv)) {
            $id_ses_indiv = $r_b_tutoria_ses_indiv['id'];
            $eliminar_ses_indiv = "DELETE FROM tutoria_sesion_individual WHERE id='$id_ses_indiv'";
            $ejec_delete =mysqli_query($conexion, $eliminar_ses_indiv);
        }
        $eliminar_tut_est = "DELETE FROM tutoria_estudiantes WHERE id='$id_tutoria_estudiante'";
        $ejec_delete = mysqli_query($conexion, $eliminar_tut_est);
        if($ejec_delete) {
            echo "<script>
			alert('Eliminado Correctamente');
			window.history.back();
		</script>
	    ";
        } else {
            echo "<script>
			alert('Error, No se pudo eliminar el registro');
			window.history.back();
		</script>
	    ";
        }
    }
}
