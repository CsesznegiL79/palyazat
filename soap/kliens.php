<?php
		
		//ini_set("default_socket_timeout", 5000);
	   $options = array(
	   "location" => SITE_ROOT."soap/server.php",
	   "uri" => SITE_ROOT."soap/server.php",
	   'keep_alive' => false,
		//'trace' =>true,
		//'connection_timeout' => 5000,
		//'cache_wsdl' => WSDL_CACHE_NONE,
	   );		
	   try {
		$kliens = new SoapClient(null, $options);
		$ido = $kliens->ido();
	   } catch (SoapFault $e) {
			var_dump($e);
	   }
?>
