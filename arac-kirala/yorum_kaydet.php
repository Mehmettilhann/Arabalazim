<?php
session_start();

// Veritabanı bağlantısını oluşturma
$servername = "127.0.0.1";
$username = "root";
$password = "";  // Eğer veritabanınız şifre gerektiriyorsa buraya yazın, yoksa boş bırakın
$database = "arabalazim";

// MySQLi nesnesiyle bağlantı oluştur
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// POST verilerini al
$uye_id = $_POST['uye_id'];
$araba_id = $_POST['araba_id'];
$yorum = $_POST['yorum'];
$puan = $_POST['puan'];

// Yorumları ve puanları veritabanına kaydetme
$sql = "INSERT INTO yorumlar (uye_id, araba_id, yorum, puan) VALUES (?, ?, ?, ?)";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("iisi", $uye_id, $araba_id, $yorum, $puan);
    if ($stmt->execute()) {
        echo "Yorumunuz kaydedildi. Teşekkür ederiz!";
    } else {
        echo "Yorum kaydedilirken bir hata oluştu: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "SQL sorgusu hazırlanırken bir hata meydana geldi: " . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();

header('Location:\Arabalazim\Arabalazim.php');
?>
