<?php
// J'initialise mes variables
$nom = '';
$prenom = '';
$email = '';
$birth = '';
$errorNom = '';
$errorPrenom = '';
$errorEmail = '';
$errorBirth ='';
$errorFriend ='';

// Formulaire soumis

if (!empty($_POST)) {;
	// print_r($_POST);
	echo '<br>';

	// Je récupère les données et les traite
	if (array_key_exists('nomSoumis', $_POST)) {
		$nom = strip_tags(strtoupper(trim($_POST['nomSoumis'])));
	}
	if (array_key_exists('prenomSoumis', $_POST)) {
		$prenom = strip_tags(trim($_POST['prenomSoumis']));
	}
	if (array_key_exists('emailSoumis', $_POST)) {
		$email = strip_tags(trim($_POST['emailSoumis']));
	}
	if (array_key_exists('birthSoumis', $_POST)) {
		$birth = strip_tags(trim($_POST['birthSoumis']));
	}
	if (array_key_exists('friendOpt', $_POST)) {
		$friendOpt = strip_tags(trim($_POST['friendOpt']));
	}
	if (array_key_exists('sessionOpt', $_POST)) {
		$sessionOpt = strip_tags(trim($_POST['sessionOpt']));
	}
	if (array_key_exists('villeOpt', $_POST)) {
		$villeOpt = strip_tags(trim($_POST['villeOpt']));
	}
	$formOk = true;

	// Vérifie si le nom est vide ou pas
	if (empty($nom)) {
		$errorNom = 'Le nom est vide<br>';
		$formOk = false;
	}
	// Vérifie que le nom fait 2 caractères au moins
	else if (strlen($nom) < 2) {
		$errorNom = 'Le nom doit comporter au moins 2 caractères<br>';
		$formOk = false;
	}
	// Vérifie si le prenom est vide ou pas
	if (empty($prenom)) {
		$errorPrenom = 'Le prénom est vide<br>';
		$formOk = false;
	}
	// Vérifie que le prénom fait 2 caractères au moins
	else if (strlen($prenom) < 2) {
		$errorPrenom = 'Le prénom doit comporter au moins 2 caractères<br>';
		$formOk = false;
	}
	// Vérification sur l'email
	if (empty($email)) {
		$errorEmail = 'L\'adresse email est vide<br>';
		$formOk = false;
	}
	else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$errorEmail = 'L\'adresse email est incorrecte<br>';
		$formOk = false;
	}
	if (empty($birth)) {
		$errorBirth = 'Date de naissance vide<br>';
		$formOk = false;
	}
	if ($formOk) {
		echo 'Nom: '.$nom.'<br>';
		echo 'Prénom: '.$prenom.'<br>';
		echo 'Email: '.$email.'<br>';
		echo 'Birth: '.$birth.'<br>';
		echo 'friendOpt: '.$friendOpt.'<br>';
		echo 'sessionOpt: '.$sessionOpt.'<br>';
		echo 'villeOpt: '.$villeOpt.'<br>';
		// print_r($_POST);
		
		// fonction addStudent  avec l id student nouvellement inséré
		$addedStudent = addStudent($sqlInsert,$nom,$prenom,$email,$birth,$friendOpt,$sessionOpt,$villeOpt);

		// Redirection vers student.php detail sur l'étudiant
		header("Location: student.php?studentId={$addedStudent}");
		exit;
		
	}
}
// ------------------------
// Upload
// ------------------------

