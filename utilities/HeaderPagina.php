<?php 
require_once "utilities/ManagerLocalizzazione.php";

initial_setup();

$headertext=GetTesti("header");

$template='<a href="#content" class="SRskip" title="'.$headertext["skip"].'" aria-label="'.$headertext["skip"].'">'.$headertext["skip"].'</a>
	<header>
            <h1 class="logo"> escaperoom </h1>
            <nav>
                        <MENU/>
            </nav>
      </header>
      <div class="breadcrumbs">
      	<p>'.$headertext["breadcrumb"].'  <span id="percorso"><BREADCRUMB/> </span></p>
      </div>';

$indirizzi_pagine=[];//nome->Indirizzo
$indirizzi_pagine["home"]="index.php";
$indirizzi_pagine["area_utente"]="area_utente.php";
$indirizzi_pagine["login"]="login.php";
$indirizzi_pagine["404"]="404.php";
$indirizzi_pagine["500"]="500.php";

$navmenu=["home","area_utente"];

$padre_pagina=[];//nome->nome genitore
$padre_pagina["home"]="#";
$padre_pagina["area_utente"]="home";
$padre_pagina["login"]="area_utente";
$padre_pagina["404"]="#";
$padre_pagina["500"]="#";

$accesskeys=[]; //nome->key
$accesskeys["home"]="h";
$accesskeys["area_utente"]="u";
$accesskeys["login"]="l";

function genera_header($pagina){
	global $template, $indirizzi_pagine, $navmenu, $padre_pagina,$headertext, $accesskeys;
	$menu='<ul class="navmenu">';
	foreach ($navmenu as $menuentry) {
      	if ($menuentry != $pagina) {
			$indirizzo=$indirizzi_pagine[$menuentry];
            $key=$accesskeys[$menuentry];
			/* if($menuentry=="login"&&isset($_SESSION["user"]))
			{
				$menuentry=$_SESSION["user"];
			} */
			$menu = $menu . '<li><a href="' . $indirizzo . '" accesskey="' . $key . '">' . $headertext[$menuentry] . "</a></li>";
			
        } else {
            $menu = $menu . '<li class="currentpage">' . $headertext[$menuentry] . "</li>";
        }
    }
	$menu=$menu.'</ul>';
	$output= str_replace("<MENU/>",$menu,$template);
	$breadcrumb="";
	$genitore=null;

    $breadcrumb="<span id=current_page>" . $headertext[$pagina] . "</span>";
    $genitore = $padre_pagina[$pagina];

	// genera breadcrumb nel formato genitore/figlio/.....		
	while($genitore&&$genitore!="#"){//verifica il raggiungimento della radice
		// aggiunge genitore/ a breadrumbs in formato figlio/.....
		$breadcrumb = '<a href="' . $indirizzi_pagine[$genitore] . '">' . $headertext[$genitore] . "</a> <span aria-hidden='true'> </span>" . $breadcrumb;
		$genitore = $padre_pagina[$genitore];
	}
	$output= str_replace("<MENU/>",$menu,$template);
	$output= str_replace("<BREADCRUMB/>",$breadcrumb,$output);
	return $output;
}
?>