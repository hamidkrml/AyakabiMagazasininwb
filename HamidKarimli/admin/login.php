<?php
/**
 * Bu sayfa yöneticiler için giriş sayfasıdır ve yöneticiler bu sayfadan yönetim paneline giriş yaparlar.
 */
?>

<!doctype html>
<html lang="en">
<head>
    <?php require_once './layout/head.php'; ?> <!-- Burada head.php dosyasını çağırdık. -->
</head>
<body>
    <!-- Burası giriş sayfası içeriği -->
    <div class="container">
        <main class = "form-main">
            <!-- Hata mesajı varsa göster -->
            <?php include 'layout/error.php'; ?>

            <div class="form-container">
                <div class="image"></div> <!-- Burada giriş sayfası için bir resim koyduk. -->

                <!-- Yönetici giriş formu -->
                <div class="form">
                    <h1>Yönetici Panel</h1>
                    <form action="../connector/Connector.php" method="POST">
                        <div class="form-group">
                            <label for="username">Kullanıcı Adı</label>
                            <input type="text" id=username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Parola</label>
                            <input type="password" id="password" name="password" autocomplete="new-password" required>
                        </div>
                        <input type="hidden" name="action" value="admin-login">
                        <div class="form-group">
                            <button type="submit">Oturum Aç</button>
                        </div>
                    </form>
                </div>
                <!-- Yönetici giriş formu bitti -->
            </div>
        </main>
    </div>
    <!-- Burada giriş sayfası içeriği bitti -->
</body>
</html>