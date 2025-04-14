<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Araba Detayı</title>
    <link rel="stylesheet" href="arac_detayy.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="/Arabalazim/logo.png" alt="Arabalazim Logo">
        </div>
        <nav>
            <ul>
                <li><a href="/Arabalazim/Arabalazim.php">Anasayfa</a></li>
                <li><a href="/Arabalazim/arac-kirala/arac_kirala.php">Araç Kirala</a></li>
                <li><a href="/Arabalazim/Arabalazim.php#hakkimizdabaslik1">Hakkımızda</a></li>
                <li><a href="/Arabalazim/Arabalazim.php#bize_ulas">İletişim</a></li>
                <li><a href=kul_profil.php>Profil</a>
            </ul>
        </nav>
<?php
    // Oturumu başlat
    session_start();

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
        <a href="/Arabalazim/login-register/giris_yap.php">Giriş Yap</a>
        <a href="/Arabalazim/login-register/kayit_ol.php">Kayıt Ol</a>
    </div>
<?php
}
?>
    </header>

    <main>
        <div class="car-details">
            <?php include 'arac_detay_cek.php'; ?>
        </div>
        <script>
            // Sayfa yüklendiğinde ve gün seçimi yapıldığında otomatik olarak hesaplamayı yapalım
            window.onload = function() 
            {
            calculatePrice();
            }
            document.getElementById("gun").addEventListener("change", function() {
            calculatePrice();
            });
        </script>
    </main>

    <footer>
        <p>&copy; 2024 ARABALAZİM. Tüm hakları saklıdır.</p>
    </footer>

    <script>
        function calculatePrice() {
        var gun = document.getElementById("gun").value;
        var gunlukFiyat = parseFloat(<?php echo $gunlukFiyat; ?>);
        var fiyat = (gunlukFiyat / 3) * gun; // Güncel fiyatı hesapla

        var indirimOrani = 0;
        var indirimliFiyat = fiyat;

        if (gun == 7) {
            indirimOrani = 5;
        } else if (gun == 15) {
            indirimOrani = 7.5;
        } else if (gun == 30) {
            indirimOrani = 10;
        }

        if (indirimOrani > 0) {
            var indirimMiktari = fiyat * indirimOrani / 100;
            indirimliFiyat = fiyat - indirimMiktari;
        }

        var hesaplafiyat = "";
        if (indirimOrani > 0) {
            hesaplafiyat += "<del>" + fiyat.toFixed(2) + " TL</del><br>";
            hesaplafiyat += "İndirim Oranı: %" + indirimOrani.toFixed(2) + "<br>";
        }
        hesaplafiyat += "Toplam Fiyat: " + indirimliFiyat.toFixed(2) + " TL";

        document.getElementById("fiyat").innerHTML = hesaplafiyat;
        
        document.getElementById("toplamFiyat").value = indirimliFiyat;
}
    </script>


    
    

    <script>
        function checkLoginAndRedirect() {
            // Oturum açılmış mı kontrol et
            var isLoggedIn = <?php echo isset($_COOKIE['kullanici_id']) ? 'true' : 'false'; ?>;
            if (!isLoggedIn) {
                // Oturum açılmamışsa, giriş yap sayfasına yönlendir
                window.location.href = "/Arabalazim/login-register/giris_yap.php";
            } else {
                // Oturum açılmışsa, kiralama formuna yönlendir
                window.location.href = "kiralama_formu.php";
            }
        }
    </script>


</body>
</html>
