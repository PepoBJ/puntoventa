<?php namespace App\Model;

	use App\Model\Clase\Usuario as CUsuario;
	use App\Model\Action\Usuario as AUsuario;
	use App\Helpers\Security as HS;

	class UsuarioModel
	{

		const USUARIO_NAMESPACE = 'App\Model\Clase\Usuario';

		public function __construct()
		{}

		public static function login($dni, $password)
		{
			$user = self::getDni($dni);
			
			if (!isset($user)) return false;

			$user = $user[0];
			
			if ($user->getPassword() == md5($password))
			{
				@session_start();
				$_SESSION['user']['dni']    = $user->getDni();
				$_SESSION['user']['password'] = $user->getPassword();
				return true;
			}

			return false;
		}
				
		public static function logout()
		{
			@session_start();
			unset($_SESSION['user']);
		}		
		
		public static function getDni($dni)
		{
			$a_usuario = new AUsuario();

			$usuario = $a_usuario->getBy("dni", $dni, self::USUARIO_NAMESPACE);

			return $usuario;
		}

		public static function saveUser($dni, $nombre, $password)
		{
			$c_usuario = new CUsuario();
			$a_usuario = new AUsuario();

			$c_usuario->setDni($dni);
			$c_usuario->setNombre($nombre);
			$c_usuario->setPassword($password);
			
			$save_user = $a_usuario->save($c_usuario);

			return $save_user;
		}

		public static function updateUser($dni, $nombre, $password)
		{
			$c_usuario = new CUsuario();
			$a_usuario = new AUsuario();

			$usuario_existe = self::getDni($dni);
			if (! isset($usuario_existe)) return false;

			$c_usuario->setDni($dni);
			$c_usuario->setNombre($nombre);
			$c_usuario->setPassword($password);

			$update_user = $a_usuario->update($c_usuario);

			return $update_user;
		}

		public static function deleteUser($dni)
		{
			$a_usuario = new AUsuario();
			$c_usuario = new CUsuario();

			$c_usuario->setDni($dni);

			$usuario_existe= self::getDni($dni);
			if (! isset($usuario_existe)) return false;

			$delete_user = $a_usuario->delete($c_usuario);

			return $delete_user;
		}

	}