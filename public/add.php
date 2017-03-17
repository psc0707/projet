<?php
// Inclusion de config.php
require dirname(dirname(__FILE__)).'/inc/config.php';

 // Récupération de données ou autres

$listSession=sqlSearch($sessionList);
$studentCity=sqlSearch($cityStudent);
// echo '<PRE>';
// print_r($listSession);
// echo '</PRE>';

// A la fin, toujours les vues

include dirname(dirname(__FILE__)).'/view/header.php';
include dirname(dirname(__FILE__)).'/view/add.php';
include dirname(dirname(__FILE__)).'/view/footer.php';