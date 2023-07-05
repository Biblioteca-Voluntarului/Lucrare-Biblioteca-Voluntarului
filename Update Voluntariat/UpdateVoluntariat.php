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
        <title>ACTUALIZEAZĂ OFERTA</title>
        <link rel="stylesheet" href="UpdateVoluntariat.css">
        <script src="https://kit.fontawesome.com/a1aab4a83a.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>
    
    <body>
        <section id class="formular">
            <div class="container">
                <div class="title"><b>Actualizează activitatea de voluntariat!</b></div>
                <div class="content">
                    <form action="UpdateVoluntariatActualizare.php" method="post" enctype="multipart/form-data" target="_blank">
                        <div class="user-details">
                            <?php
                            error_reporting(0);
                            $conn = mysqli_connect("localhost", "root","", "biblioteca voluntarului");
                            if($conn == false)
                                die("ERROR: Could not connect. " . mysqli_connect_error());
                            $id_oferta = $_POST['ID_oferta'];
                            $select = "SELECT * FROM `oferte voluntariat` WHERE `ID_activitate` = '$id_oferta'";
                            $result = mysqli_query($conn,$select);
                            $row = mysqli_fetch_assoc($result);  
                            ?>
                            <div class="input-box">
                                <span class="details">Numele activității</span>
                                <input type="text" name="nume_activitate" value="<?php echo $row["nume_activitate"]; ?>" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Intervalul de vârstă</span>
                                <input type="text" name="varsta" value="<?php echo $row["varsta"]; ?>" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Data și ora de început</span>
                                <input type="datetime-local" name="start" value="<?php echo $row["start"]; ?>" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Data și ora de încheiere</span>
                                <input type="datetime-local" name="finish" value="<?php echo $row["finish"]; ?>" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Intervalul orar de desfășurare</span>
                                <input type="text" name="interval_orar" value="<?php echo $row["interval_orar"]; ?>" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Locație</span>
                                <input type="text" name="locatie" value="<?php echo $row["locatie"];  ?>" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Descrierea activității (activitatea principală, modul de lucru, cunoștințe necesare, etc.)</span>
                                <textarea name="descrierea_activitatii" style="resize:none" placeholder="Apasă ENTER pentru o nouă linie" rows="10" cols="106"><?php echo $row["descriere"]; ?></textarea>
                            </div>
                            <div>
                                <span class="details">Încarcă o poză <b>tip portret </b>sugestivă pentru activitate (.png/.jpeg/.jpg)</span>
                                <input type="file" name="poza" accept="image/png, image/jpeg, image/jpg">
                            </div>
                            <div>
                                <br>
                                <label for="status">Alegeți statusul ofertei: </label>
                                <select name="status">
                                    <option value="activ">Activ</option>
                                    <option value="inactiv" <?php if($row["status"] == "inactiv") {echo "selected";} ?>>Inactiv</option>
                                </select>
                            </div>
                            <input type="hidden" name="ID_oferta_voluntariat" value="<?php echo $id_oferta; ?>">
                        </div>
                        <div class="button">
                            <input type="submit" name="submit" value="Actualizează datele!">
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