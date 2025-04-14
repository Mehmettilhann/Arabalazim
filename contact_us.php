<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "arabalazim";

$connection = mysqli_connect($servername, $username, $password, $database);

if (!$connection) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

if ($_POST) {
    $adi_soyadi = $_POST['adi_soyadi'];
    $konu = $_POST['subject-type'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $mesaj = $_POST['message'];

    $query = "INSERT INTO iletisim(ad_soyad, konu, telefon, mail, mesaj) VALUES ('$adi_soyadi', '$konu', '$tel', '$email', '$mesaj')";

    if (mysqli_query($connection, $query)) {
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'arabalazimpanel@gmail.com';
        $mail->Password = 'whcj guht owek sthp';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->CharSet = 'UTF-8'; // Karakter setini UTF-8 olarak ayarla
        $mail->setFrom($email, $adi_soyadi); // Kullanıcının mail adresi ve adı
        $mail->addAddress('arabalazimpanel@gmail.com'); // Sizin mail adresiniz
        $mail->addReplyTo($email, $adi_soyadi);

        $mail->isHTML(true);
        $mail->Subject = 'Bize Ulaşın Formu: ' . $konu;
        $mail->Body = "
            <h3>Yeni bir mesaj alındı:</h3>
            <p><strong>Adı Soyadı:</strong> {$adi_soyadi}</p>
            <p><strong>Telefon:</strong> {$tel}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Mesaj:</strong> {$mesaj}</p>
        ";

        if ($mail->send()) {
            echo "<script>alert('Mesajınız başarıyla iletildi!');
            setTimeout(function() {
                window.location.href = 'Arabalazim.php'; // Yönlendiriliyor
            }, 500);</script>";
        } else {
            echo "Mail gönderilirken bir hata oluştu: " . $mail->ErrorInfo;
        }
    } else {
        echo "Hata: " . $query . "<br>" . mysqli_error($connection);
    }
} else {
    die("Gönderilemedi!");
}

mysqli_close($connection);
?>
