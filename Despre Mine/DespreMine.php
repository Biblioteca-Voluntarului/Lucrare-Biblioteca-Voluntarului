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
        <title>DESPRE MINE</title>
        <link rel="stylesheet" href="DespreMine.css">
        <script src="https://kit.fontawesome.com/a1aab4a83a.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>
    
    <body>
        <section id class="formular">
            <div class="container">
                <div class="title"><b>Spune-ne mai multe despre tine!</b></div>
                <div class="content">
                    <form action="DespreMineActualizare.php" method="post" enctype="multipart/form-data">
                        <div class="user-details">
                            <div class="input-box">
                                <span class="details">Descrierea mea (descrie-ți personalitatea, pasiunile, viziunea, experiența, etc.)</span>
                                <textarea name="descrierea_mea" style="resize:none" placeholder="Apasă ENTER pentru o nouă linie" rows="10" cols="106"><?php 
                                        $conn = mysqli_connect("localhost", "root","", "biblioteca voluntarului");
                                        $id_crt = $_SESSION['id'];
                                        $sql = "SELECT * FROM `conturi utilizatori` WHERE `ID` = '$id_crt'";
                                        $query = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($query);
                                        $description = $row["descriere"];
                                        if($description)
                                            echo htmlspecialchars($description);
                                    ?></textarea>
                            </div>
                            <div>
                                <span class="details">Încarcă-ți CV-ul (.pdf). Ai grijă să îți incluzi data nașterii în acesta!</span>
                                <input type="file" name="cv" accept="application/pdf">
                            </div>
                            <div>
                                <br>
                                <span class="details">Documentul actual este:</span>
                                <?php
                                    $conn = mysqli_connect("localhost", "root","", "biblioteca voluntarului");
                                    $id_crt = $_SESSION['id'];
                                    $sql = "SELECT * FROM `conturi utilizatori` WHERE `ID` = '$id_crt'";
                                    $query = mysqli_query($conn,$sql);
                                    $info = mysqli_fetch_array($query);
                                    if($info["cv_name"]){
                                ?>
                                <embed type="application/pdf" src="CV-uri_voluntari/<?php echo $info["cv_name"]; ?>" width="700" height="500">
                                <?php
                                    }
                                    else
                                        echo "Niciun document încărcat!";
                                ?>
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