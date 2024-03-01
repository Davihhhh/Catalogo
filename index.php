<?php
	if(isset($_SESSION['operatore']))
	{	}
	else
	{ header("location:login.html"); exit(); }
?>
<html>
	<head>
		<h1>Benvenuto nel database Catalogo<br> </h1> 
	</head>
	<body>
		<form action="riceca.php" method="POST">
            <input type="submit" name="filtrare" value="Filtra"/>
        </form>	
		<form action="aggiungi.php" method="POST">
            <input type="submit" name="aggiungere" value="Aggiungi"/>
        </form>		
	</body>	
</html>
<?php 	
	echo "<h1>Tabelle</h1>";
	echo "<h2>Case Produttrici</h2>";
	$sql = "SELECT * FROM case_produttrici";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) 
	{			
		echo "<table border=1 style=width:20%>";
		echo "<tr>";
		echo "<th>Nome</th>";
		echo "<th>Data_Fondazione</th>";
		echo "</tr>";
		$rows = mysqli_fetch_array($result);
		while($row = mysqli_fetch_array($result)) 
		{
			echo "<tr><td>". $row[0] . " </td><td> " . $row[1] . "</td></tr>";
		}
		echo "</table>";
	} 
	echo "<br><h2>Sedi</h2>";
	$sql = "SELECT * FROM sedi";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) 
	{
		echo "<table border=1 style=width:40%>";
		echo "<tr>";
		echo "<th>Id</th>";
		echo "<th>Nome</th>";
		echo "<th>Casa_Produttrice</th>";
		echo "<th>Indirizzo</th>";
		echo "</tr>";
		while($row = mysqli_fetch_array($result)) 
		{
			echo "<tr><td>". $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td></tr>";
		}
		echo "</table>";
	}
	echo "<br><h2>Dispositivi</h2>	";
	$sql = "SELECT * FROM dispositivi";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) 
	{
		echo "<table border=1 style=width:60%>";
		echo "<tr>";
		echo "<th>Id</th>";
		echo "<th>Nome</th>";
		echo "<th>Data_Rilascio</th>";
		echo "<th>Marca</th>";
		echo "<th>Modello</th>";
		echo "<th>Casa_Produttrice</th>";
		echo "</tr>";
		while($row = mysqli_fetch_array($result)) 
		{
			echo "<tr><td>". $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td></tr>";
		}
		echo "</table>";
	} 
	echo "<br><h2>Prodotti</h2>	";
	$sql = "SELECT * FROM prodotti";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) 
	{
		echo "<table border=1 style=width:20%>";
		echo "<tr>";
		echo "<th>Numero_Serie</th>";
		echo "<th>Dispositivo</th>";
		echo "</tr>";
		while($row = mysqli_fetch_array($result)) 
		{
			echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>";
		}
		echo "</table>";
	} 
	echo "<br><h2>Prodotto_Sede</h2>	";
	$sql = "SELECT * FROM prodotto_sede";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) 
	{
		echo "<table border=1 style=width:30%>";
		echo "<tr>";
		echo "<th>Id</th>";
		echo "<th>Prodotto</th>";
		echo "<th>Sede</th>";
		echo "</tr>";
		while($row = mysqli_fetch_array($result)) 
		{
			echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td></tr>";
		}
		echo "</table>";
	} 

    mysqli_close($conn);
?>
