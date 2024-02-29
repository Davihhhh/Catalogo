<?php
    session_start();

	$servername = "localhost";
	$username = $_POST['utente'];
	$password = $_POST['password'];
	$database = "catalogo";

	$conn = mysqli_connect($servername, $username, $password, $database);
	if (!$conn) {
      	die("Connessione fallita: " . mysqli_connect_error());
		header("location:index.html");
		unset($_SESSION);
		exit();
    }
    else 
    {
        $_SESSION['operatore'] = $username;
        $_SESSION['chiave'] = $password;
        $_SESSION['database'] = $database;
        $_SESSION['server'] = $servername;
        header("location:index.php");
    }
?>
