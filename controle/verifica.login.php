<?php
	//session_start();
	
	class verifica_login{
		
		function verifica(){
			$site = $_SESSION["INDEX"];
			if( isset($_SESSION['LAST_REQUEST']) &&
				(time() - $_SESSION['LAST_REQUEST'] > 1200) && $_SESSION["NOME"] != '') { //20 minutos
					session_unset();
					session_destroy();
					return true;
			}
			else
			{
				return false;
			}
		
			$_SESSION['LAST_REQUEST'] = time();
		}
	}
?>