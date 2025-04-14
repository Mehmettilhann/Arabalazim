<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiralama Formu</title>
    <link rel="stylesheet" href="kiralama_formuu.css">
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
        <a href="/ARABALAZIM/login-register/giris_yap.php">Giriş Yap</a>
        <a href="/ARABALAZIM/login-register/kayit_ol.php">Kayıt Ol</a>
    </div>
<?php
}
?>
</header>

<!-- Kiralama ve Ödeme Formu -->
<form action="kiralamaF_ode.php" class="demo-form1" method="post">
    <div class="input-wrap">
        <label class="f-title" for="name">Adınız</label>
        <input type="text" id="ad" name="ad" class="input" placeholder="Adınız" required>
    </div>
   <div class="input-wrap">
        <label class="f-title" for="name">Soyadınız</label>
        <input type="text" id="soyad" name="soyad" class="input" placeholder="Soyadınız" required>
    </div>
    <div class="input-wrap">
        <label class="f-title" for="phone">Telefon Numaranız</label>
        <input type="tel" id="telefon" name="telefon" class="input" placeholder="(5xx)(123 45 67)" required>
    </div>
   <div class="input-wrap">
     <label class="f-title" for="email">Adresiniz</label>
        <textarea name="adres" id="adres" class="textarea"></textarea>
    </div>
    <div class="input-wrap">
        <label class="f-title" for="">Kart Üzerindeki İsim</label>
        <input type="text" class="input" placeholder="" required>
    </div>

    <div class="input-wrap">
        <label class="f-title" for="kart-numarasi">Kart Numarası</label>
        <input type="text" class="input" name="dogumyeri" placeholder="" required>
    </div>
  <div class="input-wrap">
        <label class="f-title" for="kart-numarasi">Son kullanma tarihi (Ay/Yıl)</label>
        <input type="text" class="input" name="dogumyeri" placeholder="" required>
    </div>
  <div class="input-wrap">
        <label class="f-title" for="kart-numarasi">CVC</label>
        <input type="number" class="input" name="" placeholder="" required>
    </div>
    <input type="submit" id="submit" name="submit" value="Öde">

</form>

<?php

$toplamFiyat=$_POST['toplamFiyat'] ;
$_SESSION["toplamFiyat"] = $toplamFiyat;




?>


<footer>
    <p>&copy; 2024 Arabalazim. Tüm hakları saklıdır.</p>
</footer>
</body>
</html>
