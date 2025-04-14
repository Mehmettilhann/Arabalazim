<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "arabalazim";

// Veritabanı bağlantısı oluştur
$connection = mysqli_connect($servername, $username, $password, $database);

if (!$connection) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

// Anasayfa tablosundan bilgileri çek
$query = "SELECT sliderimg1, sliderimg2, sliderimg3, vizyon, misyon, bizeulas FROM anasayfa WHERE aid = 1";
$result = mysqli_query($connection, $query);

$anasayfa = mysqli_fetch_assoc($result);

mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Web Sayfası</title>
    <link rel="stylesheet" href="arabalazim.css">
    <style>
        /* bg değiceği zman silenecek */body { font-family: Arial, sans-serif; background: #fff; } 
        header { padding:10px 20px; background: #ddd; margin-bottom:10px; }
        .header  { background: #bbb; }
        .section-title { text-align: center; margin-bottom: 20px; }
        .contact-form { float: left; width: 60%; padding: 20px; }
        input, textarea { width: 90%; padding: 10px; margin-top: 5px; }
        button { padding: 10px 20px; background: #333; color: white; border: none; margin-top: 10px; }
        .clearfix { clear: both; }
        .slider { position: relative; width: 100%; max-width: 600px; margin: auto; }
        .slide { display: none; }
        .slide img { width: 100%; }
        .active { display: block; }

        header {
    background-color: #333;
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
}



nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

nav ul li {
    display: inline;
    margin-right: 20px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
}

.user-actions a {
    color: #fff;
    text-decoration: none;
    margin-left: 10px;
}
    </style>
</head>
<body>
       <header>
        <div class="logo">
            <img src="/Arabalazim/logo.png" alt="Rent a Car Logo">
        </div>
        <nav>
            <ul>
                <li><a href="\Arabalazim\Arabalazim.php">Anasayfa</a></li>
                <li><a href="\Arabalazim\arac-kirala\arac_kirala.php">Araç Kirala</a></li>
                <li><a href="#hakkimizdabaslik1">Hakkımızda</a></li>
                <li><a href="#bize_ulas">İletişim</a></li>
                <li><a href="\Arabalazim\arac-kirala\kul_profil.php">Profil</a>
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
            <a href="\Arabalazim\login-register\giris_yap.php">Giriş Yap</a>
            <a href="\Arabalazim\login-register\kayit_ol.php">Kayıt Ol</a>
        </div>
        <?php
        }
        ?>
    </header>
    <div class="slider">
        <div class="slide active"><img src="data:image/jpeg;base64,<?php echo base64_encode($anasayfa['sliderimg1']); ?>" alt="Fotoğraf 1"></div>
        <div class="slide"><img src="data:image/jpeg;base64,<?php echo base64_encode($anasayfa['sliderimg2']); ?>" alt="Fotoğraf 2"></div>
        <div class="slide"><img src="data:image/jpeg;base64,<?php echo base64_encode($anasayfa['sliderimg3']); ?>" alt="Fotoğraf 3"></div>
    </div>
  <div class="neden-biz">
  <div class="container">
    <h1 class="neden-text">Neden Bizi <span style="color:#f4db31;">Seçmelisiniz ?</span></h1>
    <div class="neden-biz_2">
      <div class="dis-container">
        <div class="icerikler">
          <div class="neden_biz_main">
            <div class="yuvarlak">01</div>
            <h2 class="basliklar">İşçilik</h2>
            <p class="aciklama"></p>
            <div class="araba-resim"><img src="calisan.jpg" alt="website template image"></div>
          </div>
        </div>
        <div class="icerikler">
          <div class="neden_biz_main">
            <div class="yuvarlak">02</div>
            <h2 class="basliklar">Yenilikçilik</h2>
            <p class="aciklama"></p>
            <div class="araba-resim"><img src="yenilik.jpg" alt="website template image"></div>
          </div>
        </div>
        <div class="icerikler">
          <div class="neden_biz_main">
            <div class="yuvarlak">03</div>
            <h2 class="basliklar">Müşteri Memnuniyeti</h2>
            <p class="aciklama"></p>
            <div class="araba-resim"><img src="musteri.jpeg" alt="website template image"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="sikayet-container">
<form method="POST" action="contact_us.php" class="demo-form1" >
    <div class="input-wrap">
        <label class="f-title" for="adi_soyadi">Adınız/Soyadınız</label>
        <input type="text" id="adi_soyadi" name="adi_soyadi" class="input" placeholder="Adınız/soyadınız"
            required>
    </div>
    <div class="input-wrap">
        <label class="f-title" for="tel">Telefon Numaranız</label>
        <input type="number" id="tel" name="tel" class="input" placeholder="(5xx)(123 45 67)"
            required>
    </div>
    <div class="input-wrap">
        <label class="f-title" for="email">E-Posta Adresiniz</label>
        <input type="email" id="email" name="email" class="input" placeholder="E-Posta Adresiniz"
            required>
    </div>
  <div class="input-wrap">
        <label class="f-title" for="gender">Şikayet Nedeni</label>
       <select name="subject-type" id="subject-type" class="input">
                        <option value="Genel">Genel</option>
                        <option value="Teknik">Teknik</option>
                        <option value="Ödeme">Ödeme</option>
                        <option value="Arıza">Arıza</option>
                        <option value="Şikayet">Şikayet</option>
                    </select>
    </div>
    <div class="input-wrap">
        <textarea name="message" id="message" class="textarea"></textarea>
    </div>
    <input type="submit" id="submit" name="submit" value="FORMU GÖNDER">
</form>
  </div>
<section>    <!-- Hakkımızda Tasarımı -->
        <div class="hakkimizda" >
        <header class="HakkimizdaBaslik">
            <h1 id="hakkimizdabaslik1">Hakkımızda</h1>
        </header>        
           <div id="misyon">
                <h1>Misyonumuz</h1>
                <hr width="100%">
                <p id="misyonyazi"><?php echo htmlspecialchars($anasayfa['vizyon']); ?></p>
            </div> 
            <div id="vizyon">
                <h1>Vizyonumuz</h1>
                <hr width="100%">
        <p id="vizyonyazi"><?php echo htmlspecialchars($anasayfa['misyon']); ?></p>
            </div>
         <div id="vizyon">
                <h1 id= "bize_ulas" >Bize Ulaşın</h1>
                <hr width="100%">
        <p id="vizyonyazi"><?php echo htmlspecialchars($anasayfa['bizeulas']); ?></p>
        
        <div class="maps">
        <div> <!-- GoogleMaps konumu ile harita ekleme -->
            <h3>Genel Merkez</h3>
            İstanbul Türkiye <br>
            <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d385403.38497561915!2d28.389091810177387!3d41.0041623452353!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14caa7040068086b%3A0xe1ccfe98bc01b0d0!2zxLBzdGFuYnVs!5e0!3m2!1str!2str!4v1702685898469!5m2!1str!2str" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
            </div>
            </div>
            <div id="bosluk1"></div>
        </div>
    </section>
<section>
    <footer>
        &copy; 2024 ARABALAZİM. Tüm Hakları Saklıdır.
    </footer>
    <script>
        var currentSlide = 0;
        var slides = document.querySelectorAll('.slide');

        function showSlides() {
            for (var i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            currentSlide++;
            if (currentSlide > slides.length) {currentSlide = 1}    
            slides[currentSlide-1].style.display = "block";  
            setTimeout(showSlides, 3000); // Change image every 3 seconds
        }

        showSlides();
    </script>
</body>
</html>