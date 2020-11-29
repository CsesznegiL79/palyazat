<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    include(SERVER_ROOT . 'includes/user.inc.php');
    user::LoginUser($_REQUEST['login'], $_REQUEST['password']);

  }
  else{?>
    <form class="form-style-8" action="" method="POST">
        <label for="login">Felhasználó :</label><input type="text" name="login" id="login" required pattern="[a-zA-Z][\-\.a-zA-Z0-9_]{3}[\-\.a-zA-Z0-9_]+"><br>
        <label for="password">Jelszó :</label><input type="password" name="password" id="password" required pattern="[\-\.a-zA-Z0-9_]{4}[\-\.a-zA-Z0-9_]+"><br>
        <input type="submit" value="Küldés">
    </form>
    <?php
  }
?>


