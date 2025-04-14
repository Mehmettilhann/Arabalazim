<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yorum Yap</title>
    <link rel="stylesheet" href="yorum-kaydet.css">
</head>
<body>
    <?php
    session_start();
    $araba_id = $_SESSION['araba_id']; // Araba ID'yi session'dan çek
    $uye_id = $_COOKIE['kullanici_id']; // Kullanıcı ID'yi cookie'den çek
    ?>
    <form action="yorum_kaydet.php" class="demo-form1" method="post">
  <div class="title-container">
   <label class="title" for="kart-numarasi">Araç Kiralama Deneyiminizi Puanlayınız</label>
  </div>
   <div class="input-wrap">
     <label class="f-title" for="email">Yorumunuz</label>
        <textarea id="yorum" name="yorum" required class="textarea"></textarea>
    </div>
  <div class="input-wrap">
        <label class="f-title" for="kart-numarasi">Puan</label>
        <input type="number" id="puan" name="puan" min="1" max="5" required class="input">
    </div>
     <input type="hidden" name="araba_id" value="<?php echo $araba_id; ?>">
    <input type="hidden" name="uye_id" value="<?php echo $uye_id; ?>">
    <input type="submit" id="submit" name="submit" value="Öde">

</form>
    
</body>
</html>
