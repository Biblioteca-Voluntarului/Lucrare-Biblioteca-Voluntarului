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
        <meta name= "viewport" content="width=device-width, initial-scale=1">
        <title>BIBLIOTECA VOLUNTARULUI</title>
        <link rel="stylesheet" href="AcasaVoluntar.css">
        <script src="https://kit.fontawesome.com/a1aab4a83a.js" crossorigin="anonymous"></script>
    </head>
    
    <body>
        <div id="container">
            <div id= "main">
                <div class="barademeniu">
                    <ul>
                        <li><a href="http://localhost/Biblioteca%20Voluntarului/Despre%20Noi/DespreNoi.html">Despre noi</a></li>
                        <li><a href="http://localhost/Biblioteca%20Voluntarului/Interfata%20User/InterfataUser.php">Contul meu</a>
                            <div class="submenu1">
                                <ul>
                                    <li><a href="http://localhost/Biblioteca%20Voluntarului/Datele%20Contului%20Voluntar/DateleContuluiVoluntar.php">Datele Contului</a></li>
                                    <li><a href="http://localhost/Biblioteca%20Voluntarului/Despre%20Mine/DespreMine.php">Despre mine</a></li>
                                    <li><a href="http://localhost/Biblioteca%20Voluntarului/Voluntariatele%20Mele%20Voluntar/VoluntariateleMeleVoluntar.php">Voluntariatele<br>mele</a></li>    
                                </ul>    
                            </div>
                        </li>
                        <li><a href="http://localhost/Biblioteca%20Voluntarului/Acasa%20Voluntar/Logout.php">Deconectează-te</a></li>
                    </ul> 
                </div>
            </div>
        </div>
        
        <section id="about1">
            <div class="about">
                <div class="row1">
                    <h1><center>Asociații/Organizații înscrise pe platforma noastră:</center></h1><br>
                    <h1><center><?php 
                        $conn = mysqli_connect("localhost", "root","", "biblioteca voluntarului");
                        // Verificarea conexiunii
                        if($conn == false)
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        $selectquery="SELECT * FROM `conturi asociatii` ORDER BY `ID` DESC LIMIT 1";
                        $result = mysqli_query($conn,$selectquery);
                        $row = mysqli_fetch_assoc($result);
                        echo $row['ID'];
                        ?></center></h1>
                    <br>
                    <h1><center>Proiecte în curs de desfășurare:</center></h1><br>
                    <h1><center><?php 
                        $conn = mysqli_connect("localhost", "root","", "biblioteca voluntarului");
                        $cnt = 0;
                        $query = mysqli_query($conn,"SELECT * FROM `oferte voluntariat` WHERE `status` = 'activ'");
                        while($queryResultArray = mysqli_fetch_array($query))
                            $cnt++;
                        echo $cnt;
                        ?></center></h1>
                    <br><br>
                    <ol class="lista">
                        <?php
                        $conn = mysqli_connect("localhost", "root","", "biblioteca voluntarului");
                        // Verificarea conexiunii
                        if($conn == false)
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        $select = "SELECT * FROM `conturi asociatii` ORDER BY `denumire_asociatie` ASC";
                        $result = mysqli_query($conn,$select);
                        while($row = mysqli_fetch_assoc($result))
                        {
                        ?>
                        <li>
                            <form action="http://localhost/Biblioteca%20Voluntarului/Profil%20ONG%20Voluntari/ProfilONGVoluntari.php" method="post" target="_blank">
                                        <input type="hidden" name="ID_ONG" value="<?php echo $row["ID"]; ?>">
                                        <button type="submit" name="submit"><?php echo $row["denumire_asociatie"]; ?></button>
                            </form>
                        </li><br>
                        <?php 
                        }
                        ?>
                    </ol>  
                </div>
            </div>
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