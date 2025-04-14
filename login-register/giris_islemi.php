<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$database = "arabalazim";

// POST verilerini al
$email = $_POST['email'];
$sifre = $_POST['sifre'];
if ($email=="arabalazimpanel@gmail.com" && $sifre=="123") // ADMİN PANELE YÖNLENDİRME
{
    header("Location: /Arabalazim/admin/adminpanel.php");
    exit();
}
else{

    // Veritabanından kullanıcıyı kontrol et
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
    }

    $sql = "SELECT uye_id, ad, soyad, email FROM uyeler WHERE email='$email' AND sifre='$sifre'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Kullanıcı bilgilerini cookie'ye kaydet
        setcookie("kullanici_id", $row["uye_id"], time() + (86400 * 30), "/"); // 30 gün boyunca geçerli
        setcookie("ad", $row["ad"], time() + (86400 * 30), "/");
        setcookie("soyad", $row["soyad"], time() + (86400 * 30), "/");
        setcookie("email", $row["email"], time() + (86400 * 30), "/");

        ?>
        <script>alert("<?php echo "Giriş başarılı. Hoş geldiniz, " . $row["ad"] . " " . $row["soyad"];?>");
        setTimeout(function() {
        window.location.href = "/Arabalazim/Arabalazim.php"; // Yönlendiriliyor
        }, 500);
    </script>
<?php
    }else {
        ?>
        <script>alert("Hatalı şifre veya e-posta");
        setTimeout(function() {
        window.location.href = "giris_yap.php"; // Yönlendiriliyor
        }, 500);
    </script>
<?php
    }
    $conn->close();
}

?>
