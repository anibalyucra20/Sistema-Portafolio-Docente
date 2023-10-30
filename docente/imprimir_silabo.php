<?php
include("../include/conexion.php");
include("../include/busquedas.php");
include("../include/funciones.php");
include 'include/verificar_sesion_docente_coordinador.php';
if (!verificar_sesion($conexion)) {
  echo "<script>
                alert('Error Usted no cuenta con permiso para acceder a esta página');
                window.location.replace('index.php');
    		</script>";
}else {
  
  $id_docente_sesion = buscar_docente_sesion($conexion, $_SESSION['id_sesion'], $_SESSION['token']);
  $b_docente = buscarDocenteById($conexion, $id_docente_sesion);
  $r_b_docente = mysqli_fetch_array($b_docente);

$id_prog = $_POST['data'];
$b_prog = buscarProgramacionById($conexion, $id_prog);
$res_b_prog = mysqli_fetch_array($b_prog);
if (!($res_b_prog['id_docente'] == $id_docente_sesion)) {
    //echo "<h1 align='center'>No tiene acceso a la evaluacion de la Unidad Didáctica</h1>";
    //echo "<br><h2><center><a href='javascript:history.back(-1);'>Regresar</a></center></h2>";
    echo "<script>
			alert('Error Usted no cuenta con los permisos para acceder a la Página Solicitada');
			window.close();
		</script>
	";
}else {

require '../fpdf185/fpdf.php';
	
	class PDF extends FPDF
	{
		function Header()
		{
            $this->SetFillColor(201,201,201);
            $this->SetFont('Arial','B',13);
			$this->Cell(10,10,'MH',0,0,'C');
			$this->Cell(15,10,utf8_decode('PERÚ'),0,0,'C', true);
            $this->SetFont('Arial','B',10);
			$this->Cell(45,10,utf8_decode('Minesterio de Educación'),0,0,'C', true);
			$this->Cell(100,10,utf8_decode('Dirección Regional de Educación de AYACUCHO'),1,0,'C', true);
            $this->Cell(6,10,'UA',1,0,'C');
            $this->Cell(10,10,'LOGO',0,0,'C');
            $this->Ln(15);
			
            /*$this->Image('../img/cabeza.png', 5, 3, 190,);
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10, '',0,0,'C');
			$this->Ln(20);*/
		}
		
		function Footer()
		{
			$this->SetY(-15);
			$this->Image('../img/pie.png', 15, 278, 181);
			$this->SetFont('Arial','B', 10);
            /*$this->SetFillColor(147,178,72);
			$this->Cell(175,10, utf8_decode('IESTPúb "HUANTA" - UNIDAD ACADÉMICA'),1,0,'L',true);*/
            $this->Cell(0,10, 'Pag. '.$this->PageNo().'             ',0,0,'R' );
            //$this->Cell(0,10, 'Pag. '.$this->PageNo().'/{nb}',0,0,'R' );
		}
        
        


        var $widths;
var $aligns;

function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

function Row($data)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}

	}


    

    // INICIAMOS A CREAR EL PDF

        //buscamos los datos para imprimir

        //buscar datos de institucion
        $b_datos_insti = buscarDatosGenerales($conexion);
        $r_b_datos_insti = mysqli_fetch_array($b_datos_insti);

        //buscar periodo 
        $b_perio = buscarPeriodoAcadById($conexion, $res_b_prog['id_periodo_acad']);
        $r_b_perio = mysqli_fetch_array($b_perio);
        //buscar unidad didactica
        $b_ud = buscarUdById($conexion, $res_b_prog['id_unidad_didactica']);
        $r_b_ud = mysqli_fetch_array($b_ud);
        //buscar programa de estudio
        $b_pe = buscarCarrerasById($conexion, $r_b_ud['id_programa_estudio']);
        $r_b_pe = mysqli_fetch_array($b_pe);
        //buscar modulo profesional
        $b_mod = buscarModuloFormativoById($conexion, $r_b_ud['id_modulo']);
        $r_b_mod = mysqli_fetch_array($b_mod);
        //buscar semestre
        $b_sem = buscarSemestreById($conexion, $r_b_ud['id_semestre']);
        $r_b_sem = mysqli_fetch_array($b_sem);
        //buscamos el silabo y sus datos
        $b_silabo = buscarSilaboByIdProgramacion($conexion, $id_prog);
        $r_b_silabo = mysqli_fetch_array($b_silabo);
        $id_silabo = $r_b_silabo['id'];
        //buscar datos de docente
        $b_docente = buscarDocenteById($conexion, $res_b_prog['id_docente']);
        $r_b_docente = mysqli_fetch_array($b_docente);
        //buscar datos de coordinador de area
        $b_coordinador = buscarDocenteById($conexion, $r_b_silabo['id_coordinador']);
        $r_b_coordinador = mysqli_fetch_array($b_coordinador);
        if (mysqli_num_rows($b_coordinador)==0) {
            $coordinador = "";
        }else {
            $coordinador = $r_b_coordinador['apellidos_nombres'];
        }
        //buscar datos de director
        $b_director = buscarDocenteById($conexion, $r_b_perio['director']);
        $r_b_director = mysqli_fetch_array($b_director);

        
        //buscamos la cantidad de indicadores para definir la cantidad de calificaciones
        $b_capacidades =buscarCapacidadesByIdUd($conexion, $res_b_prog['id_unidad_didactica']);
        $total_indicadores = 0;
        while ($r_b_capacidades = mysqli_fetch_array($b_capacidades)) {
            $b_indicador_capac = buscarIndicadorLogroCapacidadByIdCapacidad($conexion, $r_b_capacidades['id']);
            $cont_indicadores = mysqli_num_rows($b_indicador_capac);
            $total_indicadores = $total_indicadores+$cont_indicadores;
        };

        //fecha de hoy


    $pdf = new PDF();
	$pdf->AliasNbPages();

    $titulo = utf8_decode("SÍLABO DE ".$r_b_ud['descripcion'].".pdf");
    $pdf->SetTitle($titulo);
    
	$pdf->AddPage();
	$pdf->SetLeftMargin(20);
	//$pdf->SetAutoPageBreak(1 , 15);
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(180,6,utf8_decode("SÍLABO DE ".$r_b_ud['descripcion']),0,1,'C',0);
	$pdf->Cell(180,3,'',0,1,'C',0);
    $pdf->SetFont('Arial','B',10);
	$pdf->Cell(80,6,utf8_decode("I.            INFORMACIÓN GENERAL"),0,1,'',0);
	$pdf->Cell(70,6,utf8_decode('       Programa de Estudios'),0,0,'',0);
    $pdf->Cell(100,6,utf8_decode(": ".$r_b_pe['nombre']),0,1,'',0);
    $pdf->Cell(70,6,utf8_decode('       Plan de Estudios'),0,0,'',0);
    $pdf->Cell(100,6,utf8_decode(": ".$r_b_pe['plan_estudio']),0,1,'',0);
    $pdf->Cell(70,6,utf8_decode('       Periodo Académico'),0,0,'',0);
    $pdf->Cell(100,6,utf8_decode(": ".$r_b_perio['nombre']),0,1,'',0);
	$pdf->Cell(70,6,utf8_decode('       Módulo'),0,0,'',0);
    //$pdf->Cell(100,6,utf8_decode(": ".$r_b_mod['descripcion']),0,1,'',0);
    $pdf->MultiCell(100,8,utf8_decode(": ".$r_b_mod['descripcion']),0,1,'',0);
    $pdf->Cell(70,6,utf8_decode('       Unidad Didáctica'),0,0,'',0);
    $pdf->Cell(100,6,utf8_decode(": ".$r_b_ud['descripcion']),0,1,'',0);
    $pdf->Cell(70,6,utf8_decode('       Créditos'),0,0,'',0);
    $pdf->Cell(100,6,utf8_decode(": ".$r_b_ud['creditos']),0,1,'',0);
    $pdf->Cell(70,6,utf8_decode('       Semestre Académico'),0,0,'',0);
    $pdf->Cell(100,6,utf8_decode(": ".$r_b_sem['descripcion']),0,1,'',0);
    $pdf->Cell(70,6,utf8_decode('       N° de Horas Semanal'),0,0,'',0);
    $pdf->Cell(100,6,utf8_decode(": ".$r_b_ud['horas']/16),0,1,'',0);
    $pdf->Cell(70,6,utf8_decode('       N°  de Horas Semestral'),0,0,'',0);
    $pdf->Cell(100,6,utf8_decode(": ".$r_b_ud['horas']),0,1,'',0);
    $pdf->Cell(70,6,utf8_decode('       Horario'),0,0,'',0);
    $horario1 = explode(",", $r_b_silabo['horario']);
        
    $horario = count($horario1);
    $horario2 = "";
    for ($i=0; $i < $horario; $i++) { 
        $horario2 = $horario2.$horario1[$i]."\r\n";
    }
    $pdf->MultiCell(100,8,utf8_decode(": ".$horario2),0,1,'',0);
    $pdf->Cell(70,6,utf8_decode('       Docente'),0,0,'',0);
    $pdf->Cell(100,6,utf8_decode(": ".$r_b_docente['apellidos_nombres']),0,1,'',0);
    $pdf->Cell(70,6,utf8_decode('       Coordinador de Área'),0,0,'',0);
    $pdf->Cell(100,6,utf8_decode(": ".$coordinador),0,1,'',0);
    $pdf->Cell(70,6,utf8_decode('       Director General'),0,0,'',0);
    $pdf->Cell(100,6,utf8_decode(": ".$r_b_director['apellidos_nombres']),0,1,'',0);
    $pdf->Cell(180,3,'',0,1,'C',0);
    
	$pdf->Cell(80,6,utf8_decode("II.            COMPETENCIA DEL PROGRAMA DE ESTUDIOS"),0,1,'',0);
    //buscar competencias
    $b_mods = buscarModuloFormativoByIdCarrera($conexion, $r_b_ud['id_programa_estudio']);
    $competencias = '';
    while ($r_b_mods = mysqli_fetch_array($b_mods)) {
        $b_mod_form = buscarCompetenciasEspecialidadByIdModulo($conexion, $r_b_mods['id']);
    while ($r_b_mod_form = mysqli_fetch_array($b_mod_form)) {
        $competencias = $competencias."* ".$r_b_mod_form['descripcion']."\r\n";
    }
    }
    
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(175,6,utf8_decode(''.$competencias),0,'J',0);
    $pdf->Cell(180,3,'',0,1,'C',0);

    $pdf->SetFont('Arial','B',10);
	$pdf->Cell(80,6,utf8_decode("III.            CAPACIDADES TERMINALES Y CRITERIOS DE EVALUACIÓN"),0,1,'',0);


    $buscar_cap = buscarCapacidadesByIdUd($conexion, $res_b_prog['id_unidad_didactica']);
    $caps = '';
    $cont_cap = 1;
    $num = 1;
    $ind_cap = '';
    while ($r_b_cap = mysqli_fetch_array($buscar_cap)) {
        $caps = $caps.$r_b_cap['codigo']." - ".$r_b_cap['descripcion']."\r\n";
        /*$pdf->SetFont('Arial','',10);*/
        /*$x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->SetXY($x+90, $y-30);*/
        //buscar indicadores de capacidad
        $b_ind_cap = buscarIndicadorLogroCapacidadByIdCapacidad($conexion, $r_b_cap['id']);
        while ($r_b_ind_cap = mysqli_fetch_array($b_ind_cap)) {
            $ind_cap = $ind_cap.$r_b_cap['codigo'].".".$r_b_ind_cap['codigo'].".- ".$r_b_ind_cap['descripcion']."\r\n";
            $num += 1;
        }
        $cont_cap += 1;
        
    };
    $pdf->Cell(175,6,utf8_decode('CAPACIDAD TERMINAL'),1,1,'C',1);
    $pdf->SetFont('Arial','',10);
    $pdf->Multicell(175, 5, utf8_decode($caps), 1, 'J', false);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(175,6,utf8_decode('CRITERIOS DE EVALUACION'),1,1,'C',1);
    $pdf->SetFont('Arial','',10);
    $pdf->Multicell(175, 5, utf8_decode($ind_cap), 1, 'J', false);

    $pdf->Cell(180,3,'',0,1,'C',0);
    $pdf->SetFont('Arial','B',10);
	$pdf->Cell(80,6,utf8_decode("IV.            PERFIL DE EGRESADO"),0,1,'',0);
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(175,6,utf8_decode(''.$r_b_pe['perfil_egresado']),0,'J',0);

    $pdf->Cell(180,3,'',0,1,'C',0);
    
    //CONTENIDO DE ACTIVIDADES Y CONTENIDOS BASICOS
    $pdf->SetFont('Arial','B',10);
	$pdf->Cell(80,6,utf8_decode("V.            ORGANIZACIÓN DE ACTIVIDADES Y CONTENIDOS BÁSICOS"),0,1,'',0);

    $pdf->SetWidths(array(25,40,40,40,30));
    $pdf->Row(array(utf8_decode('Semana'),utf8_decode("Elementos de capacidad"),utf8_decode("Actividades de aprendizaje"),utf8_decode("Contenidos Básicos"),utf8_decode("Tareas previas")));

    $pdf->SetFont('Arial','',10);
    //buscar programacion de actividades del silabo
    $b_act_silabo = buscarProgActividadesSilaboByIdSilabo($conexion, $id_silabo);
    $cant_actividades = mysqli_num_rows($b_act_silabo);
    while ($r_b_act_silabo = mysqli_fetch_array($b_act_silabo)) {
    $pdf->Row(array(utf8_decode("Semana ".$r_b_act_silabo['semana']/*."\r\n".$r_b_act_silabo['fecha']*/),utf8_decode($r_b_act_silabo['elemento_capacidad']),utf8_decode($r_b_act_silabo['actividades_aprendizaje']),utf8_decode($r_b_act_silabo['contenidos_basicos']),utf8_decode($r_b_act_silabo['tareas_previas'])));
    }
    //FIN DE CONTENIDO DE ACTIVIDADES Y CONTENIDOS BASICOS

    $pdf->Cell(180,3,'',0,1,'C',0);
    $pdf->SetFont('Arial','B',10);
	$pdf->Cell(80,6,utf8_decode("VI.            METODOLOGÍA"),0,1,'',0);
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(100,6,utf8_decode("".$r_b_silabo['metodologia']),0,1,'',0);

    $pdf->Cell(180,3,'',0,1,'C',0);
    $pdf->SetFont('Arial','B',10);
	$pdf->Cell(80,6,utf8_decode("VII.            RECURSOS DIDÁCTICOS"),0,1,'',0);
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(100,6,utf8_decode("".$r_b_silabo['recursos_didacticos']),0,1,'',0);

    $pdf->Cell(180,3,'',0,1,'C',0);
    $pdf->SetFont('Arial','B',10);
	$pdf->Cell(80,6,utf8_decode("VIII.            SISTEMA DE EVALUACION"),0,1,'',0);
    $pdf->SetFont('Arial','',10);
	$pdf->MultiCell(175,6,utf8_decode(''.$r_b_silabo['sistema_evaluacion']),0,'J',0);

    
    $pdf->SetFont('Arial','B',10);
    // ASIGNAMOS NUEVO MARGEN 
    $pdf->SetLeftMargin(30);
	$pdf->Cell(80,6,utf8_decode("8.1.            ESTRATEGÍAS DE EVALUACIÓN"),0,1,'',0);
    $pdf->SetWidths(array(80,80));
    $pdf->Row(array(utf8_decode('                           INDICADORES'),utf8_decode("                             TÉCNICAS")));
    $pdf->SetFont('Arial','',10);
    $pdf->Row(array(utf8_decode($r_b_silabo['estrategia_evaluacion_indicadores']),utf8_decode($r_b_silabo['estrategia_evaluacion_tecnica'])));
    
    $pdf->Cell(180,3,'',0,1,'C',0);
    $pdf->SetFont('Arial','B',10);
	$pdf->Cell(80,6,utf8_decode("8.2.            PROMEDIO DE INDICADORES DE LOGRO"),0,1,'',0);
	$pdf->Cell(165,15, $pdf->Image("../img/promedio.png", $pdf->GetX(), $pdf->GetY(),163,15),0); 
    $pdf->Cell(180,3,'',0,1,'C',0);
    $pdf->Cell(180,3,'',0,1,'C',0);
    $pdf->Cell(180,3,'',0,1,'C',0);
    $pdf->Cell(180,3,'',0,1,'C',0);
    $pdf->Cell(180,3,'',0,1,'C',0);


    //$pdf->Image('silabo/promedio.png', 5, 3, 160,);
    //$pdf->Image('silabo/promedio.png', float x , float y , float w , float h , string type , mixed link);

	// ASIGNAMOS NUEVO MARGEN 
    $pdf->SetLeftMargin(20);
	$pdf->Cell(180,3,'',0,1,'C',0);
    $pdf->SetFont('Arial','B',10);
	$pdf->Cell(80,6,utf8_decode("IX.            RECURSOS BIBLIOGRÁFICOS /BIBLIOGRAFÍA"),0,1,'',0);
	$pdf->Cell(175,6,'          - Impresos',1,1,'',0);
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(175,6,utf8_decode("".$r_b_silabo['recursos_bibliograficos_impresos']),1,1,'',0);
    $pdf->SetFont('Arial','B',10);
	$pdf->Cell(175,6,'          - Digitales',1,1,'',0);
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(175,6,utf8_decode("".$r_b_silabo['recursos_bibliograficos_digitales']),1,1,'',0);


	$pdf->Cell(180,3,'',0,1,'C',0);
	$pdf->Cell(180,3,'',0,1,'C',0);

    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    //echo $diassemana[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
	$pdf->Cell(175,6,utf8_decode($r_b_datos_insti['distrito'].', '.date('d')." de ".$meses[date('n')-1]. " del ".date('Y')),0,1,'R',0);


	$pdf->Output($titulo, 'I');

}
}