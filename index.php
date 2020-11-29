<?php
   session_start();
   include("includes/sitedata.inc.php");

    if(! isset($_SESSION['nickname'])) $_SESSION['nickname'] = "Látogató";
    if(! isset($_SESSION['name'])) $_SESSION['name'] = "Atlag Joska";
    if(! isset($_SESSION['user_right'])) $_SESSION['user_right'] = "1";
    if(! isset($_SESSION['user_right_name'])) $_SESSION['user_right_name'] = "Visitor";

    include(SERVER_ROOT . 'includes/database.inc.php');
    include(SERVER_ROOT . 'includes/menu.inc.php');
    

    if (isset($_GET["pid"]))
	  $aktualis_oldal = $_GET["pid"];
	else
	  $aktualis_oldal = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Pályázatíró Kft.</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
    <script type="text/javascript" src="jQuery/jQuery.js"></script>
    <script type="text/javascript">
    function validateRegForm() {
        var user_jelszo = document.forms["regform"]["password"].value;
        var user_jelszo_meg = document.forms["regform"]["password2"].value; 
    
 
        if (user_jelszo_meg != user_jelszo ) {
            alert("A megadott jelszavak nem egyeznek");
            return false;
        }

    }
    function fnRights() {
    $.post(
        "user_query.php",
        {"op" : "Rights"},
        function(data) {
            $("<option>").val("0").text("Válasszon ...").appendTo("#UserRightSelect");
            var lista = data.lista;
            for(i=0; i<lista.length; i++)
                $("<option>").val(lista[i].id).text(lista[i].name).appendTo("#UserRightSelect");
        },
        "json"                                                    
    );
    }
    function felhasznalok() {
    $(".adat").html("");
    var JogosultsagID = $("#UserRightSelect").val();
    if (JogosultsagID != 0) {
        $.post(
            "user_query.php",
            {"op" : "info", "id" : JogosultsagID},
            function(data) {
              $('#adat th').remove();
              $('#adat tr').remove();
              var lista = data.lista
              var content = "<table> <tr><th>Jogosultság</th><th>Felhasználónév</th><th>Név</th></tr>"
                  for(i=0; i<lista.length; i++){
                      content += '<tr><td>'+lista[i].user_right+'</td><td>'+lista[i].nickname+'</td><td>'+lista[i].name+'</td></tr>';
                  }
              content += "</table>"
              $('#adat').append(content);
            },
            "json"                                                    
        );
    }
}

    function dobozKiBe() {
      var id  = $(this).attr("Id");
      var ssz = id.substr(3);
      $("#NewsBody" + ssz).slideToggle();
      if ($("#NewsBody" + ssz).css("display") == "none") {
        $(this).attr({
          src: "images/block-open.gif",
          title: "Teljes hír megtekintése"
        });
      } else {
        $(this).attr({
          src: "images/block-close.gif",
          title: "Összecsukás"
        });
      }
    }
    $(document).ready(function() {
      $(".NewsBody").css("display", "none");
      $(".kep").attr({
        src: "images/block-open.gif",
        title: "Teljes hír megtekintése"
      }).css("cursor", "pointer");
      $(".kep").click(dobozKiBe);
      fnRights();
      $("#UserRightSelect").change(felhasznalok);
    });
  </script>  
</head>
<body>
  <div id="upbar">  
      <div id="userinfo">
            <h2>Pályázatíró kft., a cég, amit Ön akkor keres, amikor a web2 beadandómat ellenőrzi<h2>
            <span> <?php echo "Üdvözöljük&nbsp".$_SESSION['nickname']."!<br>Jogosultsága : ".$_SESSION['user_right_name'];?></span>
      </div>	
	    <div class="main-navigation" id="menu">	
          <ul class="top-level-menu">	
		        <?php echo Menu::getMenu($aktualis_oldal); ?>
          </ul>
      </div>
  </div>

  <br>
    <div id="content">
        <?php		                     
			include(Menu::getPath($aktualis_oldal));			
		?>
    </div>
</body>
</html>