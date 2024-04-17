<?php
include("../include/conexion.php");
include("../include/busquedas.php");
include("../include/funciones.php");

include("include/verificar_sesion_estudiante.php");

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
        <meta http-equiv="Content-Language" content="es-ES">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ficha Estudiante<?php include("../include/header_title.php"); ?></title>
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
        <!-- bootstrap-wysiwyg -->
        <link href="../Gentella/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
        <!-- Select2 -->
        <link href="../Gentella/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
        <!-- Switchery -->
        <link href="../Gentella/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
        <!-- starrr -->
        <link href="../Gentella/vendors/starrr/dist/starrr.css" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
        <link href="../Gentella/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">


        <!-- Custom Theme Style -->
        <link href="../Gentella/build/css/custom.min.css" rel="stylesheet">
        <!-- Script obtenido desde CDN jquery -->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <!--menu-->
                <?php
                include("include/menu.php"); ?>

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">

                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="">
                                        <h2 align="center">Cambiar Contraseña</h2>
                                        <br>
                                        <form role="form" action="operaciones/actualizar_datos.php" class="form-horizontal form-label-left input_mask" method="POST" enctype="multipart/form-data">
                                            <table class="table table-striped jambo_table bulk_action">
                                                <tbody>
                                                    <tr>
                                                        <td width="20%">Ingrese su Nueva Contraseña : </td>
                                                        <td><input type="password" class="form-control" name="contrasenia"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ingrese Nuevamente la Contraseña: </td>
                                                        <td><input type="password" class="form-control" name="contrasenia2"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div align="center">
                                                        <a class="btn btn-danger" href="index.php"> Cancelar</a>
                                                        <button type="submit" class="btn btn-success">Guardar</button>
                                                    </div>
                                        </form>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content -->

                <!-- footer content -->
                <?php
                include("../include/footer.php");
                ?>
                <!-- /footer content -->
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
        <!-- bootstrap-progressbar -->
        <script src="../Gentella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="../Gentella/vendors/iCheck/icheck.min.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="../Gentella/vendors/moment/min/moment.min.js"></script>
        <script src="../Gentella/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap-wysiwyg -->
        <script src="../Gentella/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
        <script src="../Gentella/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
        <script src="../Gentella/vendors/google-code-prettify/src/prettify.js"></script>
        <!-- jQuery Tags Input -->
        <script src="../Gentella/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
        <!-- Switchery -->
        <script src="../Gentella/vendors/switchery/dist/switchery.min.js"></script>
        <!-- Select2 -->
        <script src="../Gentella/vendors/select2/dist/js/select2.full.min.js"></script>
        <!-- Parsley -->
        <script src="../Gentella/vendors/parsleyjs/dist/parsley.min.js"></script>
        <!-- Autosize -->
        <script src="../Gentella/vendors/autosize/dist/autosize.min.js"></script>
        <!-- jQuery autocomplete -->
        <script src="../Gentella/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
        <!-- starrr -->
        <script src="../Gentella/vendors/starrr/dist/starrr.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="../Gentella/build/js/custom.min.js"></script>


        <!--prueba tabla-->

        <script src="../include/tabla/jquery.dataTables.min.js"></script>
        <script src="../include/tabla/dataTables.bootstrap.min.js"></script>

        <!--script para obtener los modulos dependiendo de la carrera que seleccione-->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#carrera_m').change(function() {
                    recargarlista();
                });
            })
        </script>
        <script type="text/javascript">
            function recargarlista() {
                $.ajax({
                    type: "POST",
                    url: "operaciones/obtener_modulos.php",
                    data: "id_carrera=" + $('#carrera_m').val(),
                    success: function(r) {
                        $('#modulo').html(r);
                    }
                });
            }
        </script>

        <?php mysqli_close($conexion); ?>
    </body>

    </html>
<?php
}
