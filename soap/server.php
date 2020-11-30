<?php
	class Szolgaltatas {
		public function ido()  {
			return date("Y-m-d H:i:s",time());
		}
	}
	$options = array(
	"uri" => "http://localhost/palyazat/soap/server.php");
	$server = new SoapServer(null, $options);
	$server->setClass('Szolgaltatas');
	$server->handle();
?>
