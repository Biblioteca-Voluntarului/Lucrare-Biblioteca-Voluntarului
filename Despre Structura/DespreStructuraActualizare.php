<?php
    session_start();
    if(!isset($_SESSION['id']))
    {
        header("Location: http://localhost/Biblioteca%20Voluntarului/Sign%20In%20ONG/SignInONG.html", true, 301);
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title>Mesaj actualizare cont</title>
        <link rel="stylesheet" href="DespreStructura.css">
        <script src="https://kit.fontawesome.com/a1aab4a83a.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>
 
    <body>
        <center>
            <?php      
            $id_crt = $_SESSION['id'];
            error_reporting(0);
            $conn = mysqli_connect("localhost", "root","", "biblioteca voluntarului");
            // Verificarea conexiunii
            if($conn == false)
                die("ERROR: Could not connect. " . mysqli_connect_error());
            if(isset($_POST['submit']))
            {
                // Importarea descrierii din formular
                $descrierea_mea = $_POST['descrierea_mea'];
                // Interogarea tabelului în privința ultimei descrieri
                $sql = "SELECT * FROM `conturi asociatii` WHERE `ID` = '$id_crt'";
                $query = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($query);
                $description = $row["descriere"];
                // Se stabilește dacă există modificări ale descrierii
                if($descrierea_mea === $description || $descrierea_mea == NULL)
                    $input_descriere = false;
                else
                    $input_descriere = true;
                
                if(!$input_descriere)
                {
                    echo '<script> alert("Nu au fost introduse date în vederea actualizării!"); javascript:history.back();</script>';
                }
                else
                {
                        $sql = "UPDATE `conturi asociatii` SET `descriere` = '$descrierea_mea', data_ora = data_ora WHERE `ID` = '$id_crt'";
                        $query=mysqli_query($conn,$sql); 
                        echo '<script> alert("Descriere actualizată cu succes!"); javascript:history.back();</script>';
                }
            }
            mysqli_close($conn); 
            ?>
        </center>
    </body>
</html>