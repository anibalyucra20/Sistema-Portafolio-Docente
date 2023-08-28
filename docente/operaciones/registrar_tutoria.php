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
	$id_docente = $_POST['docente'];

	$b_tutoria = buscarTutoriaByIdDocenteAndIdPeriodo($conexion, $id_docente, $per_select);
	$cont_tutoria = mysqli_num_rows($b_tutoria);
	if ($cont_tutoria == 0) {
		$insertar = "INSERT INTO tutoria (id_docente, id_periodo_acad, conclusiones) VALUES ('$id_docente', '$per_select', '')";
		$ejecutar_insetar = mysqli_query($conexion, $insertar);
		if ($ejecutar_insetar) {
			echo "<script>
                alert('Registro Existoso');
                window.location= '../tutoria_programacion.php'
    			</script>";
		} else {
			echo "<script>
			alert('Error al registrar, por favor verifique sus datos');
			window.history.back();
				</script>
			";
		};
	}else {
		echo "<script>
			alert('Error, El docente ya se encuentra registrado como tutor');
			window.history.back();
				</script>
			";
	}








	mysqli_close($conexion);
}
