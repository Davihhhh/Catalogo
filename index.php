<?php 	
	session_start();
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$servername = "localhost";
		$username = "root";
		$password = "banana";
		$database = "catalogo";

		$utente = $_POST['utente'];
		$pswd = $_POST['password'];
		$_SESSION['operatore'] = $utente;
		try
		{
			$conn = mysqli_connect($servername, $username, $password, $database);

			if (!$conn) {
				die("Connessione fallita: " . mysqli_connect_error());
				header("location:index.html");
				unset($_SESSION);
				exit();
			}
			else {      
				$check_sql = "SELECT * FROM utenti WHERE Nome='$utente' AND Password='$pswd'";
				$result = mysqli_query($conn, $check_sql);
				
				if (mysqli_num_rows($result) > 0) {
					echo 	'<html>
								<head>
									<h1>Benvenuto nel database Catalogo<br> </h1> 
								</head>
								<body>
									<form action="ricerca.php" method="POST">
										<input type="submit" name="filtrare" value="filtra"/>
									</form>	
									<form action="aggiungi.php" method="POST">
										<input type="submit" name="aggiungere" value="aggiungi"/>
									</form>		
								</body>	
							</html>';

					$_SESSION['operatore'] = $utente;

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
				} 
				else {
					echo "Credenziali errate";
					echo '<br><a href="index.html">Torna alla pagina iniziale</a>';
				}
			}
		} catch (Exception $e) { echo "Servizio momentaneamente sospeso."; header("location:index.html"); }
	}
?>
