<?php namespace App\Controller;

	use App\Core\ControladorBase;
	use App\Model\VentaModel as MVenta;
	use App\Model\DevolucionModel as MDevolucion;
	use App\Model\UsuarioModel as MUsuario;
	use App\Model\ExcelModel as MExcel;
	use App\Helpers\Security as HS;
	use stdClass;

	class VentaController extends ControladorBase
	{

		public function index()
		{
			$this->redirect('index', 'index');
		}

		public function nuevo()
		{
			@session_start();

			HS::sesion_no_iniciada($this);

			$user = MUsuario::getEmail($_SESSION['user']['email'])[0];

			$data = array(
				"title"          => "Dist. Plas Anthony",
				"mensaje"        => "",
				"class_mensaje"  => "error",
				"codigo" => "",
				"monto" => "",
				"usuario"        => $user,
				'datos_template' => array(
					"usuario" => $user,
					'autor'   => 'Sistema',
					'anio'    => '2016'
				)
			);

			if(!empty($_POST) && isset($_POST))
			{
				if(MVenta::saveVenta($_POST['codigo'], $_POST['monto'], $_SESSION['user']['email']))
				{
					
					$data['mensaje']              = "Venta Registrada Correctamente";					
					$data['class_mensaje']        = "exito";	
				}
				else
				{
					$data['codigo']    = $_POST['codigo'];
					$data['monto'] = $_POST['monto'];
					$data['mensaje']  = "La Venta no fue registrada";
				}
			}

			$this->view('Venta/Venta', $data);
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

		public function hola()
		{
			echo "<a href='/venta/render'>descargar</a>";
		}
	}