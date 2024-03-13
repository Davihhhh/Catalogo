<?php
    if(isset($_SESSION['operatore']))
    {}
    else 
    {
        header("location:login.html");
        exit();
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="catalogo.css">
    </head>
    <body>        
        <a href="index.php">Torna all'indice</a>
        <form method="POST">
            <select name="Catalogo" id="catalogo" required>
                <option value="dispositivi">Dispositivi</option>
                <option value="sedi">Sedi</option>
                <option value="case_produttrici">Case Produttrici</option>
                <option value="prodotti">Prodotti</option>
                <option value="prodotto_sede">Prodotto Sede</option>
            </select>
            <br>
            <label for="seleziona">Seleziona tabella</label>    
            <input type="submit" value="seleziona">       
        </form>
    </body>
</html>
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $servername = $_SESSION['server'];
        $username = $_SESSION['operatore'];
        $password = $_SESSION['chiave'];
        $database =$_SESSION['database'];

        $conn = new mysqli($servername, $username, $password, $dbname);
        $campi = array();
        if ($conn->connect_error) {
            die("Connessione fallita: " . $conn->connect_error);
        }
        else
        {
            if(isset($_POST['seleziona']))
            {
                $selectedTable = $_POST['catalogo'];

                $sql = "SELECT TOP 1 * FROM $selectedTable";
                
                if ($conn->query($sql) === TRUE) {
                    while ($fieldinfo = mysqli_fetch_field($result)) {
                        array_push($campi, $fieldinfo);
                    }
                }
                echo "<form method='POST'>";
                foreach ($campi as $campo) {
                    echo "<label for=$campo>$campo</label>";
                    echo "<input type='text' id='$campo' required>";
                }           
                echo "<input type='submit' value='aggiungi'>";       
                echo "</form>";    
            }
            if(isset($_POST['aggiungi']))
            {
                $selectedTable = $_POST['catalogo'];
                $valori = array();
                foreach ($campi as $campo) {
                    array_push($valori, $_POST[$campo]);
                }   
                if (count($campi) == count($valori)) {

                    $campi_string = implode(", ", $campi);                  
                    $valori_string = "'" . implode("', '", $valori) . "'";

                    $sql = "INSERT INTO $selectedTable ($campi_string) VALUES ($valori_string)";

                } else {
                    echo "Errore: completa tutti i campi.";
                }                 
            }
        }
        $conn->close();
    }
?>
