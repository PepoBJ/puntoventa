<?php namespace App\Controller;

	use App\Core\ControladorBase;
	use App\Model\UsuarioModel as MUsuario;
	use App\Helpers\Security as HS;

	class UsuarioController extends ControladorBase
	{
		
		public function index()
		{
			$this->redirect('index', 'index');
		}

		public function editar()
		{
			@session_start();

			HS::sesion_no_iniciada($this);

			$user = MUsuario::getEmail($_SESSION['user']['email'])[0];
			
			$data = array(
				"title"          => "Dist. Plas Anthony",
				"mensaje"        => "",
				"class_mensaje"  => "error",
				"usuario"        => $user,
				"email"            => $user->getEmail(),
				"nombre"         => $user->getNombre(),	
				"apellido"         => $user->getApellido(),
				'datos_template' => array(
					"usuario" => $user,
					'autor'   => 'Sistema',
					'anio'    => '2016'
				)
			);


			if(!empty($_POST) && isset($_POST))
			{
				if(md5($_POST['contrasena']) != $user->getContrasena())
				{
					$data['email']    = $_POST['email'];
					$data['nombre'] = $_POST['nombre'];
					$data['mensaje']  = "La contraseña es incorrecta";
				}
				elseif($_POST['email'] != $user->getEmail())
				{
					$data['email']    = $_POST['email'];
					$data['nombre'] = $_POST['nombre'];
					$data['apellido'] = $_POST['apellido'];
					$data['mensaje']  = "El Email proporcionado es Incorecto";
				}
				elseif(MUsuario::updateUser($_POST['email'], $_POST['nombre'], $_POST['apellido'], $_POST['contrasena']))
				{
					$user = MUsuario::getEmail($_POST['email'])[0];

					$_SESSION['user']['email']      = $user->getEmail();
					$_SESSION['user']['contrasena'] = $user->getContrasena();
					$data['usuario']                = $user;
					$data['email']                  = $user->getEmail();
					$data['nombre']                 = $user->getNombre();
					$data['apellido']               = $user->getApellido();
					$data['mensaje']                = "Se Actualizo la Información";					
					$data['class_mensaje']          = "exito";					
				}
				else
				{
					$data['email']    = $_POST['email'];
					$data['nombre'] = $_POST['nombre'];
					$data['apellido'] = $_POST['apellido'];
					$data['mensaje']  = "Ocurrio un Error, Intente Luego";
				}
			}

			$this->view('Usuario/Editar', $data);
		}

		public function contrasena()
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
				if(md5($_POST['contrasena-old']) != $user->getContrasena())
				{
					$data['mensaje']  = "La contraseña antigua es incorrecta";
				}
				elseif($_POST['contrasena-new'] != $_POST['contrasena-new-confirm'])
				{
					$data['mensaje']  = "Las contraseñas no coinciden";
				}
				elseif(MUsuario::updateUser($user->getEmail(), $user->getNombre(), $user->getApellido(), $_POST['contrasena-new']))
				{
					$user = MUsuario::getEmail($user->getEmail())[0];

					$_SESSION['user']['email']      = $user->getEmail();
					$_SESSION['user']['contrasena'] = $user->getContrasena();
					$data['mensaje']              = "Se Actualizo la contraseña";					
					$data['class_mensaje']        = "exito";					
				}
				else
				{
					$data['email']    = $_POST['email'];
					$data['nombre'] = $_POST['nombre'];
					$data['mensaje']  = "Ocurrio un Error, Intente Luego";
				}
			}

			$this->view('Usuario/CambiarContrasena', $data);
		}


		public function registro()
		{
			session_start();
			
			HS::session_no_iniciada_administrador($this);

			$user = MUsuario::getEmail($_SESSION['user']['email'])[0];
			$data = array(
				"title"          => "Distr. Plas Anthony",
				"mensaje"          => "",
				"class_mensaje"  => "error",
				"email"            => "",
				"nombre"         => "",
				"apellido"         => "",
				"usuario"        => $user,
				'datos_template' => array(
					"usuario" => $user,
					'autor'   => 'Sistema',
					'anio'    => '2016'
				)
			);

		
			if(!empty($_POST) && isset($_POST))
			{
				if(MUsuario::saveUser($_POST['email'], $_POST['nombre'], $_POST['apellido'], $_POST['contrasena'], $_POST['tipo'], $_POST['estado']))
				{
					
					$data['mensaje']              = "Usuario Creado Correctamente";					
					$data['class_mensaje']        = "exito";	
				}
				else
				{
					$data['email']    = $_POST['email'];
					$data['nombre'] = $_POST['nombre'];
					$data['apellido'] = $_POST['apellido'];
					$data['mensaje']  = "El Email ya fue registrado";
				}
			}

			$this->view('Usuario/Registro', $data);
		}
		
	}