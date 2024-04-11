<?php 
require_once "utilities/ManagerLocalizzazione.php";

initial_setup();

$header_text = getTexts("header");

$header_template='<a href="#content" class="SRskip" title="'.$header_text["skip"].'" aria-label="'.$header_text["skip"].'">'.$header_text["skip"].'</a>
	
	<header>
		<h1 class="logo"> escaperoom </h1>
		<button type="button" id="togglenav">'.$header_text["nav_toggle"].'</button>
		<nav>
			<MENU/>
		</nav>
		<LANGSWITCH/>
		<div class="breadcrumbs">
      		<p>'.$header_text["breadcrumb"].'  <span id="percorso"> <BREADCRUMB/> </span> </p>
      	</div>
    </header>';

// Nome -> File
$indirizzi_pagine=[];
$indirizzi_pagine["home"] = "index.php";
$indirizzi_pagine["area_utente"] = "area_utente.php";
$indirizzi_pagine["admin"] = "admin.php";
$indirizzi_pagine["login"] = "login.php";
$indirizzi_pagine["signup"] = "signup.php";
$indirizzi_pagine["logout"] = "logout.php";
$indirizzi_pagine["prenota"] = "prenota.php";
$indirizzi_pagine["modifica_prenotazione"] = "modifica_prenotazione.php";
$indirizzi_pagine["crea_recensione"] = "crea_recensione.php";
$indirizzi_pagine["modifica_recensione"] = "modifica_recensione.php";
$indirizzi_pagine["amministrazione_stanza"] = "amministrazione_stanza.php";
$indirizzi_pagine["404"] = "404.php";
$indirizzi_pagine["500"] = "500.php";

// Pagine presenti nella navbar
$navmenu=["home","area_utente"];

// Nome -> Nome Genitore
$padre_pagina=[];
$padre_pagina["home"] = "#";
$padre_pagina["area_utente"] = "home";
$padre_pagina["admin"] = "home";
$padre_pagina["login"] = "area_utente";
$padre_pagina["signup"] = "area_utente";
$padre_pagina["logout"] = "area_utente";
$padre_pagina["prenota"] = "home";
$padre_pagina["modifica_prenotazione"] = "area_utente";
$padre_pagina["crea_recensione"] = "area_utente";
$padre_pagina["modifica_recensione"] = "area_utente";
$padre_pagina["amministrazione_stanza"] = "admin";
$padre_pagina["404"] = "#";
$padre_pagina["500"] = "#";

// Nome -> Key
$accesskeys=[];
$accesskeys["home"]="h";
$accesskeys["area_utente"]="u";
//$accesskeys["login"]="l";

function get_menu($pagina): string {
    global $navmenu, $indirizzi_pagine, $header_text, $accesskeys;

    $menu='<ul class="navmenu closednav" id="navmenu"> ';

    foreach ($navmenu as $menu_entry) {
        if ($menu_entry != $pagina) {
            $indirizzo = $indirizzi_pagine[$menu_entry];
            $key = $accesskeys[$menu_entry];
            $menu = $menu . '<li><a href="' . $indirizzo . '" accesskey="' . $key . '">' . $header_text[$menu_entry] . "</a></li> ";

        } else {
            $menu = $menu . '<li class="currentpage">' . $header_text[$menu_entry] . "</li> ";
        }
    }
    return $menu . '</ul>';
}

function get_breadcrumb($pagina): string {
    global $header_text, $indirizzi_pagine, $padre_pagina;

    $breadcrumb = "<span id=current_page> " . $header_text[$pagina] . " </span> ";
    $genitore = $padre_pagina[$pagina];

    // genera breadcrumb nel formato genitore/figlio/...
    // Il ciclo termina quando raggiunge la radice
    while($genitore && ($genitore != "#")) {
        // aggiunge genitore/ a breadrumbs in formato figlio/.....
        $breadcrumb = '<a href="' . $indirizzi_pagine[$genitore] . '"> ' . $header_text[$genitore] . "</a> <span aria-hidden='true'> </span> " . ' &gt;' . $breadcrumb;
        $genitore = $padre_pagina[$genitore];
    }

    return $breadcrumb;
}

function get_language_switch($pagina) : string {
    global $header_text, $indirizzi_pagine;

    $lang_switch="";

    switch ($_SESSION["lang"]) {
        case "it":
            $lang_switch = "<a href='" . $indirizzi_pagine[$pagina] . "?lang=en' class='langswitch'>" . $header_text["lang_switch"] . "</a>";
            break;
        case "en":
            $lang_switch = "<a href='" . $indirizzi_pagine[$pagina] . "?lang=it' class='langswitch'>" . $header_text["lang_switch"] . "</a>";
            break;
    }

    return $lang_switch;
}

function genera_header($pagina): array|string {
	global $header_template;

    $menu = get_menu($pagina);
	$output = str_replace("<MENU/>", $menu, $header_template);

    $lang_switch = get_language_switch($pagina);
    $output= str_replace("<LANGSWITCH/>", $lang_switch, $output);

    $breadcrumb = get_breadcrumb($pagina);
    return str_replace("<BREADCRUMB/>",$breadcrumb,$output);
}