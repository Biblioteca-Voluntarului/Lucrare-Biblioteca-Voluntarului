<?php
    session_start();
    if(!isset($_SESSION['id']))
    {
        header("Location: http://localhost/Biblioteca%20Voluntarului/Sign%20In%20Voluntar/SignInVoluntar.html", true, 301);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CONTUL MEU</title>
        <link rel="stylesheet" href="InterfataUser.css">
        <script src="https://kit.fontawesome.com/a1aab4a83a.js" crossorigin="anonymous"></script>
    </head>
    
    <body>
        <div class="container">
            <div class="profile-box">
                <?php
                    $conn = mysqli_connect("localhost", "root","", "biblioteca voluntarului");
                    error_reporting(0);
                    // Verificarea conexiunii
                    if($conn == false)
                        die("ERROR: Could not connect. " . mysqli_connect_error());
                    // Copierea ID-ului și interogarea bazei de date
                    $id_crt = $_SESSION['id'];
                    $select = "SELECT * FROM `conturi utilizatori` WHERE `ID` = '$id_crt'";
                    $query = mysqli_query($conn,$select);
                    $row = mysqli_fetch_assoc($query);
                ?>
                <img src="Image/download.jpg" class="profile-pic">
                <h3>Bine ai venit, <b><?php echo $row["nume_prenume"]; ?></b>!</h3>
                <p><i><?php echo $row["username"]; ?></i><br><?php echo $row["adresa_email"]; ?></p>
                <form action="http://localhost/Biblioteca%20Voluntarului/Datele%20Contului%20Voluntar/DateleContuluiVoluntar.php" method="get">
                    <button type="submit">Datele contului</button>
                </form><br>
                <form action="http://localhost/Biblioteca%20Voluntarului/Despre%20Mine/DespreMine.php" method="get">
                    <button type="submit">Despre mine</button>
                </form><br>
                <form action="http://localhost/Biblioteca%20Voluntarului/Voluntariatele%20Mele%20Voluntar/VoluntariateleMeleVoluntar.php" method="get" target="_blank">
                    <button type="submit">Voluntariatele mele</button>
                </form><br>
                <form action="http://localhost/Biblioteca%20Voluntarului/Acasa%20Voluntar/AcasaVoluntar.php" method="get">
                    <button type="submit">Acasă</button>
                </form>
            </div>
        </div>
        
        <footer id="subsol">
            <div class="sub">
                <hr>
                <h3 style="color: darkblue"><center>Contact</center></h3>
                <ul class="socialmenu">
                    <li><a href="mailto:biblioteca.voluntarului@gmail.com"><i  class="fa-solid fa-at"></i></a></li>
                    <li><a href="tel:0771262411"><i class="fa-solid fa-phone"></i></a></li>
                    <li><a href="https://www.instagram.com/biblioteca.voluntarului/?igshid=YmMyMTA2M2Y%3D"><i class="fa-brands fa-instagram"></i></a></li>
                </ul>
            </div>
        </footer>
    </body>
</html>
