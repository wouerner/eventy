<?php

require 'config/banco.php';
require 'config/iniset.php';

function __autoload($nomeClasse){

	$nomeClasse = str_replace('\\','/',$nomeClasse);
	require_once $nomeClasse.'.php';


}

?> 
