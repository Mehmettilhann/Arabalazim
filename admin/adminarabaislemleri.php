<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="style-admin.css">
</head>
    <body>

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

$query = "SELECT * FROM arabalar";
$result = mysqli_query($connection, $query);

?>
<h2>Arabalar</h2>
<table>
<tr>
<th>ID</th>
<th>Marka</th>
<th>Model</th>
<th>Tur</th>
<th>Yıl</th>
<th>Vites</th>
<th>Yakit</th>
<th>Fiyat</th>
<th>Stok</th>
<th>Resim</th>
<th>İşlemler</th>
</tr>
<?php
// Arabaları tablo şeklinde listele
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['araba_id'] . "</td>";
    echo "<td>" . $row['marka'] . "</td>";
    echo "<td>" . $row['model'] . "</td>";
    echo "<td>" . $row['tur'] . "</td>";
    echo "<td>" . $row['yil'] . "</td>";
    echo "<td>" . $row['vites'] . "</td>";
    echo "<td>" . $row['yakit'] . "</td>";
    echo "<td>" . $row['fiyat'] . "</td>";
    echo "<td>" . $row['stok_adet'] . "</td>";
    echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['araba_resim']) . "' width='120' height='80'></td>";
    // Düzenleme ve silme bağlantıları
    echo "<td><a href='javascript:void(0);' onclick='editCar(" . $row['araba_id'] . ", \"" . $row['marka'] . "\", \"" . $row['model'] . "\", \"" . $row['tur'] . "\", \"" . $row['yil'] . "\", \"" . $row['vites'] . "\", \"" . $row['yakit'] . "\", \"" . $row['fiyat'] . "\", \"" . $row['stok_adet'] . "\", \"" . base64_encode($row['araba_resim']) . "\")'>Düzenle</a> | <a href='javascript:void(0);' onclick='deleteCar(" . $row['araba_id'] . ")'>Sil</a></td>";
    echo "</tr>";
}
echo "</table>";
?>
<h3 class="container2">

<form id='editCarForm' action='admin_araba_guncelle.php' method='post' enctype='multipart/form-data' class="form-container2">
  
 <h3>Araba Düzenle</h3>
<input type='hidden' id='araba_id' name='araba_id' value=''>
  <a class="form-input-container2">Marka: <input type='text' id='marka' name='marka' class='form-inputs2' required></a>
 <a class="form-input-container2">Model: <input type='text' id='model' name='model' class='form-inputs2' required></a>
 <a class="form-input-container2">Tur: <input type='text' id='tur' name='tur' class='form-inputs2' required></a>
 <a class="form-input-container2">Yıl: <input type='number' id='yil' name='yil' class='form-inputs2' required></a>
 <a class="form-input-container2">Vites: <input type='text' id='vites' name='vites' class='form-inputs2' required></a>
 <a class="form-input-container2">Yakıt: <input type='text' id='yakit' name='yakit' class='form-inputs2' required></a>
 <a class="form-input-container2">Fiyat: <input type='number' id='fiyat' name='fiyat' class='form-inputs2' required></a>
 <a class="form-input-container2">Stok Adedi: <input type='number' id='stok_adet' name='stok_adet' class='form-inputs2' required></a>
<img id='preview' src='' alt='Seçilen Araba' width='220' height='120'>
 <a class="form-input-container2">Resim: <input type='file' id='resim' name='resim' class='form-inputs2'></a>
<input type='submit' value='Güncelle'>
</form>


<form id='addCarForm' action='admin_araba_ekle.php' method='post' enctype='multipart/form-data' class="form-container2">
  <h3>Yeni Araç Ekle</h3>
 <a class="form-input-container2">Marka: <input type='text' id='marka' name='marka' class='form-inputs2' required></a>
 <a class="form-input-container2">Model: <input type='text' id='model' name='model' class='form-inputs2' required></a>
 <a class="form-input-container2">Tur: <input type='text' id='tur' name='tur' class='form-inputs2' required></a>
 <a class="form-input-container2">Yıl: <input type='number' id='yil' name='yil' class='form-inputs2' required></a>
 <a class="form-input-container2">Vites: <input type='text' id='vites' name='vites' class='form-inputs2' required></a>
 <a class="form-input-container2">Yakıt: <input type='text' id='yakit' name='yakit' class='form-inputs2' required></a>
 <a class="form-input-container2">Fiyat: <input type='number' id='fiyat' name='fiyat' class='form-inputs2' required></a>
 <a class="form-input-container2">Stok Adedi: <input type='number' id='stok_adet' name='stok_adet' class='form-inputs2'></a>
 <a class="form-input-container2">Resim: <input type='file' id='resim' name='resim' class='form-inputs2' required></a>
<input type='submit' value='Araç Ekle'>
</form>
  </a>
<?php
// Veritabanı bağlantısını kapat
mysqli_close($connection);
?>
</body>
<!-- Seçili aracın bilgilerini textboxlara yazdırma işlemi -->
<script>
    function editCar(id, marka, model, tur, yil, vites, yakit, fiyat, stok_adet, araba_resim) {
        document.getElementById('araba_id').value = id;
        document.getElementById('marka').value = marka;
        document.getElementById('model').value = model;
        document.getElementById('tur').value = tur;
        document.getElementById('yil').value = yil;
        document.getElementById('vites').value = vites; // Vites alanını güncelle
        document.getElementById('yakit').value = yakit; // Yakıt alanını güncelle
        document.getElementById('fiyat').value = fiyat;
        document.getElementById('stok_adet').value = stok_adet;
        document.getElementById('preview').src = 'data:image/jpeg;base64,' + araba_resim; // Resim önizleme alanını güncelle
    }

    function deleteCar(id) {
        if (confirm("Bu aracı silmek istediğinizden emin misiniz?")) {
            window.location.href = "admin_araba_sil.php?id=" + id;
        }
    }
</script>
</html>

