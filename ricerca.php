<?php
    echo '<html>
            <head>
                <link rel="stylesheet" href="catalogo.css">
            </head>
            <body>        
                <a href="index.php">Torna all indice</a>
                <form method="POST">
                    <select name="Catalogo" id="catalogo" required>
                        <option value="dispositivi">Dispositivi</option>
                        <option value="sedi">Sedi</option>
                        <option value="case_produttrici">Case Produttrici</option>
                        <option value="prodotti">Prodotti</option>
                        <option value="prodotto_sede">Prodotto Sede</option>
                    </select>
                    <br>
                    <label for="cerca">Cerca qualcosa...</label>
                    <input type="text" id="cerca" required>
                    <br>
                    <input type="submit" value="Cerca">
                </form>
                
            </body>
        </html>';
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['operatore']))
    {    }
    else
    {
        header("location:login.html");
        exit();
    }
    if(isset($_POST['cerca']) && isset($_POST['catalogo']))
    {
        $servername = "localhost";
        $username = "root";
        $password = "banana";
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

            if (mysqli_num_rows($result) > 0) {
                echo "<table border='1'>";
                
                echo "<tr>";
                while ($fieldinfo = mysqli_fetch_field($result)) {
                    echo "<th>" . $fieldinfo->name . "</th>";
                }
                echo "</tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><form method='POST' action='modifica.php'>";
                    foreach ($row as $key => $value) {
                        echo "<td>" . $value . "</td>";
                    }
                    echo "<td><form method='post' action='{$_SERVER['PHP_SELF']}' onsubmit='return confirm(\"Sei sicuro di voler eliminare questa riga?\")'>
                                <input type='hidden' name='selected_table' value='$selectedTable'>
                                <input type='hidden' name='delete_row' value='" . htmlentities(json_encode($row)) . "'>
                                <input type='submit' value='Elimina'>
                                </form></td>";
        
                    echo "<td><form method='post' action='{$_SERVER['PHP_SELF']}'>
                                <input type='hidden' name='selected_table' value='$selectedTable'>
                                <input type='hidden' name='edit_row' value='" . htmlentities(json_encode($row)) . "'>
                                <input type='submit' value='Modifica'>
                                </form></td>";
        
                    echo "</tr>";                        
                }

                echo "</table>";                                  
            } 
            else {
                echo "Nessun risultato trovato.";
            }

            mysqli_free_result($result);

            mysqli_close($conn);
        }
    }
    else
    {
        echo "<script type='text/javascript'>alert('Inserisci tutti i campi richiesti!');</script>";
    }
    function getColumns($table)
    {
        global $conn;
        $columns = array();

        $result = $conn->query("SHOW COLUMNS FROM $table;");

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $columns[] = $row['Field'];
            }
        }
        return $columns;
    }
    if (isset($_POST['delete_row'])) {
        $deleteRow = json_decode($_POST['delete_row'], true);

        $whereClause = array();
        foreach ($deleteRow as $column => $value) {
            $whereClause[] = "$column = '$value'";
        }

        $deleteQuery = "DELETE FROM $selectedTable WHERE " . implode(' AND ', $whereClause);
        $conn->query($deleteQuery);
    }
    if (isset($_POST['edit_row'])) {
        $editRow = json_decode($_POST['edit_row'], true);

        $columns = getColumns($selectedTable);

        if (is_array($columns) && count($columns) > 0) {
            echo "<form method='post' action='{$_SERVER['PHP_SELF']}'>";
            echo "<input type='hidden' name='selected_table' value='$selectedTable'>";

            foreach ($columns as $column) {
                $value = isset($editRow[$column]) ? $editRow[$column] : '';
                echo "<label for='$column'>$column:</label>";
                echo "<input type='text' name='$column' value='$value'>";
            }

            echo "<input type='hidden' name='edit_row_info' value='" . htmlentities(json_encode($editRow)) . "'>";
            echo "<input type='hidden' name='selected_table_for_edit' value='$selectedTable'>";

            echo "<input type='submit' name='update_data' value='Aggiorna'>";
            echo "</form>";
        } else {
            echo "Errore: Impossibile ottenere le colonne dalla tabella $selectedTable.";
        }
    }

    if (isset($_POST['update_data'])) {
        $editRow = json_decode($_POST['edit_row_info'], true);

        $updateData = array();

        foreach ($columns as $column) {
            $updateData[$column] = isset($_POST[$column]) ? $_POST[$column] : '';
        }

        $updateQuery = "UPDATE $selectedTable SET ";
        foreach ($updateData as $column => $value) {
            $updateQuery .= "$column = '$value', ";
        }
        $updateQuery = rtrim($updateQuery, ', ');
        $updateQuery .= " WHERE ";

        foreach ($editRow as $column => $value) {
            $updateQuery .= "$column = '$value' AND ";
        }
        $updateQuery = rtrim($updateQuery, 'AND ');

        $conn->query($updateQuery);
    }
?>
