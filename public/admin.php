<PRE><?php


print_r($_SESSION);

if (!empty($_POST)) {
	
	$key   = isset($_POST['key']) ? trim($_POST['key']) :'';
	$value = isset($_POST['value']) ? trim($_POST['value']) :'';
	
	if (strlen($key) > 0)  {
		
		echo session_id().'<br>';

		$_SESSION[$key] = $value.'/'.session_id().'/'.$_COOKIE["PHPSESSID"];

		foreach ($_SESSION as $key => $session) {
			echo "<a href=session_delete.php?all=$key>$key $session</a><br>";
		}
	}
}






?></PRE>