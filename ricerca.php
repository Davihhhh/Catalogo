<html>
    <head>
        <style>
            * {box-sizing: border-box;}

            body {
                margin: 0;
                font-family: Arial, Helvetica, sans-serif;
                }

            .topnav {
                overflow: hidden;
                background-color: #e9e9e9;
                }

            .topnav a {
                float: left;
                display: block;
                color: black;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 17px;
                }

            .topnav a:hover {
                background-color: #ddd;
                color: black;
                }

            .topnav a.active {
                background-color: #2196F3;
                color: white;
                }

            .topnav input[type=text] {
                float: right;
                padding: 6px;
                margin-top: 8px;
                margin-right: 16px;
                border: none;
                font-size: 17px;
                }

            .topnav input[type=text] {
                    border: 1px solid #ccc;  
                }
        </style>
    </head>
    <body>        
        <form method="POST">
            <select name="Catalogo" id="catalogo">
                <option value="dispositivi">Dispositivi</option>
                <option value="sedi">Sedi</option>
                <option value="case_produttrici">Case Produttrici</option>
                <option value="prodotti">Prodotti</option>
                <option value="prodotto_sede">Prodotto Sede</option>
            </select>
            <label for="cerca">Cerca qualcosa...</label>
            <input type="text" id="cerca">
        </form>
    </body>
</html>
<?php
    if(isset($_SESSION["UTENTE"]) || isset($_SESSION["filtra"]))
    {}
    else 
    {
        header("location:login.html");
        exit();
    }
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $database = "catalogo";

        $conn = mysqli_connect($servername, $username, $password, $database);
        if (!$conn) {
        die("Connessione fallita: " . mysqli_connect_error());
        }
        else 
        {	   
            $filterKeyword = $_POST['cerca'];
            $selectedTable = $_POST['catalogo'];

            $query = "SELECT * FROM $selectedTable WHERE CONCAT_WS('',";
            $query .= implode(", ", array_map(function($column) { return "COALESCE($column, '')"; }, getColumns($selectedTable)));
            $query .= ") LIKE '%$filterKeyword%';";
        
            $result = mysqli_query($conn, $query);

            // Controlla se ci sono risultati
            if (mysqli_num_rows($result) > 0) {
                // Inizia la tabella HTML
                echo "<table border='1'>";
                echo "<tr>";
                // Ottieni i nomi delle colonne
                while ($fieldinfo = mysqli_fetch_field($result)) {
                    echo "<th>" . $fieldinfo->name . "</th>";
                }
                echo "</tr>";

                // Stampare i dati
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    foreach ($row as $key => $value) {
                        echo "<td>" . $value . "</td>";
                    }
                    echo "</tr>";
                }
                // Chiudi la tabella HTML
                echo "</table>";
            } else {
                // Se non ci sono risultati
                echo "Nessun risultato trovato.";
            }

            // Rilascia la risorsa del risultato
            mysqli_free_result($result);

            // Chiudi la connessione al database
            mysqli_close($conn);
        }
    }
?>
