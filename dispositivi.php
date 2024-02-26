<html>
    <body>
        Dispositivo:
        <input type="text" id="filtronomedispositivo" placeholder="Es: Samsung Galaxy 24">
        <input type="text" id="filtromarcadispositivo" placeholder="Es: Samsung">
        <form action="risultati.php" method="POST">
            <input type="submit" name="filtrodi" value="Cerca"/>
        </form>
        <br>          
    </body>
</html>
<?php
    if(isset($_SESSION["UTENTE"]))
    echo "Benvenuto:". $_SESSION["UTENTE"];
    else
    echo "accesso non consentito";
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $sql;
        if(!empty($_POST['filtronomedispositivo']) && empty($_POST['filtromarcadispositivo']))
        {
            $sql = "SELECT *
                    FROM dispositivi
                    WHERE Nome = ";
        }
        else if (empty($_POST['filtronomedispositivo']) && !empty($_POST['filtromarcadispositivo']))
        {
            $sql = "SELECT *
                    FROM dispositivi
                    WHERE Marca = ";
        }
        else if (!empty($_POST['filtronomedispositivo']) && !empty($_POST['filtromarcadispositivo']))
        {
            $sql = "SELECT *
                    FROM dispositivi
                    WHERE Nome =  AND Marca = ";
        }

        $statement = $conn->prepare($sql);
        $band_type='rock';
        $statement->bindParam(':type', $band_type, PDO::PARAM_STR);
        $statement->execute();
        $data = $statement->fetchAll();

        foreach ($data as $row) {
            echo $row['nome']."<br />\n";
        }   

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
    }
?>