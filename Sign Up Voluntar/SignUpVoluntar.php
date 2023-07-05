<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title>Mesaj creare cont</title>
        <link rel="stylesheet" href="SignUpVoluntar.css">
        <script src="https://kit.fontawesome.com/a1aab4a83a.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    </head>
 
    <body>
        <center>
            <?php
            $conn = mysqli_connect("localhost", "root","", "biblioteca voluntarului");
            error_reporting(0);
          
            // Verificarea conexiunii
            if($conn == false)
                die("ERROR: Could not connect. " . mysqli_connect_error());
                 
            // Importarea datelor din formular
            if(isset($_POST['submit']))
            {
                $nume_prenume = $_POST['nume_prenume'];
                $username = $_POST['username'];
                $adresa_email = $_POST['adresa_email'];
                $numar_telefon = $_POST['numar_telefon'];
                $parola = $_POST['password'];
                $cparola = $_POST['cpassword'];
        
                // Eliminarea caracterelor interzise din adresa de e-mail
                $adresa_email = filter_var($adresa_email, FILTER_SANITIZE_EMAIL);
         
                // Verificarea adresei de e-mail și a username-ului în baza de date
                $identical_email = "SELECT * FROM `conturi utilizatori` WHERE `adresa_email` = '$adresa_email'";
                $verif_email = mysqli_query($conn, $identical_email);
                $identical_username = "SELECT * FROM `conturi utilizatori` WHERE `username` = '$username'";
                $verif_username = mysqli_query($conn, $identical_username);
        
                // Validarea datelor
                if (filter_var($adresa_email, FILTER_VALIDATE_EMAIL) == false)
                {
                    echo '<script> alert("Adresa de e-mail introdusă nu este validă!"); javascript:history.back();</script>';
                }
                elseif(mysqli_num_rows($verif_email) > 0)
                {
                    echo '<script> alert("Deja există un cont la această adresă de e-mail!"); javascript:history.back();</script>';
                }        
                elseif(mysqli_num_rows($verif_username) > 0)
                {
                    echo '<script> alert("Username deja folosit!"); javascript:history.back();</script>';
                }
                elseif(strlen($parola) < 10)
                {
                    echo '<script> alert("Parolă prea scurtă!"); javascript:history.back();</script>';
                }
                elseif(preg_match('/[A-Z]/', $parola) == false)
                {
                    echo '<script> alert("Parola trebuie să conțină cel puțin o majusculă!"); javascript:history.back();</script>';
                }
                elseif(preg_match('~[0-9]+~', $parola) == false)
                {
                    echo '<script> alert("Parola trebuie să conțină cel puțin o cifră!"); javascript:history.back();</script>';
                }
                elseif(preg_match('/[\'^£$%&*()}{@#~?><,|=_+¬-]/', $parola) == false)
                {
                    echo '<script> alert("Parola trebuie să conțină cel puțin un caracter special!"); javascript:history.back();</script>';
                }
                elseif($parola == $cparola)
                {
                    // După parcurgerea tuturor condițiilor, datele oferite se înregistrează în baza de date
                    $sql = "INSERT INTO `conturi utilizatori` (nume_prenume, username, adresa_email, numar_telefon, parola) VALUES ('$nume_prenume','$username','$adresa_email','$numar_telefon','$parola')";
                    if(mysqli_query($conn, $sql))
                    {
                        echo '<script> alert("Datele au fost salvate cu succes!"); </script>';
                        echo "<br><br><br><br><br><br><br><br><h1>Bun venit în comunitatea</h1>";
                        echo "<h1>Biblioteca Voluntarului, $nume_prenume!</h1>";
                        echo "<h2>Datele dumneavoastră sunt:</h2>";
                        echo "<b>Nume și prenume: </b>".$nume_prenume;
                        echo "<br><b>Username: </b>".$username;
                        echo "<br><b>E-mail: </b> <a href='mailto:".$adresa_email."'>$adresa_email</a>"; 
                        echo "<br><b>Număr de telefon: </b>".$numar_telefon;
                        echo "<br><b>Parolă: </b>".$parola;
                        echo "<br><br><h2><a href='http://localhost/Biblioteca%20Voluntarului/Sign%20In%20Voluntar/SignInVoluntar.html'>CONTUL MEU</a></h2>";               
                    }
                }
                else
                {
                    echo '<script> alert("Confirmarea parolei nu a fost realizată!"); javascript:history.back();</script>';
                }
            }
            mysqli_close($conn);
            ?>
        </center>
    </body>
</html>