<?php namespace App\Model\Action;

	
	use App\Core\ModeloBase;

	class Reporte extends ModeloBase
	{

		public function __construct()
		{
			$table = "venta";
			parent::__construct($table);
		}

		public function mejorEmpleado($mes)
		{
			$exc = $this->runSql(
				"SELECT dni_vendedor, nombre, apellido, sum(monto) total, count(dni_vendedor) as num_ventas FROM venta ve INNER JOIN vendedor v ON ve.dni_vendedor = v.dni WHERE MONTH(fecha)=$mes group by dni_vendedor"
			);

			return $exc;
		}

	}