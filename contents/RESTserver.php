<?php
$eredmeny = "";
switch($_SERVER['REQUEST_METHOD']) {
	case "GET":
		break;
	case "POST":
		$newstitle = $_REQUEST['newstitle'];
		$news = $_REQUEST['newstext'];
		$nickname = $_SESSION['nickname'];
		include(SERVER_ROOT."soap/kliens.php");
		$created_time = $ido;

  		$sql = "INSERT INTO news (title, news, nickname, created_time) VALUES ('$newstitle', '$news','$nickname', '$created_time')";
	  	$connection = Database::getConnection();
	  	try{    
	  	$stmt = $connection->prepare($sql);
	  	$stmt->execute();
		  $stmt = null;
		  $eredmeny = '';
	  	}
	  	catch(Exception $e){
			$eredmeny = '<h3>A mentés sikertelen</h3>';
	  	}
		break;
	case "PUT":
		break;
	case "DELETE":
		break;
}
echo $eredmeny;
?>