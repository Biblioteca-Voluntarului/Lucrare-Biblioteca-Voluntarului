<?php
    session_start();
    if(!isset($_SESSION['id']))
    {
        header("Location: http://localhost/Biblioteca%20Voluntarului/Sign%20In%20Voluntar/SignInVoluntar.html", true, 301);
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title>Mesaj actualizare cont</title>
        <link rel="stylesheet" href="DespreMine.css">
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
                $sql = "SELECT * FROM `conturi utilizatori` WHERE `ID` = '$id_crt'";
                $query = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($query);
                $description = $row["descriere"];
                // Se stabilește dacă există modificări ale descrierii
                if($descrierea_mea === $description || $descrierea_mea == NULL)
                    $input_descriere = false;
                else
                    $input_descriere = true;
                
                //The original name of the file to be uploaded.
                $cv = $_FILES['cv']['name'];
                $cv = "CV ".$row["nume_prenume"]."_".$id_crt.".pdf";
                //The mime type of the file.
                $cv_type = $_FILES['cv']['type'];
                //The size, in bytes, of the uploaded file.
                $cv_size = $_FILES['cv']['size'];     
                //The temporary filename of the file in which the uploaded file was stored on the server.
                $cv_tmp_loc = $_FILES['cv']['tmp_name'];
                $cv_store = "CV-uri_voluntari/".$cv;
                
                // Se stabilește dacă există un fișier încărcat pe post de CV
                if($cv_size > 0)
                    $input_cv = true;
                else
                    $input_cv = false;
                
                // Se validează câmpurile introduse
                if(!$input_descriere && !$input_cv)
                {
                    echo '<script> alert("Nu au fost introduse date în vederea actualizării!"); javascript:history.back();</script>';
                }
                elseif($input_cv)
                {
                    if($cv_type !== "application/pdf")
                    {
                        echo '<script> alert("Format CV neacceptat!"); javascript:history.back();</script>';
                    }
                    elseif($cv_size > 500000000)
                    {
                        echo '<script> alert("Document prea mare! Încărcați un fișier de cel mul 0.5 GB"); javascript:history.back();</script>';
                    }
                    elseif($input_descriere)
                    {
                        $sql = "UPDATE `conturi utilizatori` SET `descriere` = '$descrierea_mea', `cv` = '$cv_tmp_loc', `cv_name` = '$cv', data_ora = data_ora WHERE `ID` = '$id_crt'";
                        $query=mysqli_query($conn,$sql); 
                        move_uploaded_file($cv_tmp_loc,$cv_store);
                        echo '<script> alert("Descriere și CV actualizate cu succes!"); javascript:history.back();</script>';
                    }
                    else
                    {
                        $sql = "UPDATE `conturi utilizatori` SET `cv` = '$cv_tmp_loc', `cv_name` = '$cv', data_ora = data_ora WHERE `ID` = '$id_crt'";
                        $query=mysqli_query($conn,$sql); 
                        move_uploaded_file($cv_tmp_loc,$cv_store);
                        echo '<script> alert("CV actualizat cu succes!"); javascript:history.back();</script>';
                    }
                }
                elseif($input_descriere && !$input_cv)
                {
                        $sql = "UPDATE `conturi utilizatori` SET `descriere` = '$descrierea_mea', data_ora = data_ora WHERE `ID` = '$id_crt'";
                        $query=mysqli_query($conn,$sql); 
                        echo '<script> alert("Descriere actualizată cu succes!"); javascript:history.back();</script>';
                }
            }
            mysqli_close($conn); 
            ?>
        </center>
    </body>
</html>