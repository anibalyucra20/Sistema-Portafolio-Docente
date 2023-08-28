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

    $id_tutoria_est = $_POST['data'];
    $b_tutoria_est = buscarTutoriaEstudiantesById($conexion, $id_tutoria_est);
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

        $insertar = "INSERT INTO tutoria_sesion_individual (id_tutoria_estudiante, titulo, fecha_hora, motivo, link_reunion, resultados, asistencia) VALUES ('$id_tutoria_est','$titulo','$fecha_hora','$motivo','$link', ' ',1)";
		$ejecutar_insetar = mysqli_query($conexion, $insertar);
        if ($ejecutar_insetar) {
			echo "<script>
                alert('Registro Existoso');
                window.location= '../tutoria_sesion_individual.php?data=".$id_tutoria_est."'
    			</script>";
		} else {
			echo "<script>
			alert('Error al registrar, por favor verifique sus datos');
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
