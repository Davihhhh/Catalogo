<html>
    <body>
        Sede:
        <input type="text" id="filtroindirizzosede" placeholder="Es: via samsung">
        <form action="risultati.php" method="POST">
            <input type="submit" name="filtrose" value="Cerca"/>
        </form>
    </body>
</html>
<?php
    if(isset($_SESSION["UTENTE"]))
    echo "Benvenuto:". $_SESSION["UTENTE"];
    else
    echo "accesso non consentito";
?>