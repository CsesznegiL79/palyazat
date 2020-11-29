<?php
    session_destroy();
    $_SESSION['nickname'] = "Látogató";
    $_SESSION['name'] = "John Doe";
    $_SESSION['user_right'] = "1";
    $_SESSION['user_right_name'] = "Visitor";
    header('Location: index.php');
    echo 'A kijelentkezés sikeres';

?>