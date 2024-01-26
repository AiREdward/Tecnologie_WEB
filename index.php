<?php 
	require_once "utilities/HeaderPagina.php";
    $hometext=GetTesti("home");
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"] ?>">
<head>
    <title></title>
    <meta charset="utf-8"/>
    <meta name="keywords" content="TODO"/>

    <meta name="description" content="TODO" />
    
	<meta name="author" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="css/style.css"/> 
    <link rel="stylesheet" href="css/print.css" media="print" />
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
</head>
<body>
<?php
	echo genera_header("home");
?>

<div id="content"></div>

</body>