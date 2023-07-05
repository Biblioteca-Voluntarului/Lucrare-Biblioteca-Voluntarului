<?php
    session_start();
    if(!isset($_SESSION['id']))
    {
        header("Location: http://localhost/Biblioteca%20Voluntarului/Sign%20In%20ONG/SignInONG.html", true, 301);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name= "viewport" content="width=device-width,initial-scale=1">
        <title>VOLUNTARIATE</title>
        <link rel="stylesheet" href="VoluntariateleMeleONG.css">
        <script src="https://kit.fontawesome.com/a1aab4a83a.js" crossorigin="anonymous"></script>
    </head>
    
    <body>
        <div id="container">
            <div id= "main">
             <div class="barademeniu">
                    <ul>
                        <li><a href="http://localhost/Biblioteca%20Voluntarului/Interfata%20ONG/InterfataONG.php">Contul meu</a>
                        <div class="submenu1">
                                <ul>
                                    <li><a href="http://localhost/Biblioteca%20Voluntarului/Datele%20Contului%20ONG/DateleContuluiONG.php">Datele Contului</a></li>
                                    <li><a href="http://localhost/Biblioteca%20Voluntarului/Despre%20Structura/DespreStructura.php">Despre Structură</a></li>
                                    <li><a href="http://localhost/Biblioteca%20Voluntarului/Propune%20Voluntariat/PropuneVoluntariat.php">Încarcă o ofertă<br>de voluntariat</a></li>  
                                    <li><a href="http://localhost/Biblioteca%20Voluntarului/Voluntariatele%20Mele%20ONG/VoluntariateleMeleONG.php">Voluntariatele mele</a></li> 
                                </ul>    
                            </div></li></ul></div>
                               

                <section id="about1">
                    <h1><center>Lista voluntariatelor pe care le-ai încărcat se află mai jos:<br><br></center></h1>
                <?php
                    $conn = mysqli_connect("localhost", "root","", "biblioteca voluntarului");
                    $id_crt = $_SESSION['id'];
                    $select = "SELECT * FROM `oferte voluntariat` WHERE `ID_ONG` = '$id_crt'";
                    $result = mysqli_query($conn,$select);
                    if(mysqli_num_rows($result) > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            ?>
                            <div class="about">
                                <div class="row1">
                                    <h1><?php echo strtoupper($row["nume_activitate"]); ?></h1><br>
                                    <img src="..\Propune%20Voluntariat\Poze_oferte\<?php echo $row["poza_name"] ?>" class="image"> 
                                    <p1><b>Descrierea proiectului: </b><br><?php echo $row["descriere"]; ?></p1><br>
                                    <p1><b>Status: </b><?php echo $row["status"]; ?></p1><br>
                                    <p1><b>Intervalul de vârstă căutat: </b><?php echo $row["varsta"]; ?></p1><br>
                                    <p1><b>Perioada de desfășurare: </b><?php echo $row["start"]; ?><b> — </b><?php echo $row["finish"]; ?></p1><br>
                                    <p1><b>Intervalul orar de desfășurare: </b><?php echo $row["interval_orar"]; ?></p1><br>
                                    <p1><b>Locația: </b><?php echo $row["locatie"]; ?></p1><br>
                                    <div class="buton1" style='float:left'>
                                        <form action="http://localhost/Biblioteca%20Voluntarului/Update%20Voluntariat/UpdateVoluntariat.php" method="post">
                                            <input type="hidden" name="ID_oferta" value="<?php echo $row["ID_activitate"]; ?>">
                                            <button type="submit" name="submit">Modifică</button> 
                                        </form>
                                    </div>
                                    <div class="buton2">
                                        <form action="http://localhost/Biblioteca%20Voluntarului/Profil%20Voluntar%20ONG/ProfilVoluntarONG.php" method="post" target="_blank">
                                            <input type="hidden" name="ID_oferta" value="<?php echo $row["ID_activitate"]; ?>">
                                            <button type="submit" name="submit">Vezi înscrieri</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    }
                    else
                    {
                        echo '<script> alert("Nu ai înregistrat nicio ofertă de voluntariat!"); window.top.close();</script>';
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