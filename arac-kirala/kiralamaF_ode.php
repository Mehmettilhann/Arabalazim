<?php


session_start();  // Session başlatılıyor

// Kullanıcı kimliğini cookie'den çekme
$uye_id = isset($_COOKIE['kullanici_id']) ? $_COOKIE['kullanici_id'] : '';

if (!empty($uye_id)) {
    // Form verilerini alma
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $telefon = $_POST['telefon'];
    $adres = $_POST['adres'];

    // Session'dan araba_id çekme
    $araba_id = $_SESSION['araba_id'];
    // Session'dan toplamFiyat çekme
    $toplamFiyat = $_SESSION['toplamFiyat'];

    // Veritabanı bağlantısını oluşturma
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $database = "arabalazim";
    $conn = new mysqli($servername, $username, $password, $database);

    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // Kiralaform tablosuna kayıt işlemi
    $sql = "INSERT INTO kiralaform (ad, soyad, telefon, adres, uye_id) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssi", $ad, $soyad, $telefon, $adres, $uye_id);
        $stmt->execute();
        $stmt->close();
    }

    // Sepet tablosuna kayıt işlemi
    $sql = "INSERT INTO sepet (uye_id, araba_id, toplamFiyat) VALUES (?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("iis", $uye_id, $araba_id, $toplamFiyat);
        if ($stmt->execute()) {
            echo "Ödeme ve sepet bilgisi başarılı bir şekilde kaydedildi!";
        } else {
            echo "Hata: " . $stmt->error;
        }
        $stmt->close();
    }

    // Veritabanı bağlantısını kapatma
    $conn->close();
} else {
    echo "Kullanıcı kimliği bulunamadı!";
}

header('Location: yorum.php');
exit;

?>

