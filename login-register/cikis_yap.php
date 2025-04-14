<?php
// Oturumu başlat
session_start();

// Eğer kullanıcı giriş yapmışsa ve çıkış yap butonuna basılmışsa
if (isset($_COOKIE['kullanici_id'])) {
    // Oturum bilgilerini sil (Cookie'yi sil)
    setcookie("kullanici_id", "", time() - 3600, "/"); // Cookie'yi geçersizleştir
    setcookie("ad", "", time() - 3600, "/");
    setcookie("soyad", "", time() - 3600, "/");
    setcookie("email", "", time() - 3600, "/");
    
    // Kullanıcıyı çıkış yaptıktan sonra anasayfaya yönlendir
    header("Location: /Arabalazim/Arabalazim.php");
    exit;
}
?>
