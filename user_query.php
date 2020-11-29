<?php
include("includes/sitedata.inc.php");
include(SERVER_ROOT . 'includes/database.inc.php');
switch($_POST['op']) {
    case 'Rights':
      $eredmeny = array("lista" => array());
      try {
        $connection = Database::getConnection();
        $stmt = $connection->query("select users.user_right, user_rights.name from users inner join user_rights on users.user_right = user_rights.user_right_id group by users.user_right, user_rights.name;");
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny["lista"][] = array("id" => $row['user_right'], "name" => $row['name']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
      break;
    case 'info':
      $eredmeny = array("lista" => array());
      try {
        $connection = Database::getConnection();
        $stmt = $connection->query("select users.nickname, users.first_name, users.last_name, users.password, users.user_right, user_rights.name from users inner join user_rights on users.user_right = user_rights.user_right_id where users.user_right = ".$_POST["id"].";");
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $eredmeny["lista"][] = array("user_right" => $row['name'], "nickname" => $row['nickname'], "name" => $row['last_name']. " ".$row['first_name']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
      break;
    }
?>