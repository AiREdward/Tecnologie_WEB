<?php 
require_once "utilities/ManagerLocalizzazione.php";

initial_setup();

$headertext=GetTesti("header");

$header_template='<a href="#content" class="SRskip" title="'.$headertext["skip"].'" aria-label="'.$headertext["skip"].'">'.$headertext["skip"].'</a>
	
	<header>
		<h1 class="logo"> escaperoom </h1>
		<button type="button" id="togglenav">'.$headertext["nav_toggle"].'</button>
		<nav>
			<MENU/>
		</nav>
		<LANGSWITCH/>
		<div class="breadcrumbs">
      		<p>'.$headertext["breadcrumb"].'  <span id="percorso"> <BREADCRUMB/> </span> </p>
      	</div>
    </header>';

$indirizzi_pagine=[];//nome->Indirizzo
$indirizzi_pagine["home"]="index.php";
$indirizzi_pagine["area_utente"]="area_utente.php";
$indirizzi_pagine["login"]="login.php";
$indirizzi_pagine["signup"]="signup.php";
$indirizzi_pagine["404"]="404.php";
$indirizzi_pagine["500"]="500.php";

$navmenu=["home","area_utente"];

$padre_pagina=[];//nome->nome genitore
$padre_pagina["home"]="#";
$padre_pagina["area_utente"]="home";
$padre_pagina["login"]="area_utente";
$padre_pagina["signup"]="area_utente";
$padre_pagina["404"]="#";
$padre_pagina["500"]="#";

$accesskeys=[]; //nome->key
$accesskeys["home"]="h";
$accesskeys["area_utente"]="u";
//$accesskeys["login"]="l";

function get_menu($pagina): string {
    global $navmenu, $indirizzi_pagine, $headertext, $accesskeys;

    $menu='<ul class="navmenu closednav" id="navmenu"> ';

    foreach ($navmenu as $menu_entry) {
        if ($menu_entry != $pagina) {
            $indirizzo = $indirizzi_pagine[$menu_entry];
            $key = $accesskeys[$menu_entry];
            /* if($menu_entry=="login"&&isset($_SESSION["user"]))
            {
                $menu_entry=$_SESSION["user"];
            } */
            $menu = $menu . '<li><a href="' . $indirizzo . '" accesskey="' . $key . '">' . $headertext[$menu_entry] . "</a></li> ";

        } else {
            $menu = $menu . '<li class="currentpage">' . $headertext[$menu_entry] . "</li> ";
        }
    }
    return $menu . '</ul>';
}

function get_breadcrumb($pagina) : string {
    global $headertext, $indirizzi_pagine, $padre_pagina;

    $breadcrumb = "<span id=current_page> " . $headertext[$pagina] . " </span> ";
    $genitore = $padre_pagina[$pagina];

    // genera breadcrumb nel formato genitore/figlio/...
    // Il ciclo termina quando raggiunge la radice
    while($genitore && ($genitore != "#")) {
        // aggiunge genitore/ a breadrumbs in formato figlio/.....
        $breadcrumb = '<a href="' . $indirizzi_pagine[$genitore] . '"> ' . $headertext[$genitore] . "</a> <span aria-hidden='true'> </span> " . $breadcrumb;
        $genitore = $padre_pagina[$genitore];
    }

    return $breadcrumb;
}

function get_language_switch($pagina) : string {
    global $headertext, $indirizzi_pagine;

    $lang_switch="";

    switch ($_SESSION["lang"]) {
        case "it":
            $lang_switch = "<a href='" . $indirizzi_pagine[$pagina] . "?lang=en' class='langswitch'>" . $headertext["lang_switch"] . "</a>";
            break;
        case "en":
            $lang_switch = "<a href='" . $indirizzi_pagine[$pagina] . "?lang=it' class='langswitch'>" . $headertext["lang_switch"] . "</a>";
            break;
    }

    return $lang_switch;
}

function genera_header($pagina){
	global $header_template;

    $menu = get_menu($pagina);
	$output = str_replace("<MENU/>", $menu, $header_template);

    $lang_switch = get_language_switch($pagina);
    $output= str_replace("<LANGSWITCH/>", $lang_switch, $output);

    $breadcrumb = get_breadcrumb($pagina);
	$output= str_replace("<BREADCRUMB/>",$breadcrumb,$output);

	return $output;
}
?>