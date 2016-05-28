<?php namespace App\Controller;

	use App\Core\ControladorBase;
	use App\Model\VendedorModel as MVendedor;
	use App\Model\UsuarioModel as MUsuario;
	use App\Helpers\Security as HS;


	use App\Model\ReporteModel as RM;
	class VendedorController extends ControladorBase
	{

		public function index()
		{
			$this->redirect('index', 'index');
		}
		
		/*
		public function index()
		{
			echo "<pre>";
			var_dump(MVendedor::deleteVendedor('12345678', 'Test MOdificado', 'Test'));
			var_dump(MVendedor::getAll());
			var_dump(MVendedor::getDni('71960340'));
			var_dump(RM::getTopVendedor(3));
		}*/

		public function nuevo()
		{

			session_start();
			HS::session_no_iniciada_administrador($this);
			$user = MUsuario::getEmail($_SESSION['user']['email'])[0];

			$data = array(
				"title"         => "Dist. Plas Anthony",
				"mensaje"       => "",
				"class_mensaje" => "error",
				"dni" 		=> "",
				"nombre" 		=> "",
				"apellido"		=>"",
				"usuario"       => $user,
				'datos_template' => array(
					"usuario" 	=> $user,
					'autor'   	=> 'Sistema',
					'anio'    	=> '2016'
				)
			);

			if (!empty($_POST) && isset($_POST))
			{
				if (MVendedor::SaveVendedor($_POST['dni'], $_POST['nombre'], $_POST['apellido'])) 
				{
					$data['mensaje']	= "Vendedor Registrado Correctamente";
					$data['class_mensaje']	= "exito";
				}
				else
				{
					$data['dni'] = $_POST['dni'];
					$data['nombre'] = $_POST['nombre'];
					$data['apellido'] = $_POST['apellido'];
					$data['mensaje'] = "Vendedor no fue Registrado";
				}
			}
			
			$this->view("Vendedor/Vendedor", $data);
		}
	}