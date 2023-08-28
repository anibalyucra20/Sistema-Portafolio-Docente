<?php

include "../../include/conexion.php";
include "../../include/busquedas.php";
include "../../include/funciones.php";
include("../include/verificar_sesion_coordinador.php");
if (!verificar_sesion($conexion)) {
	echo "<script>
				  alert('Error Usted no cuenta con permiso para acceder a esta página');
				  window.location.replace('login/');
			  </script>";
} else {


	$id_per = $_SESSION['periodo'];
	$id_pe = $_POST['id_pe'];
	$id_sem = $_POST['id_sem'];

	$ejec_cons = buscarMatriculaByIdPeriodoCarreraSem($conexion, $id_per, $id_pe, $id_sem);

	$cadena = '<div class="checkbox">
		<label>
		  <input type="checkbox" onchange="select_all();" id="all_check"> <b> SELECCIONAR TODOS LOS ESTUDIANTES *</b>
		</label>
		</div>';

	while ($mostrar = mysqli_fetch_array($ejec_cons)) {
		$id_estudiante = $mostrar["id_estudiante"];

		//validar para solo mostrar estudiantes que no esten asignados a otra tutoria en el periodo
		$b_tutoria_est = buscarTutoria_EstudianteByIdEstudiante($conexion, $id_estudiante);
		$contar = 0;
		while ($r_b_tutoria_est = mysqli_fetch_array($b_tutoria_est)) {
			$b_tutoria = buscarTutoriaById($conexion, $r_b_tutoria_est['id_tutoria']);
			$r_b_tutoria = mysqli_fetch_array($b_tutoria);
			if ($id_per == $r_b_tutoria['id_periodo_acad']) {
				$contar++;
			}
		}
		if ($contar == 0) {
			$busc_est = buscarEstudianteById($conexion, $id_estudiante);
			$cont = mysqli_num_rows($busc_est);
			if ($cont > 0) {
				$res_est = mysqli_fetch_array($busc_est);
				$cadena = $cadena . '<div class="checkbox"><label><input type="checkbox" name="estudiantes" onchange="gen_arr_est();" value="' . $res_est["id"] . '">' . $res_est["apellidos_nombres"] . '</label></div>';
			}
		}
	}
	echo $cadena;
}
