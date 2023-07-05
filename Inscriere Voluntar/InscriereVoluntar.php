<?php
    session_start();
    if(!isset($_SESSION['id']))
    {
        header("Location: http://localhost/Biblioteca%20Voluntarului/Sign%20In%Voluntar/SignInVoluntar.html", true, 301);
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
 
    <head>
        <meta charset="UTF-8">
        <title>Mesaj înscriere</title>
        <link rel="stylesheet" href="InscriereVoluntar.css">
        <script src="https://kit.fontawesome.com/a1aab4a83a.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>
 
    <body>
        <center>
            <?php
            $conn = mysqli_connect("localhost", "root","", "biblioteca voluntarului");
            error_reporting(0);
            // Verificarea conexiunii
            if($conn == false)
                die("ERROR: Could not connect. " . mysqli_connect_error());
                 
            if(isset($_POST['inscriere_submit']))
            {
                // Importarea datelor din formular
                $id_crt = $_POST['ID_voluntar'];
                $id_ONG = $_POST['ID_ong'];
                $id_oferta = $_POST['ID_oferta'];
                
                // Extragerea ID-urilor voluntarilor înscriși la oferta de voluntariat prezentă
                $select = "SELECT * FROM `oferte voluntariat` WHERE `ID_activitate` = '$id_oferta' AND `ID_ONG` = '$id_ONG'";
                $query = mysqli_query($conn,$select);
                $result = mysqli_fetch_assoc($query);
                $inscrieri = $result["inscrieri"];
                $nr_inscrieri = $result["nr_inscrieri"];
                
                // Prelucrarea ID-urilor din șir
                $token = strtok($inscrieri," ");
                $inscriere_noua = true;
                while($token !== false && $inscriere_noua)
                {
                    // Se verifică dacă utilizatorul nu a mai fost deja înscris la prezenta ofertă de voluntariat
                    if($token == $id_crt)
                    {
                        $inscriere_noua = false;
                        echo '<script> alert("Utilizator deja înscris la această ofertă de voluntariat!"); window.top.close(); </script>';
                    }
                    $token = strtok(" ");
                }
                if($inscriere_noua)
                {
                    // Dacă înscrierea este nouă, atunci se concatenează ID-ul voluntarului la șirul de ID-uri ale voluntarilor înscriși
                    $inscrieri = $inscrieri.$id_crt." ";
                    $nr_inscrieri++;
                    $sql = "UPDATE `oferte voluntariat` SET `inscrieri` = '$inscrieri',`nr_inscrieri` = '$nr_inscrieri' WHERE `ID_activitate` = '$id_oferta'";
                    mysqli_query($conn,$sql);
                    
                    // Dacă înscrierea este nouă, atunci se concatenează ID-ul ofertei la șirul ID-urilor ofertelor la care voluntarul este înscris
                    $select = "SELECT * FROM `conturi utilizatori` WHERE `ID` = '$id_crt'";
                    $query = mysqli_query($conn,$select);
                    $result = mysqli_fetch_assoc($query);
                    $inscrieri = $result["inscrieri_oferte"];
                    $inscrieri = $inscrieri.$id_oferta." ";
                    $sql = "UPDATE `conturi utilizatori` SET `inscrieri_oferte` = '$inscrieri' WHERE `ID` = '$id_crt'";
                    mysqli_query($conn,$sql);
                    echo '<script> alert("Felicitări! Înscrierea ta a fost înregistrată cu succes!"); window.top.close();</script>';
                }
            }         
            mysqli_close($conn);
            ?>
        </center>
    </body>
</html>