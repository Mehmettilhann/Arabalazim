<?php



// Veritabanı bağlantısı için gerekli bilgiler
$servername = "localhost"; // Sunucu adı
$username = "root"; // Kullanıcı adı
$password = ""; // Şifre
$database = "arabalazim"; // Veritabanı adı

// Veritabanı bağlantısını oluştur
$connection = mysqli_connect($servername, $username, $password, $database);

// Bağlantı kontrolü
if (!$connection) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

// Formdan gelen verileri al
$ad = $_POST['ad'];
$soyad = $_POST['soyad'];
$email = $_POST['email'];
$sifre = $_POST['sifre'];

// E-posta adresinin benzersiz olup olmadığını kontrol et
$email_check_query = "SELECT * FROM uyeler WHERE email='$email'";
$result = mysqli_query($connection, $email_check_query);
$email_count = mysqli_num_rows($result);

if ($email_count > 0) {
    ?>
        <script>alert("Bu email zaten kullanımda");
            setTimeout(function() {
            window.location.href = "adminpanel.php"; // Yönlendiriliyor
            }, 500);
        </script>
    <?php
} else {
    // Eğer e-posta benzersizse, üye ekleme işlemini gerçekleştir
    $query = "INSERT INTO uyeler (ad, soyad, email, sifre) VALUES ('$ad', '$soyad', '$email', '$sifre')";

    if (mysqli_query($connection, $query)) {
        ?>
        <script>alert("Yeni üye başarıyla eklendi");
        setTimeout(function() {
            window.location.href = "adminpanel.php"; // Yönlendiriliyor
            }, 500);</script>
        <?php
    } else {
        echo "Hata: " . $query . "<br>" . mysqli_error($connection);
    }
}

// Veritabanı bağlantısını kapat
mysqli_close($connection);
?>
