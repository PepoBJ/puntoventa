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


		public function render()
		{
			$obj = new stdClass();
			$obj->nombre = "Nick";
			$obj->apellido = "Doe";

			$obj2 = new stdClass();
			$obj2->nombre = "Nick2";
			$obj2->apellido = "Doe2";

			$data = array(
				"creador"=> "Sistema Venta Plas Anthony",
				"titulo"=> "Reporte de Sistema",
				"asunto"=> "Reporte de Sistema",
				"descripcion"=> "Reporte de Sistema",
				"palabras_clave"=> "Reporte Sistema",
				"categoria"=> "Reporte",
				"nombre_hoja"=> "Reporte Diario",
				"nombre_archivo"=> "ReporteDiario",
				"cabezeras" => array(
					"motivo",
					"monto",
					"fecha",
					"codigo_boleta"
				),
				"informacion" => MDevolucion::reporte('2016-05-21', '2016-05-21')
			);
			MExcel::render($data);

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
				'datos_template' => array(
					"usuario" => $user,
					'autor'   => 'Sistema',
					'anio'    => '2016'
				)
			);

			if(!empty($_POST) && isset($_POST))
			{
				$data_excel = array(
					"creador"=> "Sistema Venta Plas Anthony",
					"titulo"=> "Reporte de Sistema",
					"asunto"=> "Reporte de Sistema",
					"descripcion"=> "Reporte de Sistema",
					"palabras_clave"=> "Reporte Sistema",
					"categoria"=> "Reporte",
					"titulo_reporte" => "Reporte De " . $_POST['tipo'] . " Del " . $_POST['fecha_ini'] . " Al " .  $_POST['fecha_fin'],
					"nombre_hoja"=> "Reporte de " . $_POST['tipo'] ,
					"nombre_archivo"=> "ReporteDe" . $_POST['tipo'] . "Del" . $_POST['fecha_ini'] . "Al" .  $_POST['fecha_fin'],
					"cabezeras" => "",
					"informacion" => ""
				);
				
				if($_POST['tipo'] == "venta")	
				{
					$data_excel['cabezeras'] = array(
						"codigo_boleta",
						"monto",
						"fecha",
						"usuario"
					);
					$reporte = MVenta::reporte($_POST['fecha_ini'], $_POST['fecha_fin']);					
					
				}
				elseif($_POST['tipo'] == "devolucion")
				{
					$data_excel['cabezeras'] = array(
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

					$data_excel['informacion'] = $reporte;
					MExcel::render($data_excel);
				}
				else 
				{
					$data['mensaje'] = "No se encontraron datos para generar el reporte";
				}
			}

			$this->view('Reporte/Reporte', $data);
		}
	}