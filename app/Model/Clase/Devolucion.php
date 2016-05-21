<?php namespace App\Model\Clase;

	use App\Helpers\Security as HS;

	class Devolucion 
	{

		public function __construct ()
		{}

		private $id_devolucion;
		public function setIdDevolucion($id_devolucion)
		{
			$id_devolucion = HS::clean_input($id_devolucion);
		
			$this->id_devolucion = $id_devolucion;
		}
		public function getIdDevolucion()
		{
			return $this->id_devolucion;
		}

		private $motivo;
		public function setMotivo($motivo)
		{
			$motivo = HS::clean_input($motivo);
		
			$this->motivo = $motivo;
		}
		public function getMotivo()
		{
			return $this->motivo;
		}

		private $monto;
		public function setMonto($monto)
		{
			$monto = HS::clean_input($monto);
		
			$this->monto = $monto;
		}
		public function getMonto()
		{
			return $this->monto;
		}

		private $fecha;
		public function setFecha($fecha)
		{
			$fecha = HS::clean_input($fecha);
		
			$this->fecha = $fecha;
		}
		public function getFecha()
		{
			return $this->fecha;
		}

		private $fk_id_venta;
		public function setFkIdVenta($fk_id_venta)
		{
			$fk_id_venta = HS::clean_input($fk_id_venta);
		
			$this->fk_id_venta = $fk_id_venta;
		}
		public function getFkIdVenta()
		{
			return $this->fk_id_venta;
		}

	}