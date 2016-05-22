<?php namespace App\Model;

	use App\Model\Clase\Usuario as CUsuario;
	use App\Model\Action\Usuario as AUsuario;
	use App\Helpers\Security as HS;

	class UsuarioModel
	{

		const USUARIO_NAMESPACE = 'App\Model\Clase\Usuario';

		public function __construct()
		{}

		public static function login($email, $contrasena)
		{
			$user = self::getEmail($email);
			
			if (!isset($user)) return false;

			$user = $user[0];
			
			if ($user->getContrasena() == md5($contrasena))
			{
				@session_start();
				$_SESSION['user']['email']    = $user->getEmail();
				$_SESSION['user']['contrasena'] = $user->getContrasena();
				$_SESSION['user']['tipo'] = $user->getTipo();
				return true;
			}

			return false;
		}
				
		public static function logout()
		{
			@session_start();
			unset($_SESSION['user']);
		}		
		
		public static function getEmail($email)
		{
			$a_usuario = new AUsuario();

			$usuario = $a_usuario->getBy("email", $email, self::USUARIO_NAMESPACE);

			return $usuario;
		}

		public static function saveUser($email, $nombre, $apellido, $contrasena, $tipo, $estado)
		{
			$c_usuario = new CUsuario();
			$a_usuario = new AUsuario();

			$c_usuario->setEmail($email);
			$c_usuario->setNombre($nombre);
			$c_usuario->setApellido($apellido);
			$c_usuario->setEmail($email);
			$c_usuario->setContrasena($contrasena);
			$c_usuario->setTipo($tipo);
			$c_usuario->setEstado($estado);
			
			$save_user = $a_usuario->save($c_usuario);

			return $save_user;
		}

		public static function updateUser($email, $nombre, $apellido, $contrasena, $tipo = "Normal", $estado = "Activo")
		{
			$c_usuario = new CUsuario();
			$a_usuario = new AUsuario();

			$usuario_existe = self::getEmail($email);
			if (! isset($usuario_existe)) return false;

			$c_usuario->setEmail($email);
			$c_usuario->setNombre($nombre);
			$c_usuario->setApellido($apellido);
			$c_usuario->setEmail($email);
			$c_usuario->setContrasena($contrasena);
			$c_usuario->setTipo($tipo);
			$c_usuario->setEstado($estado);

			$update_user = $a_usuario->update($c_usuario);

			return $update_user;
		}

		public static function deleteUser($email)
		{
			$a_usuario = new AUsuario();
			$c_usuario = new CUsuario();

			$c_usuario->setEmail($email);

			$usuario_existe= self::getEmail($email);
			if (! isset($usuario_existe)) return false;

			$delete_user = $a_usuario->delete($c_usuario);

			return $delete_user;
		}

	}