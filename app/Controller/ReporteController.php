<?php namespace App\Controller;

	use App\Core\ControladorBase;
	use App\Model\DevolucionModel as MDevolucion;
	use App\Model\VentaModel as MVenta;
	use App\Model\UsuarioModel as MUsuario;
	use App\Model\ExcelModel as MExcel;
	use App\Helpers\Security as HS;
	use stdClass;

	class ReporteController extends ControladorBase
	{

		public function index()
		{
			$this->redirect('index', 'index');
		}

		public function generar()
		{
			@session_start();

			HS::sesion_no_iniciada($this);

			$user = MUsuario::getEmail($_SESSION['user']['email'])[0];

			$data = array(
				"title"          => "Dist. Plas Anthony",
				"mensaje"        => "",
				"class_mensaje"  => "error",
				"usuario"        => $user,
				"link_reporte"   => "",
				"reporte"        => NULL,
				'datos_template' => array(
					"usuario" => $user,
					'autor'   => 'Sistema',
					'anio'    => '2016'
				)
			);

			if(!empty($_POST) && isset($_POST))
			{
				if($_POST['tipo'] == "venta")	
				{
					$data['cabezeras'] = array(
						"codigo_boleta",
						"monto",
						"fecha",
						"usuario",
						"vendedor"
					);
					$reporte = MVenta::reporte($_POST['fecha_ini'], $_POST['fecha_fin']);					
					
				}
				elseif($_POST['tipo'] == "devolucion")
				{
					$data['cabezeras'] = array(
						"codigo_boleta",
						"monto",
						"fecha",
						"motivo"
					);
					$reporte = MDevolucion::reporte($_POST['fecha_ini'], $_POST['fecha_fin']);

				}
				if(isset($reporte) && (is_array($reporte) || is_object($reporte)))
				{
					if(is_object($reporte))
					{
						$reporte = array($reporte);
					}

					$data['reporte'] = $reporte;
					$data['link_reporte'] = $_POST['tipo'] . "*" . $_POST['fecha_ini'] . "*" . $_POST['fecha_fin'];
					$data['titulo_tabla'] = "Reporte De ". $_POST['tipo'] . " Del " . $_POST['fecha_ini'] . " Al " . $_POST['fecha_fin'];
				}
				else 
				{
					$data['mensaje'] = "No se encontraron datos para generar el reporte";
				}
			}

			$this->view('Reporte/Reporte', $data);
		}

		public function render($infor_reporte = NULL)
		{
			if(! isset($infor_reporte)) exit;

			$info = explode("*", $infor_reporte);

			if(! is_array($info) || count($info) < 3) exit;

			$tipo = $info[0];
			$fecha_ini = $info[1];
			$fecha_fin = $info[2];

			$data_excel = array(
				"creador"        => "Sistema Venta Plas Anthony",
				"titulo"         => "Reporte de Sistema",
				"asunto"         => "Reporte de Sistema",
				"descripcion"    => "Reporte de Sistema",
				"palabras_clave" => "Reporte Sistema",
				"categoria"      => "Reporte",
				"titulo_reporte" => "Reporte De " . $tipo . " Del " . $fecha_ini . " Al " .  $fecha_fin,
				"nombre_hoja"    => "Reporte de " . $tipo ,
				"nombre_archivo" => "ReporteDe" . $tipo . "Del" . $fecha_ini . "Al" .  $fecha_fin,
				"cabezeras"      => "",
				"informacion"    => ""
			);
			
			if($tipo == "venta")	
			{
				$data_excel['cabezeras'] = array(
					"codigo_boleta",
					"monto",
					"fecha",
					"usuario",
					"vendedor"
				);
				$reporte = MVenta::reporte($fecha_ini, $fecha_fin);					
				
			}
			elseif($tipo == "devolucion")
			{
				$data_excel['cabezeras'] = array(
					"codigo_boleta",
					"monto",
					"fecha",
					"motivo"
				);
				$reporte = MDevolucion::reporte($fecha_ini, $fecha_fin);

			}

			if(isset($reporte) && (is_array($reporte) || is_object($reporte)))
			{
				if(is_object($reporte))
				{
					$reporte = array($reporte);
				}

				$data_excel['informacion'] = $reporte;
				MExcel::render($data_excel);
			}
			else
			{
				$this->redirect('reporte', 'generar');
			}
		}

	}