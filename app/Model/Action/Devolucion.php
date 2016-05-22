<?php namespace App\Model\Action;

	use App\Model\Clase\Devolucion as CDevolucion;
	use App\Core\ModeloBase;

	class Devolucion extends ModeloBase
	{

		public function __construct()
		{
			$table = "devolucion";
			parent::__construct($table);
		}

		public function save(CDevolucion $devolucion)
		{
			$save = $this->runSql(
				"INSERT INTO devolucion (
					motivo,
					monto,
					fecha,
					fk_id_venta
				) VALUES (
					'" . $devolucion->getMotivo() . "',
					'" . $devolucion->getMonto() . "',
					'" . $devolucion->getFecha() . "',
					'" . $devolucion->getFkIdVenta() . "'
				)"
			);

			return $save;
		}

		public function update(CDevolucion $devolucion)
		{
			$update = $this->runSql(
				"UPDATE devolucion SET 
				motivo = '" . $devolucion->getMotivo() . "',
				monto = '" . $devolucion->getMonto() . "',
				fecha = '" . $devolucion->getFecha() . "',
				fk_id_venta = '" . $devolucion->getFkIdVenta() . "' 
				WHERE id_devolucion = '" . $devolucion->getIdDevolucion() . "'"
			);
			
			return $update;
		}

		public function delete(CDevolucion $devolucion)
		{
			$delete = $this->deleteById($devolucion->getIdDevolucion());

			return $delete;
		}

		public function reporte($fecha_ini, $fecha_fin)
		{
			$reporte = $this->runSql(
				"SELECT motivo, monto, fecha, fk_id_venta as codigo_boleta FROM devolucion WHERE fecha BETWEEN '" . $fecha_ini . "' AND '" . $fecha_fin
				 ."'"
			);

			return $reporte;
		}

	}