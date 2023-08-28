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

    $conclusiones = $_POST['conclusion'];

    $b_tutoria = buscarTutoriaByIdDocenteAndIdPeriodo($conexion, $id_docente_sesion, $per_select);
    $r_b_tutoria = mysqli_fetch_array($b_tutoria);
    $id_tutoria = $r_b_tutoria['id'];
    $consultar = "UPDATE tutoria SET conclusiones='$conclusiones' WHERE id=$id_tutoria";
    $ejecutar = mysqli_query($conexion, $consultar);

    if ($ejecutar) {
        echo "<script>
                alert('Actualizado Correctamente');
                window.location= '../tutoria.php'
            </script>
        ";
    }else {
        echo "<script>
                alert('Error al Actualizar Registro');
                window.history.back();
            </script>
        ";
    }
}
