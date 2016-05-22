<?php namespace App\Controller;

	use App\Core\ControladorBase;
	use App\Model\DevolucionModel as MDevolucion;
	use App\Model\UsuarioModel as MUsuario;
	use App\Model\ExcelModel as MExcel;
	use App\Helpers\Security as HS;
	use stdClass;

	class DevolucionController extends ControladorBase
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
				"motivo" => "",
				"usuario"        => $user,
				'datos_template' => array(
					"usuario" => $user,
					'autor'   => 'Sistema',
					'anio'    => '2016'
				)
			);

			if(!empty($_POST) && isset($_POST))
			{
				if(MDevolucion::saveDevolucion($_POST['motivo'], $_POST['monto'], $_POST['codigo']))
				{
					
					$data['mensaje']              = "Devolucion Registrada Correctamente";					
					$data['class_mensaje']        = "exito";	
				}
				else
				{
					$data['codigo']    = $_POST['codigo'];
					$data['monto'] = $_POST['monto'];
					$data['motivo'] = $_POST['motivo'];
					$data['mensaje']  = "La Devolucion no fue registrada";
				}
			}

			$this->view('Devolucion/Devolucion', $data);
		}

	}