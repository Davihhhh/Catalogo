<html>
    <body>        
        Casa produttrice:
        <input type="text" id="filtrocasaproduttrice" placeholder="Es: Samsung"> 
        <form action="risultati.php" method="POST">
            <input type="submit" name="filtrocp" value="Cerca"/>
        </form>
        <br>
    </body>
</html>
<?php
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql;
    $nome;
    
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['filtrocasaproduttrice']))
    {
        $nome = $_POST['filtrocasaproduttrice'];
        $sql = "SELECT * FROM case_produttrici WHERE Nome = $nome";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {

            echo "Nome: " . $row[0]. " - Data_Fondazione: " . $row[1] . "<br>";
            }
        } 
        else {
            echo "Non ci sono risultati";
        }
    }
    else if ($_SERVER['REQUEST_METHOD'] == "POST" && !isset($_POST['filtrocasaproduttrice']))
    {
        echo "inserisci il filtro";
    }   
    
    mysqli_close($conn);
    ?>
?>