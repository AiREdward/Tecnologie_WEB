<?php 
if(!isset($_SESSION)){
	session_start();
}
$template='<a href="#content" class="SRskip" title="salta al contenuto" aria-label="salta al contenuto">Salta al contenuto</a>
	<header>
            <h1 class="logo"> escaperoom </h1>
            <nav>
                        <MENU/>
            </nav>
      </header>
      <div class="breadcrumbs">
      	<p> Ti trovi in: <span id="percorso"><BREADCRUMB/> </span></p>
      </div>';

$indirizzi_pagine=[];//nome->Indirizzo
$indirizzi_pagine["home"]="index.php";
$indirizzi_pagine["404"]="404.php";
$indirizzi_pagine["500"]="500.php";


$navmenu=["home","prenota"];

$padre_pagina=[];//nome->nome genitore
$padre_pagina["home"]="#";
$padre_pagina["404"]="#";
$padre_pagina["500"]="#";

$accesskeys=[]//nome->key
$accesskeys["home"]="h";

function genera_header($pagina){
	global $template, $indirizzi_pagine, $navmenu, $padre_pagina;
	$menu='<ul class="navmenu">';
	foreach ($navmenu as $menuentry) {
      	if ($menuentry != $pagina) {
			$indirizzo=$indirizzi_pagine[$menuentry];
            $key=$accesskeys[$menuentry]
			/* if($menuentry=="login"&&isset($_SESSION["user"]))
			{
				$menuentry=$_SESSION["user"];
			} */
			$menu = $menu . '<li><a class="first_letter_underlined" href="' . $indirizzo . '" accesskey="' . $key . '">' . $menuentry . "</a></li>";
			
        } else {
            $menu = $menu . '<li class="menu_name first_letter_underlined">' . $menuentry . "</li>";
        }
    }
	$menu=$menu.'</ul>';
	$output= str_replace("<MENU/>",$menu,$template);
	$breadcrumb="";
	$genitore=null;

    $breadcrumb="<span id=current_page>" . $pagina . "</span>";
    $genitore = $padre_pagina[$pagina];

	// genera breadcrumb nel formato genitore/figlio/.....		
	while($genitore&&$genitore!="#"){//verifica il raggiungimento della radice
		// aggiunge genitore/ a breadrumbs in formato figlio/.....
		$breadcrumb = '<a href="' . $indirizzi_pagine[$genitore] . '">' . $genitore . "</a> <span aria-hidden='true'> </span>" . $breadcrumb;
		$genitore = $padre_pagina[$genitore];
	}
	$output= str_replace("<MENU/>",$menu,$template);
	$output= str_replace("<BREADCRUMB/>",$breadcrumb,$output);
	return $output;
}
?>