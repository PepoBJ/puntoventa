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

			$user = MUsuario::getDni($_SESSION['user']['dni'])[0];
			
			$data = array(
				"title"          => "Seguimiento de Resoluciones",
				"mensaje"        => "",
				"class_mensaje"  => "error",
				"usuario"        => $user,
				"dni"            => $user->getDni(),
				"nombre"         => $user->getNombre(),	
				'datos_template' => array(
					"usuario" => $user,
					'autor'   => 'Robert BJ HC',
					'anio'    => '2016'
				)
			);


			if(!empty($_POST) && isset($_POST))
			{
				if(md5($_POST['password']) != $user->getPassword())
				{
					$data['dni']    = $_POST['dni'];
					$data['nombre'] = $_POST['nombre'];
					$data['mensaje']  = "La contraseña es incorrecta";
				}
				elseif($_POST['dni'] != $user->getDni())
				{
					$data['dni']    = $_POST['dni'];
					$data['nombre'] = $_POST['nombre'];
					$data['mensaje']  = "El DNI proporcionado es Incorecto";
				}
				elseif(MUsuario::updateUser($_POST['dni'], $_POST['nombre'], $_POST['password']))
				{
					$user = MUsuario::getDni($_POST['dni'])[0];

					$_SESSION['user']['dni']      = $user->getDni();
					$_SESSION['user']['password'] = $user->getPassword();
					$data['usuario']              = $user;
					$data['dni']                  = $user->getDni();
					$data['nombre']               = $user->getNombre();
					$data['mensaje']              = "Se Actualizo la Información";					
					$data['class_mensaje']        = "exito";					
				}
				else
				{
					$data['dni']    = $_POST['dni'];
					$data['nombre'] = $_POST['nombre'];
					$data['mensaje']  = "Ocurrio un Error, Intente Luego";
				}
			}

			$this->view('Usuario/Editar', $data);
		}

		public function contrasena()
		{
			@session_start();

			HS::sesion_no_iniciada($this);

			$user = MUsuario::getDni($_SESSION['user']['dni'])[0];
			
			$data = array(
				"title"          => "Seguimiento de Resoluciones",
				"mensaje"        => "",
				"class_mensaje"  => "error",
				"usuario"        => $user,
				'datos_template' => array(
					"usuario" => $user,
					'autor'   => 'Robert BJ HC',
					'anio'    => '2016'
				)
			);

			if(!empty($_POST) && isset($_POST))
			{
				if(md5($_POST['password-old']) != $user->getPassword())
				{
					$data['mensaje']  = "La contraseña antigua es incorrecta";
				}
				elseif($_POST['password-new'] != $_POST['password-new-confirm'])
				{
					$data['mensaje']  = "Las contraseñas no coinciden";
				}
				elseif(MUsuario::updateUser($user->getDni(), $user->getNombre(), $_POST['password-new']))
				{
					$user = MUsuario::getDni($user->getDni())[0];

					$_SESSION['user']['dni']      = $user->getDni();
					$_SESSION['user']['password'] = $user->getPassword();
					$data['mensaje']              = "Se Actualizo la contraseña";					
					$data['class_mensaje']        = "exito";					
				}
				else
				{
					$data['dni']    = $_POST['dni'];
					$data['nombre'] = $_POST['nombre'];
					$data['mensaje']  = "Ocurrio un Error, Intente Luego";
				}
			}

			$this->view('Usuario/CambiarContrasena', $data);
		}
		
	}