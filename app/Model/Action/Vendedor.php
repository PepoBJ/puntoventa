<?php namespace App\Model\Action;

	use App\Model\Clase\Vendedor as CVendedor;
	use App\Core\ModeloBase;

	class Vendedor extends ModeloBase
	{

		public function __construct()
		{
			$table = "vendedor";
			parent::__construct($table);
		}

		public function save(CVendedor $vendedor)
		{
			$save = $this->runSql(
				"INSERT INTO vendedor (
					dni,
					nombre,
					apellido
				) VALUES (
					'" . $vendedor->getDni() . "',
					'" . $vendedor->getNombre() . "',
					'" . $vendedor->getApellido() . "'
				)"
			);

			return $save;
		}

		public function update(CVendedor $vendedor)
		{
			$update = $this->runSql(
				"UPDATE vendedor SET 
				nombre = '" . $vendedor->getNombre() . "',
				apellido = '" . $vendedor->getApellido() . "'  
				WHERE dni = '" . $vendedor->getDni() . "'"
			);

			return $update;
		}

		public function delete(CVendedor $vendedor)
		{
			$delete = $this->deleteBy('dni', $vendedor->getDni());

			return $delete;
		}

	}