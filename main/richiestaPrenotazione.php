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
                   $res=$connessione1->CheckSlotDisponibili();
                   $connessione1->closeDBConnection();
                }       
                while($row = $res->fetch_assoc()){
                    print "<option value=".$row["id"].">".$row["orario"]."  ". $row["room"]."</option>";
                }
                ?> 
            </select> 
            <label for="room">Stanze</label>
            <?php $selected = $_GET['room'];?>
            <select name='room' id='room'>
                <option value="1" <?php if($selected == '1'){echo("selected");}?>>Cripta arcana</option>
                <option value="2" <?php if($selected == '2'){echo("selected");}?>>Sabotaggio sul treno</option>
                <option value="3" <?php if($selected == '3'){echo("selected");}?>>Riavvio del reattore</option>
            </select>  
            <input type="submit" value="prenota">
        </fieldset>
        </form>

        

</body>
</html>


