<?php
// echo '<PRE>';
// print_r($listStudents);
// echo '</PRE>';
if (!empty($_GET['page'])) {
	$noPage = $_GET['page'];	
} else
{
	$noPage = 1;	
}

?>

<div class='container'>
	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading lead">Liste des etudiants Webforce3</div>
	  <div class="panel-body lead">	    	
	  	<?php if ( !empty($_GET['idSession']) && !empty($listStudents) ) : ?>
			<?= "<h4>Etudiants pour la session n° {$_GET['idSession']} : {$listStudents[0]['tra_name']} à {$listStudents[0]['loc_name']}</h4>
			" ?>
		<?php else : ?>			
			<!-- Aucun etudiant trouvé pour la session en question -->
			<?php if (!empty($_GET['idSession'])) : ?>
				<?= "<h4>Aucun étudiant pour la session n° {$_GET['idSession']}"; ?>
			<?php endif ?>
		<?php endif ?>
	  </div>

	  <!-- Table -->
	  <table class="table">
		<thead>
	      <tr>
	        <th>Identifiant</th>
	        <th>Nom</th>
	        <th>Prénom</th>
	        <th>Email</th>
	        <th>Date de naissance</th>
	      </tr>
	    </thead>
	    <tbody>
			<?php foreach ($listStudents as $key => $student): ?>
			    <tr>	
			   		<!-- Save du studentId -->
			    	<?php $studentId = $student['stu_id'] ?> 
			        <td><?= $student['stu_id'] ?>  <?php echo "<a href='student.php?studentId={$student['stu_id']}'>Détail</a></td>" ?>			        
			        <td><?= $student['stu_lastname'] ?></td>
			        <td><?= $student['stu_firstname'] ?></td>
			        <td><?= $student['stu_birthdate'] ?></td>
			        <td><?= $student['stu_email'] ?></td>				        
			        <td>
			        		<a href="edit.php?studentDel=<?= $student['stu_id'] ?>" class='btn btn-success btn-sm'>Delete</a>
			        </td>
			    </tr>	    
			<?php endforeach ?> 
			<?php if ($noPage > 1) : ?>								
				<a href="list.php?page=<?= $noPage-1 ?>" class='btn btn-success btn-sm'>Previous</a>
			<?php endif ?> 
			<span> </span>
			<!-- Button next s'il y a encore des etudiants && supérieure à 1-->
			<?php if (!empty($listStudents)&& count($listStudents)>1) : ?>								
				<a href="list.php?page=<?= $noPage+1 ?>" class='btn btn-success btn-sm'>Next........</a>
			<?php endif ?> 

	    </tbody>


	  </table>
	</div>
</div>