<?php
	session_start();
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $servername = "localhost";
        $username = "root";
        $password = "banana";
        $database = "catalogo";
        
		$conn = mysqli_connect($servername, $username, $password, $database);
        
        if (!$conn) {
			die("Connessione fallita: " . mysqli_connect_error());
			header("location:index.html");
			unset($_SESSION);
			exit();
		}
        else if(isset($_POST['utentenew']) && isset($_POST['passwordnew'])) {
            $new_username = $_POST['utentenew'];
            $new_password = $_POST['passwordnew'];
            $now = date("Y-m-d H:i:s");
            $check_sql = "SELECT * FROM utenti WHERE Nome='$new_username'";
            $result = mysqli_query($conn, $check_sql);
        
            if (mysqli_num_rows($result) > 0) {
                echo "Utente già esistente.";
                echo '<br><a href="index.html">Torna alla pagina iniziale</a>';
            } 
            else {
                $sql = "INSERT INTO utenti (Nome, Password, Data_Creazione) VALUES ('$new_username', '$new_password', '$now')";
        
                if ($conn->query($sql) === TRUE) {
                    echo "Registrazione effettuata con successo.<br>";
                    echo '<a href="index.html">Torna alla pagina di login</a>';
                } else {
                    echo "Errore durante la registrazione: " . $conn->error;
                }
            }
        }
        
        $conn->close();
    }
?>
