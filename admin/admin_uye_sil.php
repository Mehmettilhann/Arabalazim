<?php
// Veritabanı bağlantısı için gerekli bilgiler
$servername = "localhost"; // Sunucu adı
$username = "root"; // Kullanıcı adı
$password = ""; // Şifre
$database = "arabalazim"; // Veritabanı adı

// Veritabanı bağlantısını oluştur
$connection = mysqli_connect($servername, $username, $password, $database);

// Bağlantı kontrolü
if (!$connection) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

// Silinecek üye ID'sini al
if(isset($_GET['id'])) {
    $uye_id = $_GET['id'];

    // Üye silme sorgusu
    $query = "DELETE FROM uyeler WHERE uye_id='$uye_id'";
    
    if (mysqli_query($connection, $query)) {
        header("Location: adminpanel.php");
        exit();
    } else {
        echo "Hata: " . $query . "<br>" . mysqli_error($connection);
    }
}
// Veritabanı bağlantısını kapat
mysqli_close($connection);
?>