// Si formulaire soumis
if (!empty($_POST)) {
	// Si des fichiers ont été uploadés
	if (!empty($_FILES)) {
		// Je récupère les données sur le fichier uploadé (input name="fileForm")		
		$currentFileUpload = $_FILES['fileForm'];
		$file_type_ok = (substr($currentFileUpload['name'], -4) != '.php') 
						&& ( (substr($currentFileUpload['name'], -4) == '.jpg')
						|| (substr($currentFileUpload['name'], -4) == '.jpeg')
						|| (substr($currentFileUpload['name'], -4) == '.gif')
						|| (substr($currentFileUpload['name'], -4) == '.svg')
						|| (substr($currentFileUpload['name'], -4) == '.ico')
						|| (substr($currentFileUpload['name'], -4) == '.png') );
		// Je vérifie l'extension PDF
		if ($file_type_ok) {
			// Je vérifie le type MIMR
			// echo $currentFileUpload['type'];
			if (($currentFileUpload['type'] == 'image/jpg')
				|| ($currentFileUpload['type'] == 'image/jpeg')	
				|| ($currentFileUpload['type'] == 'image/gif')	
				|| ($currentFileUpload['type'] == 'image/svg')	
				|| ($currentFileUpload['type'] == 'image/png')	
				|| ($currentFileUpload['type'] == 'image/x-icon'))
			 {
				// J'uploade le fichier (tmp -> files dir)
				if(move_uploaded_file($currentFileUpload['tmp_name'], dirname(dirname(__FILE__)).'/files/'.$_GET['studentId'].substr($currentFileUpload['name'], -4) )) {
					echo 'Upload réussi !!!!!!!!<br>';
					echo 'Size : '.$currentFileUpload['size'].'<br>';
					echo 'MIME Type : '.$currentFileUpload['type'].'<br>';
				}
				else {
					echo 'Bad news... upload failed<br>';
				}
			}
			else {
				echo 'Bad news... bad MIME type<br>';
			}
		}
		else {
			echo 'Bad news... bad extension<br>';
		}
	}
}

?>
<div class="container">
		<br>
	<div class="row">		
	  <div class="col-md-6">	
		<div class="panel panel-primary" style="max-width:400px;margin:auto;">
			<div class="panel-heading">
				<h3 class="panel-title">Student edit</h3>
			</div>

<!-- nom, prénom, date de naissance, email, sympathie, session (menu déroulant <select>) et ville (menu déroulant <select>)			 -->
			<div class="panel-body">			
				<form action="" method='post' enctype="multipart/form-data">
					<label>Nom</label><br>
					<input type="text" name="nomSoumis" class="form-control" placeholder="Nom" value="<?php echo $nom; ?>"><?php echo $errorNom; ?><br>

					<label>Prénom</label><br>
					<input type="text" name="prenomSoumis" class="form-control" placeholder="Prénom" value="<?php echo $prenom; ?>"><?php echo $errorPrenom; ?><br>

					<label>Né le</label><br>
					<input type="text" name="birthSoumis" class="form-control" placeholder="Né le" value="<?php echo $birth; ?>"><?php echo $errorBirth; ?><br>

					<label>Email</label><br>
					<input type="email" name="emailSoumis" class="form-control" placeholder="Email" value="<?php echo $email; ?>"><?php echo $errorEmail; ?><br>

					<label>Sympathie</label><br>
					<select name="friendOpt" class="selectpicker" data-live-search="true">
						<option value="1">1-Pas sympha</option>								  		 		  
						<option value="2"="">2-Moyennement Sympha</option>								  		 		  
						<option value="3"s="">3-Sympha</option>								  		 		  
						<option value="4"="">4-Très Sympha</option>								  		 		  
						<option value="5"s="">5-Très Sympha et aimable</option>								  		 		  
					</select>
					<br>
					<br>
					<label>Session</label><br>
					<select name="sessionOpt" class="selectpicker" data-live-search="true">
						<?php foreach ($listSession as $session): ?>				
					  		<?= "<option value={$session['ses_number']}> {$session['tra_name']} {$session['loc_name']} {$session['ses_number']} </option>"	?>							  		 		  
					  	<?php endforeach ?>	
					</select>
					<br>
					<br>
					<label>Ville</label><br>
					<select name="villeOpt" class="selectpicker" data-live-search="true">
						<?php foreach ($studentCity as $ville): ?>				
					  		<?= '<option value='.$ville['cit_id'].'>'.$ville['cit_name']. '</option>' ?>								  
					  	<?php endforeach ?>						
					</select>
					<br>
					<br>
					<input type="hidden" name="submitFile" value="1" />
					<label for="fileForm">Fichier</label>
					<input type="file" name="fileForm" id="fileForm" />
					<p class="help-block">les extensions jpg, jpeg, gif, svg, png, ico sont autorisées</p>
					<br />
						
					<input type="submit" class="btn btn-success" value="Update" />

				</form>

				<?php if (!empty($_GET['studentDel'])) : ?> 
					<a href="edit.php?studentDel=<?= $student['stu_id'] ?>" class='btn btn-success btn-sm'>Delete</a>
				<?php endif ?>

			</div>	
		</div>	
	  </div>	

	 
	</div>
</div>