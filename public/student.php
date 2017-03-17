<?php
// Inclusion de config.php
require dirname(dirname(__FILE__)).'/inc/config.php';

 // Récupération de données ou autres
// print_r($GLOBALS);
// echo($_GET['studentId']);

$detailStudent=sqlSearch($student,1);	


// echo '<PRE>';
// print_r($detailStudent);
// echo '</PRE>';

// A la fin, toujours les vues

include dirname(dirname(__FILE__)).'/view/header.php';
include dirname(dirname(__FILE__)).'/view/student.php';
include dirname(dirname(__FILE__)).'/view/footer.php';
