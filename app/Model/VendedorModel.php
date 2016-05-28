<?php namespace App\Model;

	use App\Model\Clase\Vendedor as CVendedor;
	use App\Model\Action\Vendedor as AVendedor;
	use App\Helpers\Security as HS;

	class VendedorModel
	{

		const VENDEDOR_NAMESPACE = 'App\Model\Clase\Vendedor';

		public function __construct()
		{}
		

		public static function getAll()
		{
			$a_vendedor = new AVendedor();

			$vendedores = $a_vendedor->getAll(self::VENDEDOR_NAMESPACE);

			return $vendedores;
		}
		
		public static function getDni($dni)
		{
			$a_vendedor = new AVendedor();

			$vendedor = $a_vendedor->getBy("dni", $dni, self::VENDEDOR_NAMESPACE);

			return $vendedor;
		}

		public static function saveVendedor($dni, $nombre, $apellido)
		{
			$c_vendedor = new CVendedor();
			$a_vendedor = new AVendedor();

			$c_vendedor->setDni($dni);
			$c_vendedor->setNombre($nombre);
			$c_vendedor->setApellido($apellido);
			
			$save_user = $a_vendedor->save($c_vendedor);

			return $save_user;
		}

		public static function updateVendedor($dni, $nombre, $apellido)
		{
			$c_vendedor = new CVendedor();
			$a_vendedor = new AVendedor();

			$vendedor_existe = self::getDni($dni);
			if (! isset($vendedor_existe)) return false;

			$c_vendedor->setDni($dni);
			$c_vendedor->setNombre($nombre);
			$c_vendedor->setApellido($apellido);

			$update_user = $a_vendedor->update($c_vendedor);

			return $update_user;
		}

		public static function deleteVendedor($dni)
		{
			$a_vendedor = new AVendedor();
			$c_vendedor = new CVendedor();
			$c_vendedor->setDni($dni);

			$vendedor_existe= self::getDni($dni);
			if (! isset($vendedor_existe)) return false;

			$delete_user = $a_vendedor->delete($c_vendedor);

			return $delete_user;
		}

	}