<?php
// Inclusion de config.php
require dirname(dirname(__FILE__)).'/inc/config.php';

 // Récupération de données ou autres
if (!empty($_GET['idSession'])) {
	$listStudents=sqlSearch($studentsListSessionId,2);
} else if ( array_key_exists('s', $_GET) && !empty($_GET['s']) ) {
		$searchInput = strip_tags(trim($_GET['s']));
		// echo '$searchInput ' .$searchInput;		
		$listStudents=searchStudent($searchInput);
} else
{
	$listStudents=sqlSearch($studentsList);
}

// A la fin, toujours les vues

include dirname(dirname(__FILE__)).'/view/header.php';
include dirname(dirname(__FILE__)).'/view/list.php';
include dirname(dirname(__FILE__)).'/view/footer.php';