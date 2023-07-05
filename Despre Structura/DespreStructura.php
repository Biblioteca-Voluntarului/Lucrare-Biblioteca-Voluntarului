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
        <title>DESPRE STRUCTURĂ</title>
        <link rel="stylesheet" href="DespreStructura.css">
        <script src="https://kit.fontawesome.com/a1aab4a83a.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>
    
    <body>
        <section id class="formular">
            <div class="container">
                <div class="title"><b>Spune-ne mai multe despre structură!</b></div>
                <div class="content">
                    <form action="DespreStructuraActualizare.php" method="post" enctype="multipart/form-data">
                        <div class="user-details">
                            <div class="input-box">
                                <span class="details">Descrierea structurii (descrie activitatea, rezultatele, viziunea, modalitatea de organizare, etc.)</span>
                                <textarea name="descrierea_mea" style="resize:none" placeholder="Apasă ENTER pentru o nouă linie" rows="10" cols="106"><?php 
                                        $conn = mysqli_connect("localhost", "root","", "biblioteca voluntarului");
                                        $id_crt = $_SESSION['id'];
                                        $sql = "SELECT * FROM `conturi asociatii` WHERE `ID` = '$id_crt'";
                                        $query = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($query);
                                        $description = $row["descriere"];
                                        if($description)
                                            echo htmlspecialchars($description);
                                    ?></textarea>
                            </div>
                        </div>
                        <div class="button">
                            <input type="submit" name="submit" value="Salvează!">
                        </div>
                        <div class="button">
                            <input type="button" onclick="history.back()" value="Înapoi!">
                        </div>
                    </form>
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