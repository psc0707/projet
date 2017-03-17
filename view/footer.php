	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
<footer>
	<div class='footer'>
	    <div class='container'>
	        <div class='row'>
	          	<div class='col-md-12 text-center'>
					<h4>PSC &copy 2017 | Tous droits réservés<h4>
					<div style="display:flex;justify-content:space-around;">
						<?= "<h4> <a href={$socialLinks->facebook->shareUrl}>Facebook share</a> </h4>" ?>
						<?= "<h4> <a href={$socialLinks->twitter->shareUrl}>Twitter share</a> </h4>" ?>
						<?= "<h4> <a href={$socialLinks->linkedin->shareUrl}>Linkedin share</a> </h4>" ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
</html>