<?php

// Inclusion de config.php
require dirname(dirname(__FILE__)).'/inc/config.php';

// MON CODE ICI

if (!empty($_POST)) {
	// print_r($_POST);
	//print_r(SERVER_ADDR);
	$emailToto = isset($_POST['emailToto']) ? trim($_POST['emailToto']) :'';
	$passwordToto1 = isset($_POST['passwordToto1']) ? trim($_POST['passwordToto1']) :'';
			
// Si tout se passe , stockage de la session du user id	
	verifySignIn($emailToto,$passwordToto1);	
}


// A la fin (TOUJOURS) les vues
include dirname(dirname(__FILE__)).'/view/header.php';
include dirname(dirname(__FILE__)).'/view/signin.phtml';
include dirname(dirname(__FILE__)).'/view/footer.php';