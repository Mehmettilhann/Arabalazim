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

// Anasayfa bilgilerini çek
$query = "SELECT * FROM anasayfa WHERE aid = 1"; // aid = 1 olan satırı çekiyoruz
$result = mysqli_query($connection, $query);

$anasayfa = mysqli_fetch_assoc($result);

// Form gönderildiyse güncelle
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vizyon = $_POST['vizyon'];
    $misyon = $_POST['misyon'];
    $bizeulas = $_POST['bizeulas'];

    if (isset($_FILES['sliderimg1']['tmp_name']) && $_FILES['sliderimg1']['tmp_name'] != "") {
        $sliderimg1 = addslashes(file_get_contents($_FILES['sliderimg1']['tmp_name']));
        $query = "UPDATE anasayfa SET sliderimg1='$sliderimg1' WHERE aid = 1";
        mysqli_query($connection, $query);
    }

    if (isset($_FILES['sliderimg2']['tmp_name']) && $_FILES['sliderimg2']['tmp_name'] != "") {
        $sliderimg2 = addslashes(file_get_contents($_FILES['sliderimg2']['tmp_name']));
        $query = "UPDATE anasayfa SET sliderimg2='$sliderimg2' WHERE aid = 1";
        mysqli_query($connection, $query);
    }

    if (isset($_FILES['sliderimg3']['tmp_name']) && $_FILES['sliderimg3']['tmp_name'] != "") {
        $sliderimg3 = addslashes(file_get_contents($_FILES['sliderimg3']['tmp_name']));
        $query = "UPDATE anasayfa SET sliderimg3='$sliderimg3' WHERE aid = 1";
        mysqli_query($connection, $query);
    }

    $query = "UPDATE anasayfa SET vizyon='$vizyon', misyon='$misyon', bizeulas='$bizeulas' WHERE aid = 1";
    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Anasayfa bilgileri başarıyla güncellendi.');
        setTimeout(function() {
            window.location.href = '/Arabalazim/admin/adminpanel.php'; // Yönlendiriliyor
            }, 500);</script>";
    } else {
        echo "Bilgiler güncellenirken bir hata oluştu: " . mysqli_error($connection);
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Anasayfa Bilgilerini Güncelle</title>
</head>
<body>
    <h2>Anasayfa Bilgilerini Güncelle</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="sliderimg1">Slider Resim 1:</label>
        <input type="file" id="sliderimg1" name="sliderimg1"><br>
        <?php if (!empty($anasayfa['sliderimg1'])): ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($anasayfa['sliderimg1']); ?>" alt="Slider Resim 1" style="width:100px;height:100px;"><br>
        <?php endif; ?>
        <br>
        <label for="sliderimg2">Slider Resim 2:</label>
        <input type="file" id="sliderimg2" name="sliderimg2"><br>
        <?php if (!empty($anasayfa['sliderimg2'])): ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($anasayfa['sliderimg2']); ?>" alt="Slider Resim 2" style="width:100px;height:100px;"><br>
        <?php endif; ?>
        <br>
        <label for="sliderimg3">Slider Resim 3:</label>
        <input type="file" id="sliderimg3" name="sliderimg3"><br>
        <?php if (!empty($anasayfa['sliderimg3'])): ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($anasayfa['sliderimg3']); ?>" alt="Slider Resim 3" style="width:100px;height:100px;"><br>
        <?php endif; ?>
        <br>
        <label for="vizyon">Vizyon:</label>
        <textarea id="vizyon" name="vizyon"><?php echo htmlspecialchars($anasayfa['vizyon']); ?></textarea><br><br>
        <label for="misyon">Misyon:</label>
        <textarea id="misyon" name="misyon"><?php echo htmlspecialchars($anasayfa['misyon']); ?></textarea><br><br>
        <label for="bizeulas">Bize Ulaş:</label>
        <textarea id="bizeulas" name="bizeulas"><?php echo htmlspecialchars($anasayfa['bizeulas']); ?></textarea><br><br>
        <button type="submit">Güncelle</button>
    </form>
</body>
</html>
