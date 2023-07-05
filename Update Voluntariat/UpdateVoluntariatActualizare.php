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
        <title>Mesaj actualizare ofertă</title>
        <link rel="stylesheet" href="UpdateVoluntariat.css">
        <script src="https://kit.fontawesome.com/a1aab4a83a.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>
 
    <body>
        <center>
            <?php   
            error_reporting(0);
            $conn = mysqli_connect("localhost", "root","", "biblioteca voluntarului");
            // Verificarea conexiunii
            if($conn == false)
                die("ERROR: Could not connect. " . mysqli_connect_error());
            
            // Importarea datelor din formular
            $ID = $_POST["ID_oferta_voluntariat"];
            $update_nume_activitate = $_POST['nume_activitate'];
            $update_varsta = $_POST['varsta'];
            $update_start = $_POST['start'];
            $update_finish = $_POST['finish'];
            $update_interval_orar = $_POST['interval_orar'];
            $update_locatie = $_POST['locatie'];
            $update_descrierea_activitatii = $_POST['descrierea_activitatii'];
            $update_status = $_POST['status'];
            
            // Importarea fotografiei
            //The original name of the file to be uploaded.
            $poza = $_FILES['poza']['name'];
            //The mime type of the file.
            $poza_type = $_FILES['poza']['type'];
            $poza = "POZA ".$_SESSION['id']."_".$ID.".png";
            //The size, in bytes, of the uploaded file.
            $poza_size = $_FILES['poza']['size'];     
            //The temporary filename of the file in which the uploaded file was stored on the server.
            $poza_tmp_loc = $_FILES['poza']['tmp_name'];
            $poza_store = "../Propune Voluntariat/Poze_oferte/".$poza;
            
            if($poza_size == 0)
            {
                $sql = "UPDATE `oferte voluntariat` SET `nume_activitate` = '$update_nume_activitate', `varsta` = '$update_varsta', `start` = '$update_start', `finish` = '$update_finish', `interval_orar` = '$update_interval_orar', `locatie` = '$update_locatie', `descriere` = '$update_descrierea_activitatii', `status` = '$update_status', data_ora = data_ora WHERE ID_activitate = '$ID'";
                mysqli_query($conn,$sql); 
                echo '<script> alert("Activitatea de voluntariat a fost actualizată cu succes!"); window.top.close();</script>';
            }
            else
            {
                if($poza_type == "image/png" || $poza_type == "image/jpeg" || $poza_type == "image/jpg")
                {
                    if($poza_size > 500000000)
                    {
                        echo '<script> alert("Document prea mare! Încărcați un fișier de cel mul 0.5 GB"); window.top.close();</script>';
                    }
                    else
                    {
                        move_uploaded_file($poza_tmp_loc,$poza_store);
                        $sql = "UPDATE `oferte voluntariat` SET `nume_activitate` = '$update_nume_activitate', `varsta` = '$update_varsta', `start` = '$update_start', `finish` = '$update_finish', `interval_orar` = '$update_interval_orar', `locatie` = '$update_locatie', `descriere` = '$update_descrierea_activitatii', `poza` = '$poza_tmp_loc', `poza_name` = '$poza', data_ora = data_ora WHERE ID_activitate = '$ID'";
                        mysqli_query($conn, $sql);
                        echo '<script> alert("Activitatea de voluntariat a fost actualizată cu succes!"); window.top.close();</script>';
                    }
                }
                else
                {
                    echo '<script> alert("Format poză neacceptat!"); window.top.close();</script>';
                }
            }
            
            // ÎNCERCARE (EȘUATĂ) DE COMPARARE A DATELOR ÎN VEDEREA INSERȚIEI ETAPIZATE
            /*$select = "SELECT * FROM `oferte voluntariat` WHERE ID_activitate = '$ID'";
            $query = mysqli_query($conn, $select);
            $row = mysqli_fetch_assoc($query);
            
            if($update_nume_activitate === $row["nume_activitate"] && $update_varsta === $row["varsta"] && $update_start === $row["start"] && $update_finish === $row["finish"] && $update_interval_orar === $row["interval_orar"] && $update_locatie === $row["locatie"] && $update_descrierea_activitatii === $row["descriere"] && $update_status === $row["status"] && $poza_size === 0)
            {
                echo '<script> alert("Nu au fost introduse date în vederea actualizării!"); </script>';
                echo "<br><br><br><br><br><br><br><br><h2><a href='javascript:history.back()'>↫ ÎNAPOI</a></h2>";
            }
            elseif($poza_size == 0)
            {
                if($update_nume_activitate != $row["nume_activitate"])
                {
                    $sql = "UPDATE `oferte voluntariat` SET `nume_activitate` = '$update_nume_activitate', data_ora = data_ora WHERE ID_activitate = '$ID'";
                    $query=mysqli_query($conn,$sql); 
                }
                elseif($update_varsta != $row["varsta"])
                {
                    $sql = "UPDATE `oferte voluntariat` SET `varsta` = '$update_varsta', data_ora = data_ora WHERE ID_activitate = '$ID'";
                    $query=mysqli_query($conn,$sql); 
                }
                // EROAREA ESTE PRODUSĂ DE FORMATELE DIFERITE ALE DATELOR
                elseif($update_start != $row["start"])
                {
                    $sql = "UPDATE `oferte voluntariat` SET `start` = '$update_start', data_ora = data_ora WHERE ID_activitate = '$ID'";
                    $query=mysqli_query($conn,$sql); 
                }
                elseif($update_finish != $row["finish"])
                {
                    $sql = "UPDATE `oferte voluntariat` SET `finish` = '$update_finish', data_ora = data_ora WHERE ID_activitate = '$ID'";
                    $query=mysqli_query($conn,$sql); 
                }
                elseif($update_interval_orar != $row["interval_orar"])
                {
                    $sql = "UPDATE `oferte voluntariat` SET `interval_orar` = '$update_interval_orar', data_ora = data_ora WHERE ID_activitate = '$ID'";
                    $query=mysqli_query($conn,$sql);
                }
                elseif($update_locatie != $row["locatie"])
                {
                    $sql = "UPDATE `oferte voluntariat` SET `locatie` = '$update_locatie', data_ora = data_ora WHERE ID_activitate = '$ID'";
                    $query=mysqli_query($conn,$sql);
                }
                elseif($update_descrierea_activitatii != $row["descriere"])
                {
                    $sql = "UPDATE `oferte voluntariat` SET `descriere` = '$update_locatie', data_ora = data_ora WHERE ID_activitate = '$ID'";
                    $query=mysqli_query($conn,$sql);
                }
                elseif($update_status != $row["status"])
                {
                    $sql = "UPDATE `oferte voluntariat` SET `status` = '$update_status', data_ora = data_ora WHERE ID_activitate = '$ID'";
                    $query=mysqli_query($conn,$sql);
                }
                else
                {
                    echo '<script> alert("Activitatea de voluntariat a fost actualizată cu succes!"); </script>';
                    echo "<br><br><br><br><br><br><br><br><h2><a href='".$link_home."'>↫ ÎNAPOI</a></h2>";
                }
            }
            elseif($poza_size != 0)
            {
                if($poza_type == "image/png" || $poza_type == "image/jpeg" || $poza_type == "image/jpg")
                {
                    if($poza_size > 500000000)
                    {
                        echo '<script> alert("Document prea mare! Încărcați un fișier de cel mul 0.5 GB"); </script>';
                        echo "<br><br><br><br><br><br><br><br><h2><a href='javascript:history.back()'>↫ ÎNAPOI</a></h2>";
                    }
                    else
                    {
                        move_uploaded_file($poza_tmp_loc,$poza_store);
                        $sql = "UPDATE `oferte voluntariat` SET poza = '$poza_tmp_loc', poza_name = '$poza', data_ora = data_ora WHERE ID_activitate = '$ID'";
                        mysqli_query($conn, $sql);
                    }
                }
                else
                {
                    echo '<script> alert("Format poză neacceptat!"); </script>';
                    echo "<br><br><br><br><br><br><br><br><h2><a href='javascript:history.back()'>↫ ÎNAPOI</a></h2>";
                }
                if($update_nume_activitate != $row["nume_activitate"])
                {
                    $sql = "UPDATE `oferte voluntariat` SET `nume_activitate` = '$update_nume_activitate', data_ora = data_ora WHERE ID_activitate = '$ID'";
                    $query=mysqli_query($conn,$sql); 
                }
                elseif($update_varsta != $row["varsta"])
                {
                    $sql = "UPDATE `oferte voluntariat` SET `varsta` = '$update_varsta', data_ora = data_ora WHERE ID_activitate = '$ID'";
                    $query=mysqli_query($conn,$sql); 
                }
                elseif($update_start != $row["start"])
                {
                    $sql = "UPDATE `oferte voluntariat` SET `start` = '$update_start', data_ora = data_ora WHERE ID_activitate = '$ID'";
                    $query=mysqli_query($conn,$sql); 
                }
                elseif($update_finish != $row["finish"])
                {
                    $sql = "UPDATE `oferte voluntariat` SET `finish` = '$update_finish', data_ora = data_ora WHERE ID_activitate = '$ID'";
                    $query=mysqli_query($conn,$sql); 
                }
                elseif($update_interval_orar != $row["interval_orar"])
                {
                    $sql = "UPDATE `oferte voluntariat` SET `interval_orar` = '$update_interval_orar', data_ora = data_ora WHERE ID_activitate = '$ID'";
                    $query=mysqli_query($conn,$sql);
                }
                elseif($update_locatie != $row["locatie"])
                {
                    $sql = "UPDATE `oferte voluntariat` SET `locatie` = '$update_locatie', data_ora = data_ora WHERE ID_activitate = '$ID'";
                    $query=mysqli_query($conn,$sql);
                }
                elseif($update_descrierea_activitatii != $row["descriere"])
                {
                    $sql = "UPDATE `oferte voluntariat` SET `descriere` = '$update_locatie', data_ora = data_ora WHERE ID_activitate = '$ID'";
                    $query=mysqli_query($conn,$sql);
                }
                elseif($update_status != $row["status"])
                {
                    $sql = "UPDATE `oferte voluntariat` SET `status` = '$update_status', data_ora = data_ora WHERE ID_activitate = '$ID'";
                    $query=mysqli_query($conn,$sql);
                }
                else
                {
                    echo '<script> alert("Activitatea de voluntariat a fost actualizată cu succes!"); </script>';
                    echo "<br><br><br><br><br><br><br><br><h2><a href='".$link_home."'>↫ ÎNAPOI</a></h2>";
                }
            }*/
            mysqli_close($conn);
            ?>
        </center>
    </body>
</html>