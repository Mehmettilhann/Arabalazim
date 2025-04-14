<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Araba Detayları</title>
    <link rel="stylesheet" href="arac_detayy.css">
</head>
<body>
<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$database = "arabalazim";

// Veritabanı bağlantısını oluştur
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Aracın ID'sini al
$araba_id = $_POST['araba_id'];

// SQL sorgusu: Belirli bir aracın detaylarını seç
$sql = "SELECT * FROM arabalar WHERE araba_id = $araba_id";
$result = $conn->query($sql);

//Session'a araba_id'yi kaydet
$_SESSION['araba_id'] = $araba_id;

// Sonucu kontrol et ve detayları ekrana yazdır
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Resim verisini al
    $resim_verisi = $row["araba_resim"];
    $gunlukFiyat = $row["fiyat"]; // Aracın günlük fiyatını al
?>
<div class="container"> 
<div class="arac-detay-container">
  <div class="car-image-container">
            <img src="data:image/jpg;base64,<?= base64_encode($resim_verisi) ?>" alt="Araba Resmi">
  </div>
  <div class="car-skills-container">
    <div class="car-type">
             <h2><?= htmlspecialchars($row["marka"]) . " " . htmlspecialchars($row["model"]) ?></h2>
    </div>
    <div class="car-skills">
      <div class="skills">
         <p>Yıl: <?= htmlspecialchars($row["yil"]) ?></p>
      </div>
      <div class="skills">
               <p>Tür: <?= htmlspecialchars($row["tur"]) ?></p>

      </div>
      <div class="skills">
                <p>Stok Adet: <?= htmlspecialchars($row["stok_adet"]) ?></p>
      </div>
    </div> 
    </div>
  <form action="kiralama_formu.php" class="car-pay-container" method="post">
    <div class="day">
                <label for="gun">Kiralama Süresi (Gün):</label>
                <select id="gun" name="gun" required>
                <option value="3">3 Gün</option>
                <option value="7">7 Gün</option>
                <option value="15">15 Gün</option>
                <option value="30">30 Gün</option>
                </select>

    </div>
    <div class="fiyat">
      <p id="fiyat"></p>
      <input type="hidden" id="toplamFiyat" name="toplamFiyat" value="0">
    </div>
    <div class="kirala-btn">
      <button class="glow-on-hover" type="submit">Hemen Kirala</button>
    </div>
  </form>
</div>
<div class="yorumlar-container">

    <?php
    // Yorumları çekme
    $yorum_sql = "SELECT * FROM yorumlar WHERE araba_id = ?";
    $yorum_stmt = $conn->prepare($yorum_sql);
    $yorum_stmt->bind_param("i", $araba_id);
    $yorum_stmt->execute();
    $yorum_result = $yorum_stmt->get_result();
    ?>
    <h3>Yorumlar</h3>
    <?php
    if ($yorum_result->num_rows > 0) {
        while ($yorum = $yorum_result->fetch_assoc()) {
            ?>
       
    <div class="yorumlar">
         <p>Yorum: <?= htmlspecialchars($yorum['yorum']) ?></p>
        <p>Puan: <?= htmlspecialchars($yorum['puan']) ?></p>
    </div>    
            <?php
        }
    } else {
        echo "<p>Bu araca ait yorum bulunamadı.</p>";
    }
} else {
    echo "<p>Araba detayları bulunamadı.</p>";
}
?>
  </div>  
</div>
<?php

$conn->close();
?>