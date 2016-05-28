<?php namespace App\Controller;

	use App\Core\ControladorBase;
	use App\Model\GastosModel as MGastos;
	use App\Model\UsuarioModel as MUsuario;
	use App\Helpers\Security as HS;

	use App\Model\PDFModel as PDF;

	class IndexController extends ControladorBase
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
				"title"         => "Dist. Plas Anthony",
				"mensaje"       => "",
				"class_mensaje" => "error",
				"codigo" 		=> "",
				"monto" 		=> "",
				"nombre"		=>"",
				"motivo"		=>	"",
				"usuario"       => $user,
				'datos_template' => array(
					"usuario" 	=> $user,
					'autor'   	=> 'Sistema',
					'anio'    	=> '2016'
				)
			);

			if(!empty($_POST) && isset($_POST))
			{
				if(MGastos::saveGastos($_POST['codigo'], $_POST['nombre'], $_POST['motivo'], $_POST['monto'], $_SESSION['user']['email']))
				{
					
					$data['mensaje']              = "Gasto Registrada Correctamente";					
					$data['class_mensaje']        = "exito";	
				}
				else
				{
					$data['codigo']		= 	$_POST['codigo'];
					$data['nombre']		=	$_POST['nombre'];
					$data['motivo']		=	$_POST['motivo'];
					$data['monto'] 		=	$_POST['monto'];					
					$data['mensaje']  	=	"Gasto no fue registrado";
				}
			}

			$this->view('Gastos/Gastos', $data);
		}

		public function prueba()
		{
			$data = '<h1> HOLA</h1>';

			PDF::render("prueba", $data);
		}
		
	}