<?php namespace App\Controller;

	use App\Core\ControladorBase;
	use App\Model\DevolucionModel as MDevolucion;
	use App\Helpers\Security as HS;

	class DevolucionController extends ControladorBase
	{

		public function index()
		{
			echo "<pre>";
			var_dump(MDevolucion::getId(2,"no me re gusto", 150.45, 12345));
		}

	}