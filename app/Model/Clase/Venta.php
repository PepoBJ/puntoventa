<?php namespace App\Model\Clase;

	use App\Helpers\Security as HS;

	class Venta 
	{

		public function __construct () 
		{}

		private $id_venta;
		public function setIdVenta($id_venta)
		{
			$id_venta = HS::clean_input($id_venta);
		
			$this->id_venta = $id_venta;
		}
		public function getIdVenta()
		{
			return $this->id_venta;
		}

		private $monto;
		public function setMonto($monto)
		{
			$monto = HS::clean_input($monto);
		
			$this->monto = $monto > 0 ? $monto : 0;
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

		private $fk_email_usuario;
		public function setFkEmailUsuario($fk_email_usuario)
		{
			$fk_email_usuario = HS::clean_input($fk_email_usuario);
		
			$this->fk_email_usuario = $fk_email_usuario;
		}
		public function getFkEmailUsuario()
		{
			return $this->fk_email_usuario;
		}

	}