<?php
include("RESTserver.php");
    echo '<div class="newsClass" id="news">';
    if($_SESSION['user_right'] > 1){
        echo '    <form class="form-style-8" action="" method="POST">
        <label for="newstitle">Hír címe:</label><input type="text" name="newstitle" id="newstitle" required><br>
        <label for="newstext">Hír szövege:</label><textarea id="newstext" name="newstext" cols="40" rows="5" required></textarea><br>
        <input type="submit" value="Küldés">
    </form>';
    }
    $connection = Database::getConnection();
    $stmt = $connection->query(
    "select news_id, news, title, nickname, created_time from news order by created_time desc");

    while($newsitem = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="SubNewsClass" id="News'.$newsitem["news_id"].'">';
            echo '<div class="NewsTitle" id="NewsTitle'.$newsitem["news_id"].'">';
                echo '<img src="images/block-close.gif" class="kep" id="kep'.$newsitem["news_id"].'" title="Kép nem található">';
                echo  "<span>".$newsitem["title"]."</span><br>";
                echo '<span>'. $newsitem["nickname"]." ".$newsitem["created_time"] .'</span>';
            echo '</div>';
            echo '<div class="NewsBody" id="NewsBody'.$newsitem["news_id"].'">';
                echo "<span>".$newsitem["news"] .'</span>';
            echo '</div>';
        echo '</div>';
    }
    echo '</div>';
?>