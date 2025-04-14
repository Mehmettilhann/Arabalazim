<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Araç Listesi</title>
    <style>
        .car-detailed {
            display: flex;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            width: 80%;
            align-self: flex-end;
            background-color: white;
        }
        .car-detailed img {
            width: 100%;
            height: auto;
        }
        .car-img-container {
            width: 30%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .car-img-container img {
            width: 100%;
            max-width: 760px;
            height: auto;
        }
        .car-info-container {
            width: 40%;
            padding-left: 20px;
        }
        .car-fiyat-container {
            width: 30%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            background-color: #F5F6FA;
        }
        .kirala-btn {
            background-color: #0068f4;
            height: 42px;
            width: 250px;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "arabalazim";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

$vehicleType = isset($_GET['vehicle-type']) ? $_GET['vehicle-type'] : 'TÜMÜ';
$fuelType = isset($_GET['fuel-type']) ? $_GET['fuel-type'] : 'TÜMÜ';
$transmissionType = isset($_GET['transmission-type']) ? $_GET['transmission-type'] : 'TÜMÜ';
$minPrice = isset($_GET['min-price']) ? $_GET['min-price'] : 0;
$maxPrice = isset($_GET['max-price']) ? $_GET['max-price'] : PHP_INT_MAX;
$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT arabalar.*, (SELECT COUNT(*) FROM yorumlar WHERE yorumlar.araba_id = arabalar.araba_id) AS yorum_sayisi, (SELECT AVG(puan) FROM yorumlar WHERE yorumlar.araba_id = arabalar.araba_id) AS ortalama_puan FROM arabalar WHERE stok_adet > 0";

if ($vehicleType !== 'TÜMÜ') {
    $sql .= " AND tur = '$vehicleType'";
}

if ($fuelType !== 'TÜMÜ') {
    $sql .= " AND yakit = '$fuelType'";
}

if ($transmissionType !== 'TÜMÜ') {
    $sql .= " AND vites = '$transmissionType'";
}

if (!empty($search)) {
    $sql .= " AND (marka LIKE '%$search%' OR model LIKE '%$search%')";
}

$sql .= " AND fiyat >= $minPrice AND fiyat <= $maxPrice";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='car-detailed'>";
        echo "<div class='car-img-container'>";
        echo "<h3>" . $row["marka"] . " " . $row["model"] . "</h3>";
        echo "<h3> " . $row["tur"] . "</h3>";
        echo "<img src='data:image/jpg;base64," . base64_encode($row["araba_resim"]) . "' alt='Araba Resmi'>";
        echo "</div>";
        echo "<div class='car-info-container'>";
        echo "<div style='width: 95%; display: flex; justify-content: flex-end;'>";
        echo "<p style='width: 40px; height: 40px; border: 1px solid black; display: flex; justify-content: center; align-items: center; border-radius: 5px; color: white; background-color: #0068F4;'>" . number_format((float)$row["ortalama_puan"], 1, '.', '') . "</p>";
        echo "</div>";
        echo "<div style='width: 95%; text-align: right;'>";
        echo "<p style='color: gray'>" . $row["yorum_sayisi"] . " Yorum</p>";
        echo "</div>";
        echo "<div style='width: 100%; height: 50%; align-content: center;'>";
        echo "<p>Yıl: " . $row["yil"] . "</p>";
        echo "<p>Yakıt: " . $row["yakit"] . "</p>";
        echo "<p>Vites: " . $row["vites"] . "</p>";
        echo "</div>";
        echo "</div>";
        echo "<div class='car-fiyat-container'>";
        echo "<p style='color: gray'>Toplam Fiyat: (3 Gün)</p>";
        echo "<p>Fiyat: " . $row["fiyat"] . " TL</p>";
        echo "<form action='arac_detay.php' method='post'>";
        echo "<input type='hidden' name='araba_id' value='" . $row["araba_id"] . "'>";
        echo "<button type='submit' class='kirala-btn'>Kirala</button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>Veritabanında araç bulunamadı.</p>";
}

$conn->close();
?>
</body>
</html>
