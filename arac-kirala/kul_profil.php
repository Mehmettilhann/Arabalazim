<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Profili</title>
    <link rel="stylesheet" href="kul-profill.css">
</head>
<body>

 <header>
        <div class="logo">
            <img src="/Arabalazim/logo.png" alt="Rent a Car Logo">
        </div>
        <nav>
            <ul>
                <li><a href="\Arabalazim\Arabalazim.php">Anasayfa</a></li>
                <li><a href="arac_kirala.php">Araç Kirala</a></li>
                <li><a href="/Arabalazim/Arabalazim.php#hakkimizdabaslik1">Hakkımızda</a></li>
                <li><a href="/Arabalazim/Arabalazim.php#bize_ulas">İletişim</a></li>
                <li><a href=kul_profil.php>Profil</a>
            </ul>
        </nav>
        <?php
        // Oturumu başlat
        session_start();

         // Kullanıcı oturum açmış mı kontrol et
    if (!isset($_COOKIE['kullanici_id'])) {
        // Kullanıcı giriş yapmamışsa, giriş yap sayfasına yönlendir
        header("Location: \Arabalazim\login-register\giris_yap.php");
        exit;
    }


        // Kullanıcı oturum açmış mı kontrol et
        if(isset($_COOKIE['kullanici_id'])) {
            // Oturum açmışsa kullanıcı bilgilerini al
            $ad = isset($_COOKIE['ad']) ? $_COOKIE['ad'] : '';
            $soyad = isset($_COOKIE['soyad']) ? $_COOKIE['soyad'] : '';
        ?>
        <div class="user-actions">
            <span><?php echo $ad . " " . $soyad . ","; ?></span>
            <a href="/Arabalazim/login-register/cikis_yap.php">Çıkış Yap</a>
        </div>
        <?php
        } else {
        ?>
        <div class="user-actions">
            <a href="\Arabalazim\login-register\giris_yap.php">Giriş Yap</a>
            <a href="\Arabalazim\login-register\kayit_ol.php">Kayıt Ol</a>
        </div>
     
        <?php
        }
        ?>
    </header>
<div class="container">
     <div class="kullanici-sifre">
    <div class="kullanici">

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "arabalazim";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

$uye_id = isset($_COOKIE['kullanici_id']) ? $_COOKIE['kullanici_id'] : 0;

$sql = "SELECT ad, soyad, email, sifre FROM uyeler WHERE uye_id = $uye_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    ?>
    <h1>Kullanıcı Bilgileri</h1>
    <p>Ad: <?php echo htmlspecialchars($user['ad']); ?></p>
    <p>Soyad: <?php echo htmlspecialchars($user['soyad']); ?></p>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($current_password === $user['sifre']) {
            if ($new_password === $confirm_password) {
                $update_sql = "UPDATE uyeler SET sifre = ? WHERE uye_id = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("si", $new_password, $uye_id);
                if ($update_stmt->execute()) {
                    echo "<p>Şifre başarıyla güncellendi.</p>";
                } else {
                    echo "<p>Şifre güncellenirken bir hata oluştu.</p>";
                }
            } else {
                echo "<p>Yeni şifreler uyuşmuyor.</p>";
            }
        } else {
            echo "<p>Mevcut şifre yanlış.</p>";
        }
    }
?>
        
  <div class="sifre">
    <form action="" method="post" class="demo-form1">
        <h2>Şifre Güncelle</h2>
        <label for="current_password">Mevcut Şifreniz:</label>
        <input type="password" id="current_password" name="current_password" class="input-wrap" required><br><br>
        <label for="new_password">Yeni Şifre:</label>
        <input type="password" id="new_password" name="new_password" class="input-wrap" required><br><br>
        <label for="confirm_password">Yeni Şifreyi Onaylayın:</label>
        <input type="password" id="confirm_password" name="confirm_password" class="input-wrap" required><br><br>
        <input type="submit" value="Şifre Güncelle" type="submit" name="update_password" ></input>
    </form>
 </div>
  </div>
    <?php
} else {
    echo "Kullanıcı bilgileri bulunamadı.<br>";
}

?>
<div class="yorum-arac">
        <div class="yorum">
    <h1 style="width:500px; text-align:center;">Yorumlar</h1> <br>

            <?php

// Kullanıcının yaptığı yorumları ve ilgili araç bilgilerini çek
$sql = "SELECT yorumlar.yorum, yorumlar.puan, arabalar.marka, arabalar.model FROM yorumlar 
        JOIN arabalar ON yorumlar.araba_id = arabalar.araba_id 
        WHERE yorumlar.uye_id = $uye_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>  
         <div class="yorum-ic">
       <p><?php echo "Yorum: " . $row['yorum']; ?> <br> <?php echo "Puan: " . $row['puan']; ?><br> <?php echo "Araç: " . $row['marka'] . " " . $row['model']; ?></p>
    </div>
        <?php
    }
} else {
    echo "Yorum bulunamadı.<br>";
}
?>

</div>
<div class="arac">
    <h1 style="width:500px;text-align:center;">Kiralanan Araçlar</h1>
    <?php
// Kullanıcının kiraladığı arabaları çek
$sql = "SELECT arabalar.araba_id, arabalar.marka, arabalar.model, arabalar.araba_resim FROM sepet JOIN arabalar ON sepet.araba_id = arabalar.araba_id WHERE sepet.uye_id = $uye_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
         <div class='arac-ic'>
    <p><?php echo "<img src='data:image/jpg;base64," . base64_encode($row['araba_resim']) . "' alt='Araba Resmi'>"; ?> <?php echo "Marka: " . $row['marka']; ?> <?php echo "Model: " . $row['model']; ?></p>
   </div>
        <?php
    }


} else {
    echo "Kiralık araba bulunamadı.<br>";
}
?>
</div>
 </div>
</div>
<?php
$conn->close();
?>

</body>
</html>
