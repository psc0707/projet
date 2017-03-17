<?php
// Inclusion de config.php
require dirname(dirname(__FILE__)).'/inc/config.php';

 // Récupération de données ou autres
if (!empty($_GET['studentId'])) {

	$detailStudent=sqlSearch($student,1);	
}


// A la fin, toujours les vues

include dirname(dirname(__FILE__)).'/view/header.php';
include dirname(dirname(__FILE__)).'/view/edit.php';
include dirname(dirname(__FILE__)).'/view/footer.php';