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
	$titulo = $_POST['titulo'];
	$fecha_hora = $_POST['fecha_hora'];
	$tema = $_POST['tema'];
	$link = $_POST['link'];
	$resultados = $_POST['resultados'];
    
	$b_tutoria = buscarTutoriaByIdDocenteAndIdPeriodo($conexion, $id_docente_sesion, $per_select);
    $r_b_tutoria = mysqli_fetch_array($b_tutoria);
    $id_tutoria = $r_b_tutoria['id'];
	
		$insertar = "INSERT INTO tutoria_sesion_grupal (id_tutoria, titulo, fecha_hora, tema, link_reunion, resultados, asistentes) VALUES ('$id_tutoria','$titulo','$fecha_hora','$tema','$link', '$resultados', ' ')";
		$ejecutar_insetar = mysqli_query($conexion, $insertar);
		if ($ejecutar_insetar) {
			echo "<script>
                alert('Registro Existoso');
                window.location= '../tutoria_sesion_grupal.php'
    			</script>";
		} else {
			echo "<script>
			alert('Error al registrar, por favor verifique sus datos');
			window.history.back();
				</script>
			";
		};
	
	mysqli_close($conexion);
}
