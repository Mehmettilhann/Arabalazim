<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent a Car</title>
    <link rel="stylesheet" href="style-kirala.css">
    <style>
    
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

    <main>
        <div class="filters">
            <select name="vehicle-type" id="vehicle-type">
                <option value="TÜMÜ">TÜMÜ</option>
                <option value="SUV">SUV</option>
                <option value="LUXURY">LUXURY</option>
                <option value="VAN">VAN</option>
                <option value="ECO">ECO</option>
            </select>
            <input type="text" id="search" placeholder="Araba Adı">
            <input type="number" id="min-price" placeholder="Min Fiyat">
            <input type="number" id="max-price" placeholder="Max Fiyat">
            <button onclick="filterCars()">Filtrele</button>
        </div>
        <div class="car-list">
            <?php include 'arac_cagir.php'; ?>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2024 ARABALAZİM. Tüm hakları saklıdır.</p>
    </footer>

    <script>
    function filterCars() {
        
        var selectedType = document.getElementById("vehicle-type").value;
        var searchText = document.getElementById("search").value.toLowerCase();
        var minPrice = parseFloat(document.getElementById("min-price").value);
        var maxPrice = parseFloat(document.getElementById("max-price").value);
        var cars = document.querySelectorAll(".car-detailed");

        cars.forEach(function(car) {
            var carType = car.querySelector("h3:nth-of-type(2)").textContent.split(" ")[2].toLowerCase();
            var carName = car.querySelector("h3").textContent.toLowerCase();
            var carPrice = parseFloat(car.querySelector(".car-fiyat-container p:nth-of-type(2)").textContent.replace("Fiyat: ", "").replace(" TL", ""));
            var typeMatch = (selectedType === "TÜMÜ") || (carType === selectedType.toLowerCase());
            var nameMatch = searchText === "" || carName.includes(searchText);
            var minPriceMatch = isNaN(minPrice) || carPrice >= minPrice;
            var maxPriceMatch = isNaN(maxPrice) || carPrice <= maxPrice;

            if (typeMatch && nameMatch && minPriceMatch && maxPriceMatch) {
                car.style.display = "flex";
            } else {
                car.style.display = "none";
            }
        });
    }
</script>




</body>
</html>