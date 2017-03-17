<!-- <?php
	echo '<PRE>';
	print_r($detailStudent);
	echo '</PRE>';
?>  -->
<div class="container">
	<div class="row well">

		<?php foreach ($detailStudent as $student): ?>
			<a href="edit.php?studentId=<?= $student['stu_id'] ?>" class='btn btn-success btn-sm'>Update</a>
			<p><strong>Identifiant :</strong><?= $student['stu_id'] ?></p>
			<p><strong>Nom : </strong><?= $student['stu_lastname'] ?></p>
	        <p><strong>Prénom </strong><?= $student['stu_firstname'] ?></p>
	        <p><strong>Né le :</strong><?= $student['stu_birthdate'] ?></p>
	        <p><strong>Email :</strong><?= $student['stu_email'] ?></p>		
	        <p><strong>Age :</strong><?= $student['age'] ?></p>		
	        <p><strong>Friendliness :</strong><?= $student['stu_friendliness'] ?></p>		
	        <p><strong>Session :</strong><?= $student['session_ses_id'] ?></p>		
	        <p><strong>Nom de session :</strong><?= $student['tra_name'] ?></p>		
	        <p><strong>Ville :</strong><?= $student['cit_name'] ?></p>			        
		<?php endforeach ?>
	</div>
	
</div>