<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
    <link rel="stylesheet" href="style-admin.css">
</head>
<body>
    <header>
        <nav class="admintus">
            <a href="/Arabalazim/admin/adminpanel.php">ADMİN PANEL</a>
        </nav>
        <div class="user-actions">
        <a href="/Arabalazim/Arabalazim.php">Çıkış Yap</a>
    </div>
    </header>
    <div class="container">
        <div class="menu">
        <p> Menu </p>
            <a href="#anasayfa" onclick="showContent('anasayfa');">Anasayfa İşlemleri</a>
            <a href="#uyeler" onclick="showContent('uyeler');">Üye İşlemleri</a>
            <a href="#arabalar" onclick="showContent('arabalar');">Araba İşlemleri</a>
        </div>
        <!-- Anasayfa İşlemleri İçeriği -->
        <div class="content">
            <div id="anasayfa" class="content-item">
                <h2>Anasayfa İşlemleri</h2>
                <?php
                    include 'adminanasayfaislemleri.php';
                ?>
            </div>

            <!-- Üye İşlemleri İçeriği -->
            <div id="uyeler" class="content-item">
                <h2>Üye İşlemleri</h2>
                <?php
                    include 'adminuyeislemleri.php';
                ?>
            </div>
            
            <!-- Araba İşlemleri İçeriği -->
            <div id="arabalar" class="content-item">
                <h2>Araba İşlemleri</h2>
                <?php
                    include 'adminarabaislemleri.php';
                ?>
            </div>
            
            <!-- Diğer işlemler için benzer içerikler eklenebilir -->
        </div>
    </div>

    <script> function showContent(id) {
            var contents = document.getElementsByClassName('content-item');
            for (var i = 0; i < contents.length; i++) {
                contents[i].style.display = 'none'; // Tüm içerikleri gizle
            }
            document.getElementById(id).style.display = 'block'; // İlgili içeriği göster
    }</script>
</body>
</html>
