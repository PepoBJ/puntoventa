<?php namespace App\Model\Clase;

	use App\Helpers\Security as HS;

	class Vendedor 
	{

		public function __construct ()
		{}

		private $dni;
		public function setDni($dni)
		{
			$dni = HS::clean_input($dni);
		
			$this->dni = $dni;
		}
		public function getDni()
		{
			return $this->dni;
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

		private $apellido;
		public function setApellido($apellido)
		{
			$apellido = HS::clean_input($apellido);
		
			$this->apellido = $apellido;
		}
		public function getApellido()
		{
			return $this->apellido;
		}
		

	}