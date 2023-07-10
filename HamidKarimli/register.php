<?php
/**
 * Bu sayfa kullanıcılar için kayıt sayfasıdır ve kullanıcılar bu sayfadan uygulamaya kayıt olurlar.
 */
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once 'layout/head.php'; ?> <!-- Burada head.php dosyasını çağırdık. -->
</head>
<body>
<!-- Burası kayıt sayfası içeriği -->
<div class="container">
    <main class = "form-main">
        <!-- Hata mesajı varsa göster -->
        <?php include 'layout/error.php'; ?>

        <div class="form-container">
            <div class="image"></div> <!-- Bu div içerisindeki resim, CSS ile ayarlanmıştır. -->

            <!-- Kayıt formu -->
            <div class="form">
                <h1>Kayıt Ol</h1>
                <form action="./connector/Connector.php" method="POST">
                    <div class="form-group form-inline">
                        <div class = "form-normal">
                            <label for="name">İsim</label>
                            <input type="text" id="name" name="name" placeholder="Hamid" required>
                        </div>
                        <div class = "form-normal">
                            <label for="surname">Soyisim</label>
                            <input type="text" id="surname" name="surname" placeholder="Karimli" required>
                        </div>
                    </div>
                    <div class = "form-group">
                        <label for="phone">Telefon</label>
                        <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}" placeholder="555-555-55-55" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-Posta</label>
                        <input type="email" id="email" name="email" placeholder="hamid@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Parola</label>
                        <input type="password" id="password" name="password" autocomplete="new-password" required>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Parola Doğrula</label>
                        <input type="password" id="password-confirm" name="password-confirm" autocomplete="new-password" required>
                    </div>
                    <input type="hidden" name="action" value="register">
                    <div class="form-group">
                        <button type="submit">Oluştur</button>
                    </div>
                    <div class = "form-text">
                        <span>Zaten üye misin? <a href="login.php" class = "register-link">Giriş yap</a></span>
                    </div>
                </form>
            </div>
            <!-- Kayıt formu bitti -->
        </div>
    </main>
</div>
<!-- Burada kayıt sayfası içeriği bitti -->

</body>
</html>