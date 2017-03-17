<!-- <?php
	echo '<PRE>';
	print_r($listSession);
	echo '</PRE>';
?> -->
<!-- * mettre un lien sur les noms, dates et lieux dans sessions. Ce lien renvoit sur list.php pour afficher les étudiants de cette session uniquement (filtre) -->
<div class="container">
	<div class="row well">
		<!-- Tableau des cessions/city -->
		<table class="table">					   
		    <tbody>	   
					<?php foreach ($arraySessions as $key => $sessionList): ?>	
					<tr>				
									<?= "<td><strong> Lieu : {$key} </strong></td>" ?>
				 					<?php foreach ($sessionList as $session): ?>								
									<tr>
										<?= "<td><strong><a href=list.php?idSession={$session['sessionId']}>Formation :</a></strong> {$session['traName']} </td>" ?>						
								        <?= "<td><strong><a href=list.php?idSession={$session['sessionId']}>Début :</a></strong> {$session['startDate']} </td>" ?>						
								        <?= "<td><strong><a href=list.php?idSession={$session['sessionId']}>Fin :</a></strong> {$session['endDate']} </td>" ?>
								    </tr>						      
						   			<?php endforeach ?> 
								
					</tr>					
					<?php endforeach ?> 			
			</tbody>
		</table>
		<!-- Tableau des student/city -->
		<table class="table">			
			<thead>
		      <tr>
		        <th>Ville</th>
		        <th>Nombre d'étudiant(s)</th>
		      </tr>
		    </thead>		   
		    <tbody>	   
				<?php foreach ($list_student_city as $studentCity): ?>					
					<tr>
					<?= "<td>{$studentCity['cit_name']}</td>"  ?>		
					<?= "<td>{$studentCity['nbStudent']}</td>" ?>		
					</tr>
				<?php endforeach ?> 
			</tbody>
		</table>		

	</div>
	
</div>