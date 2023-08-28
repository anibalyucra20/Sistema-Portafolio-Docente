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
    
    $b_tutoria = buscarTutoriaByIdDocenteAndIdPeriodo($conexion, $id_docente_sesion, $per_select);
    $r_b_tutoria = mysqli_fetch_array($b_tutoria);

    $b_est_tutoria = buscarTutoriaEstudiantesByIdTutoria($conexion, $r_b_tutoria['id']);
    $error = 0;
    while ($r_b_est_tutoria = mysqli_fetch_array($b_est_tutoria)) {
        $id_est_tutoria  = $r_b_est_tutoria['id'];
        $observacion = $_POST['obs_' . $id_est_tutoria];
        $b_tut_rec_info = buscarTutoriaRecojoInfoByIdTutEst($conexion, $id_est_tutoria);
        while ($r_b_tut_rec_info = mysqli_fetch_array($b_tut_rec_info)) {
            $id_rec_info = $r_b_tut_rec_info['id'];
            $valor = $_POST[$id_est_tutoria . '_' . $id_rec_info];
            $consulta = "UPDATE tutoria_recojo_informacion SET valor='$valor' WHERE id=$id_rec_info";
            $actualizar = mysqli_query($conexion, $consulta);
            if (!$actualizar) {
                $error ++;
            }
        }
        $consultar = "UPDATE tutoria_estudiantes SET observacion='$observacion' WHERE id=$id_est_tutoria";
        $ejecutar = mysqli_query($conexion, $consultar);
        if (!$ejecutar) {
            $error ++;
        }
    }
    if ($error == 0) {
        echo "<script>
                alert('Actualizado Correctamente');
                window.location= '../tutoria_recojo_informacion.php'
            </script>
        ";
    }else {
        echo "<script>
                alert('Error al Actualizar ".$error." Registros');
                window.history.back();
            </script>
        ";
    }
}
