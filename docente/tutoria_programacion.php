<?php
include("../include/conexion.php");
include("../include/busquedas.php");
include("../include/funciones.php");

include("include/verificar_sesion_coordinador.php");

if (!verificar_sesion($conexion)) {
    echo "<script>
                alert('Error Usted no cuenta con permiso para acceder a esta página');
                window.location.replace('index.php');
    		</script>";
} else {

    $id_docente_sesion = buscar_docente_sesion($conexion, $_SESSION['id_sesion'], $_SESSION['token']);
    $b_docente = buscarDocenteById($conexion, $id_docente_sesion);
    $r_b_docente = mysqli_fetch_array($b_docente);

?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="Content-Language" content="es-ES">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tutoría<?php include("../include/header_title.php"); ?></title>
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
        <!-- Script obtenido desde CDN jquery -->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <!--menu-->
                <?php
                $per_select = $_SESSION['periodo'];
                $b_per = buscarPeriodoAcadById($conexion, $per_select);
                $r_b_per = mysqli_fetch_array($b_per);
                $id_docente = $id_docente_sesion;

                $b_docentes_pe = buscarDocentesByIdPe($conexion, $r_b_docente['id_programa_estudio']);

                if ($r_b_docente['id_cargo'] == 5) { //si es docente
                    include("include/menu_docente.php");
                } elseif ($r_b_docente['id_cargo'] == 4) { // si es coordinador de area
                    include("include/menu_coordinador.php");
                }
                ?>

                <!-- page content -->
                <div class="right_col" role="main">


                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="">
                                    <h2 align="center">Tutoría</h2>
                                    <button class="btn btn-success" data-toggle="modal" data-target=".registrar"><i class="fa fa-plus-square"></i> Nuevo</button>
                                    <div class="clearfix"></div>
                                </div>

                                <!--MODAL REGISTRAR-->
                                <div class="modal fade registrar" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel" align="center">Registrar Tutoría</h4>
                                            </div>
                                            <div class="modal-body">
                                                <!--INICIO CONTENIDO DE MODAL-->
                                                <div class="x_panel">

                                                    <div class="" align="center">
                                                        <h2></h2>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="x_content">
                                                        <br />
                                                        <form role="form" action="operaciones/registrar_tutoria.php" class="form-horizontal form-label-left input_mask" method="POST">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Docente : </label>
                                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                                    <select name="docente" id="" class="form-control" required="required">
                                                                        <option value=""></option>
                                                                        <?php 
                                                                        while ($r_b_docentes_list = mysqli_fetch_array($b_docentes_pe)) {
                                                                            ?>
                                                                            <option value="<?php echo $r_b_docentes_list['id'] ?>"><?php echo $r_b_docentes_list['apellidos_nombres'] ?></option>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                            <div align="center">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

                                                                <button type="submit" class="btn btn-primary">Programar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!--FIN DE CONTENIDO DE MODAL-->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- FIN MODAL REGISTRAR-->
                                <div class="x_content">
                                    <br />

                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Docente</th>
                                                <th>Periodo Académico</th>
                                                <th>Nro de Estudiantes</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $contador = 0;
                                            $b_docentes_Pe = buscarDocentesByIdPe($conexion, $r_b_docente['id_programa_estudio']);
                                            while ($r_b_docentes_pe = mysqli_fetch_array($b_docentes_Pe)) {
                                                $b_tutoria_docente = buscarTutoriaByIdDocenteAndIdPeriodo($conexion, $r_b_docentes_pe['id'], $per_select);
                                                $cont_tutoria = mysqli_num_rows($b_tutoria_docente);
                                                
                                                if ($cont_tutoria > 0) {
                                                    $r_b_tutoria_docente = mysqli_fetch_array($b_tutoria_docente);
                                                    $b_docente = buscarDocenteById($conexion, $r_b_tutoria_docente['id_docente']);
                                                    $r_b_docente = mysqli_fetch_array($b_docente);
                                                    //buscar cantidad de estudiantes asisgandos a la turoria
                                                    $b_est_tutoria = buscarTutoriaEstudiantesByIdTutoria($conexion, $r_b_tutoria_docente['id']);
                                                    $cont_est_tutoria = mysqli_num_rows($b_est_tutoria);
                                                    $contador ++;
                                            ?>
                                                    <tr>
                                                        <td><?php echo $contador; ?></td>
                                                        <td><?php echo $r_b_docente['apellidos_nombres']; ?></td>
                                                        <td><?php echo $r_b_per['nombre']; ?></td>
                                                        <td><?php echo $cont_est_tutoria; ?></td>
                                                        <td>
                                                            <a href="tutoria_estudiantes.php?data=<?php echo $r_b_tutoria_docente['id']; ?>" class="btn btn-success"> Ver </a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>

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
        <!-- iCheck -->
        <script src="../Gentella/vendors/iCheck/icheck.min.js"></script>
        <!-- Datatables -->
        <script src="../Gentella/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../Gentella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="../Gentella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../Gentella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="../Gentella/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="../Gentella/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="../Gentella/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="../Gentella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="../Gentella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="../Gentella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../Gentella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="../Gentella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
        <script src="../Gentella/vendors/jszip/dist/jszip.min.js"></script>
        <script src="../Gentella/vendors/pdfmake/build/pdfmake.min.js"></script>
        <script src="../Gentella/vendors/pdfmake/build/vfs_fonts.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="../Gentella/build/js/custom.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable({
                    "language": {
                        "processing": "Procesando...",
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "emptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
                        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "search": "Buscar:",
                        "infoThousands": ",",
                        "loadingRecords": "Cargando...",
                        "paginate": {
                            "first": "Primero",
                            "last": "Último",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        },
                    }
                });

            });
        </script>


        <?php mysqli_close($conexion); ?>
    </body>

    </html>
<?php }
