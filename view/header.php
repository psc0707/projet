<!DOCTYPE html>
<html>
<head>
	<title>Webforce3</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


	<div class='navbar navbar-default navbar-static-top'>
		<div class='container'>
			<div class="row">
				<div class="col-lg-8">
					<a href='index.php' class='navbar-brand'>Webforce3</a>
					<div style="margin-top: 7px;">
						<p><?= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "" ?></p>
						<!-- $_SESSION['REMOTE_ADDR'] $_SESSION['usr_ip'] -->
						<?php if (!isset($_SESSION['user_id'])) : ?>
							<a href="signin.php" class="btn btn-success btn-sm">Sign In</a>	
							<a href="signup.php" class="btn btn-success btn-sm">Sign Up</a><br>	
						<?php endif ?>
																		
						
					</div>
					<ul class='nav navbar-nav navbar-right'>
					<li><a href='index.php'>Home</a></li>
					<li><a href='index.php'>Toutes les sessions</a></li>
					<li><a href='list.php'>Tous les étudiants</a></li>
					<li><a href='add.php'>Ajout d'un étudiant</a></li>
					</ul>

				</div>
				<div class="col-lg-4">	
					<form action="list.php" method="get">
						<div style="display:flex;justify-content: space-around;margin-top: 7px">
						    <input type="text" name="s" class="form-control" placeholder="Search for..." />
						    <input type="hidden" name="toto" value="toto" />
						    <input type="submit" class="btn btn-success" value="Valider" />
						</div>
				    </form> 
				    
			      
				</div>
			</div>

		</div>
	</div>

</head>
<body>

