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
					var_dump("ho");
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

		/*public function registro()
		{
			session_start();

			HS::sesion_iniciada($this);

			$data = array(
				"title"          => "Distr. Plas Anthony",
				"error"          => "",
				"dni"            => "",
				"nombre"         => "",
				'datos_template' => array(
					'autor' => 'Sistema',
					'anio'  => '2016'
				)
			);

			if(!empty($_POST) && isset($_POST))
			{
				if(MUsuario::saveUser($_POST['dni'], $_POST['nombre'], $_POST['contrasena']))
				{
					$user = MUsuario::getDni($_POST['dni'])[0];

					$_SESSION['user']['dni']      = $user->getDni();
					$_SESSION['user']['contrasena'] = $user->getPassword();

					$this->redirect('index', 'home');
				}
				else
				{
					$data['dni']    = $_POST['dni'];
					$data['nombre'] = $_POST['nombre'];
					$data['error']  = "El DNI ya fue registrado";
				}
			}

			$this->view('Registro', $data);
		}*/
		
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