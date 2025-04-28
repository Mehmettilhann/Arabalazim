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

$query = "SELECT * FROM uyeler";
$result = mysqli_query($connection, $query);

// Tablo başlığı
echo "<h2>Üyeler</h2>";
echo "<table border='1'>
<tr>
<th>ID</th>
<th>Ad</th>
<th>Soyad</th>
<th>E-posta</th>
<th>Şifre</th>
<th>Kayıt Tarihi</th>
<th>İşlemler</th>
</tr>";

// Üyeleri tablo şeklinde listele
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['uye_id'] . "</td>";
    echo "<td>" . $row['ad'] . "</td>";
    echo "<td>" . $row['soyad'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['sifre'] . "</td>";
    echo "<td>" . $row['kayit_tarihi'] . "</td>";
    // Düzenleme ve silme bağlantıları
    echo "<td><a class='updateBtn' href='javascript:void(0);' onclick='editMember(" . $row['uye_id'] . ", \"" . $row['ad'] . "\", \"" . $row['soyad'] . "\", \"" . $row['email'] . "\", \"" . $row['sifre'] . "\")'>Düzenle</a><a class='silBtn' href='javascript:void(0);' onclick='deleteMember(" . $row['uye_id'] . ")'>Sil</a></td>";
    echo "</tr>";
}
echo "</table>";

// Üye düzednleme formu
echo "<h3 style='display:inline-block; width:42%;'>Üye Düzenle</h3>";
echo "<h3 style='display:inline-block; width:45%;'>Yeni Üye Ekle</h3>";

echo "<br><br>";

echo "<form id='editForm' action='admin_uye_guncelle.php' method='post' style='display:inline-block;width:40%;margin-right: 20px;background-color: #e9e9f1;padding-left: 10px;padding-right: 10px;padding-bottom: 10px;padding-top: 10px;border: groove;border-radius: 15px;box-shadow: 0px 8px 30px 5px 
#000000;'>";
echo "<input type='hidden' id='uye_id' name='uye_id' value=''>";
echo "Ad: <input type='text' id='ad' name='ad' class='form-inputs' required><br><br>";
echo "Soyad: <input type='text' id='soyad' name='soyad' class='form-inputs' required><br><br>";
echo "E-posta: <input type='email' id='email' name='email' class='form-inputs' required><br><br>";
echo "Şifre: <input type='password' id='sifre' name='sifre' class='form-inputs' required><br><br>";
echo "<input class='updateBtn' type='submit' value='Güncelle'>";
echo "</form>";

echo "<form id='addForm' action='admin_uye_ekle.php' method='post' style='display: inline-block;width: 40%;margin-right: 20px;background-color: #e9e9f1;padding-left: 10px;padding-right: 10px;padding-bottom: 10px;padding-top: 10px;border: groove;border-radius: 15px;box-shadow: 0px 8px 30px 5px #000000;'>";
echo "Ad: <input type='text' id='ad' name='ad' class='form-inputs' required><br><br>";
echo "Soyad: <input type='text' id='soyad' name='soyad' class='form-inputs' required><br><br>";
echo "E-posta: <input type='email' id='email' name='email' class='form-inputs' required><br><br>";
echo "Şifre: <input type='password' id='sifre' name='sifre' class='form-inputs' required><br><br>";
echo "<input class='updateBtn' type='submit' value='Üye Ekle'>";
echo "</form>";

 
// Veritabanı bağlantısını kapat
mysqli_close($connection);
?>

<!-- Seçili üyenin bilgilerini textboxlara yazdırma işlemi -->
<script>
    function editMember(id, ad, soyad, email, sifre) {
        alert("Seçilen ID:" + id);
        document.getElementById('uye_id').value = id;
        document.getElementById('ad').value = ad;
        document.getElementById('soyad').value = soyad;
        document.getElementById('email').value = email;
        document.getElementById('sifre').value = sifre;
    }

    function deleteMember(id) {
        if (confirm("Bu üyeyi silmek istediğinizden emin misiniz?")) {
            window.location.href = "admin_uye_sil.php?id=" + id;
        }
    }
</script>
