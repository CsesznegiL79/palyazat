<?php
 class user{
     private $nickname;
     private $last_name;
     private $first_name;
     private $password;
     private $password_hash;

     public function __construct($nickname, $last_name, $first_name, $password){
            $this->nickname = $nickname;
            $this->last_name = $last_name;
            $this->first_name = $first_name;
            $this->password = $password;
            $this->password_hash = hash('ripemd160', $password);
     }
     public function RegistUser(){
        $sql = "INSERT INTO users (nickname, first_name, last_name, password, user_right) VALUES ('$this->nickname', '$this->first_name','$this->last_name', '$this->password_hash', 2)";
        $connection = Database::getConnection();
        try{    
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $stmt = null;
                $_SESSION['nickname'] = $this->nickname;
                $_SESSION['name'] = $this->last_name." ".$this->first_name;
                $_SESSION['user_right'] = "2";
                $_SESSION['user_right_name'] ="Registered user";
                header('Location: index.php');
        }
        catch(Exception $e){
            echo 'A felhasználó regisztrációja sikertelen<br>';
        }
    }
    public static function LoginUser($nickname, $password){
        $password_hash = hash('ripemd160', $password);
        $connection = Database::getConnection();
        $stmt = $connection->query(
            "select users.nickname, users.first_name, users.last_name, users.password, users.user_right, user_rights.name from users inner join user_rights on users.user_right = user_rights.user_right_id where nickname = '".$nickname."' and password = '". $password_hash. "';");

        if($users = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['nickname'] = $users["nickname"];
            $_SESSION['name'] = $users["last_name"]." ".$users["first_name"];
            $_SESSION['user_right'] = $users["user_right"];
            $_SESSION['user_right_name'] = $users["name"];
            header('Location: index.php');
        }
        else{
            echo 'Hibás felhasználónév vagy jelszó';
        }

    }

 }
?>