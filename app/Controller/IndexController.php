<?php namespace App\Controller;

	use App\Core\ControladorBase;
	use App\Model\UsuarioModel as MUsuario;
	use App\Helpers\Security as HS;

	class IndexController extends ControladorBase
	{
		
		public function index()
		{
			session_start();

			HS::sesion_iniciada($this, 'index', 'home');

			$data = array(
				"title"         => "Distr. Plas Anthony",
				"error"			=> "",
				"email"			=> "",
				'datos_template' => array( 
					'autor' => 'Sistema',
					'anio'  => '2016'
				)
			);
			$this->view("Index", $data);
		}

		public function login()
		{
			session_start();

			HS::sesion_iniciada($this);

			$data = array(
				"title"          => "Distr. Plas Anthony",
				"error"          => "",
				"email"            => "",
				'datos_template' => array(
					'autor' => 'Sistema',
					'anio'  => '2016'
				)
			);

			if(!empty($_POST) && isset($_POST))
			{
				if(MUsuario::login($_POST['email'], $_POST['contrasena']))
				{
					$this->redirect('index', 'home');
				}
				else
				{
					$data['email']   = $_POST['email'];
					$data['error'] = "Email o Contraseña incorrecto";
				}
			}

			$this->view('Index', $data);

		}

		
		
		public function logout()
		{
			MUsuario::logout();
			$this->redirect();
		}

		public function home()
		{
			session_start();

			HS::sesion_no_iniciada($this);

			$user = MUsuario::getEmail($_SESSION['user']['email'])[0];

			$data = array(
				"title"          => "Distr. Plas Anthony",
				"usuario"        => $user,
				'datos_template' => array(
					"usuario" => $user,
					'autor'   => 'Sistema',
					'anio'    => '2016'
				)
			);
			$this->view("Home", $data);
		}
		
	}