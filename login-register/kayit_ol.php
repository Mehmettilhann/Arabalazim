<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="style-kayit.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="/Arabalazim/logo.png" alt="Rent a Car Logo">
        </div>
        <nav>
            <ul>
                <li><a href="/Arabalazim/Arabalazim.php">Anasayfa</a></li>
                <li><a href="/Arabalazim/arac-kirala/arac_kirala.php">Araç Kirala</a></li>
                <li><a href="/Arabalazim/Arabalazim.php#hakkimizdabaslik1">Hakkımızda</a></li>
                <li><a href="/Arabalazim/Arabalazim.php#bize_ulas">İletişim</a></li>
            </ul>
        </nav>
        <div class="user-actions">
            <a href="giris_yap.php">Giriş Yap</a>
            <a href="kayit_ol.php">Kayıt Ol</a>
        </div>
    </header>

    <main>
        <form action="kayit_islemi.php" method="post" class="signin">
    <div class="content"> 
     <h2>Kayıt Ol</h2> 
     <div class="form"> 
      <div class="inputBox"> 
       <input  type="text" id="ad" name="ad" required> <i>Ad</i> 
      </div> 
        <div class="inputBox"> 
       <input  type="text" id="soyad" name="soyad" required> <i>Soyad</i> 
      </div> 
        <div class="inputBox"> 
       <input type="email" id="email" name="email" required> <i>E-Posta</i> 
      </div> 
      <div class="inputBox"> 
       <input type="password" id="sifre" name="sifre" required> <i>Şifre</i> 
      </div> 
      <div class="links"> <a href="#"></a> <a href="giris_yap.php">Giriş Yap</a> 
      </div> 
      <div class="inputBox"> 
       <input type="submit" value="Kayıt Ol"> 
      </div> 
     </div> 
    </div> 
   </form> 
    </main>

    <footer>
        <p>&copy; 2024 ARABALAZİM. Tüm hakları saklıdır.</p>
    </footer>
</body>
</html>
