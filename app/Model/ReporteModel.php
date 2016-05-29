<?php namespace App\Model;

	use App\Model\Action\Reporte as AReporte;
	use App\Helpers\Security as HS;

	class ReporteModel
	{

		public function __construct()
		{}

		public function reporteTopVendedor($mes)
		{
			$reporte = new AReporte();
			return $reporte->mejorEmpleado($mes);
		}

		public function reporteVenta($fecha_ini, $fecha_fin)
		{
			$reporte = new AReporte();

			return $reporte->reporteVenta($fecha_ini, $fecha_fin);
		}

		public function reporteDevolucion($fecha_ini, $fecha_fin)
		{
			$reporte = new AReporte();

			return $reporte->reporteDevolucion($fecha_ini, $fecha_fin);
		}

		public function reporteGasto($fecha_ini, $fecha_fin)
		{
			$reporte = new AReporte();

			return $reporte->reporteGasto($fecha_ini, $fecha_fin);
		}

	}