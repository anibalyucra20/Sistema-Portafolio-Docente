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

    $id_prog_actual = $_POST['myidactual'];
    $id_prog_a_copiar = $_POST['silabo_copi'];


    $b_silabos_prog_actual = buscarSilaboByIdProgramacion($conexion, $id_prog_actual);
    $r_b_silabo_prog_actual = mysqli_fetch_array($b_silabos_prog_actual);
    $id_silabo_actual = $r_b_silabo_prog_actual['id'];

    $b_silabos_prog_copiar = buscarSilaboByIdProgramacion($conexion, $id_prog_a_copiar);
    $r_b_silabos_prog_copiar = mysqli_fetch_array($b_silabos_prog_copiar);
    $id_silabo_a_copiar = $r_b_silabos_prog_copiar['id'];

    $b_silabo = buscarSilaboById($conexion, $id_silabo_a_copiar);
    $r_b_silabo = mysqli_fetch_array($b_silabo);

    $metodologia = $r_b_silabo['metodologia'];
    $recursos_didacticos = $r_b_silabo['recursos_didacticos'];
    $sistema_evaluacion = $r_b_silabo['sistema_evaluacion'];
    $estrategia_evaluacion_indicadores = $r_b_silabo['estrategia_evaluacion_indicadores'];
    $estrategia_evaluacion_tecnica = $r_b_silabo['estrategia_evaluacion_tecnica'];
    $promedio_indicadores_logro = $r_b_silabo['promedio_indicadores_logro'];
    $recursos_bibliograficos_impresos = $r_b_silabo['recursos_bibliograficos_impresos'];
    $recursos_bibliograficos_digitales = $r_b_silabo['recursos_bibliograficos_digitales'];

    //ACTUALIZAR INFORMACION
    $consulta_silabo = "UPDATE silabo SET metodologia='$metodologia', recursos_didacticos='$recursos_didacticos', sistema_evaluacion='$sistema_evaluacion',estrategia_evaluacion_indicadores='$estrategia_evaluacion_indicadores',estrategia_evaluacion_tecnica='$estrategia_evaluacion_tecnica',promedio_indicadores_logro='$promedio_indicadores_logro',recursos_bibliograficos_impresos='$recursos_bibliograficos_impresos',recursos_bibliograficos_digitales='$recursos_bibliograficos_digitales' WHERE id='$id_silabo_actual'";
    $ejec_update_silabo= mysqli_query($conexion, $consulta_silabo);



    // buscamos las actividades
    $b_actividades_silabo = buscarProgActividadesSilaboByIdSilabo($conexion, $r_b_silabo_prog_actual['id']);
    while ($r_b_act_silabo = mysqli_fetch_array($b_actividades_silabo)) {
        $semana_actual = $r_b_act_silabo['semana'];
        $id_actividad_actual = $r_b_act_silabo['id'];

        $b_act_silabo_a_copiar = buscarProgActividadesSilaboByIdSilaboAndSemana($conexion, $id_silabo_a_copiar, $semana_actual);
        $r_b_act_silabo_a_copiar = mysqli_fetch_array($b_act_silabo_a_copiar);
        $id_actividad_a_copiar = $r_b_act_silabo_a_copiar['id'];


        //---------- DATOS DE ACTIVIDAD A COPIAR ----------------
        $b_actividad_copiar = buscarProgActividadesSilaboById($conexion, $id_actividad_a_copiar);
        $rb_actividad_copiar = mysqli_fetch_array($b_actividad_copiar);

        $elemento_capacidad = $rb_actividad_copiar['elemento_capacidad'];
        $actividades_aprendizaje = $rb_actividad_copiar['actividades_aprendizaje'];
        $contenidos_basicos = $rb_actividad_copiar['contenidos_basicos'];
        $tareas_previas = $rb_actividad_copiar['tareas_previas'];

        //ACTUALIZAR INFORMACION
        $consulta_actividad = "UPDATE programacion_actividades_silabo SET elemento_capacidad='$elemento_capacidad', actividades_aprendizaje='$actividades_aprendizaje', contenidos_basicos='$contenidos_basicos',tareas_previas='$tareas_previas' WHERE id='$id_actividad_actual'";
        $ejec_update_actividad = mysqli_query($conexion, $consulta_actividad);
    }

    mysqli_close($conexion);


    echo "<script>
			alert('Datos Copiados Correctamente');
			window.location= '../silabos.php?id=" . $id_prog_actual . "';
				</script>
			";
}
