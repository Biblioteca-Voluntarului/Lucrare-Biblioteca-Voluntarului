<?php
    session_start();
    if(!isset($_SESSION['id']))
    {
        header("Location: http://localhost/Biblioteca%20Voluntarului/Sign%20In%20Volutnar/SignInVoluntar.html", true, 301);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name= "viewport" content="width=device-width,initial-scale=1">
        <title>VOLUNTARIATELE MELE</title>
        <link rel="stylesheet" href="VoluntariateleMeleVoluntar.css">
        <script src="https://kit.fontawesome.com/a1aab4a83a.js" crossorigin="anonymous"></script>
    </head>
    
    <body>
        <div id="container">
            <div id= "main">
             <div class="barademeniu">
                    <ul>
                        <li><a href="http://localhost/Biblioteca%20Voluntarului/Interfata%20User/InterfataUser.php">Contul meu</a>
                        <div class="submenu1">
                                <ul>
                                    <li><a href="http://localhost/Biblioteca%20Voluntarului/Datele%20Contului%20Voluntar/DateleContuluiVoluntar.php">Datele Contului</a></li>
                                    <li><a href="http://localhost/Biblioteca%20Voluntarului/Despre%20Mine/DespreMine.php">Despre mine</a></li> 
                                    <li><a href="http://localhost/Biblioteca%20Voluntarului/Voluntariatele%20Mele%20Voluntar/VoluntariateleMeleVoluntar.php">Voluntariatele mele</a></li> 
                                </ul>    
                            </div></li></ul></div>
                               

                <section id="about1">
                    <h1><center>Lista voluntariatelor la care te-ai înscris se află mai jos:<br><br></center></h1>
                <?php
                    $conn = mysqli_connect("localhost", "root","", "biblioteca voluntarului");
                    // Verificarea conexiunii
                    if($conn == false)
                        die("ERROR: Could not connect. " . mysqli_connect_error());
                    $id_crt = $_SESSION['id'];
                    $select = "SELECT * FROM `conturi utilizatori` WHERE `ID` = '$id_crt'";
                    $result = mysqli_query($conn,$select);
                    $row = mysqli_fetch_assoc($result);
                    $inscrieri = $row["inscrieri_oferte"];
                    
                    if(!empty($inscrieri))
                    {
                    $token = $inscrieri;
                    strtok($token," ");
                        while($token !== false)
                        {
                            $select = "SELECT * FROM `oferte voluntariat` WHERE `ID_activitate` = '$token'";
                            $query = mysqli_query($conn,$select);
                            $entry = mysqli_fetch_assoc($query);
                            ?>
                            <div class="about">
                                <div class="row1">
                                    <h1><?php echo strtoupper($entry["nume_activitate"]); ?></h1><br>
                                    <img src="..\Propune%20Voluntariat\Poze_oferte\<?php echo $entry["poza_name"] ?>" class="image"> 
                                    <p1><b>Descrierea proiectului: </b><br><?php echo $entry["descriere"]; ?></p1><br>
                                    <p1><b>Status: </b><?php echo $entry["status"]; ?></p1><br>
                                    <p1><b>Intervalul de vârstă căutat: </b><?php echo $entry["varsta"]; ?></p1><br>
                                    <p1><b>Perioada de desfășurare: </b><?php echo $entry["start"]; ?><b> — </b><?php echo $entry["finish"]; ?></p1><br>
                                    <p1><b>Intervalul orar de desfășurare: </b><?php echo $entry["interval_orar"]; ?></p1><br>
                                    <p1><b>Locația: </b><?php echo $entry["locatie"]; ?></p1><br>
                                    <div class="buton1" style='float:left'>
                                        <form action="http://localhost/Biblioteca%20Voluntarului/Profil%20ONG%20Voluntari/ProfilONGVoluntari.php" method="post" target="_blank">
                                            <input type="hidden" name="ID_ONG" value="<?php echo $entry["ID_ONG"]; ?>">
                                            <button type="submit" name="submit">Vezi ONG</button> 
                                        </form>
                                    </div>
                                    <div class="buton2">
                                        <form action="http://localhost/Biblioteca%20Voluntarului/Retragere%20Voluntar/RetragereVoluntar.php" method="post" target="_blank">
                                            <input type="hidden" name="ID_voluntar" value="<?php echo $id_crt; ?>">
                                            <input type="hidden" name="ID_ONG" value="<?php echo $entry["ID_ONG"]; ?>">
                                            <input type="hidden" name="ID_oferta" value="<?php echo $entry["ID_activitate"]; ?>">
                                            <button type="submit" name="submit2">Mă retrag</button> 
                                        </form>
                                    </div>
                                </div>
                            </div>
                    <?php 
                            $token = strtok(" ");
                        }
                    }
                    else
                    {
                        echo '<script> alert("Nu te-ai înregistrat la nicio ofertă de voluntariat!"); window.top.close();</script>';
                    }
                    ?>
                </section>
            </div>
        </div>
            
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