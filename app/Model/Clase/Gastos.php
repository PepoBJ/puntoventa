<?php namespace App\Model\Clase;

	use App\Helpers\Security as HS;

	class Gastos 
	{

		public function __construct () 
		{}

		private $id_gasto;
		public function setIdGasto($id_gasto)
		{
			$id_gasto = HS::clean_input($id_gasto);
		
			$this->id_gasto = $id_gasto;
		}
		public function getIdGasto()
		{
			return $this->id_gasto;
		}

		private $nombre;
		public function setNombre($nombre)
		{
			$nombre = HS::clean_input($nombre);
		
			$this->nombre = $nombre;
		}
		public function getNombre()
		{
			return $this->nombre;
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