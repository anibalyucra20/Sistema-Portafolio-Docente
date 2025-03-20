<?php

include "../../include/conexion.php";
include "../../include/busquedas.php";
include "../../include/funciones.php";
include("../include/verificar_sesion_secretaria.php");
if (!verificar_sesion($conexion)) {
    echo "<script>
				  alert('Error Usted no cuenta con permiso para acceder a esta página');
				  window.location.replace('../login/');
			  </script>";
} else {



    $id_prog = $_GET['data'];

    //buscar silabo
    $b_silabo = buscarSilaboByIdProgramacion($conexion, $id_prog);
    $r_b_silabo = mysqli_fetch_array($b_silabo);
    $id_silabo = $r_b_silabo['id'];

    //buscar programaciones de actividades del silabo 
    $b_prog_act_silabo = buscarProgActividadesSilaboByIdSilabo($conexion, $id_silabo);
    while ($r_b_prog_act_silabo = mysqli_fetch_array($b_prog_act_silabo)) {
        $id_prog_actividad_silabo = $r_b_prog_act_silabo['id'];

        //buscamos las sesiones que corresponden a la programacion de actividades del silabo
        $b_sesion_a = buscarSesionByIdProgramacionActividades($conexion, $r_b_prog_act_silabo['id']);
        while ($r_b_sesion_a = mysqli_fetch_array($b_sesion_a)) {
            $id_sesion_aprendizaje = $r_b_sesion_a['id'];

            //buscamos momentos de sesion de aprendizaje
            $b_momentos_sesion = buscarMomentosSesionByIdSesion($conexion, $id_sesion_aprendizaje);
            while ($r_b_momentos_sesion = mysqli_fetch_array($b_momentos_sesion)) {
                $id_momento_sesion = $r_b_momentos_sesion['id'];
                $eliminar_momento = "DELETE FROM momentos_sesion_aprendizaje WHERE id='$id_momento_sesion'";
                mysqli_query($conexion, $eliminar_momento);
            }
            //buscamos actividades de evaluacion de sesion de aprendizaje
            $b_act_eva_sesion = buscarActividadesEvaluacionByIdSesion($conexion, $id_sesion_aprendizaje);
            while ($r_b_act_eva_sesion = mysqli_fetch_array($b_act_eva_sesion)) {
                $id_act_eva_sesion = $r_b_act_eva_sesion['id'];
                $eliminar_actividades = "DELETE FROM actividad_evaluacion_sesion_aprendizaje WHERE id='$id_act_eva_sesion'";
                mysqli_query($conexion, $eliminar_actividades);
            }
            $eliminar_sesion = "DELETE FROM sesion_aprendizaje WHERE id='$id_sesion_aprendizaje'";
            mysqli_query($conexion, $eliminar_sesion);
        }
        $eliminar_activida_silabo = "DELETE FROM programacion_actividades_silabo WHERE id='$id_prog_actividad_silabo'";
        mysqli_query($conexion, $eliminar_activida_silabo);
    }
    // eliminar silabo
    $eliminar_silabo = "DELETE FROM silabo WHERE id='$id_silabo'";
    mysqli_query($conexion, $eliminar_silabo);

    //eliminar programacion
    $eliminar_programacion = "DELETE FROM programacion_unidad_didactica WHERE id='$id_prog'";
    $ejec_d_prog = mysqli_query($conexion, $eliminar_programacion);

    if ($ejec_d_prog) {
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
