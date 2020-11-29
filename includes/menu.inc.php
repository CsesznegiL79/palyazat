<?php

Class Menu {    
    public static function getMenu($sItems) 
    {   
        //$class = "UpperMenu";
        $upper_menu = "";     
        $connection = Database::getConnection();
        $stmt = $connection->query(
            "select menu_page_id, pid, page_url, name, user_right from menu_pages where user_right <= ".$_SESSION['user_right']." order by ordered");

        while($menuitem = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //Ha pid oszlopban # van akkor biztos, hogy vannak leszármazottjai
            if($menuitem['pid'] == "#")
            {
                $upper_menu = $upper_menu.'<li>'.$menuitem['name']; 
                //Lekérdezzük és végig megyünk a leszármazottjain is!
                $stmtsub = $connection->query(
                    "select menu_subpage_id,  parent, pid, page_url, name, user_right from menu_subpages where parent = ".$menuitem['menu_page_id']." and user_right <= ".$_SESSION['user_right']." order by ordered");
                $upper_menu = $upper_menu."<ul class='second-level-menu'>";
                while($submenuitem = $stmtsub->fetch(PDO::FETCH_ASSOC)) {
                    if($_SESSION["user_right"] == 1 && $submenuitem['pid'] == 3) continue;
                    if(($_SESSION["user_right"] == 2 || $_SESSION["user_right"] == 3) && ($submenuitem['pid'] == 2 || $submenuitem['pid'] == 6)) continue;
                    //if($sItems == $submenuitem['pid']){$class = "UpperMenuSelected";}else{$class = "UpperMenu";}
                    $upper_menu = $upper_menu."<li><a href='?pid=".$submenuitem['pid']."'>".$submenuitem['name']."</a></li>";                 
                }
                $upper_menu = $upper_menu."</ul>";                
            }
            //Nincsenek leszármazottjai, csak linkek
            else
            {
                //if($sItems == $menuitem['pid']){$class = "UpperMenuSelected";}else{$class = "UpperMenu";}
                $upper_menu = $upper_menu."<li><a href='?pid=".$menuitem['pid']."'>".$menuitem['name']."</a></li>"; 
            }            
        }        
        return $upper_menu;
    }
    public static function getPath($pid)
    {   
        $path = "";
        $connection = Database::getConnection();
        $stmt = $connection->query(
            "select pid, page_url from menu_pages where pid='". $pid ."' union select pid, page_url from menu_subpages where pid='". $pid ."'");
        
        if($item = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $path = SERVER_ROOT."contents/".$item['page_url'].".php";
            if(!file_exists($path))
                $path = SERVER_ROOT."contents/404.php"; 
        }
        else
        {
            $path = SERVER_ROOT."contents/404.php"; 
        }
        return $path;
    }
}
?>