<?php namespace App\Model\Action;

	use App\Model\Clase\Venta as CVenta;
	use App\Core\ModeloBase;

	class Venta extends ModeloBase
	{

		public function __construct()
		{
			$table = "venta";
			parent::__construct($table);
		}

		public function save(CVenta $venta)
		{
			$save = $this->runSql(
				"INSERT INTO venta (
					id_venta,
					monto,
					fecha,
					fk_email_usuario
				) VALUES (
					'" . $venta->getIdVenta() . "',
					'" . $venta->getMonto() . "',
					'" . $venta->getFecha() . "',
					'" . $venta->getFkEmailUsuario() . "'
				)"
			);

			return $save;
		}

		public function update(CVenta $venta)
		{
			$update = $this->runSql(
				"UPDATE venta SET 
				monto = '" . $venta->getMonto() . "',
				fecha = '" . $venta->getFecha() . "',
				fk_email_usuario = '" . $venta->getFkEmailUsuario() . "' 
				WHERE id_venta = '" . $venta->getIdVenta() . "'"
			);

			return $update;
		}

		public function delete(CVenta $venta)
		{
			$delete = $this->deleteById($venta->getIdVenta());

			return $delete;
		}

		public function reporte($fecha_ini, $fecha_fin)
		{
			$reporte = $this->runSql(
				"SELECT id_venta as codigo_boleta, monto, fecha, fk_email_usuario as usuario, (select sum(monto) from venta ) as total FROM venta WHERE fecha BETWEEN '" . $fecha_ini . "' AND '" . $fecha_fin
				 ."'"
			);

			return $reporte;
		}

	}