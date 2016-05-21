<?php namespace App\Controller;

	use App\Core\ControladorBase;
	use App\Model\VentaModel as MVenta;
	use App\Model\UsuarioModel as MUsuario;
	use App\Helpers\Security as HS;

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

			$this->view('Venta/Venta', $data);
		}

	}