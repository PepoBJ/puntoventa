<?php namespace App\Controller;

	use App\Core\ControladorBase;
	use App\Model\VendedorModel as MVendedor;
	use App\Helpers\Security as HS;


	use App\Model\ReporteModel as RM;
	class VendedorController extends ControladorBase
	{

		public function index()
		{
			echo "<pre>";
			var_dump(MVendedor::deleteVendedor('12345678', 'Test MOdificado', 'Test'));
			var_dump(MVendedor::getAll());
			var_dump(MVendedor::getDni('71960340'));
			var_dump(RM::getTopVendedor(3));
		}
	}