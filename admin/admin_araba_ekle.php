<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "arabalazim";

$connection = mysqli_connect($servername, $username, $password, $database);

if (!$connection) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

if(isset($_POST['stok_adet'])) {
    $stok_adet = $_POST['stok_adet'];
} else {
    $stok_adet = 1; // Stok adedi belirtilmemişse, varsayılan olarak 1 olarak ayarla
}

$marka = $_POST['marka'];
$model = $_POST['model'];
$tur = $_POST['tur'];
$yil = $_POST['yil'];
$vites = $_POST['vites'];
$yakit = $_POST['yakit'];
$fiyat = $_POST['fiyat'];


$resim = addslashes(file_get_contents($_FILES['resim']['tmp_name']));

$query = "INSERT INTO arabalar (marka, model, tur, yil, vites, yakit, fiyat, stok_adet, araba_resim) VALUES ('$marka', '$model', '$tur', '$yil', '$vites', '$yakit', '$fiyat', '$stok_adet', '$resim')";

if (mysqli_query($connection, $query)) {
    ?>
    <script>alert("Yeni araba başarıyla eklendi.");
        setTimeout(function() {
            window.location.href = "adminpanel.php"; // Yönlendiriliyor
        }, 500);</script>
    <?php
} else {
    echo "Araç eklenirken bir hata oluştu: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
