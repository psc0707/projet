<PRE><?php

session_start();

print_r($_SESSION);

if ( isset($_GET['all']) && $_GET['all'] == 1) {	
	session_destroy();
	session_unset();
}
if ( isset($_GET['all']) && $_GET['all'] != 1) {	
	
	unset($_SESSION[$_GET['all']]);
	// session_destroy();
	// session_unset();
}

?></PRE>

<br>
<br>



