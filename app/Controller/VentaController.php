<?php namespace App\Controller;

	use App\Core\ControladorBase;
	use App\Model\VentaModel as MVenta;
	use App\Model\VendedorModel as MVendedor;
	use App\Model\DevolucionModel as MDevolucion;
	use App\Model\UsuarioModel as MUsuario;
	use App\Helpers\Security as HS;
	use stdClass;

	class VentaController extends ControladorBase
	{

		public function index()
		{
			$this->redirect('index', 'index');
		}

		public function nuevo()
		{
			@session_start();

			HS::sesion_no_iniciada($this);

			$user = MUsuario::getEmail($_SESSION['user']['email'])[0];

			$data = array(
				"title"          => "Dist. Plas Anthony",
				"mensaje"        => "",
				"class_mensaje"  => "error",
				"codigo" => "",
				"monto" => "",
				"cod_boleta" => "",
				"cod_factura" => "",
				"vendedores" => MVendedor::getAll(),
				"usuario"        => $user,
				'datos_template' => array(
					"usuario" => $user,
					'autor'   => 'Sistema',
					'anio'    => '2016'
				)
			);

			if(!empty($_POST) && isset($_POST))
			{
				$cod_boleta = $_POST['cod_boleta'] == "" ? NULL : $_POST['cod_boleta'];
				$cod_factura = $_POST['cod_factura'] == "" ? NULL : $_POST['cod_factura'];

				if(MVenta::saveVenta($_POST['codigo'], $_POST['monto'], $_SESSION['user']['email'], $_POST['vendedor'], $cod_boleta, $cod_factura))
				{
					
					$data['mensaje']              = "Venta Registrada Correctamente";					
					$data['class_mensaje']        = "exito";	
				}
				else
				{
					$data['codigo']    = $_POST['codigo'];
					$data['monto'] = $_POST['monto'];
					$data['mensaje']  = "La Venta no fue registrada";
				}
			}

			$this->view('Venta/Venta', $data);
		}
	}