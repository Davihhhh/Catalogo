<?php
	session_start();
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $servername = "localhost";
        $username = "basic";
        $password = "basic";
        $database = "catalogo";
        
        $conn = new mysqli($servername, $username, $password, $database);
        
        if ($conn->connect_error) {
            die("Connessione fallita: " . $conn->connect_error);
        }
        else if(isset($_POST['utentenew']) && isset($_POST['passwordnew'])) {
            $new_username = $_POST['utentenew'];
            $new_password = $_POST['passwordnew'];
        
            $check_sql = "SELECT * FROM mysql.user WHERE user='$new_username'";
            $result = mysqli_query($conn, $check_sql);
        
            if (mysqli_num_rows($result) > 0) {
                echo "Utente già esistente.";
                echo '<br><a href="index.html">Torna alla pagina iniziale</a>';
            } 
            else {
                $sql = "INSERT INTO users (username, password, admin) VALUES ('$new_username', '$new_password', 0)";
        
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
