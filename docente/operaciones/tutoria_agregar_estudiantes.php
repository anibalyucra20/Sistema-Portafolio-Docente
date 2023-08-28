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

    $per_select = $_SESSION['periodo'];
    $b_per = buscarPeriodoAcadById($conexion, $per_select);
    $r_b_per = mysqli_fetch_array($b_per);

    $id_docente_sesion = buscar_docente_sesion($conexion, $_SESSION['id_sesion'], $_SESSION['token']);
    $b_docente = buscarDocenteById($conexion, $id_docente_sesion);
    $r_b_docente = mysqli_fetch_array($b_docente);

    $id_tutoria = $_POST['data'];
    $b_tutoria = buscarTutoriaById($conexion, $id_tutoria);
    $r_b_tutoria = mysqli_fetch_array($b_tutoria);
    $b_docente_tutoria = buscarDocenteById($conexion, $r_b_tutoria['id_docente']);
    $r_b_docente_tutoria = mysqli_fetch_array($b_docente_tutoria);
    
    $arr_recojo_informacion = array("Tiene confianza en lograr las metas que se propone y enfrentar las dificultades.", "Tiene iniciativa para resolver sus problemas.", "Se comunica en forma clara expresando sus ideas, sentimientos y opiniones.", "Valora y acepta a los demás respetando su diversidad.", "Tiene un Proyecto de Vida personal.", "Toma decisiones en forma asertiva e independiente.", "Asume responsablemente su rol de estudiante.", "Tiene habilidades para solucionar conflictos familiares.", "Se integra rápidamente a los grupos de amigos/as.");

    if ($r_b_docente_tutoria['id_programa_estudio']== $r_b_docente['id_programa_estudio']) {
        $detalle_estudiantes = explode(",", $_POST['est_relacion']);
        //recorremos el array del detalle para buscar datos complementarios y registrar el detalle
        $contar_fallas = 0;
        foreach ($detalle_estudiantes as $valor) {
            //validar si ya existe estudiante en la tutoria
            $reg_est_tutoria =  "INSERT INTO tutoria_estudiantes (id_tutoria, id_estudiante, observacion) VALUES ('$id_tutoria','$valor','')";
            $ejecutar_reg_est_tutoria = mysqli_query($conexion, $reg_est_tutoria);
            if ($ejecutar_reg_est_tutoria) {
                $id_tutoria_estudiantes = mysqli_insert_id($conexion);
                foreach ($arr_recojo_informacion as $value) {
                    $reg_recojo_info = "INSERT INTO tutoria_recojo_informacion (id_tutoria_estudiante, descripcion, valor) VALUES ('$id_tutoria_estudiantes','$value',1)";
                    mysqli_query($conexion, $reg_recojo_info);
                }
            }else{
                $contar_fallas ++;
            }
        }
        if ($contar_fallas==0) {
            echo "<script>
				  alert('Se agregó correctamente');
				  window.location.replace('../tutoria_estudiantes_agregar.php?data=".$id_tutoria."');
			  </script>";
        }else {
            echo "<script>
			alert('Error, no se pudo registrar ".$contar_fallas." registros');
			window.history.back();
				</script>
			";
        }
    }
}
