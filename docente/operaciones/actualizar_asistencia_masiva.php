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

    $id_sesion = base64_decode($_POST['ddata']);
    $id_prog = base64_decode($_POST['ddata2']);
    $asistencia = $_POST['asistencia'];


    $b_prog = buscarProgramacionById($conexion, $id_prog);
    $res_b_prog = mysqli_fetch_array($b_prog);
    $b_periodo_acad = buscarPeriodoAcadById($conexion, $res_b_prog['id_periodo_acad']);
    $r_per_acad = mysqli_fetch_array($b_periodo_acad);
    $fecha_actual = strtotime(date("d-m-Y"));
    $fecha_fin_per = strtotime($r_per_acad['fecha_fin']);
    if ($fecha_actual <= $fecha_fin_per) {

        $b_detalle_mat = buscarDetalleMatriculaByIdProgramacion($conexion, $id_prog);
        while ($r_b_det_mat = mysqli_fetch_array($b_detalle_mat)) {
            $b_matricula = buscarMatriculaById($conexion, $r_b_det_mat['id_matricula']);
            $r_b_matricula = mysqli_fetch_array($b_matricula);

            $b_asistencia = buscarAsistenciaBySesionAndEstudiante($conexion, $id_sesion, $r_b_matricula['id_estudiante']);
            $r_b_asistencia = mysqli_fetch_array($b_asistencia);
            $id_ass = $r_b_asistencia['id'];

            $consulta = "UPDATE asistencia SET asistencia='$asistencia' WHERE id='$id_ass'";
            $ejec_consulta = mysqli_query($conexion, $consulta);
        }
    }
}
