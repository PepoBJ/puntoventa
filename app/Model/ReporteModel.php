<?php namespace App\Model;

	use App\Model\Action\Reporte as AReporte;
	use App\Helpers\Security as HS;

	class ReporteModel
	{

		public function __construct()
		{}

		public function getTopVendedor($mes)
		{
			$reporte = new AReporte();
			return $reporte->mejorEmpleado($mes);
		}

	}