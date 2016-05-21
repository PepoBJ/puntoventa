<?php namespace App\Model\Clase;

	use App\Helpers\Security as HS;

	class Usuario 
	{

		public function __construct()
		{}


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

		private $email;
		public function setEmail($email)
		{
			$email = HS::clean_input($email);
		
			$this->email = $email;
		}
		public function getEmail()
		{
			return $this->email;
		}

		private $contrasena;
		public function setContrasena($contrasena)
		{
			$contrasena = HS::clean_input($contrasena);
		
			$this->contrasena = md5($contrasena);
		}
		public function getContrasena()
		{
			return $this->contrasena;
		}

		private $tipo;
		public function setTipo($tipo)
		{
			$tipo = HS::clean_input($tipo);
		
			$this->tipo = $tipo;
		}
		public function getTipo()
		{
			return $this->tipo;
		}

		private $estado;
		public function setEstado($estado)
		{
			$estado = HS::clean_input($estado);
		
			$this->estado = $estado;
		}
		public function getEstado()
		{
			return $this->estado;
		}

	}