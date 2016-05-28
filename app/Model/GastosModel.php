<?php namespace App\Model;

	use App\Model\Clase\Gastos as CGastos;
	use App\Model\Action\Gastos as AGastos;
	use App\Helpers\Security as HS;

	class GastosModel
	{

		const GASTOS_NAMESPACE = 'App\Model\Clase\Gastos';

		public function __construct()
		{}

		public function saveGastos($codigo, $nombre, $motivo, $monto, $fk_email_usuario)
		{
			$c_Gastos = new CGastos();
			$a_Gastos = new AGastos();

			$c_Gastos->setIdGasto($codigo);
			$c_Gastos->setNombre($nombre);
			$c_Gastos->setMotivo($motivo);
			$c_Gastos->setMonto($monto);
			$c_Gastos->setFkEmailUsuario($fk_email_usuario);

			$fecha = getDate();
			$c_Gastos->setFecha($fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday']);

			$save_gastos = $a_Gastos->save($c_Gastos);

			return $save_gastos;

		}
		
	}