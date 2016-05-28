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

		private $cod_boleta;
		public function setCodBoleta($cod_boleta)
		{
			$cod_boleta = HS::clean_input($cod_boleta);
		
			$this->cod_boleta = $cod_boleta;
		}
		public function getCodBoleta()
		{
			return $this->cod_boleta;
		}

		private $cod_factura;
		public function setCodFactura($cod_factura)
		{
			$cod_factura = HS::clean_input($cod_factura);
		
			$this->cod_factura = $cod_factura;
		}
		public function getCodFactura()
		{
			return $this->cod_factura;
		}

		private $dni_vendedor;
		public function setDniVendedor($dni_vendedor)
		{
			$dni_vendedor = HS::clean_input($dni_vendedor);
		
			$this->dni_vendedor = $dni_vendedor;
		}
		public function getDniVendedor()
		{
			return $this->dni_vendedor;
		}

	}