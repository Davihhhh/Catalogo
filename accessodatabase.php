<?php
    session_start();
    $name = $_POST['utente'];
    $password = $_POST['password'];

    if ($name == "pietro" && $password == "patelli"){
        $_SESSION["UTENTE"]=$name;
        header("location:protetta.php");
        exit();
    }
    else{
        unset($_SESSION["UTENTE"]);
        echo "non autenticato";
    }

?>