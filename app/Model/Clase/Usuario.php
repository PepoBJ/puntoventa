<?php namespace App\Model\Clase;

	use App\Helpers\Security as HS;

	class Usuario 
	{

		public function __construct()
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

		private $password;
		public function setPassword($password)
		{
			$password = HS::clean_input($password);

			$this->password = md5($password);
		}
		public function getPassword()
		{
			return $this->password;
		}
	}