<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    include(SERVER_ROOT . 'includes/user.inc.php');
    $usr = new user($_REQUEST['login'], $_REQUEST['last_name'], $first_name=$_REQUEST['first_name'], $_REQUEST['password']);
    $usr->RegistUser();
  }
  else{ ?>
    <form class="form-style-8" id="regform" onsubmit="return validateRegForm()" action="" method="post">
        <label for="login">Felhasználónév: </label><input type="text" name="login" id="login" required pattern="[a-zA-Z][\-\.a-zA-Z0-9_]{3}[\-\.a-zA-Z0-9_]+"><br>
        <label for="last_name">Vezetéknév: </label><input type="text" name="last_name" id="last_name" required><br>
        <label for="first_name">Keresztnév: </label><input type="text" name="first_name" id="first_name" required><br>
        <label for="password">Jelszó: </label><input type="password" name="password" id="password" required pattern="[\-\.a-zA-Z0-9_]{4}[\-\.a-zA-Z0-9_]+"><br>
        <label for="password2">Jelszó megerősítése: </label><input type="password" name="password2" id="password2" required pattern="[\-\.a-zA-Z0-9_]{4}[\-\.a-zA-Z0-9_]+"><br>
        <input type="submit" value="Küldés">
    </form>
    <?php
  }
?>

