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

    $per_select = $_SESSION['periodo'];
    $b_per = buscarPeriodoAcadById($conexion, $per_select);
    $r_b_per = mysqli_fetch_array($b_per);

    $id_docente_sesion = buscar_docente_sesion($conexion, $_SESSION['id_sesion'], $_SESSION['token']);
    $b_docente = buscarDocenteById($conexion, $id_docente_sesion);
    $r_b_docente = mysqli_fetch_array($b_docente);

    $id_tutoria = $_POST['tutoria'];
    $b_tutoria = buscarTutoriaById($conexion, $id_tutoria);
    $r_b_tutoria = mysqli_fetch_array($b_tutoria);
    $b_docente_tutoria = buscarDocenteById($conexion, $r_b_tutoria['id_docente']);
    $r_b_docente_tutoria = mysqli_fetch_array($b_docente_tutoria);
    if ($r_b_docente_tutoria['id_programa_estudio'] == $r_b_docente['id_programa_estudio']) {

        $id_tutoria_est = $_POST['data'];

        $consulta = "UPDATE tutoria_estudiantes SET id_tutoria='$id_tutoria' WHERE id=$id_tutoria_est";
        $ejec_consulta = mysqli_query($conexion, $consulta);
        if ($ejec_consulta) {
            echo "<script>
            alert('Datos Modificados Correctamente');
			window.location= '../tutoria_estudiantes.php'
		</script>
	";
        } else {
            echo "<script>
			alert('Error al Actualizar Registro, por favor contacte con el administrador');
			window.history.back();
		</script>
	";
        }




        
    } else {
        echo "<script>
        window.history.back();
            </script>
        ";
    }
    mysqli_close($conexion);
}

