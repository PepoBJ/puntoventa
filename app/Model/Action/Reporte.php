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

		public function reporteVenta($fecha_ini, $fecha_fin)
		{
			$reporte = $this->runSql(
				"SELECT id_venta as codigo_boleta, monto, fecha, fk_email_usuario as usuario, concat(v.nombre, ' ', v.apellido) as vendedor, (select sum(monto) from venta ) as total FROM venta ve INNER JOIN vendedor v ON ve.dni_vendedor = v.dni WHERE fecha BETWEEN '" . $fecha_ini . "' AND '" . $fecha_fin
				 ."'"
			);
			return $reporte;
		}

		public function reporteDevolucion($fecha_ini, $fecha_fin)
		{
			$reporte = $this->runSql(
				"SELECT motivo, monto, fecha, fk_id_venta as codigo_boleta, (select sum(monto) from devolucion ) as total FROM devolucion WHERE fecha BETWEEN '" . $fecha_ini . "' AND '" . $fecha_fin
				 ."'"
			);

			return $reporte;
		}

		public function reporteGasto($fecha_ini, $fecha_fin)
		{
			$reporte = $this->runSql(
				"SELECT id_gasto as codigo, nombre, motivo, monto, fecha, fk_email_usuario as usuario, (select sum(monto) from gasto__externo ) as total FROM gasto__externo WHERE fecha BETWEEN '" . $fecha_ini . "' AND '" . $fecha_fin
				 ."'"
			);

			return $reporte;
		}
	}