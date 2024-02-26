<?php
	if(isset($_SESSION['user']))
	{	}
	else
	{ header("location:login.php"); exit(); }
?>
<html>
	<head>
		<h1>Benvenuto nel database Catalogo<br> </h1> 
	</head>
	<body>
		<h3>Indice</h3>
		<div class="btn-group">
			<form action="alltables.php" method="POST">
            	<input type="submit" name="tutte" value="Tutte le tabelle"/>
        	</form>
			<form action="case_produttrici.php" method="POST">
            	<input type="submit" name="case" value="Case Produttrici"/>
        	</form>
			<form action="sedi.php" method="POST">
            	<input type="submit" name="sedi" value="Sedi"/>
        	</form>
			<form action="dispositivi.php" method="POST">
            	<input type="submit" name="dispo" value="Dispositivi"/>
        	</form>
		</div>
	</body>	
</html>