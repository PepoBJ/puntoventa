<?php namespace App\Model;

	use App\Model\Clase\Devolucion as CDevolucion;
	use App\Model\Action\Devolucion as ADevolucion;
	use App\Helpers\Security as HS;

	class DevolucionModel
	{

		const DEVOLUCION_NAMESPACE = 'App\Model\Clase\Devolucion';

		public function __construct()
		{}

		
		public static function getId($id)
		{
			$a_devolucion = new ADevolucion();

			$devolucion = $a_devolucion->getById($id, self::DEVOLUCION_NAMESPACE);

			return $devolucion;
		}

		public static function saveDevolucion($motivo, $monto, $fk_id_venta)
		{
			$c_devolucion = new CDevolucion();
			$a_devolucion = new ADevolucion();

			$c_devolucion->setMotivo($motivo);
			$c_devolucion->setMonto($monto);
			$c_devolucion->setFkIdVenta($fk_id_venta);
			$fecha = getDate();
			$c_devolucion->setFecha($fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday']);

			$save_devolucion = $a_devolucion->save($c_devolucion);

			return $save_devolucion;
		}

		public static function updateDevolucion($id_devolucion, $motivo, $monto, $fk_id_venta)
		{
			$c_devolucion = new CDevolucion();
			$a_devolucion = new ADevolucion();

			$devolucion_existe = self::getId($id_devolucion);
			if (! isset($devolucion_existe)) return false;

			$c_devolucion->setIdDevolucion($id_devolucion);
			$c_devolucion->setMotivo($motivo);
			$c_devolucion->setMonto($monto);
			$c_devolucion->setFkIdVenta($fk_id_venta);
			$c_devolucion->setFecha($devolucion_existe->getFecha());

			$update_devolucion = $a_devolucion->update($c_devolucion);

			return $update_devolucion;
		}

		public static function deleteDevolucion($id_devolucion)
		{
			$a_devolucion = new ADevolucion();
			$c_devolucion = new CDevolucion();

			$c_devolucion->setIdDevolucion($id_devolucion);

			$devolucion_existe= self::getId($id_devolucion);
			if (! isset($devolucion_existe)) return false;

			$delete_devolucion = $a_devolucion->delete($c_devolucion);

			return $delete_devolucion;
		}

	}