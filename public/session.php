<PRE><?php
/*
EXERCICE 2
----------------------
- à partir du formulaire fourni, et dans un nouveau fichier PHP, ajouter une ligne dans le tableau $_SESSION avec clé et valeur
- afficher le contenu du tableau $_SESSION (sans print_r, ni var_dump)
- afficher l'identifiant de session (voir la doc)
*/
session_start();

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




/*
EXERCICE++
----------------------
- permettre à l'utilisateur de supprimer une ligne du tableau $_SESSION (qu'il choisit, passer la clé en GET par exemple)

EXERCICE-extra
----------------------
- pour chaque variable en session, créer automatiquement sa variable globale
	=> $_SESSION['toto'] = 45;
		=> donne l'équivalent de : $toto = 45;
*/


?></PRE>
<form action="" method="post">
	<fieldset>
		<legend>Play with PHP Session</legend>
		<input type="text" name="key" value="" placeholder="Clé tableau session" /><br />
		<input type="text" name="value" value="" placeholder="Valeur tableau session" /><br />
		<input type="submit" value="Add to $_SESSION" />
	</fieldset>
</form>