<?php
    class database{

        function __construct() {

        }
/*
        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['filtrocp']) && !empty($_POST['filtrocasaproduttrice']))
        {
            $valore = $_POST['filtrocasaproduttrice'];
            func1($valore);
        }
        else if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['filtrodi']) && !empty($_POST['filtronomedispositivo']))
        {
            $valore = $_POST['filtronomedispositivo'];
            func21($valore);
        }
        else if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['filtrodi']) && !empty($_POST['filtromarcadispositivo']))
        {
            $valore = $_POST['filtromarcadispositivo'];
            func22($valore);
        }
        else if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['filtrodi']) && !empty($_POST['filtromodellodispositivo']))
        {
            $valore = $_POST['filtromodellodispositivo'];
            func23($valore);
        }
        else if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['filtrose']) && !empty($_POST['filtroindirizzosede']))
        {
            $valore = $_POST['filtroindirizzosede'];
            func3($valore);
        }
*/
        function func1($valore)
        {
            try
            {            
                $sql = "SELECT * FROM Case_Produttrici WHERE Nome='{$valore}'";
                $query = $connection->prepare($sql);
                $query->execute();

                $result = $query->fetchAll(PDO::FETCH_ASSOC);
            }catch (Exception $e)
            {
                die('Cant fetch rows.');
            }
            foreach ($result as $r)
            {
                echo $r; 
            }  
        }
        function func21($valore)
        {
            //database    
        }
        function func22($valore)
        {
            //database    
        }
        function func23($valore)
        {
            //database    
        }
        function func3($valore)
        {
            //database    
        }
    }
?>