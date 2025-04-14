<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$database = "arabalazim";

$ad = $_POST['ad'];
$soyad = $_POST['soyad'];
$email = $_POST['email'];
$sifre = $_POST['sifre'];

// Veritabanına bağlan
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// E-posta adresinin kullanılıp kullanılmadığını kontrol et
$sql = "SELECT email FROM uyeler WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // E-posta adresi zaten kullanılmakta
    ?>
        <script>alert("Bu E-Posta adresi zaten kullanılmakta.");
        setTimeout(function() {
        window.location.href = "kayit_ol.php"; // Yönlendiriliyor
        }, 500);
        </script>
    <?php
} else {
    // E-posta adresi kullanılmıyorsa, kullanıcıyı kaydet
    $sql = "INSERT INTO uyeler (ad, soyad, email, sifre, kayit_tarihi) VALUES ('$ad', '$soyad', '$email', '$sifre', NOW())";

    if ($conn->query($sql) === TRUE) {
        // Kullanıcıyı otomatik olarak giriş yap
        setcookie("email", $email, time() + (86400 * 30), "/");
        ?>
        <script>alert("Kayıt başarıyla tamamlandı lütfen giriş yapınız.");
        setTimeout(function() {
        window.location.href = "giris_yap.php"; // Yönlendiriliyor
        }, 500);
    </script>
<?php
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
