<?php
    require_once "utilities/HeadPagina.php";
	require_once "utilities/HeaderPagina.php";
    require_once "utilities/DBConnection.php";

                
?>


<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <?php echo get_head(); ?>
</head>
<body>
<?php    echo "<a href=prenotazione.php?room=".$_GET['room'].">";     ?>
  <?php echo genera_header("home"); ?>
  <form id='form' action='prenotazione.php' method="post"> 
        <fieldset>
            <label><span lang="en">Username</span></label>
            <span><input id="username" name="username" type="text" /></span>
            <br>
            <label>Password</label>
            <span><input id="password" name="password" type="password" /></span>
            <br>
            <label for="slot">Slot pretotabili</label>
            <select name="slot" id="slot">
            <?php
                $stanza = $_GET['room'];
                $connessione1 = new Connection();
                $connOK = $connessione1->apriConnessione();
                if(!$connOK) {    
                    return "errore_connessione";
                }else{
                   $res=$connessione1->CheckSlotDisponibili($stanza);
                   $connessione1->closeDBConnection();
                }       
                while($row = $res->fetch_assoc()){
                    print "<option value=".$row["id"].">".$row["giorno_settimana"]."  ". $row["orario"]."</option>";
                }
                ?> 
            </select>   
            <input type="submit" value="prenota">   </a>
        </fieldset>
        </form>

        

</body>
</html>
