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

    $per_select = $_SESSION['periodo'];
    $b_per = buscarPeriodoAcadById($conexion, $per_select);
    $r_b_per = mysqli_fetch_array($b_per);

    $id_sesion_indiv= $_POST['id_sesion_indiv'];

    $b_sesion_indiv = buscarTutoriaSesIndivById($conexion, $id_sesion_indiv);
    $r_b_sesion_indiv = mysqli_fetch_array($b_sesion_indiv);
    $id_tut_est = $r_b_sesion_indiv['id_tutoria_estudiante'];
    $b_tutoria_est = buscarTutoriaEstudiantesById($conexion, $id_tut_est);
    $r_b_tutoria_est = mysqli_fetch_array($b_tutoria_est);
    $id_tutoria = $r_b_tutoria_est['id_tutoria'];
    $b_tutoria = buscarTutoriaById($conexion, $id_tutoria);
    $r_b_tutoria = mysqli_fetch_array($b_tutoria);
    $id_docente_tutoria = $r_b_tutoria['id_docente'];
    if ($id_docente_tutoria == $id_docente_sesion) {

        $titulo = $_POST['titulo'];
        $motivo = $_POST['motivo'];
        $fecha_hora = $_POST['fecha_hora'];
        $link = $_POST['link'];
        $resultados = $_POST['resultados'];
        $asistencia = $_POST['asistencia'];

        $consulta = "UPDATE tutoria_sesion_individual SET titulo='$titulo',fecha_hora='$fecha_hora',motivo='$motivo',link_reunion='$link',resultados='$resultados',asistencia='$asistencia' WHERE id='$id_sesion_indiv'";
		$ejecutar_consulta = mysqli_query($conexion, $consulta);
        if ($ejecutar_consulta) {
			echo "<script>
                alert('Actualizado Correctamente');
                window.location= '../tutoria_sesion_individual.php?data=".$id_tut_est."'
    			</script>";
		} else {
			echo "<script>
			alert('Error al Actualizar, por favor verifique sus datos');
			window.history.back();
				</script>
			";
		};

    } else {
        echo "<script>
    window.history.back();
        </script>
    ";
    }






    mysqli_close($conexion);
}
