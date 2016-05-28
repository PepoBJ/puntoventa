<?php namespace App\Controller;

	use App\Core\ControladorBase;
	use App\Model\DevolucionModel as MDevolucion;
	use App\Model\VentaModel as MVenta;
	use App\Model\UsuarioModel as MUsuario;
	use App\Model\ExcelModel as MExcel;
	use App\Helpers\Security as HS;
	use stdClass;

	class DevolucionController extends ControladorBase
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
				"motivo" => "",
				"usuario"        => $user,
				'datos_template' => array(
					"usuario" => $user,
					'autor'   => 'Sistema',
					'anio'    => '2016'
				)
			);

			if(!empty($_POST) && isset($_POST))
			{

				$venta = MVenta::getId($_POST['codigo']);
				$data['codigo']    = $_POST['codigo'];
				$data['monto'] = $_POST['monto'];
				$data['motivo'] = $_POST['motivo'];

				if(!isset($venta))
				{
					$porboleta = MVenta::getByCodBoleta($_POST['codigo']);
					$porfactura = MVenta::getByCodFactura($_POST['codigo']);

					if(isset($porboleta))
					{
						$venta = $porboleta[0];
						$_POST['codigo'] = $venta->getIdVenta();
					}
					elseif(isset($porfactura))
					{
						$venta = $porfactura[0];
						$_POST['codigo'] = $venta->getIdVenta();
					}
				}

				if (isset($venta))
				{

					if($venta->getMonto() >= $_POST['monto'])
					{
						$venta->setMonto($venta->getMonto() - $_POST['monto']);

						if(MVenta::updateVenta($venta->getIdVenta(), $venta->getMonto(), $venta->getFkEmailUsuario(), $venta->getDniVendedor(), $venta->getCodBoleta(), $venta->getCodFactura()) && MDevolucion::saveDevolucion($_POST['motivo'], $_POST['monto'], $_POST['codigo']))
						{
							
							$data['mensaje']              = "Devolucion Registrada Correctamente";					
							$data['class_mensaje']        = "exito";	
						}
						else
						{
							$data['mensaje']  = "La Devolucion no fue registrada";
						}
					}
					else
					{
						$data['mensaje'] = "El monto a devolver es mayor al de venta";
					}
				}
				else
				{
					$data['mensaje'] = "No se encontro la boleta con ese código";
				}
			}

			$this->view('Devolucion/Devolucion', $data);
		}

	}