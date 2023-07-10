<?php
/**
 * Bu sayfa kullanıcılar için giriş sayfasıdır ve kullanıcılar bu sayfadan uygulamaya giriş yaparlar.
 */
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once 'layout/head.php'; ?> <!-- Burada head.php dosyasını çağırdık. -->
</head>
<body>
    <!-- Burası giriş sayfası içeriği -->
    <div class="container">
        <main class = "form-main">
            <!-- Hata mesajı varsa göster -->
            <?php include 'layout/error.php'; ?>

            <div class="form-container">
                <div class="image"></div> <!-- Bu div içerisindeki resim, CSS ile ayarlanmıştır. -->

                <!-- Giriş formu -->
                <div class="form">
                    <h1>Giriş Yap</h1>
                    <form action="./connector/Connector.php" method="POST">
                        <div class="form-group">
                            <label for="email">E-Posta</label>
                            <input type="email" id="email" name="email" placeholder="hamid@example.com" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Parola</label>
                            <input type="password" id="password" name="password"  autocomplete="new-password" required>
                        </div>
                        <input type="hidden" name="action" value="login">
                        <div class="form-group">
                            <button type="submit">Oturum Aç</button>
                        </div>
                        <div class = "form-text">
                            <span>Üye değil misin? <a href="register.php" class = "register-link">Bize Katıl!</a></span>
                        </div>
                    </form>
                </div>
                <!-- Giriş formu bitti -->
            </div>
        </main>
    </div>
    <!-- Burada giriş sayfası içeriği bitti -->
</body>
</html>