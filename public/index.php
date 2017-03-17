<?php
// Inclusion de config.php
require dirname(dirname(__FILE__)).'/inc/config.php';

 // Récupération de données ou autres

$listSession=sqlSearch($sessionList);

$arraySession = [];

foreach ($listSession as $key => $sessions) {
				
	$arraySessions [$sessions['loc_name']][] = [
					 'sessionId'=> $sessions['ses_number'],	
					 'traName'	=> $sessions['tra_name'],
					 'startDate'=> $sessions['ses_start_date'],
					 'endDate'	=> $sessions['ses_end_date']
					];						

}	

$list_student_city = student_city();

// A la fin, toujours les vues

include dirname(dirname(__FILE__)).'/view/header.php';
include dirname(dirname(__FILE__)).'/view/home.php';
include dirname(dirname(__FILE__)).'/view/footer.php';