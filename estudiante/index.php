<?php
session_start();
if (!isset($_SESSION['id_sesion_est'])) {
	echo "<script>
			window.location.replace('login/');
		</script>
		";
} else {


	include("../include/conexion.php");
	include("../include/busquedas.php");
	include("../include/funciones.php");
	include 'include/verificar_sesion_estudiante.php';
	if (!verificar_sesion($conexion)) {
		echo "<script>
                  alert('Error Usted no cuenta con permiso para acceder a esta página');
                  window.location.replace('index.php');
          </script>";
	} else {

		$id_estudiante_sesion = buscar_estudiante_sesion($conexion, $_SESSION['id_sesion_est'], $_SESSION['token']);
		$b_estudiante = buscarEstudianteById($conexion, $id_estudiante_sesion);
		$r_b_estudiante = mysqli_fetch_array($b_estudiante);

?>
		<!DOCTYPE html>
		<html lang="es">

		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<!-- Meta, title, CSS, favicons, etc. -->
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Inicio<?php include("../include/header_title.php"); ?></title>
			<!--icono en el titulo-->
			<link rel="shortcut icon" href="../img/favicon.ico">
			<!-- Bootstrap -->
			<link href="../Gentella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
			<!-- Font Awesome -->
			<link href="../Gentella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
			<!-- NProgress -->
			<link href="../Gentella/vendors/nprogress/nprogress.css" rel="stylesheet">
			<!-- iCheck -->
			<link href="../Gentella/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
			<!-- bootstrap-progressbar -->
			<link href="../Gentella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
			<!-- JQVMap -->
			<link href="../Gentella/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
			<!-- bootstrap-daterangepicker -->
			<link href="../Gentella/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
			<!-- Custom Theme Style -->
			<link href="../Gentella/build/css/custom.min.css" rel="stylesheet">
		</head>

		<body class="nav-md">
			<div class="container body">
				<div class="main_container">
					<?php
					include("include/menu.php");

					$b_perido = buscarPeriodoAcadById($conexion, $_SESSION['periodo']);
					$r_b_per = mysqli_fetch_array($b_perido);

					$b_matricula = buscarMatriculaByEstudiantePeriodo($conexion, $id_estudiante_sesion, $_SESSION['periodo']);
					$r_b_matricula = mysqli_fetch_array($b_matricula);
					$id_matricula = $r_b_matricula['id'];
					$b_det_mat = buscarDetalleMatriculaByIdMatricula($conexion, $id_matricula);
					$cont_det_mat = mysqli_num_rows($b_det_mat);
					?>
					<!-- page content -->
					<div class="right_col" role="main">
						<!-- top tiles -->
						<div class="row tile_count">
							<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
								<span class="count_top"><i class="fa fa-calendar"></i> Periodo Académico</span>
								<div class="count"><?php echo $r_b_per['nombre']; ?></div>
								<span class="count_bottom"><a href=""><i class="green">.</i></a></span>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
								<span class="count_top"><i class="fa fa-pencil-square-o"></i> Mis Unidades Didácticas</span>
								<div class="count"><?php echo $cont_det_mat; ?></div>
								<span class="count_bottom"><a href="mis_unidades_didacticas.php"><i class="green">Ver</i></a></span>
							</div>



						</div>




					</div>
					<!-- /page content -->


					<?php
					include("../include/footer.php");
					?>
					<!--/footer content -->
				</div>
			</div>

			<!-- jQuery -->
			<script src="../Gentella/vendors/jquery/dist/jquery.min.js"></script>
			<!-- Bootstrap -->
			<script src="../Gentella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
			<!-- FastClick -->
			<script src="../Gentella/vendors/fastclick/lib/fastclick.js"></script>
			<!-- NProgress -->
			<script src="../Gentella/vendors/nprogress/nprogress.js"></script>
			<!-- Chart.js -->
			<script src="../Gentella/vendors/Chart.js/dist/Chart.min.js"></script>
			<!-- gauge.js -->
			<script src="../Gentella/vendors/gauge.js/dist/gauge.min.js"></script>
			<!-- bootstrap-progressbar -->
			<script src="../Gentella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
			<!-- iCheck -->
			<script src="../Gentella/vendors/iCheck/icheck.min.js"></script>
			<!-- Skycons -->
			<script src="../Gentella/vendors/skycons/skycons.js"></script>
			<!-- Flot -->
			<script src="../Gentella/vendors/Flot/jquery.flot.js"></script>
			<script src="../Gentella/vendors/Flot/jquery.flot.pie.js"></script>
			<script src="../Gentella/vendors/Flot/jquery.flot.time.js"></script>
			<script src="../Gentella/vendors/Flot/jquery.flot.stack.js"></script>
			<script src="../Gentella/vendors/Flot/jquery.flot.resize.js"></script>
			<!-- Flot plugins -->
			<script src="../Gentella/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
			<script src="../Gentella/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
			<script src="../Gentella/vendors/flot.curvedlines/curvedLines.js"></script>
			<!-- DateJS -->
			<script src="../Gentella/vendors/DateJS/build/date.js"></script>
			<!-- JQVMap -->
			<script src="../Gentella/vendors/jqvmap/dist/jquery.vmap.js"></script>
			<script src="../Gentella/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
			<script src="../Gentella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
			<!-- bootstrap-daterangepicker -->
			<script src="../Gentella/vendors/moment/min/moment.min.js"></script>
			<script src="../Gentella/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

			<!-- Custom Theme Scripts -->
			<script src="../Gentella/build/js/custom.min.js"></script>

		</body>

		</html>
<?php }
}
