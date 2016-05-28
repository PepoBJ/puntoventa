<?php namespace App\Model;

	use Dompdf\Dompdf;
	use Autoloader;

	class PDFModel 
	{

		protected static $configured = false;

		public static function configure()
		{

			if(static::$configured) return ;


			require_once '../vendor/dompdf/dompdf/autoload.inc.php';

			static::$configured = true;

		}

		public static function render($file, $html)
		{
			static::configure();

			$dompdf = new Dompdf();

			$dompdf->load_html($html);
			$dompdf->render();
			$dompdf->stream("$file");

		}

	}