<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// Veritabanı bağlantısını oluşturma
$servername = "127.0.0.1";
$username = "root";
$password = "";  // Veritabanınız şifre gerektiriyorsa buraya yazın, yoksa boş bırakın
$database = "arabalazim";

$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$email = $_POST['email'];

// Kullanıcının şifresini güvenli bir şekilde veritabanından çekme
$query = "SELECT sifre FROM uyeler WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $gideceksifre = $row['sifre'];

    $mail = new PHPMailer(true);
    try {
        // Server ayarları
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Host = "smtp.gmail.com";
        $mail->Username = "arabalazimpanel@gmail.com";
        $mail->Password = "whcj guht owek sthp";  // Gerçek parola ile değiştirin

        // Alıcı ayarları
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('arabalazimpanel@gmail.com', 'Arabalazim Panel');
        $mail->addAddress($email);

        // İçerik ayarları
        $mail->isHTML(true);
        $mail->Subject = "Hatırlatma Maili";
        $mail->Body = "Şifreniz: " . $gideceksifre;

        $mail->send();
        echo "Şifreniz e-posta adresinize gönderildi.";
    } catch (Exception $e) {
        echo "E-posta gönderilemedi. Mailer Error: " . $mail->ErrorInfo;
    }
} else {
    echo "Bu e-posta ile kayıtlı bir kullanıcı bulunamadı.";
}

$conn->close();

header('Location:\Arabalazim\Arabalazim.php');

?>
