<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "arabalazim";

$connection = mysqli_connect($servername, $username, $password, $database);

if (!$connection) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

$id = $_GET['id'];

$query = "DELETE FROM arabalar WHERE araba_id=$id";

if (mysqli_query($connection, $query)) {
    ?>
        <script>alert("Araba başarıyla silindi.");
        setTimeout(function() {
            window.location.href = "adminpanel.php"; // Yönlendiriliyor
            }, 500);</script>
        <?php
} else {
    echo "Araç silinirken bir hata oluştu: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
