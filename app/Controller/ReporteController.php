<?php namespace App\Controller;

	use App\Core\ControladorBase;
	use App\Model\DevolucionModel as MDevolucion;
	use App\Model\VentaModel as MVenta;
	use App\Model\ReporteModel as MReporte;
	use App\Model\UsuarioModel as MUsuario;
	use App\Model\ExcelModel as MExcel;
	use App\Helpers\Security as HS;
	use App\Model\PDFModel as MPDF;
	use stdClass;

	class ReporteController extends ControladorBase
	{

		public function index()
		{
			$this->redirect('index', 'index');
		}

		public function generar()
		{
			@session_start();

			HS::sesion_no_iniciada($this);

			$user = MUsuario::getEmail($_SESSION['user']['email'])[0];

			$data = array(
				"title"          => "Dist. Plas Anthony",
				"mensaje"        => "",
				"class_mensaje"  => "error",
				"usuario"        => $user,
				"link_reporte"   => "",
				"reporte"        => NULL,
				'datos_template' => array(
					"usuario" => $user,
					'autor'   => 'Sistema',
					'anio'    => '2016'
				)
			);

			if(!empty($_POST) && isset($_POST))
			{
				if($_POST['tipo'] == "venta")	
				{
					$data['cabezeras'] = array(
						"codigo",
						"cod_boleta",
						"cod_factura",
						"monto",
						"fecha",
						"usuario",
						"vendedor"
					);
					$reporte = MReporte::reporteVenta($_POST['fecha_ini'], $_POST['fecha_fin']);					
					
				}
				elseif($_POST['tipo'] == "devolucion")
				{
					$data['cabezeras'] = array(
						"codigo_boleta",
						"monto",
						"fecha",
						"motivo"
					);
					$reporte = MReporte::reporteDevolucion($_POST['fecha_ini'], $_POST['fecha_fin']);

				}
				elseif($_POST['tipo'] == "gasto")
				{
					$data['cabezeras'] = array(
						"codigo",
						"nombre",
						"motivo",
						"monto",
						"fecha",
						"usuario"
					);
					$reporte = MReporte::reporteGasto($_POST['fecha_ini'], $_POST['fecha_fin']);

				}

				if(isset($reporte) && (is_array($reporte) || is_object($reporte)))
				{
					if(is_object($reporte))
					{
						$reporte = array($reporte);
					}

					$data['reporte'] = $reporte;
					$data['link_reporte'] = $_POST['tipo'] . "*" . $_POST['fecha_ini'] . "*" . $_POST['fecha_fin'];
					$data['titulo_tabla'] = "Reporte De ". $_POST['tipo'] . " Del " . $_POST['fecha_ini'] . " Al " . $_POST['fecha_fin'];
				}
				else 
				{
					$data['mensaje'] = "No se encontraron datos para generar el reporte";
				}
			}

			$this->view('Reporte/Reporte', $data);
		}

		public function renderPDF($infor_reporte = NULL)
		{
			@session_start();

			HS::sesion_no_iniciada($this);

			if(! isset($infor_reporte)) $this->redirect('index', 'index');;

			$info = explode("*", $infor_reporte);

			if(! is_array($info) || count($info) < 3) exit;

			$tipo = $info[0];
			$fecha_ini = $info[1];
			$fecha_fin = $info[2];

			$data = array(
				"title"          => "Dist. Plas Anthony"
			);

			if($tipo == "venta")	
			{
				$data['cabezeras'] = array(
					"codigo",
					"cod_boleta",
					"cod_factura",
					"monto",
					"fecha",
					"usuario",
					"vendedor"
				);
				$reporte = MReporte::reporteVenta($fecha_ini, $fecha_fin);					
				
			}
			elseif($tipo == "devolucion")
			{
				$data['cabezeras'] = array(
					"codigo_boleta",
					"monto",
					"fecha",
					"motivo"
				);
				$reporte = MReporte::reporteDevolucion($fecha_ini, $fecha_fin);

			}
			elseif($tipo == "gasto")
			{
				$data['cabezeras'] = array(
					"codigo",
					"nombre",
					"motivo",
					"monto",
					"fecha",
					"usuario"
				);
				$reporte = MReporte::reporteGasto($fecha_ini, $fecha_fin);

			}

			if(isset($reporte) && (is_array($reporte) || is_object($reporte)))
			{
				if(is_object($reporte))
				{
					$reporte = array($reporte);
				}

				$data['reporte'] = $reporte;
				$data['titulo_tabla'] = "Reporte De ". $tipo . " Del " . $fecha_ini . " Al " . $fecha_fin;
			}

			$dataPdf = $this->renderView('Reporte/PDFReporte', $data);
			
			MPDF::generar("Reporte De ". $tipo . " Del " . $fecha_ini . " Al " . $fecha_fin, $dataPdf);
		}

		public function render($infor_reporte = NULL)
		{
			@session_start();

			HS::sesion_no_iniciada($this);
			
			if(! isset($infor_reporte)) $this->redirect('index', 'index');;

			$info = explode("*", $infor_reporte);

			if(! is_array($info) || count($info) < 3) exit;

			$tipo = $info[0];
			$fecha_ini = $info[1];
			$fecha_fin = $info[2];

			$data_excel = array(
				"creador"        => "Sistema Venta Plas Anthony",
				"titulo"         => "Reporte de Sistema",
				"asunto"         => "Reporte de Sistema",
				"descripcion"    => "Reporte de Sistema",
				"palabras_clave" => "Reporte Sistema",
				"categoria"      => "Reporte",
				"titulo_reporte" => "Reporte De " . $tipo . " Del " . $fecha_ini . " Al " .  $fecha_fin,
				"nombre_hoja"    => "Reporte de " . $tipo ,
				"nombre_archivo" => "ReporteDe" . $tipo . "Del" . $fecha_ini . "Al" .  $fecha_fin,
				"cabezeras"      => "",
				"informacion"    => ""
			);
			
			if($tipo == "venta")	
			{
				$data_excel['cabezeras'] = array(
					"codigo",
					"cod_boleta",
					"cod_factura",
					"monto",
					"fecha",
					"usuario",
					"vendedor"
				);
				$reporte = MReporte::reporteVenta($fecha_ini, $fecha_fin);					
				
			}
			elseif($tipo == "devolucion")
			{
				$data_excel['cabezeras'] = array(
					"codigo_boleta",
					"monto",
					"fecha",
					"motivo"
				);
				$reporte = MReporte::reporteDevolucion($fecha_ini, $fecha_fin);

			}
			elseif($tipo == "gasto")
			{
				$data_excel['cabezeras'] = array(
					"codigo",
					"nombre",
					"motivo",
					"monto",
					"fecha",
					"usuario"
				);
				$reporte = MReporte::reporteGasto($fecha_ini, $fecha_fin);

			}

			if(isset($reporte) && (is_array($reporte) || is_object($reporte)))
			{
				if(is_object($reporte))
				{
					$reporte = array($reporte);
				}

				$data_excel['informacion'] = $reporte;
				MExcel::render($data_excel);
			}
			else
			{
				$this->redirect('reporte', 'generar');
			}
		}

		public function vendedor()
		{
			@session_start();

			HS::sesion_no_iniciada($this);
			
			$data = array(
				"title"          => "Dist. Plas Anthony",
				"no_total" => true
			);

			$data['cabezeras'] = array(
				"dni_vendedor",
				"nombre",
				"apellido",
				"total",
				"num_ventas"
			);
			$fecha = getDate();
			$reporte = MReporte::reporteTopVendedor($fecha['mon']);		
			
			if(isset($reporte) && (is_array($reporte) || is_object($reporte)))
			{
				if(is_object($reporte))
				{
					$reporte = array($reporte);
				}

				$data['reporte'] = $reporte;
			}
			$data['titulo_tabla'] = "TOP VENDEDORES DEL MES DE " . HS::getMes($fecha['mon']);
			
			$dataPdf = $this->renderView('Reporte/PDFReporte', $data);
			
			MPDF::generar("reporteTopMes" . HS::getMes($fecha['mon']), $dataPdf);
		}

		public function diario()
		{
			@session_start();

			HS::sesion_no_iniciada($this);
			
			$data = array(
				"title"          => "Dist. Plas Anthony",
				"reporte_complejo" => true
			);

			$fecha = getDate();
			$fecha_hoy = $fecha['year'].'-'.$fecha['mon'].'-'.$fecha['mday'];

			$reporte_ventas = MReporte::reporteVenta($fecha_hoy, $fecha_hoy);
			$reporte_devolucion = MReporte::reporteDevolucion($fecha_hoy, $fecha_hoy);
			$reporte_gastos = MReporte::reporteGasto($fecha_hoy, $fecha_hoy);


			$data['cabezeras_gastos'] = array(
				"codigo",
				"nombre",
				"motivo",
				"monto",
				"fecha",
				"usuario"
			);
			$data['cabezeras_devoluciones'] = array(
				"codigo_boleta",
				"monto",
				"fecha",
				"motivo"
			);
			$data['cabezeras_ventas'] = array(
				"codigo",
				"cod_boleta",
				"cod_factura",
				"monto",
				"fecha",
				"usuario",
				"vendedor"
			);
			
			if((isset($reporte_ventas) && (is_array($reporte_ventas) || is_object($reporte_ventas))) )
			{
				if(is_object($reporte_ventas))
				{
					$reporte_ventas = array($reporte_ventas);
				}
				if(is_object($reporte_devolucion))
				{
					$reporte_devolucion = array($reporte_devolucion);
				}
				if(is_object($reporte_gastos))
				{
					$reporte_gastos = array($reporte_gastos);
				}

				$data['titulo_tabla'] = $fecha_hoy;
				$data['reporte_ventas'] = $reporte_ventas;
				
			}

			if((isset($reporte_devolucion) && (is_array($reporte_devolucion) || is_object($reporte_devolucion))) )
			{
				if(is_object($reporte_devolucion))
				{
					$reporte_devolucion = array($reporte_devolucion);
				}

				$data['titulo_tabla'] = $fecha_hoy;
				$data['reporte_devoluciones'] = $reporte_devolucion;
				
			}

			if((isset($reporte_gastos) && (is_array($reporte_gastos) || is_object($reporte_gastos))))
			{
				if(is_object($reporte_gastos))
				{
					$reporte_gastos = array($reporte_gastos);
				}

				$data['titulo_tabla'] = $fecha_hoy;
				$data['reporte_gastos'] = $reporte_gastos;
				
			}
			$data['titulo_tabla'] = $fecha_hoy;
			$dataPdf = $this->renderView('Reporte/PDFReporte', $data);
			
			MPDF::generar("reporteDiario-" .($fecha_hoy), $dataPdf);

		}
	}