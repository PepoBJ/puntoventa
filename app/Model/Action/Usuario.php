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
					dni,
					nombre,
					password
				) VALUES (
					'" . $usuario->getDni() . "',
					'" . $usuario->getNombre() . "',
					'" . $usuario->getPassword() . "'
				)"
			);

			return $save;
		}

		public function update(CUsuario $usuario)
		{
			$update = $this->runSql(
				"UPDATE usuario SET 
				nombre = '" . $usuario->getNombre() . "',
				password = '" . $usuario->getPassword() . "' 
				WHERE dni = '" . $usuario->getDni() . "'"
			);

			return $update;
		}

		public function delete(CUsuario $usuario)
		{
			$delete = $this->deleteBy("dni", $usuario->getDni());

			return $delete;
		}

	}