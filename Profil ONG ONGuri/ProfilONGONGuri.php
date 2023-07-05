<?php
    session_start();
    if(!isset($_SESSION['id']))
    {
        header("Location: http://localhost/Biblioteca%20Voluntarului/Sign%20In%20ONG/SignInONG.html", true, 301);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PROFIL ONG</title>
        <link rel="stylesheet" href="ProfilONGVoluntari.css">
        <script src="https://kit.fontawesome.com/a1aab4a83a.js" crossorigin="anonymous"></script>
    </head>
    
    <body>
        <div class="container">
            <div class="profile-box">
                <img src="Images/download.jpg" class="profile-pic">
                <?php
                $conn = mysqli_connect("localhost", "root","", "biblioteca voluntarului");
                if(isset($_POST['submit']))
                {
                    $ID_ONG = $_POST['ID_ONG'];
                    $select = "SELECT * FROM `conturi asociatii` WHERE `ID` = '$ID_ONG'";
                    $query = mysqli_query($conn,$select);
                    $row = mysqli_fetch_assoc($query);
                ?>
                <h3><?php echo $row["denumire_asociatie"]; ?></h3>
                <p><i><?php echo $row["CIF_CUI"]; ?></i><br><?php echo $row["adresa_email"]; ?></p>
                <div class="fund">
                    <h2><?php echo $row["descriere"]; ?><br></h2>
                </div><br>
                <?php
                } ?>
            </div>
        </div>
        
        <section id="about1">
            <?php  
            $conn = mysqli_connect("localhost", "root","", "biblioteca voluntarului");
            if(isset($_POST['submit']))
            {
                $ID_ONG = $_POST['ID_ONG'];
                $select = "SELECT * FROM `oferte voluntariat` WHERE `ID_ONG` = '$ID_ONG' AND `status` = 'activ' ORDER BY `start` ASC";
                $query = mysqli_query($conn,$select);
                while($row = mysqli_fetch_assoc($query))
                {
            ?>
            <div class="about">
                <div class="row1">
                    <h1><?php echo strtoupper($row["nume_activitate"]) ?></h1><br>
                    <img src="..\Propune%20Voluntariat\Poze_oferte\<?php echo $row["poza_name"] ?>" class="image">
                    <p1><b>Descrierea proiectului: </b><br><?php echo $row["descriere"]; ?></p1><br>
                    <p1><b>Status: </b><?php echo $row["status"]; ?></p1><br>
                    <p1><b>Intervalul de vârstă căutat: </b><?php echo $row["varsta"]; ?></p1><br>
                    <p1><b>Perioada de desfășurare: </b><?php echo $row["start"]; ?><b> — </b><?php echo $row["finish"]; ?></p1><br>
                    <p1><b>Intervalul orar de desfășurare: </b><?php echo $row["interval_orar"]; ?></p1><br>
                    <p1><b>Locația: </b><?php echo $row["locatie"]; ?></p1><br>
                </div>
            </div>
            <?php
                }
                $select = "SELECT * FROM `oferte voluntariat` WHERE `ID_ONG` = '$ID_ONG' AND `status` = 'inactiv' ORDER BY `finish` DESC";
                $query = mysqli_query($conn,$select);
                while($row = mysqli_fetch_assoc($query))
                {
            ?>
            <div class="about">
                <div class="row1">
                    <h1><?php echo strtoupper($row["nume_activitate"]) ?></h1><br>
                    <img src="..\Propune%20Voluntariat\Poze_oferte\<?php echo $row["poza_name"] ?>" class="image">
                    <p1><b>Descrierea proiectului: </b><br><?php echo $row["descriere"]; ?></p1><br>
                    <p1><b>Status: </b><?php echo $row["status"]; ?></p1><br>
                    <p1><b>Intervalul de vârstă căutat: </b><?php echo $row["varsta"]; ?></p1><br>
                    <p1><b>Perioada de desfășurare: </b><?php echo $row["start"]; ?><b> — </b><?php echo $row["finish"]; ?></p1><br>
                    <p1><b>Intervalul orar de desfășurare: </b><?php echo $row["interval_orar"]; ?></p1><br>
                    <p1><b>Locația: </b><?php echo $row["locatie"]; ?></p1><br>
                </div>
            </div>
            <?php
               }
            }
            ?>
        </section>
        
        <footer id="subsol">
            <div class="sub">
                <hr>
                <h3 style="color: darkblue"><center>Contact</center></h3>
                <ul class="socialmenu">
                    <li><a href="mailto:biblioteca.voluntarului@gmail.com"><i class="fa-solid fa-at"></i></a></li>
                    <li><a href="tel:0771262411"><i class="fa-solid fa-phone"></i></a></li>
                    <li><a href="https://www.instagram.com/biblioteca.voluntarului/?igshid=YmMyMTA2M2Y%3D"><i class="fa-brands fa-instagram"></i></a></li>
                </ul>
            </div>
        </footer>
    </body>
</html>