<?php

function verifySignUp ($emailToto,$passwordToto1,$passwordToto2) {
	global $errorList, $pdo;
	$errorList = array();

	if (empty($emailToto)) {
		$errorList [] = 'Email vide <br>';		
	} else if (filter_var($emailToto, FILTER_VALIDATE_EMAIL) === false) {
		$errorList [] = 'Format email incorrect <br>';
	}

	if (strlen($passwordToto1) == 0 ) {
		$errorList [] = 'Paswword 1 vide <br>';		
	} else {
		if (strlen($passwordToto1) < 3 ) {
			$errorList [] = 'Paswword < 3 caractères <br>';		
		}
		// print_r(preg_match("[0-9]", $passwordToto1));
		if (preg_match("[0-9]", $passwordToto1, $match)) {
      		$errorList [] = 'Paswword contenant au moins un chiffre <br>';	
		}

	}

	if (strlen($passwordToto2) == 0 ) {
		$errorList [] = 'Paswword 2 vide <br>';		
	}

	
	if ($passwordToto1 != $passwordToto2) {
		$errorList [] = 'Les 2 mots de pass sont différents <br>';		
	}


	// var_dump ($errorList);

	if (empty($errorList)) {

		$sql ='SELECT usr_id
			FROM  user 
			WHERE usr_email = :email
		';

		$pdoStatement = $pdo->prepare($sql);
		// print_r($pdoStatement);

		$pdoStatement->bindValue(':email', $emailToto);		

		if ($pdoStatement->execute() === false) {
			echo 'Error<br>';
			print_r($pdo->errorInfo());
			$errorList [] = 'Error pdo execute select <br>';
		}
		else {
			// echo '$pdoStatement->rowCount() '.$pdoStatement->rowCount() ;
			if ( ($pdoStatement->rowCount() == 0) ) {

				$sql ='INSERT INTO user (`usr_email`, `usr_password`,`usr_date_creation`)
						   VALUES (:email, :password, NOW())
					';
					$pdoStatement = $pdo->prepare($sql);
					// print_r($pdoStatement);

					$pdoStatement->bindValue(':email', $emailToto);
					$pdoStatement->bindValue(':password', password_hash($passwordToto1,PASSWORD_BCRYPT));

					if ($pdoStatement->execute() === false) {
						echo 'Error<br>';
						print_r($pdo->errorInfo());
						$errorList [] = 'Error pdo execute insert <br>';
					}
					else {
						echo 'signup OK <br>';		
					}
				
			} else
			{
				$errorList [] = 'Email existe :   <br>';
			}

		}
	}

// // Aucune erreur détectée
// 	if (empty($errorList)) {
// 		return true;
// 	} else {
// // Erreur détectée		
// 		return false;
// 	}
		
}

function verifySignIn ($emailToto,$passwordToto1) {
	global $errorList, $pdo;

	$errorList = array();

	if (empty($emailToto)) {
		$errorList [] = 'Email vide <br>';		
	}		
	
	if (empty($passwordToto1)) {
		$errorList [] = 'Password vide <br>';		
	}	

	// var_dump ($errorList);

	if (empty($errorList)) {
		$sql ='SELECT `usr_id`, `usr_email`, `usr_password`, `usr_role`
			   FROM user
			   WHERE usr_email = :email
		';
		$pdoStatement = $pdo->prepare($sql);
		// print_r($pdoStatement);

		$pdoStatement->bindValue(':email', $emailToto);		

		if ($pdoStatement->execute() === false) {
			print_r($pdo->errorInfo());
			$errorList [] = 'Error pdo execute <br>';	
		}
		else {
			if ($pdoStatement->rowCount() > 0) {

				$row = $pdoStatement->fetch(PDO::FETCH_ASSOC);
				
				if ( password_verify($passwordToto1,$row['usr_password']) ) {
					echo 'Signin OK <br>';			
					$_SESSION['user_id']   = $row['usr_id'];
					$_SESSION['usr_email'] = $row['usr_email'];
					$_SESSION['usr_role']  = $row['usr_role'];
					$_SESSION['user_ip']   = $_SERVER['SERVER_ADDR'];
					unset($row['usr_password']);
					$_SESSION['user']   = $row;
					// print_r($_SERVER);	
					// echo '<pre>',print_r($_SESSION),'</pre>';
				} else
				{
					// echo 'Mot de passe/email inconnu <br>';
					$errorList [] = 'password/email inconnu <br>';	
				}
			} else {
					$errorList [] = 'email inconnu <br>';	
			}
		}
	}
// // Aucune erreur détectée
// 	if (empty($errorList)) {
// 		return true;
// 	} else {
// // Erreur détectée		
// 		return false;
// 	}		
}