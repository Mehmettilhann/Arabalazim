<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "arabalazim";

$connection = mysqli_connect($servername, $username, $password, $database);

if (!$connection) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

$id = $_POST['araba_id'];
$marka = $_POST['marka'];
$model = $_POST['model'];
$tur = $_POST['tur'];
$yil = $_POST['yil'];
$vites = $_POST['vites'];
$yakit = $_POST['yakit'];
$fiyat = $_POST['fiyat'];
$stok_adet = $_POST['stok_adet'];

$query = "UPDATE arabalar SET marka='$marka', model='$model', tur='$tur', yil='$yil', vites='$vites', yakit='$yakit', fiyat='$fiyat', stok_adet='$stok_adet'";

// Resmin var olup olmadığını kontrol et eğer dosya yüklenmemişse resmi arabanın kendi resmi yapıyor
if (isset($_FILES['resim']) && $_FILES['resim']['error'] == UPLOAD_ERR_OK) {
    $resim = addslashes(file_get_contents($_FILES['resim']['tmp_name'])); // Resmi al ve blob formatına dönüştür
    $query .= ", araba_resim='$resim'";
}

$query .= " WHERE araba_id=$id"; // id'si eşleşen aracın bilgilerini güncelliycek

if (mysqli_query($connection, $query)) {
    ?>
    <script>
        alert("Araba başarıyla güncellendi.");
        setTimeout(function() {
            window.location.href = "adminpanel.php"; // Yönlendiriliyor
        }, 500);
    </script>
    <?php
} else {
    echo "Araç güncellenirken bir hata oluştu: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
