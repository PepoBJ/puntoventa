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
				"title"         => "Seguimiento de Resoluciones",
				"error"			=> "",
				"dni"			=> "",
				'datos_template' => array(
					'autor' => 'Robert BJ HC',
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
				"title"          => "Seguimiento de Resoluciones",
				"error"          => "",
				"dni"            => "",
				'datos_template' => array(
					'autor' => 'Robert BJ HC',
					'anio'  => '2016'
				)
			);

			if(!empty($_POST) && isset($_POST))
			{
				if(MUsuario::login($_POST['dni'], $_POST['password']))
				{
					$this->redirect('index', 'home');
				}
				else
				{
					$data['dni']   = $_POST['dni'];
					$data['error'] = "DNI o Contraseña incorrecto";
				}
			}

			$this->view('Index', $data);

		}

		public function registro()
		{
			session_start();

			HS::sesion_iniciada($this);

			$data = array(
				"title"          => "Seguimiento de Resoluciones",
				"error"          => "",
				"dni"            => "",
				"nombre"         => "",
				'datos_template' => array(
					'autor' => 'Robert BJ HC',
					'anio'  => '2016'
				)
			);

			if(!empty($_POST) && isset($_POST))
			{
				if(MUsuario::saveUser($_POST['dni'], $_POST['nombre'], $_POST['password']))
				{
					$user = MUsuario::getDni($_POST['dni'])[0];

					$_SESSION['user']['dni']      = $user->getDni();
					$_SESSION['user']['password'] = $user->getPassword();

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

			$user = MUsuario::getDni($_SESSION['user']['dni'])[0];

			$data = array(
				"title"          => "Seguimiento de Resoluciones",
				"usuario"        => $user,
				'datos_template' => array(
					"usuario" => $user,
					'autor'   => 'Robert BJ HC',
					'anio'    => '2016'
				)
			);
			$this->view("Home", $data);
		}
		
	}