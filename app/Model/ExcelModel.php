<?php namespace App\Model;

	use PHPExcel;
	use PHPExcel_IOFactory;
	use PHPExcel_Style_Border;

	class ExcelModel 
	{

		protected static $configured = false;

		public static function configure()
		{

			if(static::$configured) return ;


			require_once '../vendor/phpoffice/phpexcel/Classes/PHPExcel.php';

			static::$configured = true;

		}

		public static function render($data)
		{
			static::configure();

			$objPHPExcel = new PHPExcel();

			$objPHPExcel->
		    getProperties()
		        ->setCreator($data['creador'])
		        ->setLastModifiedBy($data['creador'])
		        ->setTitle($data['titulo'])
		        ->setSubject($data['asunto'])
		        ->setDescription($data['descripcion'])
		        ->setKeywords($data['palabras_clave'])
		        ->setCategory($data['categoria']);

		    $indice = 1;
		    $letra_ascii = 65;
		    $cell_name = chr($letra_ascii) . $indice;

		    $objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue($cell_name, $data['titulo_reporte']);
		    $objPHPExcel->getActiveSheet()->getStyle("$cell_name:$cell_name")->getFont()->setBold(true);

		    $indice = 3;

	        foreach($data['cabezeras'] as $cabezera)
	        {
	        	$cell_name = chr($letra_ascii) . $indice;

        		$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue($cell_name, $cabezera);
		        
		        $objPHPExcel->getActiveSheet()->getColumnDimension(chr($letra_ascii))->setWidth(20);
		    		        
		        $objPHPExcel->getActiveSheet()->getStyle($cell_name)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                
                $objPHPExcel->getActiveSheet()->getStyle("$cell_name:$cell_name")->getFont()->setBold(true);

		       	$letra_ascii ++;
	        }

	        $indice ++;
	        $letra_ascii = 65;

	        foreach ($data['informacion']  as $dato)
	        {
		       	$letra_ascii = 65;
	        	
	        	foreach ($data['cabezeras'] as $cabezera) 
	        	{
	        		$objPHPExcel->setActiveSheetIndex(0)
			            ->setCellValue(chr($letra_ascii) . $indice, $dato->$cabezera);
			        $objPHPExcel->getActiveSheet()->getColumnDimension(chr($letra_ascii))->setWidth(20);
			        $objPHPExcel->getActiveSheet()->getStyle(chr($letra_ascii) . $indice)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			        $letra_ascii ++;
	        	}
                   
		       	$indice ++;
	        }

	        $indice ++;
	        $letra_ascii = 65;
		    $cell_name = chr($letra_ascii) . $indice;

		    $objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue($cell_name, "TOTAL: " . $data['informacion'][0]->total);
		    $objPHPExcel->getActiveSheet()->getStyle("$cell_name:$cell_name")->getFont()->setBold(true);
		    

	        $objPHPExcel->getActiveSheet()->setTitle($data['nombre_hoja']);
			$objPHPExcel->setActiveSheetIndex(0);

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $data['nombre_archivo'] . '.xlsx"');
			header('Cache-Control: max-age=0');
			 
			$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
			$objWriter->save('php://output');
			exit;
		}

	}