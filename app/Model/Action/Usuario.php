<?php namespace App\Model\Action;

	use App\Model\Clase\Usuario as CUsuario;
	use App\Core\ModeloBase;

	class Usuario extends ModeloBase
	{

		public function __construct()
		{
			$table = "usuario";
			parent::__construct($table);
		}

		public function save(CUsuario $usuario)
		{
			$save = $this->runSql(
				"INSERT INTO usuario (
					nombre,
					apellido,
					email,
					contrasena,
					tipo,
					estado
				) VALUES (
					'" . $usuario->getNombre() . "',
					'" . $usuario->getApellido() . "',
					'" . $usuario->getEmail() . "',
					'" . $usuario->getContrasena() . "',
					'" . $usuario->getTipo() . "',
					'" . $usuario->getEstado() . "'
				)"
			);

			return $save;
		}

		public function update(CUsuario $usuario)
		{
			$update = $this->runSql(
				"UPDATE usuario SET 
				nombre = '" . $usuario->getNombre() . "',
				apellido = '" . $usuario->getApellido() . "',
				email = '" . $usuario->getEmail() . "',
				contrasena = '" . $usuario->getContrasena() . "',
				tipo = '" . $usuario->getTipo() . "',
				estado = '" . $usuario->getEstado() . "' 
				WHERE email = '" . $usuario->getEmail() . "'"
			);

			return $update;
		}

		public function delete(CUsuario $usuario)
		{
			$delete = $this->deleteBy('email', $usuario->getEmail());

			return $delete;
		}

	}