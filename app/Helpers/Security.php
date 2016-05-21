<?php namespace App\Helpers;
	
	class Security 
	{
		/*		CLEAN INPUT 		*/
		
		public static function clean_input ($data) 
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			
			return $data;
		}
		
		/*	**	*/

		public static function sesion_iniciada($controller, $uri1 = "index", $uri2 = "index")
		{
			if(isset($_SESSION['user']['dni']) && isset($_SESSION['user']['password']))
			{
				$controller->redirect($uri1, $uri2);
			}
		}

		public static function sesion_no_iniciada($controller, $uri1 = "index", $uri2 = "index")
		{
			if(! isset($_SESSION['user']['dni']) || ! isset($_SESSION['user']['password']))
			{
				$controller->redirect($uri1, $uri2);
			}
		}
	}

/*		FIN CLASS HELPERS SECURITY		*/