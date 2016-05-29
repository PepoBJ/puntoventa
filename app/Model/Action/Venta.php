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
			$cod_boleta = $venta->getCodBoleta() == "" ? "NULL" : "'" . $venta->getCodBoleta() . "'";
			$cod_factura = $venta->getCodFactura() == "" ? "NULL" : "'" . $venta->getCodFactura() . "'" ;

			$save = $this->runSql(
				"INSERT INTO venta (
					id_venta,
					monto,
					fecha,
					fk_email_usuario,
					cod_boleta,
					cod_factura,
					dni_vendedor
				) VALUES (
					'" . $venta->getIdVenta() . "',
					'" . $venta->getMonto() . "',
					'" . $venta->getFecha() . "',
					'" . $venta->getFkEmailUsuario() . "',
					" . $cod_boleta . ",
					" . $cod_factura . ",
					'" . $venta->getDniVendedor() . "'
				)"
			);
			return $save;
		}

		public function update(CVenta $venta)
		{
			$cod_boleta = $venta->getCodBoleta() == "" ? "NULL" : "'" . $venta->getCodBoleta() . "'";
			$cod_factura = $venta->getCodFactura() == "" ? "NULL" : "'" . $venta->getCodFactura() . "'" ;

			$update = $this->runSql(
				"UPDATE venta SET 
				monto = '" . $venta->getMonto() . "',
				fecha = '" . $venta->getFecha() . "',
				cod_boleta = " . $cod_boleta . ",
				cod_factura = " . $cod_factura . ",
				dni_vendedor = '" . $venta->getDniVendedor() . "',
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

		

	}