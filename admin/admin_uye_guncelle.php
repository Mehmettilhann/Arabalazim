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

// Formdan gelen verileri al
$uye_id = $_POST['uye_id'];
$ad = $_POST['ad'];
$soyad = $_POST['soyad'];
$email = $_POST['email'];
$sifre = $_POST['sifre'];

// Güncelleme sorgusu
$query = "UPDATE uyeler SET ad='$ad', soyad='$soyad', email='$email', sifre='$sifre' WHERE uye_id='$uye_id'";

// Sorguyu çalıştır ve sonucu kontrol et
if (mysqli_query($connection, $query)) 
{
?>
    <script>alert("Üye başarıyla güncellendi");
        setTimeout(function() {
        window.location.href = "adminpanel.php"; // Yönlendiriliyor
        }, 500);
    </script>
<?php
} else {
    echo "Hata: " . $query . "<br>" . mysqli_error($connection);
}

// Veritabanı bağlantısını kapat
mysqli_close($connection);
?>
