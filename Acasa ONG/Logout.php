<?php
$conn = mysqli_connect("localhost", "root","", "biblioteca voluntarului");
session_destroy();
header('location:http://localhost/Biblioteca%20Voluntarului/Pagina%20Principala/PaginaPrincipala.html');
?>