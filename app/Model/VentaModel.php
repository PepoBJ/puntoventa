<?php namespace App\Model;

	use App\Model\Clase\Venta as CVenta;
	use App\Model\Action\Venta as AVenta;
	use App\Helpers\Security as HS;

	class VentaModel
	{

		const VENTA_NAMESPACE = 'App\Model\Clase\Venta';

		public function __construct()
		{}

		public static function getAll()
		{
			$a_venta = new AVenta();

			$ventas = $a_venta->getAll(self::VENTA_NAMESPACE);

			return $ventas;
		}
		public static function reporte($fecha_ini, $fecha_fin)
		{
			$a_venta = new AVenta();
			return $a_venta->reporte($fecha_ini, $fecha_fin);
		}

		public static function getId($id)
		{
			$a_venta = new AVenta();

			$venta = $a_venta->getById($id, self::VENTA_NAMESPACE);

			return $venta;
		}
		public static function getByCodBoleta($cod_boleta)
		{
			$a_venta = new AVenta();

			$venta = $a_venta->getBy('cod_boleta', $cod_boleta, self::VENTA_NAMESPACE);

			return $venta;
		}
		public static function getByCodFactura($cod_factura)
		{
			$a_venta = new AVenta();

			$venta = $a_venta->getBy('cod_factura', $cod_factura, self::VENTA_NAMESPACE);

			return $venta;
		}

		public static function saveVenta($id_venta, $monto, $fk_email_usuario, $dni_vendedor, $cod_boleta = NULL, $cod_factura = NULL)
		{
			$c_venta = new CVenta();
			$a_venta = new AVenta();

			$c_venta->setIdVenta($id_venta);
			$c_venta->setMonto($monto);
			$c_venta->setFkEmailUsuario($fk_email_usuario);
			$fecha = getDate();
			$c_venta->setFecha($fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday']);
			$c_venta->setCodBoleta($cod_boleta);
			$c_venta->setCodFactura($cod_factura);
			$c_venta->setDniVendedor($dni_vendedor);

			$save_venta = $a_venta->save($c_venta);

			return $save_venta;
		}

		public static function updateVenta($id_venta, $monto, $fk_email_usuario, $dni_vendedor, $cod_boleta = NULL, $cod_factura = NULL)
		{
			$c_venta = new CVenta();
			$a_venta = new AVenta();

			$venta_existe = self::getId($id_venta);
			if (! isset($venta_existe)) return false;

			$c_venta->setIdVenta($id_venta);
			$c_venta->setMonto($monto);
			$c_venta->setFkEmailUsuario($fk_email_usuario);
			$c_venta->setFecha($venta_existe->getFecha());

			$c_venta->setCodBoleta($cod_boleta);
			$c_venta->setCodFactura($cod_factura);
			$c_venta->setDniVendedor($dni_vendedor);
			
			$update_venta = $a_venta->update($c_venta);

			return $update_venta;
		}

		public static function deleteventa($id_venta)
		{
			$a_venta = new AVenta();
			$c_venta = new CVenta();

			$c_venta->setIdVenta($id_venta);

			$venta_existe= self::getId($id_venta);
			if (! isset($venta_existe)) return false;

			$delete_venta = $a_venta->delete($c_venta);

			return $delete_venta;
		}

	}